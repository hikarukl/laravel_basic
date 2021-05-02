<x-guest-layout>
    <div class="row vh-100 ">
        <div class="col-12 align-self-center">
            <div class="auth-page">
                <div class="card auth-card shadow-lg">
                    <div class="card-body">
                        <div class="px-3">
                            <div class="auth-logo-box">
                                <a href="#" class="logo logo-admin"><img src="{{ asset("images/logo-sm.png") }}" height="55" alt="logo" class="auth-logo"></a>
                            </div><!--end auth-logo-box-->

                            <div class="text-center auth-logo-text">
                                <h4 class="mt-0 mb-3 mt-5">Welcome Admin</h4>
                                <p class="text-muted mb-0">Sign in to continue.</p>
                            </div> <!--end auth-logo-text-->

                            @if(($errors->count()))
                                @include(
                                    "admin.share.alert_content",
                                    [
                                        "content" => $errors->default->first(),
                                        "classes" => "mt-3"
                                    ]
                                )
                            @endif

                            <form class="form-horizontal auth-form my-4" method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <div class="input-group mb-3">
                                        <span class="auth-form-icon">
                                            <i class="dripicons-user"></i>
                                        </span>
                                        <x-jet-input
                                            placeholder="Enter username"
                                            id="username"
                                            class="form-control mt-1"
                                            type="text"
                                            name="username"
                                            :value="old('username')"
                                            required
                                            autofocus
                                        />
                                    </div>
                                </div><!--end form-group-->

                                <div class="form-group">
                                    <label for="userpassword">Password</label>
                                    <div class="input-group mb-3">
                                        <span class="auth-form-icon">
                                            <i class="dripicons-lock"></i>
                                        </span>
                                        <x-jet-input
                                            id="password"
                                            class="form-control mt-1"
                                            type="password"
                                            name="password"
                                            required
                                            autocomplete="current-password"
                                            placeholder="Enter password"
                                        />
                                    </div>
                                </div><!--end form-group-->

                                <div class="form-group row mt-4">
                                    <div class="col-sm-6">
                                        <div class="custom-control custom-switch switch-success">
                                            <input id="remember_me" type="checkbox" class="custom-control-input" name="remember">
                                            <label class="custom-control-label text-muted" for="remember_me">Remember me</label>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-sm-6 text-right">
                                        @if (Route::has('password.request'))
                                            <a class="text-muted font-13" href="{{ route('password.request') }}">
                                                <i class="dripicons-lock"></i> {{ __('Forgot your password?') }}
                                            </a>
                                        @endif
                                    </div><!--end col-->
                                </div><!--end form-group-->

                                <div class="form-group mb-0 row">
                                    <div class="col-12 mt-2">
                                        <button class="btn btn-gradient-primary btn-round btn-block waves-effect waves-light" type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
                                    </div><!--end col-->
                                </div> <!--end form-group-->
                            </form><!--end form-->
                        </div><!--end /div-->

                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end auth-page-->
        </div><!--end col-->
    </div><!--end row-->
</x-guest-layout>
