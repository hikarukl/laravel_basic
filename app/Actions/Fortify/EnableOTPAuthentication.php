<?php


namespace App\Actions\Fortify;

class EnableOTPAuthentication
{
    /**
     * Enable two factor authentication for the user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function __invoke($user)
    {
        $user->forceFill([
            'is_enable_otp' => 1,
        ])->save();
    }
}