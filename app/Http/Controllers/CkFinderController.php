<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostShowRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CkFinderController extends Controller
{
    public function upload(PostShowRequest $request)
    {
        try {
            Log::info(123);
        } catch (\Exception $e) {
            Log::error(__CLASS__ . ": Has error.");
        }
    }
}
