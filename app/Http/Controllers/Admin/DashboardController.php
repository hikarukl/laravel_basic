<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $response = [
            'body_class' => 'dark-topbar'
        ];
        return view("admin.dashboard.index", $response);
    }
}
