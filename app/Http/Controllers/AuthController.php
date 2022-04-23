<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login(){
        return Inertia::render("Auth/Login");
    }

    public function register(){
        return Inertia::render('Auth/Register');
    }

    public function registerAcc(Request $request){


        $request->validate([
            'name'=>'required|max:50',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
            'photo' => 'image|mimes:png,jpg,jpeg',
        ]);


        if ($request->file('photo')) {

            $photo = $request->file('photo');
            $path = 'public/images/profile';
            $photo_name = 'profile_'.uniqid().'_photo.'.$photo->getClientOriginalExtension();
            $photo->storeAs($path,$photo_name);

        }


        $user = new User();

        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        if ($request->file('photo')) {

            $user->photo = $photo_name;

        }
        $user->save();

        $credentials = $request->only('email','password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('page.home');
        }

    }


    public function loginAcc(Request $request){

        $request->validate([
            'email'=>'required',
            'password'=>'required|min:8',
        ]);

        $credentials = $request->only('email','password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('page.home')->with('success','Welcome '.Auth::user()->name);
}

    }

    public function logOut(){
        Auth::logout();
        return redirect()->route('login');
    }

}
