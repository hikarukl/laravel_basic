<x-app-layout>
    <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
        <x-jet-button type="button" wire:loading.attr="disabled">
            {{ __('Enable') }}
        </x-jet-button>
    </x-jet-confirms-password>
</x-app-layout>