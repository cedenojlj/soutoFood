<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CartItem extends Component
{
   
   public $product;

   public $finalprice=0;

   public $subtotal=0;

   public $notes=0;   

   public $price;

   public $amount;

   public $qtyone;

   public $qtytwo;

   public $qtythree;

   public $errores='';

   public $date1;

   public $date2;

   public $date3;



   protected $rules = [

    'amount' => 'required',
    'qtyone' => 'required',

];



   
    public function mount(Product $product)
    {
        $this->price = $product->price;

        $user=User::find(Auth::id());

        $this->date1= Carbon::createFromFormat('Y-m-d', $user->date1)->format('m/d/Y');    

        $this->date2= Carbon::createFromFormat('Y-m-d', $user->date2)->format('m/d/Y'); 

        $this->date3= Carbon::createFromFormat('Y-m-d', $user->date3)->format('m/d/Y'); 


        $carrito = session()->get('carrito');

        if ($carrito) {

            if (Arr::exists($carrito, $this->product->id)) {

                $this->amount = $carrito[$this->product->id]['amount'];
                $this->notes = $carrito[$this->product->id]['notes'];
                $this->qtyone = $carrito[$this->product->id]['qtyone'];
                $this->qtytwo = $carrito[$this->product->id]['qtytwo'];
                $this->qtythree = $carrito[$this->product->id]['qtythree'];  
                $this->finalprice = (float) $this->price - $this->notes;
                $this->subtotal = (float) $this->amount * $this->finalprice; 
            }           
            
        }


    }


    public function updatedAmount()
    {

                      
        if ($this->amount < 0) {           
           
            $this->reset('amount');

            $this->errores = 'The quantity must be greater than zero';
        }

        if ($this->amount >= 0) {
           
            $this->errores = '';

            $this->finalprice = (float) $this->price - $this->notes;

            $this->subtotal = (float) $this->amount * $this->finalprice;
        }


    }


    public function updatednotes()
   {    
       
        if ($this->notes > 0 && $this->notes < $this->price ) {

            $this->errores = '';  
            
            $this->finalprice = (float) $this->price - (float) $this->notes;

            $this->subtotal = (float) $this->amount * $this->finalprice;
            
        }else{ 
            
            $this->notes='';

            $this->finalprice = (float) $this->price;

            $this->subtotal = (float) $this->amount * (float) $this->price;
            
           /*  $this->errores = 'The quantity must be greater than zero and The discount must be less than the price'; */

        }
                 
   }


    public function updatedQtyone()
    {
        if ($this->qtyone < 0) {

            $this->reset('qtyone');

            $this->errores = 'The quantity must be greater than zero';
        }

        if ($this->qtyone > $this->amount) {

            $this->qtyone=$this->amount;            
        }
        
    }


    public function updatedQtytwo()
    {
        if ($this->qtytwo < 0) {

            $this->reset('qtytwo');

            $this->errores = 'The quantity must be greater than zero';
        }        
        
    }

    public function updatedQtythree()
    {
        if ($this->qtythree < 0) {

            $this->reset('qtythree');

            $this->errores = 'The quantity must be greater than zero';
        }        
        
    }


    public function submit()
    {
        
        $this->validate();


        if (!$this->notes or $this->notes < 0 ) {

            $this->notes= 0;            
        }

        if (!$this->qtytwo) {

            $this->qtytwo= 0;            
        }

        if (!$this->qtythree) {

            $this->qtythree= 0;            
        }

        
        $this->finalprice = $this->price - $this->notes;


        $sumaParcial = $this->qtyone + $this->qtytwo + $this->qtythree;

        if ($this->amount == $sumaParcial) {


            $item = [

                $this->product->id => [
    
                    'id'=>$this->product->id,
                    'name'=>$this->product->name,
                    'price'=>$this->product->price,
                    'amount' => $this->amount,
                    'notes' => $this->notes,
                    'qtyone' => $this->qtyone,
                    'qtytwo' => $this->qtytwo,
                    'qtythree' => $this->qtythree,                
                    'finalprice' => $this->finalprice,
                ]
    
            ];   

            $carrito = session()->get('carrito');

            if (!$carrito) {


                session()->put('carrito', $item);

                
            } else {               
    
                    $carrito[$this->product->id] = [
    
                        'id'=>$this->product->id,
                        'name'=>$this->product->name,
                        'price'=>$this->product->price,
                        'amount' => $this->amount,
                        'notes' => $this->notes,
                        'qtyone' => $this->qtyone,
                        'qtytwo' => $this->qtytwo,
                        'qtythree' => $this->qtythree,                
                        'finalprice' => $this->finalprice,
                    ];
    
                     session()->put('carrito', $carrito); 
                
            }
            
            return redirect()->route('home')->with('status', 'Product added or updated successfully');

        } else {
            
            $this->errores = 'The quantity must be equal to 
            the sum of the quantity One, two and three';
        }
          
    }


   

    public function render()
    {
        return view('livewire.cart-item');
    }
}


