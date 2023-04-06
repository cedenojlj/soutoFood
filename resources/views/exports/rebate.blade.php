

    <table class="table">
       
        <tbody>
            <tr>
                <td></td>
                <th style="font-size:16px"> <strong>Rebate #</strong></th>
                <td style="font-size:16px; "><strong>{{$orden->rebate}}</strong></td>  
                <td></td>   
                <th style="font-size:16px"> <strong>Order:</strong></th>
                <td style="font-size:16px; "><strong>{{ $orderDate}}</strong></td>               
                             
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


{{-- 
<table>
    <thead>
    <tr>        
        <th style="background-color: #fcbf43;border: 1px solid #000000;"><strong>   Qty </strong>  </th>
        <th style="background-color: #999793;border: 1px solid #000000;"><strong>   Item Number </strong>  </th> 
        <th style="background-color: #999793;border: 1px solid #000000;"><strong>   Description </strong>  </th> 
        <th style="background-color: #999793;border: 1px solid #000000;"><strong>   Scan Item UPC </strong>  </th>
        <th style="background-color: #999793;border: 1px solid #000000;"><strong>   Cases per Pallet </strong>  </th>
        <th style="background-color: #999793;border: 1px solid #000000;"><strong>   Food Show Deal </strong>  </th>
        <th style="background-color: #fcbf43;border: 1px solid #000000;"><strong>   notes </strong>  </th>

        <th style="background-color: #999793;border: 1px solid #000000;"><strong>   finalprice </strong>  </th>
        <th style="background-color: #fcbf43;border: 1px solid #000000;"><strong>   {{$date1}} </strong>  </th>
        <th style="background-color: #fcbf43;border: 1px solid #000000;"><strong>   {{$date2}} </strong>  </th>
        <th style="background-color: #fcbf43;border: 1px solid #000000;"><strong>   {{$date3}} </strong>  </th>
    </tr>
    </thead>
    <tbody>

    
    @foreach($orders as $order)
        <tr>
            
            <td style="border: 1px solid #000000;" >{{ $order->amount }}</td>
            <td style="border: 1px solid #000000;">{{ $order->itemnumber }}</td> 
            <td style="border: 1px solid #000000;">{{ $order->name }}</td>  
                      

            <td style="border: 1px solid #000000;">{{ $order->upc }}</td>
            <td style="border: 1px solid #000000;">{{ $order->pallet }}</td>
            <td style="border: 1px solid #000000;">{{"$ ". $order->price }}</td>
            <td style="border: 1px solid #000000;">{{ $order->notes }}</td>

            <td style="border: 1px solid #000000;">{{"$ ". $order->finalprice }}</td>
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
            <td style="font-size:14px"><strong>{{$orden->rebate}}</strong></td>  
            
        </tr>    
        <tr>
            
            <th style="font-size:14px;"> <strong>Amount #</strong></th>
            <td style="font-size:14px"><strong>{{"$ ". $orden->total }}</strong></td>   
            
                        
        </tr>          
         
       
    </tbody>
</table>
 --}}

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




