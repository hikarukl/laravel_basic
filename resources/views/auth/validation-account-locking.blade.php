<div class="mb-3">
    <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>
    <input type="hidden" name="input-countdown_login_otp_time" value="{{ old('countdown_time') }}">
    <input type="hidden" id="input-locking_message" value="{!! trans('auth.account_locking') !!}">
    <span class="text-red-500" id="remaining-login_otp"></span>
</div>

@push('scripts')
    <script>
        let inputCountdownTime = $('input[name="input-countdown_login_otp_time"]');
        let countdownTarget = $('#remaining-login_otp');
        let messageTarget = $('#input-locking_message');

        handleCountdownTime(countdownTarget, inputCountdownTime.val(), messageTarget.val());
    </script>
@endpush
