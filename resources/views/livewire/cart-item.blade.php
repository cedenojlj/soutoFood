<div>

    @if ($errores)

        <div class="alert alert-danger" role="alert">

            {{ $errores }}

        </div>
        
    @endif

    {{-- <form method="POST" action="{{ route('savetocart',['product'=>$product]) }}"> --}}

    <form wire:submit.prevent="submit">
        @csrf
                
        {{-- para el campo cantidad total a distribuir--}}
        <div class="row mb-3">
            <label for="amount" class="col-md-4 col-form-label text-md-end">Quantity</label>

            <div class="col-md-6">
                <input wire:model="amount" id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" required autocomplete="amount" autofocus>

                @error('amount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        {{-- para el campo precio--}}
        
        <div class="row mb-3">
            <label class="col-md-4 col-form-label text-md-end">Price</label>

            <div class="col-md-6">             
                                
                <label class="form-control">{{$product->price}}</label>     

            </div>
        </div>

        {{-- para el campo descuento notes --}}

        <div class="row mb-3">
            <label for="notes" class="col-md-4 col-form-label text-md-end">Notes</label>

            <div class="col-md-6">
                <input wire:model="notes" id="notes" type="number" step="0.01" class="form-control @error('notes') is-invalid @enderror" name="notes"  autocomplete="notes" autofocus>

                @error('notes')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        {{-- para el campo finalprice --}}
        
        <div class="row mb-3">

            <label class="col-md-4 col-form-label text-md-end">Finalprice</label>

           <div class="col-md-6"> 
               
                <label class="form-control">{{$finalprice}}</label>           

            </div>                       
            
        </div>

         {{-- para el campo subtotal --}}
         

        <div class="row mb-3">
            
            <label class="col-md-4 col-form-label text-md-end">Subtotal</label>

            <div class="col-md-6">  

                <label class="form-control">{{$subtotal}}</label> 

            </div>
            
        </div>

        

        {{-- para el campo cantidad uno--}}
        <div class="row mb-3">
            <label for="qtyone" class="col-md-4 col-form-label text-md-end">{{'Week of ' .$date1}}</label>

            <div class="col-md-6">
                <input wire:model="qtyone" id="qtyone" type="number" class="form-control @error('qtyone') is-invalid @enderror" name="qtyone" required autocomplete="qtyone" autofocus>

                @error('qtyone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        {{-- para el campo cantidad dos--}}
        <div class="row mb-3">
            <label for="qtytwo" class="col-md-4 col-form-label text-md-end">{{'Week of ' .$date2}}</label>

            <div class="col-md-6">
                <input wire:model="qtytwo"  id="qtytwo" type="number" class="form-control @error('qtytwo') is-invalid @enderror" name="qtytwo" value="{{ old('qtytwo')}}" autocomplete="qtytwo" autofocus>

                @error('qtytwo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        {{-- para el campo cantidad tres--}}
        <div class="row mb-3">
            <label for="qtythree" class="col-md-4 col-form-label text-md-end">{{'Week of ' .$date3}}</label>

            <div class="col-md-6">
                <input wire:model="qtythree" id="qtythree" type="number" class="form-control @error('qtythree') is-invalid @enderror" name="qtythree" value="{{ old('qtythree') }}" autocomplete="qtythree" autofocus>

                @error('qtythree')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
              

        {{-- <div class="row mb-3">
                            
            <div class="col-md-6">
                <input id="product_id" type="hidden" name="product_id" value="{{ $product->id }}" >  
            </div>
        </div> --}}

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                   Add to Cart
                </button>
            </div>
        </div>
    </form>


    
</div>
