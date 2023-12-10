<?php

namespace App\Http\Controllers;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemsController extends Controller
{
    public function add_quantity(Request $req)
    {
        $users = new Users;
        $users->quantity = $req->quantity;
        $users->save();
    }
}
