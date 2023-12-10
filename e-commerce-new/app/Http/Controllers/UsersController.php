<?php

namespace App\Http\Controllers;
use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function create_user(Request $req)
    {
        $users = new Users;
        $users->full_name = $req->full_name;
        $users->phone_number =$req->phone_number;
        $users->email = $req->email;
        $users->username = $req->username;
        $users->password = $req->password;
        
        $users->save();
    }
}
