@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                       {{--  <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus disabled>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <label class="form-control">{{ $user->name }}</label>
                                <input type="hidden" name="name" value="{{ $user->name }}">
                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" {{Auth::user()->rol == 'user'?'disabled':''}}>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="emailuser" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="emailuser" type="text" class="form-control @error('emailuser') is-invalid @enderror" name="emailuser" value="{{ $user->emailuser }}" required autocomplete="emailuser" {{Auth::user()->rol == 'user'?'disabled':''}}>

                                @error('emailuser')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="row ">

                            @if (Auth::user()->rol == "admin")
                           
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">

                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> 

                            @else

                            <input type="hidden" name="password" value="12345678">

                            @endif

                        </div>

                        <div class="row ">

                            @if (Auth::user()->rol == "admin")

                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div> 

                            @else

                                <input type="hidden" name="password_confirmation" value="12345678">

                            @endif

                        </div>

                        <div class="row mb-3">
                            <label for="date1" class="col-md-4 col-form-label text-md-end">Date1</label>

                            <div class="col-md-6">
                                <input id="date1" type="date" class="form-control" name="date1" required value="{{$user->date1}}" {{Auth::user()->rol == 'user'?'disabled':''}}>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="date2" class="col-md-4 col-form-label text-md-end">Date2</label>

                            <div class="col-md-6">
                                <input id="date2" type="date" class="form-control" name="date2" required value="{{$user->date2}}" {{Auth::user()->rol == 'user'?'disabled':''}}>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="date3" class="col-md-4 col-form-label text-md-end">Date3</label>

                            <div class="col-md-6">
                                <input id="date3" type="date" class="form-control" name="date3" required value="{{$user->date3}}" {{Auth::user()->rol == 'user'?'disabled':''}}>
                            </div>
                        </div>

                        <div class="row mb-3">   
                            
                            @if (Auth::user()->rol == "admin")

                                <label for="rol" class="col-md-4 col-form-label text-md-end">Rol</label>

                                <div class="col-md-6">               
                            
                                    <select name="rol" class="form-select @error('rol') is-invalid @enderror" aria-label="Default select example">
                
                                        <option >Open this select menu</option>                
                                                       
                                        <option {{$user->rol == "user" ? 'selected' : ''}} value="user">User</option>
                                        <option {{$user->rol == "admin" ? 'selected' : ''}} value="admin">Admin</option>              
                                                              
                                        
                                    </select> 

                                    @error('rol')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                
                                </div>
                            
                            @else

                                 <input type="hidden" name="rol" value="{{ $user->rol }}">

                            @endif

                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">

                                @if (Auth::user()->rol == 'admin')

                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                    
                                @else
                                    
                                <a class="btn btn-primary" href="{{ route('home') }}">Back</a>
                            </a>
                                    
                                    
                                @endif

                                


                               


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
