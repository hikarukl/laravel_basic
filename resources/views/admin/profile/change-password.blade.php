<x-app-layout>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Profile Menu -->
        @include('admin.profile.profile-menu')
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Change Password</h2>
                </div>
                <div class="p-5">
                    <div class="flex flex-col-reverse xl:flex-row flex-col">
                        <div class="flex-1 mt-6 xl:mt-0">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 2xl:col-span-6">
                                    <div>
                                        <label for="update-profile-form-1" class="form-label">New Password</label>
                                        <input id="update-profile-form-1" type="password" class="form-control" placeholder="New Password" value="">
                                    </div>
                                    <div class="mt-3">
                                        <label for="update-profile-form-2" class="form-label">Confirm Password</label>
                                        <input id="update-profile-form-1" type="password" class="form-control" placeholder="Confirm Password" value="">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary w-20 mt-3">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Display Information -->
        </div>
    </div>
</x-app-layout>
