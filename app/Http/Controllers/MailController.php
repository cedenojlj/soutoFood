<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Mail\DemoEmail;
use App\Mail\RebateMail;
use App\Models\Customer;
use App\Exports\OrderExport;
use Illuminate\Http\Request;
use App\Exports\RebateExport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    
    
    public function index($id)
    {
       
        $orden= Order::find($id);

        $numberOrder="#".$orden->created_at->format('Ymdhis');

        $dateOrder="#".$orden->created_at->format('m-d-Y');

        $customer= Customer::find($orden->customer_id)->name;
       
        $tittle = 'Order Created ' .$numberOrder; 

        $subjectEmail = 'Souto Foods Festival - '.  $customer . ' - ' . Auth::user()->name;
       
        $emailData=[

            'title'=> $tittle,
            'body'=>'',
            'dateOrder' => $dateOrder,
            'customer' => $customer,
            'subjectEmail' => $subjectEmail 

        ];

       // $destinatarios[]=["illenybm36@gmail.com"];

        //dd($destinatarios);

        if (isset($orden->customerName)) {
            
            $destinatarios[]=[$orden->customerName];
        }

        if (isset($orden->customerEmail)) {
            
            $destinatarios[]=[$orden->customerEmail];
        }

        if (isset($orden->customerEmail2)) {
            
            $destinatarios[]=[$orden->customerEmail2];
        }

        if (isset($orden->saleRepEmail)) {
            
            $destinatarios[]=[$orden->saleRepEmail];
        }

       
        //$destinatarios[]=['sales@soutofoodsfestival.com'];

        //$ventas = 'illenybm36@gmail.com';

       // $destinatarios[]=[$ventas];

       // dd($destinatarios);


        $reporte = Excel::raw(new OrderExport($id), \Maatwebsite\Excel\Excel::XLSX);

        Mail::to('illenybm36@gmail.com')->send(new DemoEmail($emailData, $reporte));

        foreach ($destinatarios as $value) {
            
            Mail::to($value)->send(new DemoEmail($emailData, $reporte));
        }        

      

    }



    public function rebate($id)
    {
       
        $orden= Order::find($id);

        $numberOrder="#".$orden->created_at->format('Ymdhis');

        $dateOrder="#".$orden->created_at->format('m-d-Y');

        $customer= Customer::find($orden->customer_id)->name;
       
        $tittle = 'Rebate Order Created ' .$numberOrder; 

        $subjectEmail = 'Souto Foods Festival - '.  $customer . ' - ' . Auth::user()->name . ' - Rebate';

               
        $emailData=[

            'title'=> $tittle,
            'body'=>'',
            'dateOrder' => $dateOrder,
            'customer' => $customer,
            'subjectEmail' => $subjectEmail 

        ];

        unset($destinatarios);

        if (isset($orden->customerName)) {
            
            $destinatarios[]=[$orden->customerName];
        }

        if (isset($orden->customerEmail)) {
            
            $destinatarios[]=[$orden->customerEmail];
        }

        if (isset($orden->customerEmail2)) {
            
            $destinatarios[]=[$orden->customerEmail2];
        }

        if (isset($orden->saleRepEmail)) {
            
            $destinatarios[]=[$orden->saleRepEmail];
        }

        //$destinatarios[]=['rebates@soutofoodsfestival.com'];

        


        $reporte = Excel::raw(new RebateExport($id), \Maatwebsite\Excel\Excel::XLSX);


        foreach ($destinatarios as $value) {
            
           
        Mail::to($value)->send(new RebateMail($emailData, $reporte));

        }    






        //dd("REBATE all is ready");

        //return view('home');


    }



















}




