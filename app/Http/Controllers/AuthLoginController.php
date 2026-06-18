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
    public function edit()
    {
        $user=auth_login::find(session('user_id'));
        if(!$user) {
            return redirect()->route('login')->with('error','please login first');
        }
        return view('edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = auth_login::find(session('user_id'));

        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:auth_logins,email,' . $user->id,
            'password' => 'nullable|min:6'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('dashboard')
            ->with('success', 'Profile Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy()
    // {
    //     $user = auth_login::find(session('user_id'));

    //     $user->delete();

    //     session()->forget(['user_id', 'user_name']);

    //     return redirect()->route('index')->with('success', 'Account deleted');
    // }
}
