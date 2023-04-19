<?php

namespace App\Http\Livewire;


use App\Models\User;
use App\Models\Order;
use App\Mail\DemoEmail;
use App\Models\Product;
use Livewire\Component;
use App\Mail\RebateMail;
use App\Models\Customer;

use Illuminate\Support\Str;
use App\Exports\OrderExport;
use App\Models\Ordersdetail;
use App\Exports\RebateExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;




class CheckOut extends Component
{

    public $searchx = '';

    public $Customers = [];

    public $idCustomer;

    public $Customer;

    public $email; // email del customer

    public $email2; // segundo email del customer

    public $emailRep; // email del representante de ventas

    public $vendorEmail; // email del vendor

    public $pin;

    public $rebate;

    public $rebateEmail;

    public $errores = '';

    public $comments = '';

    public $status = '';

    public $general = true;

    public $lastId;

    public $orderDate;

    public $total = 0;

    public $mostrarOrdenCreada = false;

    public $statusEmail = '';

    public $tipoInput = 'text';

    public $mostrarPin = true;

    public $verificar;

    public $acumulador = '';

    public $control;

    public $otroNombre = 'pin';


    protected $rules = [

        'idCustomer' => 'required',
        'email' => 'required|email',
        'email2' => 'required|email',
        'emailRep' => 'required|email',
        'vendorEmail' => 'required|email',
        'pin' => 'required',

    ];


    public function updatedSearchx()
    {

        $this->Customers = Customer::where('name', 'LIKE', '%' . $this->searchx . '%')->get();

        $this->emit('ocultarBack');
    }


    public function updatedidCustomer()
    {
        $this->Customer = Customer::find($this->idCustomer);

        $this->email = $this->Customer->email;

        $this->email2 = $this->Customer->email2;

        $this->emailRep = $this->Customer->emailRep;

        $this->vendorEmail = Auth::user()->emailuser;
    }


    public function updatedRebate()
    {

        if (is_numeric($this->rebate)) {

            $control = intval($this->rebate);

            $this->rebate = $control;


            //dd($control);

            if ($this->rebate <= 0 or $this->rebate > 10000) {

                $this->reset('rebate');
            }
            
        } else {

            $this->reset('rebate');
        }
    }

    public function updatingPin($value)
    {
    }

    public function updatedPin($clave)
    {

        $this->errores = '';
    }


    public function procesarPedido()
    {

        //dd($this->pin);

        //$this->tipoInput='text';

        $this->errores = '';

        $miPin = $this->pin;

        /* $this->pin='**********';
        $this->otroNombre='********'; */

        $this->emit('ocultar');

        $this->validate();

        $totalorden = 0;



        if ($miPin != $this->Customer->pin) {

            $this->errores = 'The pin field is invalid.';

            $this->reset('pin');
        } else {

            $this->errores = '';

            $user = User::find(Auth::id());


            if (session()->has('carrito')) {

                foreach (session('carrito') as $key => $item) {

                    // $total = $this->total + $item['finalprice'] * $item['amount'];

                    $totalorden = $totalorden + $item['finalprice'] * $item['amount'];
                }
            }

            $this->total = $totalorden;

            if (!$this->rebate) {

                $this->rebate = 0;
            }



            $order = new Order();

            $order->customer_id = $this->Customer->id;
            $order->customerName = $this->Customer->name;
            $order->user_id = Auth::id();
            $order->total = $totalorden;
            $order->date1 = $user->date1;
            $order->date2 = $user->date2;
            $order->date3 = $user->date3;
            $order->comments = $this->comments;
            $order->customerEmail = $this->email;
            $order->customerEmail2 = $this->email2;

            // $order->saleRepEmail = $this->email;
            // $order->vendorEmail = $this->vendorEmail;

            $order->saleRepEmail = $this->Customer->emailRep;
            $order->vendorEmail = Auth::user()->emailuser;

            $order->rebate = $this->rebate;
            $order->idRebate = Str::ulid();

            $order->save();

            $this->lastId = $order->id;

            $this->orderDate = $order->created_at;


            if (session()->has('carrito')) {

                foreach (session('carrito') as $key => $item) {

                    if (empty($item['notes'])) {

                        $item['notes'] = 0;
                    }

                    if (empty($item['qtytwo'])) {

                        $item['qtytwo'] = 0;
                    }

                    if (empty($item['qtythree'])) {

                        $item['qtythree'] = 0;
                    }

                    $producto = Product::find($item['id']);

                    $ordersdetail = new Ordersdetail();

                    $ordersdetail->order_id = $this->lastId;
                    $ordersdetail->product_id =  $item['id'];
                    // $ordersdetail->name =  $item['name'];
                    $ordersdetail->name =  $producto->description;
                    $ordersdetail->itemnumber =  $item['itemnumber'];

                    $ordersdetail->upc =  $producto->upc;
                    $ordersdetail->pallet =  $producto->pallet;
                    $ordersdetail->price =  $producto->price;

                    $ordersdetail->amount =  $item['amount'];
                    $ordersdetail->notes =  $item['notes'];
                    $ordersdetail->finalprice = $item['finalprice'];
                    $ordersdetail->qtyone = $item['qtyone'];
                    $ordersdetail->qtytwo = $item['qtytwo'];
                    $ordersdetail->qtythree = $item['qtythree'];

                    $ordersdetail->save();
                }
            }

            session()->forget('carrito');

            //$this->enviandoEmail($order->id);

            // return redirect()->to('/home');

            $this->general = false;
            // para ocultar los demas campos y dejar solo el reporte
            // de orden creada   

            $this->status = 'Order Created Successfully';

            $this->mostrarOrdenCreada = true;

            $this->reset('pin');

            $this->reset('searchx');
        }


        if ($this->mostrarOrdenCreada) {

            //dd('entrado a la funcion de envio');

            $this->enviandoEmail($order->id);
        }
    }

    public function enviandoEmail($id)
    {
        ///dd($id);

        try {



            $this->indexMail($id);


            if ($this->rebate > 0) {

                $this->rebateMail($id);
            }
        } catch (\Throwable $th) {

            report($th);

            $this->statusEmail = 'Emails not sent';

            return false;
        }
    }

    public function indexMail($id)
    {

        $orden = Order::find($id);

        $numberOrder = "#" . $orden->created_at->format('Ymdhis');

        $dateOrder = "#" . $orden->created_at->format('m-d-Y');

        $customer = Customer::find($orden->customer_id)->name;

        $tittle = 'Order Created ' . $numberOrder;

        $emailData = [

            'title' => $tittle,
            'body' => '',
            'dateOrder' => $dateOrder,
            'customer' => $customer,

        ];

        if (isset(Auth::user()->emailuser)) {

            $destinatarios[] = Auth::user()->emailuser;
        }

        if (isset($orden->customerEmail)) {

            $destinatarios[] = $orden->customerEmail;
        }

        if (isset($orden->customerEmail2)) {

            $destinatarios[] = $orden->customerEmail2;
        }

        if (isset($orden->saleRepEmail)) {

            $destinatarios[] = $orden->saleRepEmail;
        }

        $destinatarios[] = 'sales@soutofoodsfestival.com';


        // dd($destinatarios);


        $reporte = Excel::raw(new OrderExport($id), \Maatwebsite\Excel\Excel::XLSX);


        foreach ($destinatarios as $value) {

            Mail::to($value)->send(new DemoEmail($emailData, $reporte));
        }

        unset($destinatarios);
    }

    public function rebateMail($id)
    {

        $orden = Order::find($id);

        $numberOrder = "#" . $orden->created_at->format('Ymdhis');

        $dateOrder = "#" . $orden->created_at->format('m-d-Y');

        $customer = Customer::find($orden->customer_id)->name;

        $tittle = 'Order Created ' . $numberOrder;

        $emailData = [

            'title' => $tittle,
            'body' => '',
            'dateOrder' => $dateOrder,
            'customer' => $customer,
            'rebate' => $orden->rebate,
            'vendor' => Auth::user()->name,

        ];



        if (isset(Auth::user()->emailuser)) {

            $destinatarios[] = Auth::user()->emailuser;
        }

        if (isset($orden->customerEmail)) {

            $destinatarios[] = $orden->customerEmail;
        }

        if (isset($orden->customerEmail2)) {

            $destinatarios[] = $orden->customerEmail2;
        }

        if (isset($orden->saleRepEmail)) {

            $destinatarios[] = $orden->saleRepEmail;
        }

        $destinatarios[] = 'rebates@soutofoodsfestival.com';


        $reporte = Excel::raw(new RebateExport($id), \Maatwebsite\Excel\Excel::XLSX);


        foreach ($destinatarios as $value) {


            Mail::to($value)->send(new RebateMail($emailData, $reporte));
        }






        //dd("REBATE all is ready");

        //return view('home');


    }



    public function render()
    {
        return view('livewire.check-out');
    }
}
