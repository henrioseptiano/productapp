<?php

namespace App\Http\Controllers\Api;

//use Illuminate\Support\Facades\Request;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RoleController extends Controller
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
        $role = "";
        if(isset($inputs['role']) && !empty($inputs['role'])){
            $role = $inputs['role'];
        }

        $roleModel = new Role();
        $roleModel->role_name = $role;
        $roleModel->save();
    }

    public function update(Request $request){
        $inputs = $request->all();
        $role = "";
        $roleId = "";

        if(isset($inputs['role_id']) && !empty($inputs['role_id'])){
            if(intval($inputs['role_id'])){
                $roleId = intval($inputs['role_id']);
            }
        }

        if(isset($inputs['role']) && !empty($inputs['role'])){
            $role = $inputs['role'];
        }

        $roleModel = Role::whereRaw("id = ?",[$roleId])->first();
        $roleModel->role_name = $role;
        $roleModel->save();
    }

    public function destroy(Request $request){
        $inputs = $request->all();
        $roleId = 0;
        if(isset($inputs['role_id']) && !empty($inputs['role_id'])){
            if(intval($inputs['role_id'])){
                $roleId = intval($inputs['role_id']);
            }
        }
        //check userid
        $getUser = DB::Table("users")->selectRaw("count(*) as users")->whereRaw("roles_id = ?",[$roleId])->first();
        $checkUserid = intval($getUser->users);
        if($checkUserid > 0){
            return response()->json(["HTTP CODE" => "404", "message" => "Cannot Delete Role. Please delete user first"]);
        }
        Role::whereRaw("id = ?",[$roleId])->delete();
    }

}