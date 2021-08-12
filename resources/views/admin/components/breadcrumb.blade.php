<div class="w-full top-bar">
    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        @if(request()->route()->getName() === 'dashboard.index')
            <a href="javascript:void(0)" class="breadcrumb--active">Dashboard</a>
        @else
            <a href="{{ route('dashboard.index') }}" class="">Dashboard</a> <i class="h-4" data-feather="chevron-right"></i>
            <a href="{{ $route }}" class="breadcrumb--active">{{ $pageName }}</a>
        @endif
    </div>
</div>