<!-- BEGIN: Top Bar -->
<div class="border-b border-white/[0.08] -mt-10 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 pt-3 md:pt-0 mb-10">
    <div class="top-bar-boxed flex items-center">
        <!-- BEGIN: Logo -->
        <a href="{{ route('dashboard.index') }}" class="-intro-x hidden md:flex">
            <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="{{ asset('images/logo.svg') }}">
            <span class="text-white text-lg ml-3">
                Admin
            </span>
        </a>
        <!-- END: Logo -->
        <!-- BEGIN: Breadcrumb -->
        @include('admin.components.breadcrumb')
        <!-- END: Breadcrumb -->

        <!-- BEGIN: Account Menu -->
        <div class="intro-x dropdown w-8 h-8">
            <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                <img alt="Rubick Tailwind HTML Admin Template" src="{{ asset('images/profile-1.jpg') }}">
            </div>

            <div class="dropdown-menu w-56">
                <ul class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
                    <li class="p-2">
                        <div class="font-medium">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-white/60 mt-0.5 dark:text-slate-500">{{ auth()->user()->email }}</div>
                    </li>
                    <li><hr class="dropdown-divider border-white/[0.08]"></li>

                    <li>
                        <a href="{{ route('admin-profile.index') }}" class="dropdown-item hover:bg-white/5">
                            <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile
                        </a>
                    </li>
                    <li><hr class="dropdown-divider border-white/[0.08]"></li>
                    <li>
                        <form action="{{  route('logout') }}" method="post" class="p-2 dark:border-dark-3 hover:bg-white/5 rounded-md">
                            @csrf
                            <button type="submit" class="flex items-center block transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md ">
                                <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- END: Account Menu -->
    </div>
</div>
<!-- END: Top Bar -->

<nav class="top-nav">
    <ul>
        @foreach($menu_list as $key => $menu)
            @php
                $iconConfig = $menu->icon_config ? json_decode($menu->icon_config, true) : '';
            @endphp
            <li>
                <a href="{{ $menu->route ? route($menu->route) : 'javascript:void(0)' }}" class="top-menu @if($key == $parent_active_index) top-menu--active @endif">
                    @if($iconConfig)
                        <div class="top-menu__icon">
                            {!! $iconConfig['value'] !!}
                        </div>
                    @endif
                    @if($menu->subMenus->isEmpty())
                        <div class="top-menu__title"> {{ $menu->name }} </div>
                    @else
                        @if(auth()->user()->getChildMenusOfRoot($menu->id)->isNotEmpty())
                            <div class="top-menu__title"> {{ $menu->name }} <i data-feather="chevron-down" class="top-menu__sub-icon"></i> </div>
                        @else
                            <div class="top-menu__title"> {{ $menu->name }} </div>
                        @endif
                    @endif
                </a>

                @if(($listChildMenus = auth()->user()->getChildMenusOfRoot($menu->id))->isNotEmpty())
                    <ul class="@if($key == $parent_active_index) top-menu__sub-open @endif">
                        @foreach($listChildMenus as $subKey => $subMenu)
                            <li class="@if($subKey !== (count($listChildMenus) - 1)) border-b border-white @endif">
                                <a href="{{ $subMenu->route_params ? route($subMenu->route, json_decode($subMenu->route_params, true)) : route($subMenu->route) }}" class="top-menu">
                                    <div class="top-menu__icon">
                                        <i data-feather="activity"></i>
                                    </div>
                                    <div class="top-menu__title">
                                        {{ $subMenu->name }}
                                        @if (isset($subMenu['sub_menu']))
                                            <i data-feather="chevron-down" class="top-menu__sub-icon"></i>
                                        @endif
                                    </div>
                                </a>

                                @if (isset($subMenu['sub_menu']))
                                    <ul class="{{ $second_level_active_index == $subMenuKey ? 'top-menu__sub-open' : '' }}">
                                        @foreach ($subMenu['sub_menu'] as $lastSubMenuKey => $lastSubMenu)
                                            <li>
                                                <a href="{{ isset($lastSubMenu['route_name']) ? route($lastSubMenu['route_name'], $lastSubMenu['params']) : 'javascript:;' }}" class="top-menu">
                                                    <div class="top-menu__icon">
                                                        <i data-feather="zap"></i>
                                                    </div>
                                                    <div class="top-menu__title">{{ $lastSubMenu['title'] }}</div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
