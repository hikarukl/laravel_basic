<?php

namespace App\Http\Livewire\Profile;

use App\Actions\Fortify\DisableOTPAuthentication;
use App\Actions\Fortify\EnableOTPAuthentication;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\Features;
use Livewire\Component;

class OtpAuthenticationForm extends Component
{
    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Determine if two factor authentication is enabled.
     *
     * @return bool
     */
    public function getEnabledProperty()
    {
        return $this->user->is_enable_otp;
    }

    /**
     * Enable OTP authentication for the user.
     *
     * @param  EnableOTPAuthentication  $enable
     * @return void
     */
    public function enableOTPAuthentication(EnableOTPAuthentication $enable)
    {
        $enable(Auth::user());
    }

    /**
     * Disable OTP authentication for the user.
     *
     * @param  DisableOTPAuthentication  $disable
     * @return void
     */
    public function disableOTPAuthentication(DisableOTPAuthentication $disable)
    {
        $disable(Auth::user());
    }

    public function render()
    {
        return view('livewire.profile.otp-authentication-form');
    }
}
