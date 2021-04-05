<?php

namespace App\Http\Middleware;


use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EnsureOtpVerified
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
        $user = Auth::user();

        if ($user && $user->is_enable_otp) {
            $optExpired = Carbon::parse($user->otp_expired_at);
            $current = Carbon::now();

            // Expired and not verify OTP
            if (!$user->is_verify_otp && $optExpired->lt($current)) {
                Auth::logout();
                return redirect(route('login'));
            }

            // Verified
            if ($user->is_verify_otp) {
                return $next($request);
            } else {
                // Already reach max fail then reset
                if ($user->otp_fail_times >= User::LIMIT_LOG_FAIL_TIMES) {
                    $user->resetLoginFailOtp();
                }

                return redirect(route('otp.get'));
            }
        }

        return $next($request);
    }
}
