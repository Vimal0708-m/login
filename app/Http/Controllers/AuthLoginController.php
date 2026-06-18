<?php

namespace App\Http\Controllers;

use App\Models\auth_login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|min:3',
            'email'=> 'required|email|unique:auth_logins,email',
            'password'=> 'required|min:6|confirmed'
        ]);
        auth_login::Create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password)
        ]);
        return redirect()->route('login')->with('success','User Has been created');
    }

    public function checklogin(Request $request)
    {
        $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
        $user = auth_login::where('email', $request->input('email'))->first();

        if ($user && Hash::check($request->password, $user->password)) {

        session([
            'user_id' => $user->id,
            'user_name' => $user->name
        ]);

        return redirect()->route('dashboard');
    }

    return back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('login');
    }

    public function dashboard(){
    return view('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(auth_login $auth_login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(auth_login $auth_login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, auth_login $auth_login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(auth_login $auth_login)
    {
        //
    }
}
