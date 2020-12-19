<x-jet-authentication-card>
    <x-slot name="logo">
        <x-jet-authentication-card-logo />
    </x-slot>

    <div class="mb-4 text-sm text-gray-600">
        <strong>{{ __('Vui lòng nhập OTP.') }}</strong>
    </div>

    <div class="mb-4 text-sm text-red-600 hidden" id="wrap-otp_error"></div>

    <div class="mt-2 flex items-center justify-between">
        <form method="POST" class="w-full" action="{{ route('otp.send') }}">
            @csrf
            <div class="mb-4">
                <x-jet-input id="otp" class="block mt-1 w-full" type="text" minlength="6" inputmode="numeric" name="login_otp" :value="old('login_otp')" required autofocus />
                <p class="mt-1" id="remaining-login_otp"></p>
                <x-jet-input type="hidden" name="input-countdown_login_otp_time" value="{{ $otp_expired_at }}"></x-jet-input>
            </div>
            <div>
                <x-jet-button wire:click="process" type="button" id="btn-process_login_otp">
                    {{ __('Submit OTP') }}
                </x-jet-button>
                <x-jet-button wire:click="resend" type="button" id="btn-request_login_otp" wire:then="showCountDown">
                    {{ __('Resend Verification OTP') }}
                </x-jet-button>
                <x-jet-input type="hidden" id="input-url_resend_login_otp" value="{{ route('otp.resend') }}"></x-jet-input>
                <x-jet-input type="hidden" id="input-url_send_login_otp" value="{{ route('otp.send') }}"></x-jet-input>
            </div>
        </form>
    </div>
</x-jet-authentication-card>
