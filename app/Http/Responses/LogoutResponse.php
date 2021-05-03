<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class LogoutResponse extends \Laravel\Fortify\Http\Responses\LogoutResponse
{
    public function toResponse($request)
    {
        return $request->wantsJson()
            ? new JsonResponse('', 204)
            : redirect('/admin');
    }
}