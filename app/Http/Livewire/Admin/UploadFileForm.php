<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadFileForm extends Component
{
    use WithFileUploads;

    public $inputId;
    public $inputName;
    public $spanAttributes;
    public $photo;

    public function mount()
    {
        $this->inputId = "123";
    }

    public function render()
    {
        return view('livewire.admin.upload-file-form');
    }

    /**
     * Upload avatar
     *
     *
     */
    public function updatedPhoto($type)
    {
        switch ($type) {
            case 'avatar':
                $this->uploadAvatar();
                break;
        }
    }

    private function uploadAvatar()
    {
        Log::info('Begin upload');
        $this->validate([
            'photo' => 'image',
        ]);

        Log::info('Begin upload');
        if ($this->photo) {
            Log::info('Has photo');
            $user = Auth::user();

            $fileName = md5($user->getAuthIdentifierName()) . "_avatar";
            $this->photo->storeAs('avatar', $fileName);
        }
    }
}
