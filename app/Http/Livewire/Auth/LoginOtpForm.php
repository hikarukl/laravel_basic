<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class LoginOtpForm extends Component
{
    public function render()
    {
        $user = Auth::user();

        $otpExpired = Carbon::parse($user->otp_expired_at);
        $current = Carbon::now();

        if ($otpExpired->lt($current)) {
            Auth::logout();

            return redirect(route('login'));
        }

        $this->otp_expired_at = $otpExpired->format('Y/m/d H:i:s');

        return view('livewire.auth.login-otp-form', ['otp_expired_at' => $otpExpired->format('Y/m/d H:i:s')]);
    }

    /**
     * Resend login OTP
     *
     *
     * @return mixed
     *
     */
    public function resend()
    {
        $user = Auth::user();
        $user->createOtp();

        $this->otp_expired_at = Carbon::parse($user->otp_expired_at)->format('Y/m/d H:i:s');
        $this->show_countdown = true;

        $this->dispatchBrowserEvent('resend-otp', ['login_otp' => $user->login_otp]);
    }

    /**
     * Process login OTP
     *
     *
     * @return mixed
     *
     */
    public function process(Request $request)
    {
        $user = Auth::user();
        try {
            $otpReceived = trim($request->get('login_otp'));
            $otpSent = $user->login_otp;

            if (!$otpReceived || $otpReceived != $otpSent) {
                throw new \Exception("OTP is invalid.");
            }

            $otpExpired = \Illuminate\Support\Carbon::parse($user->otp_expired_at);
            $currentDateTime = Carbon::now();

            if ($otpExpired < $currentDateTime) {
                throw new \Exception("OTP is expired.");
            }

            // Valid
            $user->is_verify_otp = 1;
            $user->otp_fail_times = 0;
            $user->log_password_fail_times = 0;
            $user->save();

            $response = [
                'stt'          => 1,
                'redirect_url' => route('home'),
                'message'      => 'Verify OTP was successful.'
            ];
        } catch (\Exception $e) {
            Log::error($e->getTraceAsString());

            $response = [
                'stt'          => 0,
                'redirect_url' => '',
                'message'      => $e->getMessage()
            ];

            $user->otp_fail_times += 1;

            $response['remaining_times'] = User::LIMIT_LOG_FAIL_TIMES - $user->otp_fail_times;

            if ($user->otp_fail_times >= User::LIMIT_LOG_FAIL_TIMES) {
                $user->unlock_login_at = Carbon::now()->addMinutes(User::UNLOCK_LOGIN_LIMIT_MINUTES)->format('Y-m-d H:i:s');
                $response['redirect_url'] = route('login');
            }
            $user->save();
        }

        $this->dispatchBrowserEvent('send-otp', $response);
    }
}
