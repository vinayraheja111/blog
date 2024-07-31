<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Hash,Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        return view('register');
    }

    public function login(){
        return view('login');
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $user = new User();
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->password = Hash::make($request->post('password'));
        $user->save();

        return redirect('user-login')->with('success','Registraion successful!!');
    }

    public function userLogin(Request $request){
        // dd($request->all());/
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

         $credentials = $request->only('email', 'password');

         if (Auth::attempt($credentials)) {
            return redirect('/');
            } else {
            return redirect('user-login')->with('error','Invalid email or password');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/user-login'); 
    }
}
