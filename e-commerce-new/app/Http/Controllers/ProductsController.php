<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    private function validation_logging($sellerId = null)
    {
        $user = Auth::user();
        if (!$user || $user->user_type_id !== 3) {
            return false;
        }

        if ($sellerId !== null && $user->id !== $sellerId) {
            return false;
        }

        return true;
    }

    public function insert_product(Request $req)
    {
        if ($this->validation_logging($req->seller_id)) {
            $product = new Products;
            $product->seller_id = $req->seller_id;
            $product->name = $req->name;
            $product->description = $req->description;
            $product->price = $req->price;
            $product->stock = $req->stock;
            $product->save();

            return response()->json([
                'message' => 'Product added successfully',
            ]);
        } else {
            return response()->json([
                'error' => 'Unauthorized',
            ], 401);
        }
    }

    public function update_product(Request $req)
    {
        if ($this->validation_logging()) {
            $id_product = $req->id_product;
            $product = Products::find($id_product);

            if (!$product) {
                return response()->json([
                    'error' => 'Product not found',
                ], 404);
            }

            // Check if the authenticated user is the seller of the product
            if ($product->seller_id !== Auth::id()) {
                return response()->json([
                    'error' => 'Unauthorized',
                ], 401);
            }

            $product->update($req->all());

            return response()->json([
                "message" => "Product updated successfully",
            ]);
        } else {
            return response()->json([
                'error' => 'Unauthorized',
            ], 401);
        }
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
        if ($this->validation_logging()) {
            $id_product = $req->id_product;

            $product = Products::find($id_product);

            if (!$product) {
                return response()->json([
                    'error' => 'Product not found',
                ], 404);
            }

            // Check if the authenticated user is the seller of the product
            if ($product->seller_id !== Auth::id()) {
                return response()->json([
                    'error' => 'Unauthorized',
                ], 401);
            }

            $product->delete();

            return response()->json([
                'message' => 'Product deleted successfully',
            ]);
        } else {
            return response()->json([
                'error' => 'Unauthorized',
            ], 401);
        }
    }
}
