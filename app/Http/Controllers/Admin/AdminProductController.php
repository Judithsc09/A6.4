<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

       //Coge la foto y la guarda
       $idimagen = Str::uuid()->toString();
       $fileName = $idimagen. ".".($request->file('image')->getClientOriginalExtension());
       Storage::disk('public')->put(
            $fileName,
            file_get_contents($request->file('image')->getRealPath())
        );
       
        //Crear producto
        Product::create(['nombre' => $nombre, 'precio' => $precio, 'descripcion' => $descripcion, 'imagen' => $fileName ]);
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";
        $viewData["products"] = Product::all();
        return view('admin\product\index')->with("viewData", $viewData);
       
    }
    
    //Borrar Producto

    public function destroy($id){

        Product::destroy($id);
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";
        $viewData["products"] = Product::all();
        return view('admin\product\index')->with("viewData", $viewData);
    }

    public function edit($id){

        $viewData = [];

        $product = Product::find($id);
        $viewData["title"] = $product["name"]." - Online Store";
        $viewData["subtitle"] =  $product["name"]." - Product information";
        $viewData["product"] = $product;
        
        return view('admin.Edit.edit')->with("viewData", $viewData);



    }

    public function update(Request $request){

        $product = Product::find($request->input("id"));
        $product["nombre"] = $request->input("name");
        $product["precio"] = $request->input("price");
        $product["descripcion"] = $request->input("description");
        if($request->hasFile('image'))
        {

          Storage::delete(public_path().'\storage\ '.$product['image']);
          $idimagen = Str::uuid()->toString();
          $fileName = $idimagen. ".".($request->file('image')->getClientOriginalExtension());
          Storage::disk('public')->put(
               $fileName,
               file_get_contents($request->file('image')->getRealPath())
           );
          $product['imagen'] = $fileName ;
        }

        $product->save();
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";
        $viewData["products"] = Product::all();
        return view('admin.product.index')->with("viewData", $viewData);

    }



}
