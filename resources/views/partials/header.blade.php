<nav class="top-nav">
    <ul class="d-flex items-center">
        <li>
            <a href="{{ route('home') }}">
                <img class="h-24 mr-3 mt-1" src="{{ asset('images/logo.png') }}">
            </a>
        </li>
        <li class="mr-4">
            <a href="{{ route('home') }}" class="top-menu top-menu--active">
                <div class="top-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> </div>
                <div class="top-menu__title"> Home </div>
            </a>
        </li>
        <li class="mr-4">
            <a href="{{ route('home') }}" class="top-menu">
                <div class="top-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg> </div>
                <div class="top-menu__title"> Menu Layout <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down top-menu__sub-icon"><polyline points="6 9 12 15 18 9"></polyline></svg> </div>
            </a>
            <ul class="">
                <li>
                    <a href="index.html" class="top-menu">
                        <div class="top-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> </div>
                        <div class="top-menu__title"> Side Menu </div>
                    </a>
                </li>
                <li>
                    <a href="simple-menu-light-dashboard.html" class="top-menu">
                        <div class="top-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> </div>
                        <div class="top-menu__title"> Simple Menu </div>
                    </a>
                </li>
                <li>
                    <a href="top-menu-light-dashboard.html" class="top-menu">
                        <div class="top-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> </div>
                        <div class="top-menu__title"> Top Menu </div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="mr-4">
            <a href="{{ route('home') }}" class="top-menu">
                <div class="top-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> </div>
                <div class="top-menu__title"> Apps <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down top-menu__sub-icon"><polyline points="6 9 12 15 18 9"></polyline></svg> </div>
            </a>
            <ul class="">
                <li>
                    <a href="javascript:;" class="top-menu">
                        <div class="top-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> </div>
                        <div class="top-menu__title"> Users </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="top-menu">
                        <div class="top-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> </div>
                        <div class="top-menu__title"> Profile </div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>