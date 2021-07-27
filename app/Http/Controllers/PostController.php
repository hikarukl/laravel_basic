<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostShowRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Description
     *
     */
    public function index()
    {
        return view('pages.post.index');
    }

    public function show(PostShowRequest $request, $id)
    {
        try {
            return view('pages.post.show');
        } catch (\Exception $e) {
            Log::error(__CLASS__ . ": Has error.");
        }
    }
}
