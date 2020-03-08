<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicine;
class WebController extends Controller
{
    public function index(){

        $product = Medicine::limit(6)->get();
        return view('home',compact('product'));

    }

    public function allProduct(){

        $product = Medicine::paginate(6);
        return view('product',compact('product'));
    }
    public function singleProduct(Medicine $id){

        return view('singleProduct',compact('id'));

    }
}
