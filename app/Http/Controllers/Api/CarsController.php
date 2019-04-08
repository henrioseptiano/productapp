<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Request;
use Carbon\Carbon;
use Faker\Provider\Image;
use http\Env\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Car;
use Illuminate\Support\Facades\Storage;
use PharIo\Manifest\Url;

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
            //check existing car model
            $model = $inputs['model'];
            $checkModel = Car::selectRaw("count(*) as model")->whereRaw("model = ?", $model)->first();
            if(intval($checkModel->model) > 0 ){
                return \response()->json(["http" => "400", "Message" => "Model Name already Exist!"]);
            }
        }
        else{
            return \response()->json(["http" => "400", "Message" => "Model Must Be Filled!"]);
        }
        if(isset($inputs['brand_id']) && !empty($inputs['brand_id'])){
            $brand = $inputs['brand_id'];
        }else{
            return \response()->json(["http" => "400", "Message" => "Must Select Brand Id!"]);
        }
        if(isset($inputs['fuel']) && !empty($inputs['fuel'])){
            $fuel = $inputs['fuel'];
        }
        else{
            return \response()->json(["http" => "400", "Message" => "Fuel Must Be Filled!"]);
        }
        if(isset($inputs['year_built']) && !empty($inputs['year_built'])){
            if(is_numeric($inputs['year_built'])) {
                $yearBuilt = intval($inputs['year_built']);
            }else{
                return \response()->json(["http" => "400", "Message" => "Year Must Be Numeric!"]);
            }
        }
        else{
            return \response()->json(["http" => "400", "Message" => "Year Must Be Filled!"]);
        }
        if(isset($inputs['price']) && !empty($inputs['price'])){
            if(is_numeric($inputs['price'])) {
                $price = intval($inputs['price']);
            }
            else{
                return \response()->json(["http" => "400", "Message" => "Price Must Be Numeric!"]);
            }
        }
        else{
            return \response()->json(["http" => "400", "Message" => "Price Must Be Filled!"]);
        }
        if(isset($inputs['transmission']) && !empty($inputs['transmission'])){
            $transmission = $inputs['transmission'];
        }
        else{
            return \response()->json(["http" => "400", "Message" => "Transmission Must Be Filled!"]);
        }
        if(isset($inputs['engine_type']) && !empty($inputs['engine_type'])){
            $engineType = $inputs['engine_type'];
        }
        else{
            return \response()->json(["http" => "400", "Message" => "Engine Type Must Be Filled!"]);
        }
        if($request->file('image') != null){
            $image = $request->file('image');
            $destinationPath = 'uploads';
            $extension = $image->getClientOriginalExtension();
            $fileName = date("YmdHis") . '.' . $extension;
            $image->move($destinationPath, $fileName);
            //$image = url('/').'/'.$fileName;
            $image = '/'.$fileName;
        }else{
            return \response()->json(["http" => "400", "Message" => "Image Must Be Filled!"]);
        }

        try {
            $car = new Car();
            $car->brand_id = $brand;
            $car->model = $model;
            $car->year_built = $yearBuilt;
            $car->fuel = $fuel;
            $car->price = $price;
            $car->transmission = $transmission;
            $car->engine_type = $engineType;
            $car->image = $image;
            $car->created_at = Carbon::now();
            $car->created_by = " ";
            $car->updated_by = " ";
            $car->save();
            return \response()->json(["http" => "200", "Message" => "Success Submitted Data!"]);
        }catch(QueryException $e){
            return \response()->json(["http" => "400", "Message" => "Server Error! Please Contact Support Team!"]);
        }
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
            $checkModel = Car::selectRaw("count(*) as carModel, model")->whereRaw("model = ?",[$model])->groupBy("model")->first();

            if($checkModel !== null){
                return \response()->json(["http" => "400", "Message" => "Model Name already Exist!"]);
            }
        }
        else{
            return \response()->json(["http" => "400", "Message" => "Model Must Be Filled!"]);
        }

        if(isset($inputs['brand_id']) && !empty($inputs['brand_id'])){
            $brand = $inputs['brand_id'];
        }
        else{
            return \response()->json(["http" => "400", "Message" => "Must Select Brand Id!"]);
        }
        if(isset($inputs['fuel']) && !empty($inputs['fuel'])){
            $fuel = $inputs['fuel'];
        }
        else{
            return \response()->json(["http" => "400", "Message" => "Fuel Must Be Filled!"]);
        }
        if(isset($inputs['year_built']) && !empty($inputs['year_built'])){
            if(is_numeric($inputs['year_built'])) {
                $yearBuilt = intval($inputs['year_built']);
            }
            else{
                return \response()->json(["http" => "400", "Message" => "Year Must Be Numeric!"]);
            }
        }
        else{
            return \response()->json(["http" => "400", "Message" => "Year Must Be Filled!"]);
        }
        if(isset($inputs['price']) && !empty($inputs['price'])){
            if(is_numeric($inputs['price'])) {
                $price = intval($inputs['price']);
            }
            else{
                return \response()->json(["http" => "400", "Message" => "Price Must Be Numeric!"]);
            }
        }
        else{
            return \response()->json(["http" => "400", "Message" => "Price Must Be Filled!"]);
        }
        if(isset($inputs['transmission']) && !empty($inputs['transmission'])){
            $transmission = $inputs['transmission'];
        }
        else{
            return \response()->json(["http" => "400", "Message" => "Transmission Must Be Filled!"]);
        }
        if(isset($inputs['engine_type']) && !empty($inputs['engine_type'])){
            $engineType = $inputs['engine_type'];
        }
        else{
            return \response()->json(["http" => "400", "Message" => "Engine Type Must Be Filled!"]);
        }

        if($request->file('imageFile') != null) {
            $image = $request->file('imageFile');
            $destinationPath = 'uploads';
            $extension = $image->getClientOriginalExtension();
            $fileName = date("YmdHis") . '.' . $extension;
            $image->move($destinationPath, $fileName);
            //$image = url('/').'/'.$fileName;
            $image = '/' . $fileName;
        }else{
            if(isset($inputs['image']) && !empty($inputs['image'])){
                $image = $inputs['image'];
            }else{
                return \response()->json(["http" => "400", "Message" => "Image Must Be Filled!"]);
            }
        }

        try {
            $car = Car::whereRaw("id = ?", [$carId])->first();
            $car->brand_id = $brand;
            $car->model = $model;
            $car->year_built = $yearBuilt;
            $car->fuel = $fuel;
            $car->price = $price;
            $car->transmission = $transmission;
            $car->engine_type = $engineType;
            $car->image = $image;
            $car->updated_at = Carbon::now();
            $car->updated_by = " ";
            $car->save();
            return \response()->json(["http" => "200", "Message" => "Your Data is Sucessfully Edited!"]);
        }catch (QueryException $e){
            return \response()->json(["http" => "400", "Message" => "Server Error! Please Contact Support Team!"]);
        }
    }

    public function destroy(Request $request){
        $inputs = $request->all();
        $carId = 0;
        if(isset($inputs['carId']) && !empty($inputs['carId'])){
            if(is_numeric($inputs['carId'])) {
                $carId = intval($inputs['carId']);
            }
        }
        try{
            Car::whereRaw("id = ?",[$carId])->delete();
            return \response()->json(["http" => "200", "Message" => "Data Successfully Deleted!"]);
        }catch (QueryException $e){
            return \response()->json(["http" => "400", "Message" => "Server Error! Please Contact Support Team!"]);
        }
        //Car::whereRaw("id = ?",[$carId])->delete();
    }

}