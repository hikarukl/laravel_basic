<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\FrontendMenu as FrontendMenuService;

class HomeController extends Controller
{
    protected $frontendMenuService;

    public function __construct(FrontendMenuService $frontendMenuService)
    {
        $this->frontendMenuService = $frontendMenuService;
    }

    /**
     * Description
     *
     *
     */
    public function index()
    {
        return view('pages.home.index');
    }

    public function show()
    {
        return view('pages.home.show');
    }
}
