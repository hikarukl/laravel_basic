<div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
    <div class="intro-y box mt-5 lg:mt-0">
        <div class="relative flex items-center p-5">
            <div class="w-12 h-12 image-fit">
                <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="{{ asset('images/profile-1.jpg') }}">
            </div>
            <div class="ml-4 mr-auto">
                <div class="font-medium text-base">{{ auth()->user()->name }}</div>
                <div class="text-slate-500">{{ auth()->user()->email }}</div>
            </div>
        </div>
        <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
            <a class="flex items-center @if(request()->route()->getName() === 'admin-profile.index') text-primary font-bold @endif" href="{{ route('admin-profile.index') }}">
                <i data-feather="activity" class="w-4 h-4 mr-2"></i> Personal Information
            </a>
            <a class="flex items-center mt-5 @if(request()->route()->getName() === 'admin-profile.account-settings') text-primary font-bold @endif" href="{{ route('admin-profile.account-settings') }}">
                <i data-feather="box" class="w-4 h-4 mr-2"></i> Account Settings
            </a>
            <a class="flex items-center mt-5 @if(request()->route()->getName() === 'admin-profile.change-password') text-primary font-bold @endif" href="{{ route('admin-profile.change-password') }}">
                <i data-feather="lock" class="w-4 h-4 mr-2"></i> Change Password
            </a>
        </div>
    </div>
</div>
