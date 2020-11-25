<x-jet-action-section>
    <x-slot name="title">
        {{ __('OTP Authentication') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Add additional security to your account using OTP authentication.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                {{ __('You have enabled OTP authentication.') }}
            @else
                {{ __('You have not enabled OTP authentication.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('When OTP authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s message.') }}
            </p>
        </div>

        <div class="mt-5">
            @if (! $this->enabled)
                <x-jet-button type="button" wire:click="enableOTPAuthentication" wire:loading.attr="disabled">
                    {{ __('Enable') }}
                </x-jet-button>
            @else
                <x-jet-danger-button wire:click="disableOTPAuthentication" wire:loading.attr="disabled">
                    {{ __('Disable') }}
                </x-jet-danger-button>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
