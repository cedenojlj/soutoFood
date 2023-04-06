@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">          

            <div class="card mt-3">

                <div class="card-header">


                  <div style="display: flex; justify-content: space-between; align-items: center;">

                    <span id="card_title">
                      Vendors
                    </span>

                     {{-- <div class="float-right">
                      <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}">Create New</a>
                        </a>
                      </div> --}}
                </div>



                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          @foreach ($users as $user)

                          <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td> {{$user->name}} </td>
                            <td>{{$user->email}}</td>
                            <td>
                                <form action="{{route('users.destroy', $user->id)}}" method="post">

                                  <a class="btn btn-primary" href="{{route('users.edit', $user->id)}}">{{Auth::user()->rol == 'admin'?'Edit':'View'}}</a>

                                  @csrf
                                  @method('DELETE')

                                  {{-- <button type="submit" class="btn btn-danger">Delete</button> --}}
                                  
                                </form>

                            </td>
                          </tr>
                              
                          @endforeach
                          
                          
                          
                        </tbody>
                      </table>  

                      {{ $users->links() }}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
