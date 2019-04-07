<?php

namespace App\Http\Controllers\Main;

use App\Car;
use App\CarBrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //
    public function index(Request $request){
        $paginate = 1;
        $productQuery = Car::selectRaw("image, cars.id as carId, model")->paginate($paginate);
        $productData = [];
        foreach($productQuery as $key => $value){
            $productData[] = [
                "carId" => $value->carId,
                "model" => $value->model,
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
        return view('products.detail');
    }

}
