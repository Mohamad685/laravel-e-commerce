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
        $products->description = $req->description;
        $products->price = $req->price;
        $products->stock = $req->stock;
        $products->save();

    }

    public function update_product(Request $req)
    {
        $id_product = $req->id_product;
        $product = Products::find($id_product);

        $product->update($req->all());

        return response()->json([
            "product" => $product,
        ]);
    }

    public function get_products()
    {
        $products = Products::all();
        return response()->json([
            "products" => $products
        ]);
    }

    public function delete_product(Request $req)
    {
        $id_product = $req->id_product;

        $product = Products::find($id_product);

        if (!$product) {
            return response()->json([
                'error' => 'Product not found',
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
        ]);
    }

}

