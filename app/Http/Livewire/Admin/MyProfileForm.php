<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyProfileForm extends Component
{
    use WithFileUploads;

    public $name;
    public $newPassword;
    public $confirmPassword;
    public $phone;
    public $useOtp;
    public $useAuthenticator;
    public $email;
    public $qrCodeAuthenticator;
    public $photo;

    const PREFIX_DIRECTORY_AVATAR = "images/avatars/";

    protected $rules = [
        'name'             => ['required', 'string', 'regex:' . User::REGEX_NAME],
        'phone'            => ['required', 'string', 'regex:' . User::REGEX_PHONE],
        'email'            => 'required|email',
        'useOtp'           => 'nullable|boolean',
        'useAuthenticator' => 'nullable|boolean',
        'newPassword'      => ['nullable', 'regex:' . User::REGEX_PASSWORD],
        'confirmPassword'  => 'required_with:newPassword|same:newPassword'
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
        $this->useAuthenticator = (bool)$user->two_factor_secret;
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
     * Render view component
     *
     *
     */
    public function render()
    {
        return view('livewire.admin.my-profile-form');
    }

    /**
     * When updated value need validate avatar
     *
     *
     */
    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image',
        ]);
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

        // TemporaryUploadedFile
        if ($this->photo) {
            $avatarName = md5(uniqid($user->getAuthIdentifierName())) . '_avatar.' . $this->photo->extension();
            $this->photo->storeAs('avatars', $avatarName, 'avatars');
        }

        $dataUpdate = [
            'name'              => $this->name,
            'email'             => $this->email,
            'phone'             => $this->phone,
            'is_enable_otp'     => $this->useOtp,
        ];

        if ($this->photo) {
            $dataUpdate['profile_photo_path'] = self::PREFIX_DIRECTORY_AVATAR . $avatarName;
        }

        $user->update($dataUpdate);

        if ($this->newPassword) {
            $user->password = Hash::make($this->newPassword);
        }

        if ($this->useAuthenticator) {
            if (!$user->two_factor_secret) {
                $enableTwoFactorAuthentication($user);
            }
        } else {
            $user->two_factor_secret = null;
            $user->two_factor_recovery_codes = null;
            $user->save();
        }

        $qrContent = $user->two_factor_secret ? $user->twoFactorQrCodeSvg() : '';

        session()->flash("message", "Update profile was successfully.");

        $responseData = [
            'qr_content' => $qrContent,
            'avatar'     => $this->photo ? asset($dataUpdate['profile_photo_path'] ): asset($user->profile_photo_path)
        ];

        $this->dispatchBrowserEvent('updated-profile', $responseData);
    }
}
