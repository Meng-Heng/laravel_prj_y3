<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserMgt;

class UserController extends Controller
{
    public function index()
    {
        return UserMgt::all();
    }
 
    public function show(UserMgt $user)
    {
        return $user;
    }
}
