<?php


namespace App\Actions\Fortify;

use App\Models\User;
use Carbon\Carbon;
use Laravel\Fortify\Actions\AttemptToAuthenticate as MainAttemptToAuthenticate;
use Laravel\Fortify\Fortify;

class AttemptToAuthenticate extends MainAttemptToAuthenticate
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
        // Check lock first
        $user = User::where('username', $request->username)->first();

        if ($user) {
            $unlockDateTime = $user->unlock_login_at ? Carbon::parse($user->unlock_login_at) : '';
            $current = Carbon::now();
            if ($unlockDateTime && $unlockDateTime->gt($current)) {
                $minutesWait = $unlockDateTime->diff($current)->format("%i minutes %s seconds");
                return redirect(route('login'))->with('status', "Your account was locked. Please try again after: {$minutesWait}.");
            }
        }

        if (Fortify::$authenticateUsingCallback) {
            return $this->handleUsingCustomCallback($request, $next);
        }

        if ($this->guard->attempt(
            $request->only(Fortify::username(), 'password'),
            $request->filled('remember'))
        ) {
            return $next($request);
        }

        $this->throwFailedAuthenticationException($request);
    }
}
