<?php

namespace App\Http\Middleware;


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

        if ($user) {
            $optExpired = new \DateTime($user->otp_expired_at);
            $current = new \DateTime();

            // Expired and not verify OTP
            if (!$user->is_verify_otp && $optExpired < $current) {
                Auth::logout();
                return redirect(route('login'));
            }

            // Verified
            if ($user->is_verify_otp) {
                return $next($request);
            } else {
                return redirect(route('otp.get'));
            }
        }

        return redirect(route('login'));
    }
}