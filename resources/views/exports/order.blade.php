
    <p>-</p>
    <table class="table">
       
        <tbody>
            <tr>
                <td></td>
                <th style="font-size:16px"> <strong>Order:</strong></th>
                <td style="font-size:16px; "><strong>{{ "0".$orderDate}}</strong></td>                  
                <td></td>              
            </tr>    
            <tr>
                <td></td>
                <th style="font-size:16px; color:#fcbf43"> <strong>Customer:</strong></th>
                <td style="font-size:16px; border: 1px solid #000000;"><strong>{{$customer->name}}</strong></td>  
                <td></td>
                            
            </tr>   
            
            <tr>
                <td></td>
                <th style="font-size:16px; color:#fcbf43"> <strong>Vendor:</strong></th>
                <td style="font-size:16px; border: 1px solid #000000;"><strong>{{Auth::user()->name}}</strong></td> 
                <td></td>                             
            </tr>   
           
        </tbody>
    </table>



<table>
    <thead>
    <tr>        
        <th style="background-color: #fcbf43;border: 1px solid #000000;" align="center" ><strong>   Qty </strong>  </th>
        <th style="background-color: #6bc7e0;border: 1px solid #000000;" align="center" ><strong>   Item Number </strong>  </th> 
        <th style="background-color: #6bc7e0;border: 1px solid #000000;" align="center" ><strong>   Description </strong>  </th> 
        <th style="background-color: #6bc7e0;border: 1px solid #000000;" align="center" ><strong>   Scan Item UPC </strong>  </th>
        <th style="background-color: #6bc7e0;border: 1px solid #000000;" align="center" ><strong>   Cases per Pallet </strong>  </th>
        <th style="background-color: #6bc7e0;border: 1px solid #000000;" align="center" ><strong>   Food Show Deal </strong>  </th>
        <th style="background-color: #fcbf43;border: 1px solid #000000;" align="center" ><strong>   Notes </strong>  </th>

        <th style="background-color: #6bc7e0;border: 1px solid #000000;" align="center" ><strong>   Final Price </strong>  </th>
        <th style="background-color: #fcbf43;border: 1px solid #000000;" align="center" ><strong>   {{$date1}} </strong>  </th>
        <th style="background-color: #fcbf43;border: 1px solid #000000;" align="center" ><strong>   {{$date2}} </strong>  </th>
        <th style="background-color: #fcbf43;border: 1px solid #000000;" align="center" ><strong>   {{$date3}} </strong>  </th>
    </tr>
    </thead>
    <tbody>

    
    @foreach($orders as $order)
        <tr>
            
            <td style="border: 1px solid #000000;" >{{ $order->amount }}</td>
            <td style="border: 1px solid #000000;">{{ $order->itemnumber }}</td> 
            <td style="border: 1px solid #000000;">{{ $order->name }}</td>  
                      

            <td style="border: 1px solid #000000;">{{ "0".$order->upc }}</td>
            <td style="border: 1px solid #000000;">{{ $order->pallet }}</td>
            <td style="border: 1px solid #000000;">{{"$ ". number_format($order->price,2) }}</td>
            <td style="border: 1px solid #000000;">{{"$ ". number_format($order->notes,2) }}</td>

            <td style="border: 1px solid #000000;">{{"$ ". number_format($order->finalprice,2) }}</td>
            <td style="border: 1px solid #000000;">{{ $order->qtyone }}</td>
            <td style="border: 1px solid #000000;">{{ $order->qtytwo }}</td>
            <td style="border: 1px solid #000000;">{{ $order->qtythree }}</td>          
            
        </tr>
    
    @endforeach

    </tbody>
</table>



<table class="table">
       
    <tbody>

        <tr>            
            <th style="font-size:14px"> <strong>Rebate #</strong></th>
            <td style="font-size:14px"><strong>{{$numeroRebate}}</strong></td>  
            
        </tr>    

        <tr>            
            <th style="font-size:14px"> <strong>Rebate</strong></th>
            <td style="font-size:14px"><strong>{{"$ ". number_format($orden->rebate,2)}}</strong></td>  
            
        </tr>    
        <tr>
            
            <th style="font-size:14px;"> <strong>Amount</strong></th>
            <td style="font-size:14px"><strong>{{"$ ". number_format($orden->total,2) }}</strong></td>   
            
                        
        </tr>          
         
       
    </tbody>
</table>


<table >
       
    <tbody>
        <tr> 
            <td></td>           
            <th style="font-size:14px"> <strong>Notes:</strong></th>  
        </tr>    
        <tr>          
            <td></td>
            <td style="font-size:16px; border-bottom: 50px solid #000000;" colspan="6">{{$orden->comments}}</td>     
                        
        </tr>    
        <tr>          
            <td></td>
            <td style="font-size:16px; border-bottom: 50px solid #000000;" colspan="6"></td>     
                        
        </tr>  
        <tr>          
            <td></td>
            <td style="font-size:16px; border-bottom: 50px solid #000000;" colspan="6"></td>     
                        
        </tr>  
        <tr>          
            <td></td>
            <td style="font-size:16px; border-bottom: 50px solid #000000;" colspan="6"></td>     
                        
        </tr>  
        <tr>          
            <td></td>
            <td style="font-size:16px; border-bottom: 50px solid #000000;" colspan="6"></td>     
                        
        </tr>  
        <tr>          
            <td></td>
            <td style="font-size:16px; border-bottom: 50px solid #000000;" colspan="6"></td>     
                        
        </tr>  

         
       
    </tbody>
</table>




