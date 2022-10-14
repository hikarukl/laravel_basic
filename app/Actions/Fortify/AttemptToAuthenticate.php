<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use App\Models\BlockIp;
use Carbon\Carbon;
use Laravel\Fortify\Actions\AttemptToAuthenticate as MainAttemptToAuthenticate;
use Laravel\Fortify\Fortify;

class AttemptToAuthenticate extends MainAttemptToAuthenticate
{
    const LIMIT_LOGIN_FAIL_NUMBER = 3;
    const LOGIN_LOCK_AFTER_MINUTES = 30;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  callable  $next
     * @return mixed
     */
    public function handle($request, $next)
    {
        if (Fortify::$authenticateUsingCallback) {
            return $this->handleUsingCustomCallback($request, $next);
        }

        if ($this->guard->attempt(
            $request->only(Fortify::username(), 'password'),
            $request->filled('remember'))
        ) {
            // Check lock first
            $user = $this->guard->user();

            $unlockDateTime = $user->unlock_login_at ? Carbon::parse($user->unlock_login_at) : '';
            $current = Carbon::now();
            // Locking datetime valid
            if ($unlockDateTime && $unlockDateTime->gt($current)) {
                $this->guard->logout();

                $minutesWait = $unlockDateTime->diff($current)->format("%i minutes %s seconds");
                return redirect(route('login'))
                    ->withInput([
                        'show_countdown' => true,
                        'countdown_time' => $unlockDateTime->format('Y/m/d H:i:s')
                    ])
                    ->withErrors("Your account was locked. Please try again after: {$minutesWait}.");
            } else {
                $user->password_fail_times = 0;
                $user->save();
            }

            return $next($request);
        } else {
            $user = Admin::where(Fortify::username(), $request->email)->first();

            if ($user) {
                // Increase fail times or set lock admin
                if ($user->password_fail_times < self::LIMIT_LOGIN_FAIL_NUMBER) {
                    $user->password_fail_times += 1;
                } else {
                    $user->unlock_login_at = Carbon::now()->addMinutes(self::LOGIN_LOCK_AFTER_MINUTES);
                }
                $user->save();
            }

            // Write to table lock
            $blockIp = BlockIp::firstOrCreate([
                'ip'           => $request->getClientIp(),
                'action_block' => BlockIp::ACTION_BLOCK_LOGIN_NAME
            ]);
            $blockIp->num_fails += 1;
            $blockIp->save();
        }

        $this->throwFailedAuthenticationException($request);
    }
}
