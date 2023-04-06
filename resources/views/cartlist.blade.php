@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Cart') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('errores'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('errores') }}
                    </div>
                @endif

                    <h5>{{Auth::user()->name}}</h5>
                    
                    <livewire:cart-list />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


