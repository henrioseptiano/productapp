<?php

namespace App\Http\Controllers\Main;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    public function login(Request $request){
        //print_r(session('username'));

        if(Session::has('username')){
            return redirect('/');
        }
        return view("login.index");
    }

    public function loginProcess(Request $request){
        $input = $request->all();
        $username = $password = null;
        if(isset($input["username"]) && !empty($input["username"])){
            $username = $input["username"];
        }
        if(isset($input["password"]) && !empty($input["password"])){
            $password = $input["password"];
        }
        $user = User::join("roles","users.roles_id","=","roles.id")
                ->selectRaw("username, password, roles.role_name as role")->whereRaw("username = ?", [$username])->first();
        if(password_verify($password, $user->password)){

            Session::put('username',$username);
            Session::put('role',$user->role);
            Session::save();

            return redirect('/');
        }else{
            return back()->with("message", "Invalid Login Credentials")->withInput();
        }
    }
    public function logoutProcess(Request $request){
        Session::forget("username");
        Session::flush();
        return redirect('/');
    }
}
