<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";
        $viewData["products"] = Product::all();
        return view('admin.product.index')->with("viewData", $viewData);
    }


    public function store(Request $request)
    {


        $nombre=$request -> input('name');
        $precio=$request -> input('price');
        $descripcion=$request -> input('description');
        $imagen=$request -> file('image') -> getRealPath();

        Product::create(['nombre' => $nombre, 'precio' => $precio, 'descripcion' => $descripcion, 'imagen' => $imagen ]);

        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";
        $viewData["products"] = Product::all();
        return view('admin.product.index')->with("viewData", $viewData);
    }
    
}
