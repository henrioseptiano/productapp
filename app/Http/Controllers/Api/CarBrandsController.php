<?php

namespace App\Http\Controllers\Api;

//use Illuminate\Support\Facades\Request;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\CarBrand;
use App\Car;
use App\Http\Controllers\Controller;

class CarBrandsController extends Controller
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
        $brand = "";
        if(isset($inputs['brand']) && !empty($inputs['brand'])){
            $brand = $inputs['brand'];
        }
        $brandModel = new CarBrand();
        $brandModel->brand_name = $brand;
        $brandModel->save();
    }

    public function update(Request $request){
        $inputs = $request->all();
        $brand = "";
        $brand_id = 0;
        if(isset($inputs['brand_id']) && !empty($inputs['brand_id'])){
            if(is_numeric($inputs['brand_id'])){
                $brand_id = intval($inputs['brand_id']);
            }
        }
        if(isset($inputs['brand']) && !empty($inputs['brand'])){
            $brand = $inputs['brand'];
        }
        $brandModel = CarBrand::whereRaw("id = ?",$brand_id)->first();
        $brandModel->brand_name = $brand;
        $brandModel->save();
    }

    public function destroy(Request $request){
        $inputs = $request->all();
        $brand_id = 0;
        if(isset($inputs['brand_id']) && !empty($inputs['brand_id'])){
            if(is_numeric($inputs['brand_id'])){
                $brand_id = intval($inputs['brand_id']);
            }
        }
        //check if there brand on car data
        $getCar = Car::selectRaw("count(*) as cars")->whereRaw("brand_id = ?", [$brand_id])->first();
        $countCars = intval($getCar->cars);
        if($countCars > 0){
            return response()->json(["HTTP CODE" => "404", "Message" => "Cannot Delete Brand. Please Delete Car First"]);
        }
        CarBrand::whereRaw("id = ?",$brand_id)->delete();

    }

}