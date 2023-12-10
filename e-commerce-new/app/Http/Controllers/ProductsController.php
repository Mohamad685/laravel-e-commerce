<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function insert_product(Request $req)
    {
        $products = new Products;
        $products->seller_id = $req->seller_id;
        $products->name = $req->name;
        $products->description =$req->description;
        $products->price = $req->price;
        $products->stock = $req->stock;
        $products->save();

    }
}
