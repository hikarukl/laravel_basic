<?php


namespace App\Actions\Fortify;

class DisableOTPAuthentication
{
    /**
     * Disable two factor authentication for the user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function __invoke($user)
    {
        $user->forceFill([
            'is_enable_otp' => 0,
        ])->save();
    }
}