<div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Product</th>
            <th scope="col">Qty</th>
            <th scope="col">Price</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>

            @php

                $total=0;

            @endphp


            @if (session('carrito'))
                                    
                @foreach (session('carrito') as $item)

                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['amount'] }}</td>
                        <td>{{ '$ '. $item['finalprice'] }}</td>
                        <td>

                           <form action="{{route('cartdestroy')}}" method="post">

                                @csrf
                                @method('DELETE')

                                <a class="btn btn-primary" href="{{route('editcart', $item['id'])}}">Edit</a>

                                <input id="idproduct" type="hidden" name="id" value="{{$item['id']}}">                              

                                <button type="submit" class="btn btn-danger">Delete</button>                           

                            </form>                           

                        </td>
                    </tr> 

                    @php
                        $total=$total+ ($item['amount'] * $item['finalprice']);
                    @endphp
                @endforeach 

            @else

                <h6>No Product in the Cart</h6>  
                              
            @endif     
        
      </table>

      

      @if ($total>0)

        <div class="container">

            <div class="row mt-2">
                <div class="col">

                    <h5>Total $: {{ round($total,2)}}</h5>

                </div>
            </div>

            <div class="row mt-2">
                <div class="col">

                    <a class="btn btn-primary" href="{{route('checkout')}}">Checkout</a>

                </div>
            </div>

        </div>
          
      @endif
      
</div>
