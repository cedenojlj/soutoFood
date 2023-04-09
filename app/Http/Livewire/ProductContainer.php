<?php

namespace App\Http\Livewire;

use App\Models\Bundle;
use App\Models\User;
use App\Models\Product;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;

class ProductContainer extends Component
{
    public $mensajex;

    // protected $listeners = ['incluir', 'excluir'];

    public $product;

    public $idProduct;

    public $idProductBundle;

    // public $finalprice;

    public $search = '';

    public $subtotal;

    public $notes;

    public $prices;

    public $price;

    public $amount;

    public $qtyone;

    public $qtytwo;

    public $qtythree;

    public $date1;

    public $date2;

    public $date3;

    public $status = '';

    public $control;

    public $mierror = false;

    public $mostrarCheckout = false;

    public $indicador;

    public $items;

    public $listaProductos = [];

    public $showFormItems = false;

    public $showFormItemsBundle = false;

    public $mostrarItems = true;

    public $showCheckout = false;

    public $showGeneral = true;

    public $showBotonRetroceso = true;


    protected $listeners = ['ocultar' => 'ocultar'];


    protected $rules = [


        'amount.*' => 'required|numeric|integer|min:1|max:999',
        'notes.*' => 'required|numeric|min:0',
        'prices.*' => 'required|numeric|min:0',
        'qtyone.*' => 'required|numeric|min:0',
        'qtytwo.*' => 'required|numeric|min:0',
        'qtythree.*' => 'required|numeric|min:0',

    ];

    /* public function updated($propertyName)
    {
       $this->validateOnly($propertyName);

       // dd($propertyName);
    } */

    
    public function updatedAmount($value, $key)
    {
              
       $value= intval($value);   
       
       //dd($value);

       $clave= intval($key);  

       //$this->amount[$clave]='';


       //$this->reset($this->amount[$clave]);

      if (($value <= 0) or $value > 999) {

            $this->amount[$key]='';

        }else{

            $this->amount[$key]= $value; 

        }

    } 

    public function updatedQtyone($value, $key)
    {
              
       $value= intval($value);   
       
       //dd($value);

       $clave= intval($key);  

       //$this->amount[$clave]='';


       //$this->reset($this->amount[$clave]);

      if (($value <= 0) or $value > 999) {

            $this->qtyone[$key]='';

        }else{

            $this->qtyone[$key]= $value; 

        }
        
    } 

    
    public function updatedQtytwo($value, $key)
    {
              
       $value= intval($value);   
       
       //dd($value);

       $clave= intval($key);  

       //$this->amount[$clave]='';


       //$this->reset($this->amount[$clave]);

      if (($value <= 0) or $value > 999) {

            $this->qtytwo[$key]='';

        }else{

            $this->qtytwo[$key]= $value; 

        }
        
    } 

    public function updatedQtythree($value, $key)
    {
              
       $value= intval($value);   
       
       //dd($value);

       $clave= intval($key);  

       //$this->amount[$clave]='';


       //$this->reset($this->amount[$clave]);

      if (($value <= 0) or $value > 999) {

            $this->qtythree[$key]='';

        }else{

            $this->qtythree[$key]= $value; 

        }
        
    } 


    public function updatedNotes($value, $key)
    {
              
       $value= floatval($value);   
       
       //dd($value);

       $clave= intval($key);  

       //$this->amount[$clave]='';


       //$this->reset($this->amount[$clave]);

      if (($value <= 0)) {

            $this->notes[$key]='';

        }else{

            $this->notes[$key]= $value; 

        }
        
    } 




    

    public function mount()
    {
       //$productos = Product::where('user_id', Auth::user()->id)->orderBy('prioridad')->get();

       //$productos = Product::where('user_id', Auth::user()->id)->get();

       // $productos = Product::where('user_id', Auth::id())->orderBy('prioridad')->get();

        $productos = Product::where('email', Auth::user()->email)->orderBy('prioridad')->get();

        //dd($productos);
        //$this->listaProductos = [];

        foreach ($productos as $key => $value) {

            $this->items[] = [

                'id' => $value['id'],
                'itemnumber' => $value['itemnumber'],
                'name' => $value['name'],
                'description' => $value['description'],
                'upc' => $value['upc'],
                'pallet' => $value['pallet'],
                'price' => $value['price'],
            ];
            
            $this->prices[$key]=$value['price'];
        }

        unset($value);

        //dd($this->items);


    }

    public function saveItem()
    {
        $this->mensajex = '';

        $producto = Product::find($this->idProduct);

        //dd($producto);

        // dd($this->items);

        if (isset($producto['id'])) {

            $this->items[] = [

                'id' => $producto['id'],
                'itemnumber' => $producto['itemnumber'],
                'name' => $producto['name'],
                'description' => $producto['description'],
                'upc' => $producto['upc'],
                'pallet' => $producto['pallet'],
                'price' => $producto['price'],
            ];

            $this->prices[]=$producto['price'];


            $this->mensajex = 'Product added or updated successfully';

            // dd($this->items);

            $this->showFormItems = false;

            $this->mostrarItems = true;

           

            $this->reset('search');

            $this->reset('idProduct');


            # code...
        } else {


            $this->mierror = true;

            $this->mensajex = 'You must select a product';
        }
    }


    public function closeItem()
    {
        $this->showFormItems = false;
        $this->mensajex = '';
        $this->mostrarItems = true;
    }


    public function openFormItem()
    {
        $this->mostrarItems = false;
        $this->mensajex = '';
        $this->showFormItems = true;
        $this->showFormItemsBundle = false;
       
    }


    public function saveItemBundle()
    {
        // dd('dentro de bundle');
        $this->mensajex = '';

        //dd($bundles);

        if (isset($this->idProductBundle)) {

            //dd($this->items);

           // $bundles = Bundle::where('numBundle', $this->idProductBundle)->where('user_id', Auth::id())->get();

            $bundles = Bundle::where('numBundle', $this->idProductBundle)->where('email', Auth::user()->email)->get();

            //dd($bundles);


            foreach ($bundles as $bundle) {               
              
                $productBundle = Product::where('itemnumber', $bundle['itemnumber'])->first();

                $this->items[] = [

                    'id' => $productBundle['id'],
                    'itemnumber' => $productBundle['itemnumber'],
                    'name' => $productBundle['name'],
                    'description' => $productBundle['description'],
                    'upc' => $productBundle['upc'],
                    'pallet' => $productBundle['pallet'],
                    'price' => $bundle['priceBundle'],
                ];


                 $this->prices[]= $bundle['priceBundle'];

                 $this->amount[]= $bundle['qtyBundle'];

            }

            //dd($this->items);
            unset($bundle);
            $productBundle = '';


            $this->mensajex = 'Product added or updated successfully';

            $this->showFormItemsBundle = false;

            $this->mostrarItems = true;

            # code...
        } else {


            $this->mierror = true;

            $this->mensajex = 'You must select a Bundle';
        }
    }

    public function closeItemBundle()
    {
        $this->showFormItemsBundle = false;

        $this->mensajex = '';

        $this->mostrarItems = true;
    }

    public function openFormItemBundle()
    {
        $this->mostrarItems = false;
        $this->mensajex = '';
        $this->showFormItemsBundle = true;
        $this->showFormItems = false;
       
    }


    public function updatedSearch()
    {
       // $this->listaProductos = Product::where('name', 'LIKE', '%' . $this->search . '%')->where('user_id', Auth::id())->orWhere('itemnumber', 'LIKE', '%' . $this->search . '%')->where('user_id', Auth::id())->get();

        $this->listaProductos = Product::where('name', 'LIKE', '%' . $this->search . '%')->where('email', Auth::user()->email)->orWhere('itemnumber', 'LIKE', '%' . $this->search . '%')->where('email', Auth::user()->email)->get();
    }

    public function save()
    {

        

       //session()->forget('carrito');


        $proceder=false;

        foreach ($this->items as $key => $value) {


            if (isset($this->amount[$key])) {

                if ($this->amount[$key] < 0) {

                    $this->amount[$key] = 0;
                }

                if (empty($this->notes[$key]) or $this->notes[$key] < 0) {

                    $this->notes[$key] = 0;
                }

                if (empty($this->qtyone[$key]) or $this->qtyone[$key] < 0) {

                    $this->qtyone[$key] = 0;
                }

                if (empty($this->qtytwo[$key]) or $this->qtytwo[$key] < 0) {

                    $this->qtytwo[$key] = 0;
                }

                if (empty($this->qtythree[$key]) or $this->qtythree[$key] < 0) {

                    $this->qtythree[$key] = 0;
                }

                $finalprice = (float) $this->prices[$key] - (float) $this->notes[$key];

                $sumaparcial = $this->qtyone[$key] + $this->qtytwo[$key] + $this->qtythree[$key];


                if ($sumaparcial == $this->amount[$key] and $this->amount[$key] > 0) {



                    $this->mierror = false;
                    $this->indicador[$key] = 'table-success';

                    $proceder=true;

                    //******************************************* */


                    $item = [

                        $key => [

                            'id' => $value['id'],
                            'name' => $value['name'],
                            'itemnumber' => $value['itemnumber'],
                            'price' => $value['price'],
                            'amount' => $this->amount[$key],
                            'notes' => (float) $this->notes[$key],
                            'qtyone' => $this->qtyone[$key],
                            'qtytwo' => $this->qtytwo[$key],
                            'qtythree' => $this->qtythree[$key],
                            'finalprice' => $finalprice,
                        ]

                    ];

                    $carrito = session()->get('carrito');

                    if (!$carrito) {


                        session()->put('carrito', $item);
                    } else {

                        $carrito[$key] = [


                            'id' => $value['id'],
                            'name' => $value['name'],
                            'itemnumber' => $value['itemnumber'],
                            'price' => $value['price'],
                            'amount' => $this->amount[$key],
                            'notes' => $this->notes[$key],
                            'qtyone' => $this->qtyone[$key],
                            'qtytwo' => $this->qtytwo[$key],
                            'qtythree' => $this->qtythree[$key],
                            'finalprice' => $finalprice,
                        ];

                        session()->put('carrito', $carrito);
                    }


                    //*********************************************** */
                    # code...
                } else {

                    /* $this->mensajex= 'The quantity must be equal to 
                the sum of the quantity One, two and three';     */
                    $this->mierror = true;
                    $this->indicador[$key] = 'table-danger';

                    # code...
                }

                # code..
            }
        }

        //limpiar value

        unset($value);



        if ($this->mierror) {


            $this->mensajex = 'The quantity must be equal to 
                the sum of the quantity One, two and three, only valid items were added';

           //dd(count($carrito));

           /* if (isset($carrito)) {

                if (count($carrito)>0) {

                    $this->showCheckout=true;

                    $this->showGeneral=false;
            
                    $this->mensajex = '';
                   
                }
            
           } */           
        
           if ($proceder) {

                $this->showCheckout=true;

                $this->showGeneral=false;
        
                $this->mensajex = '';           
        
           }
           


        } else {

                    

            if ($proceder) {

                $this->mensajex = 'Product added or updated successfully';

                $this->showCheckout=true;
    
                $this->showGeneral=false;
    
                $this->mensajex = '';

                
            } else {

                $this->mensajex = 'You must select an item';
                $this->mierror=true;
                
            }
            


           // return redirect()->to('/checkout');

        }

    }

    public function regresar()
    {
        $this->showCheckout=false;

        $this->showGeneral=true;
    }

    public function ocultar()
    {
        $this->showBotonRetroceso=false;
    }
  
    public function render()
    {
        $user = User::find(Auth::id());

        return view('livewire.product-container', [

            'fecha1' => Carbon::createFromFormat('Y-m-d', $user->date1)->format('m/d/Y'),
            'fecha2' => Carbon::createFromFormat('Y-m-d', $user->date2)->format('m/d/Y'),
            'fecha3' => Carbon::createFromFormat('Y-m-d', $user->date1)->format('m/d/Y')
        ]);
    }
}

 


