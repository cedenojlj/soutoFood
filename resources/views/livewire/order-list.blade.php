<div>
   
    
    <div class="row mb-3">

        <label for="search" class="col-md-8 col-form-label text-md-end">Search:</label>

        <div class="col-md-4">
            
           <input wire:model="search" class="form-control" type="text" placeholder="Search customers..."/>            
           
        </div>
    </div>

 
      
            
            {{-- <li>{{ $order->name }}</li> --}}

           

                <div class="card mb-3">
                    <div class="card-body">
                        
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Created</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Total $</th>
                                <th scope="col">Actions</th>
                              </tr>
                            </thead>
                            <tbody>

                            @foreach($orders as $order)
 
                              <tr>
                                <th scope="row">{{ $order->id }}</th>
                                <td>{{ $order->created_at->format('Ymdhis') }}</td>
                                <td>{{ $order->customerName }}</td>
                                <td>{{ '$ '. $order->total }}</td>
                                <td>
                                    <a href="{{url('export-order',[$order->id])}}" class="btn btn-primary">Download</a>
                                </td>
                              </tr> 

                              @endforeach  

                            </tbody>
                          </table>
                    </div>
                  </div>

          

        

        {{ $orders->links() }}
    


</div>
