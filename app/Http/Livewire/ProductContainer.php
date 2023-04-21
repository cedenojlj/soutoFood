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

use function PHPUnit\Framework\isEmpty;

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


    protected $listeners = ['ocultar' => 'ocultar', 'regresar'=>'regresar', 'ocultarBack'=>'ocultarBack'];


    protected $rules = [


        'amount.*' => 'required|numeric|integer|min:1|max:99999',
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



    public function verificarAmount($key)
    {
        
        if (empty($this->qtyone[$key])) {
            
            $this->qtyone[$key] = 0;
        }

       
        if (empty($this->qtytwo[$key])) {
            
            $this->qtytwo[$key] = 0;
        }

        if (empty($this->qtythree[$key])) {
            
            $this->qtythree[$key] = 0;
        }

        if (empty($this->amount[$key])) {
            
            $this->amount[$key] =  $this->qtyone[$key] +  $this->qtytwo[$key] + $this->qtythree[$key];
        }

        $sumaQty = $this->qtyone[$key] +  $this->qtytwo[$key] + $this->qtythree[$key];

        if ($this->amount[$key] != $sumaQty ) {
           
            $this->amount[$key] = $sumaQty;
        }



    }


    public function updatedAmount($value, $key)
    {

        $value = intval($value);

        //dd($value);

        $clave = intval($key);

        //$this->amount[$clave]='';


        //$this->reset($this->amount[$clave]);

        if (($value <= 0)  ) {

            $this->amount[$key] = '';

        } elseif ($value > 99999) {
            
            $this->amount[$key] = 99999;

        } else {

            $this->amount[$key] = $value;
        }

       



    }

    public function updatedQtyone($value, $key)
    {

        $value = intval($value);

        //dd($value);

        $clave = intval($key);

        //$this->amount[$clave]='';


        //$this->reset($this->amount[$clave]);

        if (($value <= 0) ) {

            $this->qtyone[$key] = '';

        } elseif ($value > 99999) {

            $this->qtyone[$key] = 99999;

        }else {

            $this->qtyone[$key] = $value;
        }
    
        $this->verificarAmount($key);

    }


    public function updatedQtytwo($value, $key)
    {

        $value = intval($value);

        //dd($value);

        $clave = intval($key);

        //$this->amount[$clave]='';


        //$this->reset($this->amount[$clave]);

        if (($value <= 0)) {

            $this->qtytwo[$key] = '';

        } elseif ($value > 99999) {

            $this->qtytwo[$key] = 99999;

        }else {

            $this->qtytwo[$key] = $value;
        }


        $this->verificarAmount($key);


    }

    public function updatedQtythree($value, $key)
    {

        $value = intval($value);

        //dd($value);

        $clave = intval($key);

        //$this->amount[$clave]='';


        //$this->reset($this->amount[$clave]);

        if (($value <= 0)) {

            $this->qtythree[$key] = '';

        } elseif ($value > 99999) {

            $this->qtythree[$key] = 99999;

        }else {

            $this->qtythree[$key] = $value;
        }


        $this->verificarAmount($key);


    }


    public function updatedNotes($value, $key)
    {

        $value = floatval($value);

        //dd($value);

        $clave = intval($key);

        //$this->amount[$clave]='';

       // dd($this->items[$key]['price']);

        $numPrice = $this->items[$key]['price'];

        //$this->reset($this->amount[$clave]);

        if (($value <= 0 or $value> $numPrice)) {

            $this->notes[$key] = '';

        } else {

            $this->notes[$key] = number_format($value,2) ;
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

            $this->prices[$key] = $value['price'];
        }

        unset($value);

        //dd($this->items);


    }

    public function saveItem()
    {
        $this->mensajex = '';

        $producto = Product::find($this->idProduct);

        //dd($producto);

        //dump(count($this->items));

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

            $this->prices[] = $producto['price'];


            $this->mensajex = 'Product added or updated successfully';

            //dd(count($this->items));

            $this->showFormItems = false;

            $this->mostrarItems = true;

            if (!empty($this->items)) {

                $this->indicador[count($this->items)-1] = 'bg-warning';
                
            }    

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

        if (empty($this->items)) {

            return false;
        }

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


            /* if ($bundles->isEmpty()) {

               $this->closeItemBundle();

            } */

            //dd($bundles);

            $keyBundle = 0;

            if (!empty($this->items)) {

                $keyBundle = count($this->items);
               
            } 
            


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


                $this->prices[] = $bundle['priceBundle'];

                $this->amount[$keyBundle] = $bundle['qtyBundle'];

                if (!empty($this->items)) {

                    $this->indicador[count($this->items)-1] = 'bg-warning';
                    
                }    

                $keyBundle = $keyBundle + 1;

            }

            //dd($this->items);
            unset($bundle);
            $productBundle = '';

            $this->mierror = false;
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

        if (empty($this->items)) {

            return false;

        }

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

        $this->showBotonRetroceso = true;
       
        if (empty($this->items)) {

            return false;
        }
        // dd(count($this->items));

        //session()->forget('carrito');

       // $proceder = false;

        $errores = 0;

        $itemValidos = 0;

        foreach ($this->items as $key => $value) {


            if (!empty($this->amount[$key])) {

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

                    //$proceder = true;
                    $miproducto = Product::find($value['id']);

                    //******************************************* */

                    $itemValidos = $itemValidos + 1;

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
                            'upc' => $miproducto->upc,
                            'pallet' => $miproducto->pallet,
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
                            'upc' => $miproducto->upc,
                            'pallet' => $miproducto->pallet,
                        ];

                        session()->put('carrito', $carrito);
                    }


                } else {

                    
                    $this->mierror = true;
                    $this->indicador[$key] = 'table-danger';

                    $errores = $errores + 1;


                    # code...
                }

                # code..
            }
        }

        //limpiar value

        unset($value);

        //dd(session('carrito'));

        if ($errores > 0) {

            $this->mensajex = 'The quantity must be equal to 
            the sum of the quantity One, two and three, only valid items were added';

            return false;
            # code...
        }

        if ($itemValidos == 0) {

            $this->mensajex = 'You must select an item';

            $this->mierror = true;

            return false;
            
        }


        $this->mensajex = 'Product added or updated successfully';

        $this->showCheckout = true;

        $this->showGeneral = false;

        $this->mensajex = '';


       /*  if ($this->mierror) {


            $this->mensajex = 'The quantity must be equal to 
                the sum of the quantity One, two and three, only valid items were added';
           
        } else {

            if ($proceder) {

                $this->mensajex = 'Product added or updated successfully';

                $this->showCheckout = true;

                $this->showGeneral = false;

                $this->mensajex = '';

            } else {

                $this->mensajex = 'You must select an item';
                $this->mierror = true;
            }



            // return redirect()->to('/checkout');

        } */





    }

    public function regresar()
    {
        $this->showCheckout = false;

        $this->showGeneral = true;
    }

    public function ocultar()
    {
        $this->showBotonRetroceso = false;
    }

    public function ocultarBack()
    {
        $this->showBotonRetroceso = false;
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
