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
        return view('products.index');
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
        $cars = Car::selectRaw("brand_id, model, year_built, fuel, price, engine_type, image");
        $getCar = $cars->whereRaw("id = ?", [$carId])->first();
        $brand = CarBrand::get();
        $brandItems = "";
        foreach($brand as $key => $value){
            if($value->id === $getCar->brand_id){
                $brandItems .= "<option value='".$value->id."' selected>".$value->brand_name."</option>";
                continue;
            }
            $brandItems .= "<option value='".$value->id."'>".$value->brand_name."</option>";
        }
        $carArray = [

        ];
        return view('products.edit',["brandItems" => $brandItems]);
    }
    public function detailproduct($id){
        return view('products.detail');
    }

}
