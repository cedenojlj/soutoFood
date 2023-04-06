<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Customer;
use App\Exports\OrderExport;
use Illuminate\Http\Request;
use App\Exports\RebateExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('orderlist');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function export($id) {

      $order= Order::find($id);
      $customer= Customer::find($order->customer_id);
      $nameCustomer= $customer->name;

      $user=User::find(Auth::id());
      $nameUser= $user->name; 
      $orderDate= $order->created_at->format('mdyhis');   

      $nameFile= $nameCustomer."-".$nameUser."-".$orderDate.".xlsx";

      return Excel::download(new OrderExport($id), $nameFile);

    }

    public function rebate($id) {

        $order= Order::find($id);        
        $customer= Customer::find($order->customer_id);
        $nameCustomer= $customer->name;
  
        $user=User::find(Auth::id());
        $nameUser= $user->name; 
        $orderDate= $order->created_at->format('mdyhis');   
  
        $nameFile= "Rebate-".$nameCustomer."-".$nameUser."-".$orderDate.".xlsx";
  
        return Excel::download(new RebateExport($id), $nameFile);
  
      }


}

