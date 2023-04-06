<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Auth::user()->rol == 'admin') {

            $users = User::paginate(25);

        } else {
           
            $users = User::where('id', Auth::id())->paginate(15);
        }
        
       

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => ['required', 'string', 'max:255'],            
            'email' => ['required'],
            'emailuser' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'date1' => ['required'],
            'date2' => ['required'],
            'date3' => ['required'],            
        ]);

        //User::create($request->post());

        $user = new User;

        $user->name = $request->name;       
        $user->email = $request->email;
        $user->emailuser = $request->emailuser;
        $user->password = Hash::make($request->password);
        $user->date1 = $request->date1;
        $user->date2 = $request->date2;
        $user->date3 = $request->date3; 
        $user->rol = $request->rol;      

        $user->save();


        return redirect()->route('users.index')->with('status','Vendor has been created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user= User::find($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([

            'name' => ['required', 'string', 'max:255'],            
            'email' => ['required'],
            'emailuser' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'date1' => ['required'],
            'date2' => ['required'],
            'date3' => ['required'],            
        ]);
 
        $user= User::find($id);

        $user->name = $request->name;        
        $user->email = $request->email;
        $user->emailuser = $request->emailuser;
        $user->password = Hash::make($request->password);
        $user->date1 = $request->date1;
        $user->date2 = $request->date2;
        $user->date3 = $request->date3; 
        $user->rol = $request->rol;          

        $user->save();

        return redirect()->route('users.index')->with('status','Vendor has been updated successfully.');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user= User::find($id);

        $user->delete();

        return redirect()->route('users.index')->with('status','Vendor has been deleted successfully.');
    }


    public function export()     {
        
        //dd('estoy dentro del excel');
       return Excel::download(new UsersExport, 'users.xlsx');
    }

    
}


