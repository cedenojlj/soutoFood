<div>

     
    <div class="row mb-4">

        <label for="name" class="col-md-8 col-form-label text-md-end">Search:</label>

        <div class="col-md-4">
            
           <input wire:model="search" class="form-control" type="text" placeholder="Search products..."/>            
           
        </div>
    </div>

    <table class="table">
        <thead>
          <tr>            
            <th scope="col">Product</th>
            <th scope="col">UPC</th>
            <th scope="col">Cases</th>
            <th scope="col">Price</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>

            @foreach($productos as $product) 
           
              <tr>
                
                <td>{{ $product->name }}</td>
                <td>{{ $product->upc }}</td>
                <td>{{ $product->pallet }}</td>
                <td>{{ '$ '. $product->price }}</td>
                <td><a href="{{route('addtocart', ['product'=> $product])}}" class="btn btn-primary btn-sm">+</a></td>
                
              </tr>


            @endforeach 

        </tbody>

    </table>

                
        {{ $productos->links() }}
    

</div>


