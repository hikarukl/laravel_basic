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

    {{--<form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-jet-label for="username" value="{{ __('Username') }}" />
            <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
        </div>

        <div class="mt-4">
            <x-jet-label for="password" value="{{ __('Password') }}" />
            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="flex items-center">
                <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-jet-button class="ml-4">
                {{ __('Login') }}
            </x-jet-button>
        </div>
    </form>--}}
</x-guest-layout>
