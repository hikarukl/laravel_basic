@extends('master_post_share')
@section('main')
    {{-- Headers --}}
    <nav class="bg-gray-100 fixed z-10 w-full md:relative top-0">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button class="inline-flex items-center justify-center p-2 rounded-md text-home_share_color_two focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-expanded="false" id="btn-switch_header_menu">
                        <span class="sr-only">Open main menu</span>

                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>

                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start" id="wrap-header_menus">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('share-home') }}">
                            <img class="block sm:hidden h-8 w-auto" src="{{ asset('images/ico_app.png') }}" alt="Trang tin hay">
                        </a>
                        {{-- Icon for desktop --}}
                        <a href="{{ route('share-home') }}">
                            <img class="hidden sm:block h-10 w-auto" src="{{ asset('images/ico_app.png') }}" alt="Trang tin hay">
                        </a>
                    </div>
                    <div class="hidden sm:block sm:ml-6">
                        <div class="flex space-x-4">
                            <a href="{{ route('share-home') }}" class="bg-green_custom_two hover:bg-blue-300 text-white px-3 py-2 rounded-md text-sm font-medium">
                                Trang Chủ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Open when click icon mobile show --}}
        <div class="hidden sm:hidden" id="wrap-mobile_header_menus">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('share-home') }}" class="bg-green_custom_two text-white block px-3 py-2 rounded-md text-base font-medium">
                    Trang Chủ
                </a>
            </div>
        </div>
    </nav>

    {{-- End headers --}}
    <div class="mt-12 sm:mt-0 w-full mx-auto bg-green_custom_two">
        {{-- Banner --}}
        <div class="w-full mx-auto md:max-w-screen-sm grid grid-cols-2 pt-8 pb-8 pl-2 pr-2 sm:pl-0 sm:pr-0">
            <img class="w-11/12 sm:w-3/4 sm:col-span-1" src="{{ asset('images/home_share_banner.png') }}">

            <div class="md:col-span-1 mt-0 sm:mt-10">
                <p class="text-3xl sm:text-5xl font-bold text-white sm:mt-5 mb-2">Tin Hay 24h</p>
                <p class="text-sm sm:text-lg text-white mb-10">App đọc tin hay. Cập nhật liên tục các tin mới nhất, hot nhất.</p>
                <a
                    class="uppercase text-md text-white rounded-xl border-2 border-white p-3 hover:bg-blue-300"
                    target="_blank"
                    href="{{ \App\Constants\CommonConstant::URL_IOS_APP }}"><i class="fab fa-apple text-xl mr-1"></i> App Store</a>
                <img class="mt-10 w-1/2" src="{{ asset('images/qr_ios_app.png') }}">
            </div>
        </div>
    </div>

    {{-- Content One --}}
    <div class="w-full bg-green-100 text-center pb-10">
        <p class="text-xl text-home_share_color_one font-bold pt-5 pb-5 sm:pt-10 sm:pb-10 sm:text-5xl">
            Luôn cập nhật các tin hot và mới nhất
        </p>

        <div class="grid grid-cols-4 gap-1 text-center">
            <div class="flex justify-center col-span-2 sm:col-span-1 pb-3 sm:pb-0">
                <img class="w-4/5 rounded-2xl" src="{{ asset('images/home_share_one.png') }}">
            </div>
            <div class="flex justify-center col-span-2 sm:col-span-1 pb-3 sm:pb-0">
                <img class="w-4/5 rounded-2xl" src="{{ asset('images/home_share_two.png') }}">
            </div>
            <div class="flex justify-center col-span-2 sm:col-span-1 pb-3 sm:pb-0">
                <img class="w-4/5 rounded-2xl" src="{{ asset('images/home_share_three.png') }}">
            </div>
            <div class="flex justify-center col-span-2 sm:col-span-1 pb-3 sm:pb-0">
                <img class="w-4/5 rounded-2xl" src="{{ asset('images/home_share_four.png') }}">
            </div>
        </div>
    </div>
@endsection