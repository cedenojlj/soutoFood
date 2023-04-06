<div>

    @if ($status)
        <div class="alert alert-success" role="alert">
            {{ $status }}
        </div>
    @endif     

    @if ($errores)

        <div class="alert alert-danger" role="alert">

            {{ $errores }}

        </div>
        
    @endif

    <div class="text-center">
         <div wire:loading.inline-flex wire:target="submit">       

            <button class="btn btn-primary" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Processing...
            </button>
            
        </div>
    </div>  

    <div class="Container">

       @if (!$general)           
      
            {{-- search  --}}

            <div class="row mb-4 mt-2" wire:loading.remove wire:target="submit">           

                <div class="col-md-6">                
                    
                    <input type="text" class="col form-control" wire:model="searchx">               
                
                </div>

                {{-- <div class="col-md-6">                
                    
                    <button class="btn btn-primary" wire:click="CaptarIdCliente">Search Customer</button>
                
                </div> --}}
            </div> 
               

            <form wire:submit.prevent="submit" wire:loading.remove wire:target="submit">

                @if (!empty($searchx))

                    {{-- select customer  --}}

                    <div class="row mb-3">

                        <div class="col-md-6">               
                        
                                <select wire:model="idCustomer" class="form-select @error('idCustomer') is-invalid @enderror" aria-label="Default select example">
            
                                    <option selected>Open this select menu</option>
            
                                    @foreach ($Customers as $item)
            
                                        <option value="{{$item->id}}">{{$item->name}}</option>
            
                                    @endforeach                       
                                    
                                </select> 

                                @error('idCustomer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            
                        </div>
            
                    </div>
            
                    {{-- email customer  --}}

                    <div class="row mb-3">                
            
                        <div class="col-md-6">
            
                            <label for="email" class="col-form-label text-md-end">Email Customer</label>
                            
                            <input wire:model="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required>
            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- email customer segundo  --}}

                    <div class="row mb-3">                
            
                        <div class="col-md-6">
            
                            <label for="email2" class="col-form-label text-md-end">Email Customer</label>
                            
                            <input wire:model="email2" id="email2" type="email2" class="form-control @error('email2') is-invalid @enderror" name="email2" required>
            
                            @error('email2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Sales Rep  email--}}

                    <div class="row mb-3">                
            
                        <div class="col-md-6">
            
                            <label for="emailRep" class="col-form-label text-md-end">Sales Rep</label>
                            
                            <input wire:model="emailRep" id="emailRep" type="emailRep" class="form-control @error('emailRep') is-invalid @enderror" name="emailRep" required>
            
                            @error('emailRep')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
            
                     {{-- email vendor  --}}

                     <div class="row mb-3">                
            
                        <div class="col-md-6">
            
                            <label for="vendorEmail" class="col-form-label text-md-end">Email Vendor</label>
                            
                            <input wire:model="vendorEmail" id="vendorEmail" type="vendorEmail" class="form-control @error('vendorEmail') is-invalid @enderror" name="vendorEmail" required>
            
                            @error('vendorEmail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                                           
                    
                    {{-- pin customer  --}}

                    <div class="row mb-3">                
            
                        <div class="col-md-6">
            
                            <label for="pin" class="col-form-label">PIN</label>
            
                            <input wire:model="pin" id="pin" type="password" class="form-control @error('pin') is-invalid @enderror" name="pin" required autocomplete="new-password">
            
                            @error('pin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 

                    {{-- rebate  --}}

                    <div class="row mb-3">                
            
                        <div class="col-md-6">
            
                            <label for="rebate" class="col-form-label">Rebate</label>
            
                            <input wire:model="rebate" id="rebate" type="number" step=".01" class="form-control @error('rebate') is-invalid @enderror" name="rebate" >
            
                            @error('rebate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>                    

                    {{-- comments  --}}
                    
                    <div class="row mb-3">                
            
                        <div class="col-md-6">
            
                            <label for="comments" class="col-form-label text-md-end">Comments</label>  
                            
                            <textarea wire:model="comments" class="form-control" name="comments" id="comments" rows="3"></textarea>  

                        </div>
                    </div>

                    {{-- submit  --}}

                    <div class="row mb-3">

                        <div class="col-md-6">

                            <button type="submit" class="btn btn-primary">Checkout</button>  

                        </div>

                    </div>
                
                @endif


            </form>

        @else

            <div class="row mt-3" wire:loading.remove wire:target="submit">

                {{-- <h5>Number Order: #{{ $orderDate->format('Ymdhis') }}</h5> --}}
                <h5>Order: <a href="{{url('export-order',[$lastId])}}" class="btn btn-primary">{{ $Customer->name . " - ". Auth::user()->name . " .xlsx" }}</a> </h5>
                <h5>Date Order: {{$orderDate->format('m-d-Y')}}</h5>
               
                <h5>Total Order: {{'$ ' . $total}}</h5>

            </div>
           
        @endif
       
    </div>  

    
</div>
