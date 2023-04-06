<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


/* use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithBackgroundColor; */



class OrderExport implements FromView, ShouldAutoSize, WithDrawings
{
    public $id;

    public function __construct($id)
    {
        $this->id= $id;
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/img/logo1.jpg'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('J1');

        return $drawing;
    }
    
    
    public function view(): View
    {
        $orden= Order::find($this->id);

        $orderDate="#".$orden->created_at->format('Ymdhis');

        $user=User::find(Auth::id());

       $date1= Carbon::createFromFormat('Y-m-d', $user->date1)->format('m/d/Y');    

       $date2= Carbon::createFromFormat('Y-m-d', $user->date2)->format('m/d/Y'); 

       $date3= Carbon::createFromFormat('Y-m-d', $user->date3)->format('m/d/Y'); 

       $numeroRebate = Auth::id().$orden->created_at->format('ymd');

       
        
        
        $customer= Customer::find($orden->customer_id);

        return view('exports.order', [

            'orders' => Order::find($this->id)->ordersdetails,
            'orden'=>$orden,
            'customer'=>$customer,
            'orderDate'=> $orderDate,
            'date1'=> $date1,
            'date2'=> $date2,
            'date3'=> $date3,
            'numeroRebate' => $numeroRebate

        ]);
    }
}




