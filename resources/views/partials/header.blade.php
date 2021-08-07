<nav class="nav-background fixed z-10 w-full md:relative top-0">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button class="inline-flex items-center justify-center p-2 rounded-md text-white hover:nav-item_active focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-expanded="false" id="btn-switch_header_menu">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon when menu is closed. -->
                    <!--
                      Heroicon name: menu

                      Menu open: "hidden", Menu closed: "block"
                    -->

                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Icon when menu is open. -->
                    <!--
                      Heroicon name: x

                      Menu open: "block", Menu closed: "hidden"
                    -->
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start" id="wrap-header_menus">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img class="block lg:hidden h-8 w-auto" src="{{ asset('images/web_news/favicon.png') }}" alt="Trang tin hay">
                    </a>
                    <a href="{{ route('home') }}">
                        <img class="hidden lg:block h-8 w-auto" src="{{ asset('images/web_news/favicon.png') }}" alt="Trang tin hay">
                    </a>
                </div>
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="{{ route('home') }}" class="@if(!isset($category_selected)) nav-item_active @else hover:nav-item_active @endif text-white px-3 py-2 rounded-md text-sm font-medium">
                            Trang Chủ
                        </a>
                        @foreach($menu_list as $category)
                            <a
                                href="{{ route('post-list', ['category' => $category['slug']]) }}"
                                class="@if(isset($category_selected) && $category_selected == $category['slug']) nav-item_active @else hover:nav-item_active @endif text-white px-3 py-2 rounded-md text-sm font-medium">
                            {{ ucwords($category['name']) }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            {{--<div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <!-- Profile dropdown -->
                <div class="ml-3 relative">
                    <div>
                        <button class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </button>
                    </div>
                    <!--
                      Profile dropdown panel, show/hide based on dropdown state.

                      Entering: "transition ease-out duration-100"
                        From: "transform opacity-0 scale-95"
                        To: "transform opacity-100 scale-100"
                      Leaving: "transition ease-in duration-75"
                        From: "transform opacity-100 scale-100"
                        To: "transform opacity-0 scale-95"
                    -->
                    <div class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Your Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Settings</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
                    </div>
                </div>
            </div>--}}
        </div>
    </div>

    <!--
      Mobile menu, toggle classes based on menu state.

      Menu open: "block", Menu closed: "hidden"
    -->
    <div class="hidden sm:hidden" id="wrap-mobile_header_menus">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="@if(!isset($category_selected)) nav-item_active @endif text-white block px-3 py-2 rounded-md text-base font-medium">
                Trang Chủ
            </a>

            @foreach($menu_list as $category)
                <a href="{{ route('post-list', ['category' => $category['slug']]) }}" class="@if(isset($category_selected) && $category_selected == $category['slug']) nav-item_active @endif text-white block px-3 py-2 rounded-md text-base font-medium">
                    {{ ucwords($category['name']) }}
                </a>
            @endforeach
            <a
                href="{{ route('post-list', ['category' => 'moi-nhat']) }}"
                class="@if(isset($category_selected) && $category_selected == 'moi-nhat') nav-item_active @endif text-white block px-3 py-2 rounded-md text-base font-medium">
                Mới Nhất
            </a>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4 pl-4 pr-4 text-center border-t border-white sm:hidden" id="wrap-mobile_specific_menus">
        <a
            href="{{ route('post-list', ['category' => 'moi-nhat']) }}"
            class="@if(isset($category_selected) && $category_selected == 'moi-nhat') nav-item_active @endif text-white px-3 py-2 rounded-md text-base font-medium">
            Mới Nhất
        </a>
        <a
            href="{{ route('post-list', ['category' => 'doi-song']) }}"
            class="@if(isset($category_selected) && $category_selected == 'doi-song') nav-item_active @endif text-white px-3 py-2 rounded-md text-base font-medium">
            Đời Sống
        </a>
        <a
            href="{{ route('post-list', ['category' => 'phap-luat']) }}"
            class="@if(isset($category_selected) && $category_selected == 'phap-luat') nav-item_active @endif text-white px-3 py-2 rounded-md text-base font-medium">
            Pháp Luật
        </a>
    </div>
</nav>
