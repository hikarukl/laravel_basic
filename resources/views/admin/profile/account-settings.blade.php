<x-app-layout>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Profile Menu -->
        @include('admin.profile.profile-menu')
        <!-- END: Profile Menu -->

        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Account Settings</h2>
                </div>

                <div class="p-5">
                    <div class="flex-1 mt-6 xl:mt-0">
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 2xl:col-span-6">
                                <div>
                                    <div class="form-check form-switch flex flex-col items-start mt-5">
                                        <label class="form-check-label ml-0 mb-2">Enable Two Factor</label>
                                        <div class="mt-2">
                                            <input id="post-status" name="post_status" class="form-check-input" type="checkbox" @if(old('post_status')) checked @endif">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @livewire('profile.two-factor-authentication-form')
            </div>
            <!-- END: Display Information -->
        </div>
    </div>
</x-app-layout>
