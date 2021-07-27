<nav class="top-nav">
    <ul class="d-flex items-center">
        <li>
            <a href="{{ route('home') }}">
                <img class="h-24 mr-3 mt-1" src="{{ asset('images/logo.png') }}">
            </a>
        </li>
        @foreach($menu_list as $key => $menu)
            <li class="mr-4">
                <a href="{{ $menu->route ? route($menu->route) : 'javascript:void(0)' }}" class="top-menu @if($key == $parent_active_index) top-menu--active @endif">
                    @php
                        $iconConfig = $menu->icon_config ? json_decode($menu->icon_config, true) : '';
                    @endphp
                    @if($iconConfig)
                        <span class=" @if($key == $parent_active_index) text-theme-1 @else text-white @endif">{!! $iconConfig['value'] !!}</span>
                    @endif
                    @if($menu->subMenus->isEmpty())
                        <div class="top-menu__title text-theme-3"> {{ $menu->name }} </div>
                    @else
                        <div class="top-menu__title"> {{ $menu->name }} <i data-feather="chevron-down" class="top-menu__sub-icon"></i> </div>
                    @endif
                </a>
                @if($menu->subMenus->isNotEmpty())
                    <ul class="">
                        @foreach($menu->subMenus as $subKey => $subMenu)
                            <li>
                                <a href="{{ route($subMenu->route, ['category' => $subMenu->slug]) }}" class="top-menu">
                                    <div class="top-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> </div>
                                    <div class="top-menu__title"> {{ $subMenu->name }} </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
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