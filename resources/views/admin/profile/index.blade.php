<x-app-layout>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Profile Menu -->
        @include('admin.profile.profile-menu')
        <!-- END: Profile Menu -->

        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Profile Information</h2>
                </div>
                <div class="p-5">
                    <div class="flex flex-col-reverse xl:flex-row flex-col">
                        <div class="flex-1 mt-6 xl:mt-0">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 2xl:col-span-6">
                                    <div>
                                        <label for="update-profile-form-1" class="form-label">Name</label>
                                        <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" value="{{ auth()->user()->name }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="update-profile-form-2" class="form-label">Email</label>
                                        <input id="update-profile-form-1" type="email" class="form-control" placeholder="Input text" value="{{ auth()->user()->email }}">
                                    </div>
                                </div>
                                <div class="col-span-12 2xl:col-span-6">
                                    <div>
                                        <label for="update-profile-form-4" class="form-label">Phone Number</label>
                                        <input id="update-profile-form-4" type="text" class="form-control" placeholder="Input text" value="65570828">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary w-20 mt-3">Save</button>
                        </div>
                        <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                            <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                    <img class="rounded-md" alt="Rubick Tailwind HTML Admin Template" src="{{ asset('images/profile-1.jpg') }}">
                                    <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                        <i data-feather="x" class="w-4 h-4"></i>
                                    </div>
                                </div>
                                <div class="mx-auto cursor-pointer relative mt-5">
                                    <button type="button" class="btn btn-primary w-full">Change Photo</button>
                                    <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Display Information -->
        </div>
    </div>
</x-app-layout>
