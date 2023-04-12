
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

                <div wire:loading.inline-flex wire:target="procesarPedido">       

                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Processing...
                    </button>
                    
                </div>

            </div> 


            <div class="Container">

                        @if(!$general)           
                        
                                {{-- search  --}} 

                                @if ($mostrarPin)   

                                
                                    <div class="row mb-4 mt-2" wire:loading.remove wire:target="procesarPedido">           

                                        <div class="col-md-6">                
                                            
                                            <input type="text" class="col form-control" wire:model="searchx" autocomplete="off">               
                                        
                                        </div>

                                        {{-- <div class="col-md-6">                
                                            
                                            <button class="btn btn-primary" wire:click="CaptarIdCliente">Search Customer</button>
                                        
                                        </div> --}}
                                    </div> 


                                @endif
                                    
                                {{-- <form wire:procesarPedido.prevent="procesarPedido" wire:loading.remove wire:target="procesarPedido" autocomplete="off">  --}}
                                <div wire:loading.remove wire:target="procesarPedido">           

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

                                         {{-- customer address--}}

                                         <div class="row mb-3">                
                                
                                            <div class="col-md-6">
                                
                                                <label for="addressBundle" class="col-form-label text-md-end">Customer Address</label>  

                                                <label class="form-control">{{ empty($this->Customer->address)?'Customer Address':$this->Customer->address }}</label>


                                            </div>
                                        </div>

                                        {{-- Sales Rep  email--}}

                                        <div class="row mb-3">                
                                
                                            <div class="col-md-6">
                                
                                                <label for="emailRep" class="col-form-label text-md-end">Sales Rep</label>
                                                
                                                {{-- <input wire:model="emailRep" id="emailRep" type="emailRep" class="form-control @error('emailRep') is-invalid @enderror" name="emailRep" required>
                                
                                                @error('emailRep')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror --}}

                                                <label class="form-control">{{ empty($this->Customer->emailRep)?'Sales Rep Email':$this->Customer->emailRep }}</label>


                                            </div>
                                        </div>
                                
                                        {{-- email vendor  --}}

                                        <div class="row mb-3">                
                                
                                            <div class="col-md-6">
                                
                                                <label for="vendorEmail" class="col-form-label text-md-end">Email Vendor</label>
                                                
                                               {{--  <input wire:model="vendorEmail" id="vendorEmail" type="vendorEmail" class="form-control @error('vendorEmail') is-invalid @enderror" name="vendorEmail" required> --}}
                                
                                                {{-- @error('vendorEmail')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror --}}

                                                <label class="form-control">{{ Auth::user()->emailuser }}</label>


                                            </div>
                                        </div>
                                                            
                                        
                                        {{-- pin customer  --}}

                                        @if ($mostrarPin)                                                                                 

                                            <div class="row mb-3">                
                                    
                                                <div class="col-md-6">
                                    
                                                    <label for="pin" class="col-form-label">PIN</label>
                                    
                                                    {{-- <input wire:model="pin" id="pin" type="password" class="form-control @error('pin') is-invalid @enderror" name="pin" required autocomplete="off"> --}}

                                                    <input wire:model="pin" id="pin" type="{{$tipoInput}}" class="form-control @error('pin') is-invalid @enderror" name="pin" required autocomplete="new-password">
                                    
                                                    @error('pin')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                        @endif

                                        {{-- Colocando la tabla --}}

                                        <table class="table table-bordered">
                                            <thead align="center">
                                              <tr>
                                                    <th scope="col">Order Qty</th>                                                    
                                                    <th scope="col" colspan="3">Description</th>
                                                    <th scope="col">Scan Item UPC</th>
                                                    <th scope="col">Cases per Pallet</th>
                                                    <th scope="col">Food Show Deal</th>
                                                    <th scope="col">Notes $</th>
                                                    <th scope="col">Final Price $</th>                                                    
                                                    <th scope="col">{{Auth::user()->date1}}</th>
                                                    <th scope="col">{{Auth::user()->date2}}</th>
                                                    <th scope="col">{{Auth::user()->date3}}</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                    
                                                @php
                                                    $total =0;
                                                    $totalqty=0;
                                                    $totalpallet=0;
                                                    $totalqtyone=0;
                                                    $totalqtytwo=0;
                                                    $totalqtythree=0;
                                    
                                                @endphp
                                    
                                    
                                                @if (session('carrito'))
                                                                        
                                                    @foreach (session('carrito') as $item)
                                    
                                                        <tr>
                                                            <td>{{ $item['amount'] }}</td>
                                                            <td colspan="3">{{ $item['name'] }}</td>
                                                            <td>{{ $item['upc'] }}</td>
                                                            <td>{{ $item['pallet'] }}</td>
                                                            <td>{{ '$ '. $item['price'] }}</td>
                                                            <td>{{ '$ '. $item['notes'] }}</td>
                                                            <td>{{ '$ '. $item['finalprice'] }}</td>
                                                            <td>{{ $item['qtyone'] }}</td>
                                                            <td>{{ $item['qtytwo'] }}</td>
                                                            <td>{{ $item['qtythree'] }}</td>
                                                            
                                                        </tr> 
                                    
                                                        @php
                                                            $totalqty=$totalqty + $item['amount'];
                                                            $totalpallet=$totalpallet + $item['pallet'];
                                                            $totalqtyone=$totalqtyone + $item['qtyone'];
                                                            $totalqtytwo=$totalqtytwo + $item['qtytwo'];
                                                            $totalqtythree=$totalqtythree + $item['qtythree'];
                                                            $total = $total + $item['amount'] * $item['finalprice'];
                                                        @endphp
                                                    @endforeach 

                                                        <tr>
                                                            <td>{{ $totalqty }}</td>
                                                            <td colspan="3"></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>{{ $totalqtyone }}</td>
                                                            <td>{{ $totalqtytwo}}</td>
                                                            <td>{{ $totalqtythree }}</td>
                                                            
                                                        </tr> 

                                                        <tr>
                                                            <td><strong>Total Order:</strong></td>
                                                            <td colspan="9"><strong>{{ '$ '. number_format($total,2) }}</strong></td>
                                                            
                                                            
                                                        </tr> 
                                    
                                                @else
                                    
                                                    <h6>No Product in the Cart</h6>  
                                                                  
                                                @endif  
                                                
                                            </tbody>   
                                            
                                        </table>

                                        {{-- rebate  --}}

                                        <div class="row mb-3">                
                                
                                            <div class="col-md-6">
                                
                                                <label for="rebate" class="col-form-label">Rebate</label>
                                
                                                {{-- <input wire:model="rebate" id="rebate" type="number" step=".01" class="form-control @error('rebate') is-invalid @enderror" name="rebate" autocomplete="new-password" > --}}
                                
                                                <div class="input-group mb-3">

                                                    <span class="input-group-text">$</span>
                                                    <input wire:model.debounce.1000ms="rebate" id="rebate" type="number" step=".01" class="form-control" aria-label="Amount (to the nearest dollar)">
                                                    {{-- <span class="input-group-text">.00</span> --}}
                                                
                                                </div>
                                                
                                                
                                                
                                                
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

                                        {{-- procesarPedido  --}}

                                        <div class="row mb-3">

                                            <div class="col-md-6">

                                                {{-- <button type="procesarPedido" class="btn btn-primary">Checkout</button>   --}}
                                                <button wire:click="procesarPedido" type="button" class="btn btn-primary">Checkout</button>
                                                <button type="button" wire:click="$emit('regresar')" name="" id="" class="btn btn-primary">Back</button> 

                                            </div>

                                        </div>
                                    
                                    @endif

                                </div>                             
                             
                        @endif       
                
            </div>            

            <div class="container">  

                    @if ($mostrarOrdenCreada)

                        <div class="row mt-3">
                            
                            <h5>Order: <a href="{{url('export-order',[$lastId])}}" class="btn btn-primary">{{ $Customer->name . " - ". Auth::user()->name . " .xlsx" }}</a> </h5>
                            <h5>Date Order: {{$orderDate->format('m-d-Y')}}</h5>
                        
                            <h5>Total Order: {{'$ ' . number_format($total,2)}}</h5>
                            <h5>Rebate: {{'$ ' . number_format($rebate,2)}}</h5>

                        </div>

                    @endif       
                    
            </div>

            @if ($statusEmail)

                <div class="alert alert-danger" role="alert">

                    {{ $statusEmail }}

                </div>
            
            @endif
    
</div>


