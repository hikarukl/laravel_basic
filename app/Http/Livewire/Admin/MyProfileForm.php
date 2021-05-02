<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\Fortify;
use Livewire\Component;

class MyProfileForm extends Component
{
    public $name;
    public $newPassword;
    public $confirmPassword;
    public $phone;
    public $useOtp;
    public $useAuthenticator;
    public $email;
    public $qrCodeAuthenticator;

    protected $rules = [
        'name'             => ['required', 'string', 'regex:' . User::REGEX_NAME],
        'phone'            => ['required', 'string', 'regex:' . User::REGEX_PHONE],
        'email'            => 'required|email',
        'useOtp'           => 'nullable|boolean',
        'useAuthenticator' => 'nullable|boolean',
        'newPassword'      => ['nullable', 'regex:' . User::REGEX_PASSWORD],
        'confirmPassword'  => 'required_with:newPassword|same:newPassword',
    ];

    /**
     * Init properties
     *
     */
    public function mount()
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->useOtp = $user->is_enable_otp;
        $this->useAuthenticator = $user->two_factor_secret;
    }

    /**
     * Cleaning input fields
     *
     *
     */
    public function resetFilters()
    {
        // $this->reset(['name', 'phone']);
    }

    /**
     * Render
     *
     *
     */
    public function render()
    {
        return view('livewire.admin.my-profile-form');
    }

    /**
     * Handle update profile
     *
     *
     */
    public function update(EnableTwoFactorAuthentication $enableTwoFactorAuthentication)
    {
        $this->dispatchBrowserEvent('begin-update');
        $this->validate();

        $user = Auth::user();
        Log::info(__FUNCTION__ . ': Begin update profile.');
        $user->update([
            'name'          => $this->name,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'is_enable_otp' => $this->useOtp,
        ]);

        if ($this->newPassword) {
            $user->password = Hash::make($this->newPassword);
        }

        if ($this->useAuthenticator) {
            $enableTwoFactorAuthentication($user);
        } else {
            $user->two_factor_secret = null;
            $user->two_factor_recovery_codes = null;
            $user->save();
        }

        Log::info(__FUNCTION__ . ': End update profile.');

        $qrContent = $user->two_factor_secret ? $user->twoFactorQrCodeSvg() : '';

        $this->dispatchBrowserEvent('updated-profile', ['qr_content' => $qrContent]);
    }
}
