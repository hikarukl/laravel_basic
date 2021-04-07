<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CoinController extends Controller
{
    public function index()
    {
        return view("admin.coin.index");
    }
}
