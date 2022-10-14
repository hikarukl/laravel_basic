<x-guest-layout>
    <x-slot name="logo">
        <x-jet-authentication-card-logo />
    </x-slot>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Admin Management" class="w-6" src="{{ asset('images/logo.svg') }}">
                    <span class="text-white text-lg ml-3">
                        Admin Management
                    </span>
                </a>
                <div class="my-auto">
                    <img alt="Admin Management" class="-intro-x w-1/2 -mt-16" src="{{ asset('images/illustration.svg') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10 w-3/4">Sign in to your account and manage your business features.</div>
                </div>
            </div>
            <!-- END: Login Info -->

            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Sign In</h2>
                    <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">Sign in to your account and manage your business features.</div>

                    @if(old('countdown_time'))
                        @include('auth.validation-account-locking')
                    @else
                        <x-jet-validation-errors class="mb-4" />
                    @endif

                    <div class="intro-x mt-8">
                        <form id="login-form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <x-jet-input id="email" class="intro-x login__input form-control py-3 px-4 block" type="email" name="email" placeholder="Email" :value="old('email')" required autofocus />
                            <div id="error-email" class="login__input-error text-danger mt-2"></div>

                            <x-jet-input id="password" class="intro-x login__input form-control py-3 px-4 block mt-4" type="password" name="password" placeholder="Password" required autocomplete="current-password" />
                            <div id="error-password" class="login__input-error text-danger mt-2"></div>

                            <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                                <div class="flex items-center mr-auto">
                                    <input id="remember-me" type="checkbox" name="remember" class="form-check-input border mr-2">
                                    <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                                </div>
                                <a href="{{ route('password.request') }}">Forgot Password?</a>
                            </div>

                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button id="btn-login" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
</x-guest-layout>
