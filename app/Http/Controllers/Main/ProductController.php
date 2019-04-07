<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //
    public function index(Request $request){
        return view('products.index');
    }
    public function addproduct(){
        return view('products.add');
    }
    public function editproduct($id){
        return view('products.edit');
    }
    public function detailproduct($id){
        return view('products.detail');
    }

}
