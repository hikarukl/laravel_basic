<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class LoginOtpForm extends Component
{
    public $loginOtp;
    public $otpExpiredAt;
    public $showCountDown;

    protected $guard;

    public function render()
    {
        // Get user
        $loginInfoSession = session()->get('login');
        $user = User::find($loginInfoSession['id']);

        $otpExpired = Carbon::parse($user->otp_expired_at);
        $this->otpExpiredAt = $otpExpired->format('Y/m/d H:i:s');
Log::info('render');
Log::info($this->otpExpiredAt);
        if ($otpExpired->lt(now())) {
            $this->showCountDown = false;
        }

        return view('livewire.auth.login-otp-form');
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
        // Get user
        $loginInfoSession = session()->get('login');
        $user = User::find($loginInfoSession['id']);
        $user->createOtp();

        $this->otpExpiredAt = Carbon::parse($user->otp_expired_at)->format('Y/m/d H:i:s');
        $this->showCountDown = true;
        Log::info('resend');
        Log::info($this->otpExpiredAt);

        $this->dispatchBrowserEvent('resend-otp', ['otp_expired_at' => $this->otpExpiredAt]);
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
        $loginInfoSession = session()->get('login');
        $user = User::find($loginInfoSession['id']);

        try {
            $otpReceived = trim($this->loginOtp);
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
            $user->password_fail_times = 0;
            $user->save();

            app(StatefulGuard::class)->login($user, $loginInfoSession['remember']);

            $response = [
                'stt'          => 1,
                'redirect_url' => route('home'),
                'message'      => 'Verify OTP was successful.'
            ];
        } catch (\Exception $e) {
            Log::error($e->getMessage());
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

            session()->flash('message', $e->getMessage());
        }

        $this->dispatchBrowserEvent('send-otp', $response);
    }
}
