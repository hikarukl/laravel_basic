<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    const LIMIT_LOG_FAIL_TIMES = 5;
    const UNLOCK_LOGIN_LIMIT_MINUTES = 5;
    const REGEX_NAME = '/[a-zA-Z\s]$/';
    const REGEX_PHONE = '/^(09|03|07|08|05)[0-9]{8}$/';
    const REGEX_PASSWORD = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';

    /**
     * The attributes that are mass assignable.
     *
     * @var arraylogoutOtherBrowserSessions
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'email_verified_at',
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'phone',
        'state',
        'login_otp',
        'otp_expired_at',
        'otp_fail_times',
        'is_enable_otp',
        'is_verify_otp',
        'password_fail_times',
        'unlock_login_at',
        'current_team_id',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Create new OTP
     *
     */
    public function createOtp()
    {
        $otp = random_int(100000, 999999);
        $this->login_otp = $otp;
        $this->otp_expired_at = Carbon::now()
            ->addSeconds(10)
            //->addMinutes(1)
            ->format('Y-m-d H:i:s');
        $this->save();
    }

    /**
     * Reset fail login OTP
     *
     */
    public function resetLoginFailOtp()
    {
        $this->otp_fail_times = 0;
        $this->save();
    }

    /**
     * Increase login password fail times
     *
     */
    public function increaseLogPasswordFail()
    {
        $this->log_password_fail_times += 1;

        if ($this->log_password_fail_times >= self::LIMIT_LOG_FAIL_TIMES) {
            $this->unlock_login_at = Carbon::now()->addMinutes(self::UNLOCK_LOGIN_LIMIT_MINUTES)->format('Y-m-d H:i:s');
        }

        $this->save();
    }
}
