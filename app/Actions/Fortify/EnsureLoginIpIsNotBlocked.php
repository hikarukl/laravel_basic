<?php

namespace App\Actions\Fortify;

use App\Models\BlockIp;
use Illuminate\Auth\Events\Lockout;
use Laravel\Fortify\Contracts\LockoutResponse;
use App\Http\Responses\LockoutIpResponse;

class EnsureLoginIpIsNotBlocked
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  callable  $next
     * @return mixed
     */
    public function handle($request, $next)
    {
        $ipInfo = BlockIp::where('ip', $request->getClientIp())
            ->where('action_block', BlockIp::ACTION_BLOCK_LOGIN_NAME)
            ->first();

        if($ipInfo && $ipInfo->num_fails >= BlockIp::LIMIT_NUM_FAILS) {
            event(new Lockout($request));

            return app(LockoutIpResponse::class);
        }

        return $next($request);
    }
}