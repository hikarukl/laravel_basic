<x-app-layout>
    <div class="w-full">
        @include('admin.components.breadcrumb', ['route' => route('admin-post.index'), 'pageName' => 'Posts'])

        <div class="w-full">
            <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">Add New Post</h2>

                <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                    <button class="dropdown-toggle button text-white bg-theme-1 shadow-md flex items-center">
                        Save
                    </button>
                </div>
            </div>

            <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
                <div class="intro-y col-span-12 lg:col-span-8">
                    <input type="text" class="intro-y input input--lg w-full box pr-10 placeholder-theme-13" placeholder="Title">

                    <div class="post intro-y overflow-hidden box mt-5">
                        <div class="post__tabs nav-tabs flex flex-col sm:flex-row bg-gray-300 dark:bg-dark-2 text-gray-600">
                            <a title="Fill in the article content" data-toggle="tab" data-target="#content" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center active">
                                <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Content
                            </a>
                        </div>
                        <div class="post__content tab-content">
                            <div class="tab-content__pane p-5 active" id="content">
                                <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                                        <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Text Content
                                    </div>
                                    <div class="mt-5">
                                        <div class="editor" name="editor">

                                        </div>
                                    </div>
                                </div>
                                <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5 mt-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                                        <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Description & Thumbnail
                                    </div>
                                    <div class="mt-5">
                                        <div>
                                            <label>Description</label>
                                            <textarea class="input w-full border mt-2"></textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label>Upload Thumbnail</label>
                                            <div class="border-2 border-dashed dark:border-dark-5 rounded-md mt-3 pt-4">
                                                <div class="flex flex-wrap px-4">
                                                    <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                        <img class="rounded-md" alt="Midone Tailwind HTML Admin Template" src="{{ asset('images/food-beverage-1.jpg') }}">
                                                        <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">
                                                            <i data-feather="x" class="w-4 h-4"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                                    <i data-feather="image" class="w-4 h-4 mr-2"></i> <span class="text-theme-1 dark:text-theme-10 mr-1">Upload a file</span>
                                                    <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-2 ml-5 flex justify-center">
                            <a href="{{ route('admin-post.index') }}" class="button text-white bg-theme-1 shadow-md flex items-center mr-3">
                                Back
                            </a>
                            <button class="button text-white bg-theme-1 shadow-md flex items-center">
                                Save
                            </button>
                        </div>
                    </div>
                </div>

                <!-- BEGIN: Post Info -->
                <div class="col-span-12 lg:col-span-4">
                    <div class="intro-y box p-5">
                        <div class="mt-3">
                            <label>Categories</label>
                            <div class="mt-2">
                                <select data-placeholder="Select categories" class="tail-select w-full">
                                    <option value="1" selected>Horror</option>
                                    <option value="2">Sci-fi</option>
                                    <option value="3" selected>Action</option>
                                    <option value="4">Drama</option>
                                    <option value="5">Comedy</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label>Tags</label>
                            <div class="mt-2">
                                <input class="input w-full border" type="text">
                            </div>
                        </div>
                        <div class="mt-3">
                            <label>Published</label>
                            <div class="mt-2">
                                <input class="input input--switch border" type="checkbox">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="{{ asset('js/ckfinder/ckfinder.js') }}"></script>
        <script>
            CKFinder.config( { connectorPath: '/ckfinder/connector' } );
        </script>
    @endsection
</x-app-layout>