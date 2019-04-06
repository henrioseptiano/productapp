<?php

namespace App\Http\Controllers\Api;

//use Illuminate\Support\Facades\Request;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    /*public function show($id)
    {
        return User::findOrFail($id);
    }*/
    public function store(Request $request){
        $inputs = $request->all();
        $username = $password = $firstName = $lastName = $status = "";
        $roleId = 0;
        if(isset($inputs['username']) && !empty($inputs['username'])){
            $username = $inputs['username'];
        }
        if(isset($inputs['password']) && !empty($inputs['password'])){
            $password = password_hash($inputs['password'], PASSWORD_BCRYPT);
        }
        if(isset($inputs['firstName']) && !empty($inputs['firstName'])){
            $firstName = $inputs['firstName'];
        }
        if(isset($inputs['lastName']) && !empty($inputs['lastName'])){
            $lastName = $inputs['username'];
        }
        if(isset($inputs['roleId']) && !empty($inputs['roleId'])){
            if(is_numeric($inputs['roleId'])) {
                $roleId = intval($inputs['roleId']);
            }
        }


        $user = new User();
        $user->username = $username;
        $user->password = $password;
        $user->roles_id = $roleId;
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->status = "inactive";
        $user->save();
    }

    public function update(Request $request){
        $inputs = $request->all();
        $username = $password = $firstName = $lastName = $status = "";
        $userId = $roleId = 0;
        if(isset($inputs['userId']) && !empty($inputs['userId'])){
            if(is_numeric($inputs['userId'])) {
                $userId = $inputs['userId'];
            }
        }
        if(isset($inputs['username']) && !empty($inputs['username'])){
            $username = $inputs['username'];
        }
        if(isset($inputs['password']) && !empty($inputs['password'])){
            $password = password_hash($inputs['password'], PASSWORD_BCRYPT);
        }
        if(isset($inputs['firstName']) && !empty($inputs['firstName'])){
            $firstName = $inputs['firstName'];
        }
        if(isset($inputs['lastName']) && !empty($inputs['lastName'])){
            $lastName = $inputs['username'];
        }
        if(isset($inputs['roleId']) && !empty($inputs['roleId'])){
            if(is_numeric($inputs['roleId'])) {
                $roleId = intval($inputs['roleId']);
            }
        }
        if(isset($inputs['status']) && !empty($inputs['status'])){
            $status = $inputs['status'];
        }

        $user = User::whereRaw("id = ?",[$userId])->first();
        $user->username = $username;
        $user->password = $password;
        $user->roles_id = $roleId;
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->status = $status;
        $user->save();
    }

    public function destroy(Request $request){
        $inputs = $request->all();
        $userId = 0;
        if(isset($inputs['userId']) && !empty($inputs['userId'])){
            if(is_numeric($inputs['userId'])) {
                $userId = $inputs['userId'];
            }
        }
        $user = User::whereRaw("id = ?",[$userId])->first();
        $user->status = "inactive";
        $user->save();
    }

}