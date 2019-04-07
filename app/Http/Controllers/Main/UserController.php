<?php

namespace App\Http\Controllers\Main;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    public function login(){
        return view("login.index");
    }

    public function loginProcess(Request $request){
        $input = $request->all();
        $user = $password = null;
        if(isset($input["username"]) && !empty($input["username"])){
            $user = $input["username"];
        }
        if(isset($input["password"]) && !empty($input["password"])){
            $password = $input["password"];
        }
        $user = User::whereRaw("username = ?", [$user])->first();
        if(password_verify($password, $user->password)){
            $request->session()->put('username', $user);
            return redirect('/');
        }else{
            return back()->with("message", "Invalid Login Credentials")->withInput();
        }
        //return view("products.index");
    }
    public function logoutProcess(){
        Session::forget("username");
        Session::flush();
        return redirect('/');
    }
}
