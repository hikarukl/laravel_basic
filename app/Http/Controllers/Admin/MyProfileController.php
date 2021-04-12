<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MyProfileController extends Controller
{
    public function index()
    {
        return view("admin.my_profile.index");
    }
}
