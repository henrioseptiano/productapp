<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Request;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Car;

class CarsController extends Controller
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

        $model = $brand = $fuel = $transmission = $engineType = $image = "";
        $yearBuilt = $price = 0;
        if(isset($inputs['model']) && !empty($inputs['model'])){
            $model = $inputs['model'];
        }
        if(isset($inputs['brand_id']) && !empty($inputs['brand_id'])){
            $brand = $inputs['brand_id'];
        }
        if(isset($inputs['fuel']) && !empty($inputs['fuel'])){
            $fuel = $inputs['fuel'];
        }
        if(isset($inputs['year_built']) && !empty($inputs['year_built'])){
            if(is_numeric($inputs['year_built'])) {
                $yearBuilt = intval($inputs['year_built']);
            }
        }
        if(isset($inputs['price']) && !empty($inputs['price'])){
            if(is_numeric($inputs['price'])) {
                $price = intval($inputs['price']);
            }
        }
        if(isset($inputs['transmission']) && !empty($inputs['transmission'])){
            $transmission = $inputs['transmission'];
        }
        if(isset($inputs['engine_type']) && !empty($inputs['engine_type'])){
            $engineType = $inputs['engine_type'];
        }
        if(isset($inputs['image']) && !empty($inputs['image'])){
            $image = $inputs['image'];
        }

        $car = new Car();
        $car->brand_id = $brand;
        $car->model = $model;
        $car->year_built = $yearBuilt;
        $car->fuel  = $fuel;
        $car->price = $price;
        $car->transmission = $transmission;
        $car->engine_type = $engineType;
        $car->image = $image;
        $car->created_at = Carbon::now();
        $car->created_by = " ";
        $car->updated_by = " ";
        $car->save();

    }

    public function update(Request $request){
        $inputs = $request->all();

        $model = $brand = $fuel = $transmission = $engineType = $image = "";
        $carId = $yearBuilt = $price = 0;
        if(isset($inputs['car_id']) && !empty($inputs['car_id'])){
            if(is_numeric($inputs['car_id'])) {
                $carId = intval($inputs['car_id']);
            }
        }
        if(isset($inputs['model']) && !empty($inputs['model'])){
            $model = $inputs['model'];
        }
        if(isset($inputs['brand_id']) && !empty($inputs['brand_id'])){
            $brand = $inputs['brand_id'];
        }
        if(isset($inputs['fuel']) && !empty($inputs['fuel'])){
            $fuel = $inputs['fuel'];
        }
        if(isset($inputs['year_built']) && !empty($inputs['year_built'])){
            if(is_numeric($inputs['year_built'])) {
                $yearBuilt = intval($inputs['year_built']);
            }
        }
        if(isset($inputs['price']) && !empty($inputs['price'])){
            if(is_numeric($inputs['price'])) {
                $price = intval($inputs['price']);
            }
        }
        if(isset($inputs['transmission']) && !empty($inputs['transmission'])){
            $transmission = $inputs['transmission'];
        }
        if(isset($inputs['engine_type']) && !empty($inputs['engine_type'])){
            $engineType = $inputs['engine_type'];
        }
        if(isset($inputs['image']) && !empty($inputs['image'])){
            $image = $inputs['image'];
        }

        $car = Car::whereRaw("id = ?",[$carId])->first();
        $car->brand_id = $brand;
        $car->model = $model;
        $car->year_built = $yearBuilt;
        $car->fuel  = $fuel;
        $car->price = $price;
        $car->transmission = $transmission;
        $car->engine_type = $engineType;
        $car->image = $image;
        $car->updated_at = Carbon::now();
        $car->updated_by = " ";
        $car->save();
    }

    public function destroy(Request $request){
        $inputs = $request->all();
        $carId = 0;
        if(isset($inputs['car_id']) && !empty($inputs['car_id'])){
            if(is_numeric($inputs['car_id'])) {
                $carId = intval($inputs['car_id']);
            }
        }
        try{
            Car::whereRaw("id = ?",[$carId])->delete();
        }catch (QueryException $e){
            echo $e->getMessage();
        }
        //Car::whereRaw("id = ?",[$carId])->delete();
    }

}