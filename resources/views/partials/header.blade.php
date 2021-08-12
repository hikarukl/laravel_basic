<nav class="top-nav">
    <ul class="d-flex items-center">
        <li>
            <a href="{{ route('home') }}">
                <img class="h-24 mr-3 mt-1" src="{{ asset('images/logo.png') }}">
            </a>
        </li>
        @foreach($menu_list as $key => $menu)
            @php
                $iconConfig = $menu->icon_config ? json_decode($menu->icon_config, true) : '';
            @endphp
            <li class="mr-4 text-md sm:text-lg">
                <a href="{{ $menu->route ? route($menu->route) : 'javascript:void(0)' }}" class="top-menu @if($key == $parent_active_index) top-menu--active @endif">
                    @if($iconConfig)
                        <span class=" @if($key == $parent_active_index) text-theme-1 @else text-white @endif">{!! $iconConfig['value'] !!}</span>
                    @endif
                    @if($menu->subMenus->isEmpty())
                        <div class="top-menu__title"> {{ $menu->name }} </div>
                    @else
                        @if(auth()->user())
                            @if(auth()->user()->getChildMenusOfRoot($menu->id)->isNotEmpty())
                                <div class="top-menu__title"> {{ $menu->name }} <i data-feather="chevron-down" class="top-menu__sub-icon"></i> </div>
                            @else
                                <div class="top-menu__title"> {{ $menu->name }} </div>
                            @endif
                        @else
                            <div class="top-menu__title"> {{ $menu->name }} <i data-feather="chevron-down" class="top-menu__sub-icon"></i> </div>
                        @endif
                    @endif
                </a>
                @if(auth()->user())
                    @if(($listChildMenus = auth()->user()->getChildMenusOfRoot($menu->id))->isNotEmpty())
                        <ul class="">
                            @foreach($listChildMenus as $subKey => $subMenu)
                                <li class="hover:bg-theme-1 rounded-md">
                                    <a href="{{ $subMenu->route_params ? route($subMenu->route, json_decode($subMenu->route_params, true)) : route($subMenu->route) }}" class="top-menu">
                                        <div class="top-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> </div>
                                        <div class="top-menu__title"> {{ $subMenu->name }} </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                @else
                    @if($menu->subMenus->isNotEmpty())
                        <ul class="">
                            @foreach($menu->subMenus as $subKey => $subMenu)
                                <li class="hover:bg-theme-1 rounded-md">
                                    <a href="{{ $subMenu->route_params ? route($subMenu->route, json_decode($subMenu->route_params, true)) : route($subMenu->route) }}" class="top-menu">
                                        <div class="top-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> </div>
                                        <div class="top-menu__title"> {{ $subMenu->name }} </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                @endif
            </li>
        @endforeach
    </ul>

    @if(auth()->user())
        <div class="dropdown w-8 h-8 absolute top-9 right-0">
            <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110">
                <img alt="Midone Tailwind HTML Admin Template" src="{{ asset('images/profile-1.jpg') }}">
            </div>
            <div class="dropdown-box w-56">
                <div class="dropdown-box__content box bg-theme-38 dark:bg-dark-6 text-white">
                    <div class="p-4 border-b border-theme-40 dark:border-dark-3">
                        <div class="font-medium">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-theme-41 mt-0.5 dark:text-gray-600">{{ auth()->user()->email }}</div>
                    </div>
                    <div class="p-2">
                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                            <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile
                        </a>
                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                            <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Account
                        </a>
                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                            <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password
                        </a>
                    </div>
                    <form action="{{  route('logout') }}" method="post" class="p-2 border-t border-theme-40 dark:border-dark-3">
                        @csrf
                        <button type="submit" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                            <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</nav>
{{-- Mobile menus --}}
<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img class="h-12 mr-3 mt-1" src="{{ asset('images/logo.png') }}">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2 w-8 h-8 text-white transform -rotate-90"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg> </a>
    </div>

    <ul class="border-t border-theme-24 py-5 hidden">
        @foreach($menu_list as $key => $menu)
            <li>
                <a href="{{ $menu->route ? route($menu->route) : 'javascript:void(0)' }}" class="menu @if($key == $parent_active_index) menu--active @endif">
                    @if($menu->subMenus->isEmpty())
                        <div class="menu__title"> {{ $menu->name }} </div>
                    @else
                        <div class="menu__title"> {{ $menu->name }} <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down menu__sub-icon"><polyline points="6 9 12 15 18 9"></polyline></svg> </div>
                    @endif
                </a>
                @if($menu->subMenus->isNotEmpty())
                    <ul class="">
                        @foreach($menu->subMenus as $subKey => $subMenu)
                            <li>
                                <a href="{{ route($subMenu->route, ['category' => $subMenu->slug]) }}" class="menu">
                                    <div class="menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> </div>
                                    <div class="menu__title"> {{ $subMenu->name }} </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>