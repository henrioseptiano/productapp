<?php

namespace App\Http\Controllers\Main;

use App\Car;
use App\CarBrand;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ProductController extends Controller
{
    //
    public function index(){
        $paginate = 12;
        $productQuery = DB::table('Cars')
                        ->join("car_brands","Cars.brand_id","=","car_brands.id")
                        ->selectRaw("image, Cars.id as carId, car_brands.brand_name as brand, model, price")
                        //->join("car_brands"," c.brand_id", "=","car_brands.id")
                        ->paginate($paginate);
        $productData = [];
        foreach($productQuery as $key => $value){
            $productData[] = [
                "carId" => $value->carId,
                "model" => $value->model,
                "brand" => $value->brand,
                "price" => intval($value->price),
                "image" => url("/")."/uploads".$value->image
            ];
        }

        return view('products.index',["productData" => $productData, "productQuery" => $productQuery]);
    }
    //
    public function searchs(Request $request){
        $inputs = $request->all();
        $brand = $model = $valueMin = $valueMax = null;
        if(isset($inputs["value-min"]) && !empty($inputs["value-min"])){
            $valueMin = $inputs["value-min"];
        }
        if(isset($inputs["value-max"]) && !empty($inputs["value-max"])){
            $valueMax = $inputs["value-max"];
        }
        if(isset($inputs["brand"]) && !empty($inputs["brand"])){
            $brand = $inputs["brand"];
        }
        if(isset($inputs["model"]) && !empty($inputs["model"])){
            $model = $inputs["model"];
        }

        $paginate = 12;
        $productQuery = DB::table('Cars')
            ->join("car_brands","Cars.brand_id","=","car_brands.id");

        if($brand !== null){
            $productQuery->whereRaw("car_brands.brand_name like ?",["%".$brand."%"]);
        }
        if($model !== null){
            $productQuery->whereRaw("model like ?",["%".$model."%"]);
        }
        if($valueMin !== null && $valueMax !== null){
            $productQuery->whereRaw("price >= ? AND price <= ?",[intval($valueMin), intval($valueMax)]);
        }
        elseif($valueMin !== null){
            $productQuery->whereRaw("price >= ?",[intval($valueMin)]);
        }
        elseif($valueMax !== null){
            $productQuery->whereRaw("price <= ?",[intval($valueMax)]);
        }

        $productQuery = $productQuery->selectRaw("image, Cars.id as carId, car_brands.brand_name as brand, model, price")->paginate($paginate);
        $productData = [];
        foreach($productQuery as $key => $value){
            $productData[] = [
                "carId" => $value->carId,
                "model" => $value->model,
                "brand" => $value->brand,
                "price" => intval($value->price),
                "image" => url("/")."/uploads".$value->image
            ];
        }

        return view('products.index',["productData" => $productData, "productQuery" => $productQuery]);
    }
    public function addproduct(){
        $brand = CarBrand::get();
        $brandItems = "";
        foreach($brand as $key => $value){
            $brandItems .= "<option value='".$value->id."'>".$value->brand_name."</option>";
        }
        return view('products.add',["brandItems" => $brandItems]);
    }
    public function editproduct($id){
        $carId = $id;
        $cars = Car::selectRaw("brand_id, model, year_built, fuel, price, engine_type, image, transmission");
        $getCar = $cars->whereRaw("id = ?", [$carId])->first();
        $brand = CarBrand::get();
        $brandItems = "";
        foreach($brand as $key => $value){
            if(intval($value->id) === intval($getCar->brand_id)){
                $brandItems .= "<option value='".intval($value->id)."' selected>".$value->brand_name."</option>";
                continue;
            }
            $brandItems .= "<option value='".$value->id."'>".$value->brand_name."</option>";
        }
        $carArray = [
            "carId" => $carId,
            "carModel" => $getCar->model,
            "yearBuilt" => $getCar->year_built,
            "fuel" => $getCar->fuel,
            "price" => $getCar->price,
            "transmission" => $getCar->transmission,
            "engineType" => $getCar->engine_type,
            "image" => url('')."/uploads".$getCar->image,
            "imageHide" => $getCar->image
        ];

        return view('products.edit',["brandItems" => $brandItems, "car" => $carArray]);
    }
    public function detailproduct($id){
        $carId = $id;
        $cars = Car::join("car_brands","Cars.brand_id","=","car_brands.id")
                  ->selectRaw("car_brands.brand_name as brand, model, year_built, fuel, price, engine_type, image, transmission");
        $getCar = $cars->whereRaw("Cars.id = ?", [$carId])->first();
        $comments = Comment::whereRaw("car_id = ?",[$carId])->get();
        $commentData = [];
        foreach($comments as $key => $value){
            $commentData[] = [
                "commentId" => $value->id,
                "genericId" => $value->generic_id,
                "username"  => (!empty($value->generic_id)) ? $value->generic_id : $value->username,
                "comment"   => $value->comment,
                "voteCounter" => ($value->upvote - $value->downvote),
                "upvote"    => $value->upvote,
                "downvote"  => $value->downvote,
                "Date"      => date("l d F Y h:i:s",strtotime($value->created_at))
            ];
        }
        $carArray = [
            "carId" => $carId,
            "carModel" => $getCar->model,
            "yearBuilt" => $getCar->year_built,
            "fuel" => $getCar->fuel,
            "price" => $getCar->price,
            "transmission" => $getCar->transmission,
            "engineType" => $getCar->engine_type,
            "image" => url('')."/uploads".$getCar->image,
            "brand" => $getCar->brand,
            "commentData" => $commentData
        ];
        return view('products.detail',["carArray" => $carArray]);
    }

}
