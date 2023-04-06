<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductItem extends Component
{
   public $product;    

   public $finalprice;

   public $subtotal;

   public $notes;   

   public $price;

   public $amount;

   public $qtyone;

   public $qtytwo;

   public $qtythree;   

   public $date1;

   public $date2;

   public $date3;

   public $status='';


   /* protected $rules = [

    'amount' => 'required',
    'qtyone' => 'required',

    ]; */

    // protected $listeners = ['incluir','excluir'];   

   /*  public function agregar()
    {
        $this->status='agregando productos';
    }

    public function eliminar()
    {
        $this->status='eliminando productos';
    } */

    public function mount(Product $product)
    {
        $this->product= $product;
    }

    public function render()
    {
        return view('livewire.product-item');
    }
}
