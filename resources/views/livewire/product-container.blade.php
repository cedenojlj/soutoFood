<div>

   
        
    <h5>{{Auth::user()->name}}</h5>  

                            
               @if ($mensajex)


                        @if ($mierror)

                            <div class="alert alert-danger" role="alert">
                                {{$mensajex}}
                            </div> 
                    
                        @else

                            <div class="alert alert-success" role="alert">
                                {{$mensajex}}
                            </div> 
                    
                        @endif   

                   
               @endif

             {{--  @if ($mostrarCheckout)

                <div class="row mt-2">

                    <div class="col">

                        <a class="btn btn-primary" href="{{route('checkout')}}">Checkout</a>

                    </div>

                </div>
                  
              @endif --}}

            <div class="text-center mb-4">
                <div wire:loading.inline-flex>

                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Processing......
                    </button>
                    
                </div>
            </div>      


            @if ($showCheckout)

                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">{{ __('Checkout') }}</div>
            
                            <div class="card-body">                        
                                
                                <h5>{{Auth::user()->name}}</h5>                                          
                                
                                <livewire:check-out />

                                @if ($showBotonRetroceso)

                                    <button type="button" wire:click="regresar" name="" id="" class="btn btn-primary">Back</button>   
                                    
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>


               {{--  <div class="row mt-4">

                    <div class="col-1">
    
                        <button type="button" wire:click="regresar" name="" id="" class="btn btn-primary">Back</button>
                        
                    </div>                      
                    
                </div>     --}}
                
            @endif

           
            
        @if ($showGeneral)
             
           
            {{-- Add Form Items   --}}

                @if ($showFormItems)             

                    <div class="row justify-content-center">

                        <div class="col-md-8">

                            <div class="card">
                                
                                <div class="card-header">Add Items</div>
                
                                <div class="card-body">

                                    {{--  Boton buscar   --}}

                                    <div class="row mb-3 justify-content-center">

                                        <label for="search" class="col col-md-2 col-form-label text-md-end">Search:</label>

                                        <div class="col col-md-6">
                                            
                                            <input wire:model="search" class="form-control" type="text" placeholder="Search Product code or name..."/>            
                                        
                                        </div>
                                    </div>

                                    
                                    {{--  Boton select   --}}

                                    <div class="row mb-3 justify-content-center">

                                        <label for="idProduct" class="col-md-2 col-form-label text-md-end">Product:</label>

                                        <div class="col-md-6">               
                                        
                                                <select wire:model="idProduct" class="form-select @error('idProduct') is-invalid @enderror" aria-label="Default select example">
                            
                                                    <option selected>Open this select menu</option>
                            
                                                    @foreach ($listaProductos as $item)
                            
                                                        <option value="{{$item->id}}">{{$item->itemnumber.' '.$item->name}}</option>
                            
                                                    @endforeach                       
                                                    
                                                </select> 
                
                                                @error('idProduct')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                            
                                        </div>
                            
                                    </div>


                                    {{--  Boton agregar   --}}

                                    <div class="row justify-content-md-center ">


                                        <div class="col-md-1">
                        
                                        <button type="button" wire:click="saveItem" name="" id="" class="btn btn-primary">Add</button>
                                        
                        
                                        </div>

                                        <div class="col-md-1">
                        
                                            <button type="button" wire:click="closeItem" name="" id="" class="btn btn-primary">Close</button>
                            
                                        </div>

                                    </div>   

                                    
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
            
                {{-- Add Form Bundle   --}}
                
                @if ($showFormItemsBundle)             

                    <div class="row justify-content-center mt-4">

                        <div class="col-md-8">

                            <div class="card">
                                
                                <div class="card-header">Add Bundles</div>
                
                                <div class="card-body">                               

                                    
                                    {{--  Boton select   --}}

                                    <div class="row mb-3 justify-content-center">

                                        <label for="idProductBundle" class="col-md-2 col-form-label text-md-end">Product:</label>

                                        <div class="col-md-6">               
                                        
                                                <select wire:model="idProductBundle" class="form-select @error('idProductBundle') is-invalid @enderror" aria-label="Default select example">
                            
                                                    <option selected>Open this select menu</option>  
                                                    
                                                    <option value="1">Bundle 1</option>
                                                    <option value="2">Bundle 2</option>
                                                    <option value="3">Bundle 3</option>
                                                    <option value="4">Bundle 4</option>
                                                    <option value="5">Bundle 5</option>
                                                    
                                                </select> 
                
                                                @error('idProductBundle')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                            
                                        </div>
                            
                                    </div>


                                    {{--  Boton agregar   --}}

                                    <div class="row justify-content-md-center ">


                                        <div class="col-md-1">
                        
                                        <button type="button" wire:click="saveItemBundle" name="" id="" class="btn btn-primary">Add</button>
                                        
                        
                                        </div>

                                        <div class="col-md-1">
                        
                                            <button type="button" wire:click="closeItemBundle" name="" id="" class="btn btn-primary">Close</button>
                            
                                        </div>

                                    </div>   

                                    
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
                
        
                {{-- <div wire:loading.inline-flex wire:target="save">    --}}              
                        
                
                @if ($mostrarItems)

                    <div class="row mt-4 mb-2" wire:loading.remove wire:target="save">

                    <div class="col-1">

                        <button type="button" wire:click="save" name="" id="" class="btn btn-primary">Checkout</button>

                        

                    </div>

                    <div class="col-1">

                        <button type="button" wire:click="openFormItem" name="" id="" class="btn btn-primary">AddItem</button>

                    </div>

                    <div class="col-1">

                        <button type="button" wire:click="openFormItemBundle" name="" id="" class="btn btn-primary">Bundle</button>

                    </div>


                    </div>  

                    <div class="table-responsive" wire:loading.remove wire:target="save">

                            <table class="table table-sm">

                                    <thead>
                                        <tr>
                                            <th scope="col">Order Qty</th>
                                            {{-- <th scope="col">Item text</th> --}}
                                            <th scope="col">Description</th>
                                            <th scope="col">Scan Item UPC</th>
                                            <th scope="col">Cases per Pallet</th>
                                            <th scope="col">Food Show Deal</th>
                                            <th scope="col">Notes</th>
                                            <th scope="col">Final Price</th>
                                            {{-- <th scope="col">{{Auth::user()->date1}}</th>
                                            <th scope="col">{{Auth::user()->date2}}</th>
                                            <th scope="col">{{Auth::user()->date3}}</th>  --}} 
                                            <th scope="col">{{$fecha1}}</th>
                                            <th scope="col">{{$fecha2}}</th>
                                            <th scope="col">{{$fecha3}}</th> 

                                        </tr>
                                    </thead>
                                    <tbody>
                    
                                    

                                    @if (!empty($items))                                       
                                    

                                        @foreach ($items as $key => $value)
                        
                                        
                                            {{--  <tr class="{{$control == $key ? $status:''}}">   --}}

                                            <tr class="{{empty($indicador[$key]) ? '': $indicador[$key]}}"> 
                                                
                                                
                        
                                                    {{-- @livewire('product-item', ['product' => $value], key($key)) --}}
                        
                                                {{--  <td> <button wire:click="agregar" type="button" class="btn btn-primary btn-sm">+</button> 
                                                    <button wire:click="eliminar" type="button" class="btn btn-danger btn-sm">-</button> </th>     --}}
                                        
                                                    <td>
                                                        <input wire:model="amount.{{$key}}" 
                                                        id="amount" type="number"  
                                                        class="form-control @error('amount.'.$key) is-invalid @enderror" 
                                                        name="amount" required autofocus>
                                                        
                                                        <span class="error">
                                                            @error('amount.'.$key) {{ $message }} @enderror
                                                        </span>
                        
                                                        {{-- <span>
                                                            {{ $control == $key ? $mensajex: ''}}
                                                        </span> --}}
                                                        
                                                    </td>
                                                    {{-- <td>{{$value[itemnumber}}</td> --}}
                                                    <td>{{$value['description']}}</td>
                                                    <td>{{$value['upc']}}</td>
                                                    <td>{{$value['pallet']}}</td>
                                                    {{-- <td>{{$value['price']}}</td> --}}

                                                    <td><input wire:model="prices.{{$key}}" 
                                                        id="prices" type="number" 
                                                        class="form-control @error('prices.'.$key) is-invalid @enderror" name="prices" >
                                                    
                                                        <span class="error">
                                                            @error('prices.'.$key) {{ $message }} @enderror
                                                        </span>
                                                    
                                                    </td>
                        
                        
                                                    <td><input wire:model="notes.{{$key}}" 
                                                        id="notes" type="number" 
                                                        class="form-control @error('notes.'.$key) is-invalid @enderror" name="notes" >
                                                    
                                                        <span class="error">
                                                            @error('notes.'.$key) {{ $message }} @enderror
                                                        </span>
                                                    
                                                    </td>
                        
                        
                                                    {{-- <td>{{!empty($notes[$key])? $value['price'] - $notes[$key] :$value['price']}}</td> --}}

                                                    <td>{{!empty($notes[$key])? (float) $prices[$key] - (float) $notes[$key] :(float) $prices[$key]}}</td>
                        
                                            
                                                    <td><input wire:model="qtyone.{{$key}}" 
                                                        id="qtyone" type="number" 
                                                        class="form-control @error('qtyone.'.$key) is-invalid @enderror" name="qtyone" required>
                                                    
                                                        
                                                        <span class="error">
                                                            @error('qtyone.'.$key) {{ $message }} @enderror
                                                        </span>
                        
                                                    </td>
                                            
                                                    <td><input wire:model="qtytwo.{{$key}}"  
                                                        id="qtytwo" type="number" 
                                                        class="form-control @error('qtytwo.'.$key) is-invalid @enderror" name="qtytwo">
                                                    
                                                        <span class="error">
                                                            @error('qtytwo.'.$key) {{ $message }} @enderror
                                                        </span>
                        
                                                    </td>
                                            
                                                    <td><input wire:model="qtythree.{{$key}}" 
                                                        id="qtythree" type="number"  
                                                        class="form-control @error('qtythree.'.$key) is-invalid @enderror" name="qtythree">
                                                    
                                                        <span class="error">
                                                            @error('qtythree.'.$key) {{ $message }} @enderror
                                                        </span>
                        
                                                    </td>     
                                            
                                            
                                            </tr>                            
                                            
                        
                                        @endforeach  
                                    
                                    @else                                       

                                        <h3> No items </h3>

                                        
                                    @endif
                                      
                                                                
                                        
                                    </tbody>

                            </table>

                    </div>
                    
                        
                @endif


        @endif               
            
</div>


