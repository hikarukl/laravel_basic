<div class="row vh-100">
    <div class="col-12 align-self-center">
        <div class="auth-page">
            <div class="card auth-card shadow-lg">
                <div class="card-body">
                    <div class="px-3">
                        <div class="auth-logo-box">
                            <a href="#" class="logo logo-admin"><img src="{{ asset("images/logo-sm.png") }}" height="55" alt="logo" class="auth-logo"></a>
                        </div><!--end auth-logo-box-->

                        <div class="text-center auth-logo-text">
                            <h4 class="mt-0 mb-3 mt-5">Input OTP</h4>
                        </div> <!--end auth-logo-text-->

                        @if(session()->has('message') || session()->has('status'))
                            <div class="alert alert-secondary border-0" role="alert">
                                {{ session()->has('message') ? session('message') : session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal auth-form my-4" method="POST" action="{{ route('otp.send') }}">
                            @csrf
                            <div class="form-group">
                                <label for="loginOtp">OTP</label>
                                <div class="input-group mb-3">
                                    <x-jet-input
                                        placeholder="Enter OTP"
                                        id="loginOtp"
                                        class="form-control mt-1"
                                        type="text"
                                        wire:model.defer="loginOtp"
                                        :value="old('loginOtp')"
                                        required
                                        autofocus
                                    />
                                </div>
                                <p class="mt-1" id="remaining-login_otp"></p>
                                <x-jet-input type="hidden" name="input-countdown_login_otp_time" value="{{ $otpExpiredAt }}"></x-jet-input>
                            </div><!--end form-group-->

                            <div class="form-group mb-0 row">
                                <div class="col-6 mt-2">
                                    <button
                                        class="btn btn-gradient-primary btn-round btn-block waves-effect waves-light"
                                        wire:click="process"
                                        wire:loading.attr="disabled"
                                        type="button"
                                        id="btn-process_login_otp">
                                        Submit OTP<i class="fas fa-sign-in-alt ml-1"></i>
                                    </button>
                                </div><!--end col-->

                                <div class="col-6 mt-2">
                                    <button
                                        class="btn btn-gradient-primary btn-round btn-block waves-effect waves-light @if($showCountDown) d-none @endif"
                                        wire:click="resend"
                                        type="button"
                                        id="btn-request_resend_otp">
                                        Resend OTP<i class="fas fa-sign-in-alt ml-1"></i>
                                    </button>
                                </div>

                            </div> <!--end form-group-->
                        </form><!--end form-->
                    </div><!--end /div-->

                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end auth-page-->
    </div><!--end col-->

    @include('admin.share.processing', ['target' => 'process'])
</div><!--end row-->

@push('scripts')
    <script>
        $(document).ready(function () {
            let inputLoginOtpTarget = $('#loginOtp');

            inputLoginOtpTarget.on('keyup', function () {
                let alertErrorTarget = $('.alert');

                if (alertErrorTarget.length) {
                    alertErrorTarget.remove();
                }
            });
        });
    </script>
@endpush
