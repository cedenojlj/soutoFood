<div> 
           

            <td><input wire:model="amount" id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" required autofocus></td>
            <td>{{$product->itemnumber}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->upc}}</td>
            <td>{{$product->pallet}}</td>
            <td>{{$product->price}}</td>
            <td><input wire:model="notes" id="notes" type="text" step="0.01" class="form-control @error('notes') is-invalid @enderror" name="notes" ></td>
            <td>{{$finalprice}}</td>
    
            <td><input wire:model="qtyone" id="qtyone" type="text" class="form-control @error('qtyone') is-invalid @enderror" name="qtyone" required></td>
    
            <td><input wire:model="qtytwo"  id="qtytwo" type="text" class="form-control @error('qtytwo') is-invalid @enderror" name="qtytwo"></td>
    
            <td><input wire:model="qtythree" id="qtythree" type="text" class="form-control @error('qtythree') is-invalid @enderror" name="qtythree"></td> 

            <td> <button wire:click.prevent="incluir({{$product->id}})" type="button" class="btn btn-primary btn-sm">+</button> 
                <button wire:click.prevent="excluir({{$product->id}})" type="button" class="btn btn-danger btn-sm">-</button> </th>    



</div>

