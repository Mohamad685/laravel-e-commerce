<?php

namespace App\Http\Controllers;
use App\Models\Order; // Import the CartItem model

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function create_order(Request $req)
    {
        $order = new Order;
        $order->user_id = $req->user_id;
        $order->status = $req->status;
        $order->save();

    }
}
