<x-app-layout>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Add New Post</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            @if(\Illuminate\Support\Facades\Session::has('message'))
                <div class="rounded-md mt-3 p-5 border border-red-600">
                    <div class="font-medium text-red-600">{{ \Illuminate\Support\Facades\Session::get('message') }}</div>
                </div>
            @endif
            <x-jet-validation-errors class="rounded-md mt-3 p-5 border border-red-600" />

            <div class="dropdown mr-2">
                <button class="dropdown-toggle btn box flex items-center" aria-expanded="false" data-tw-toggle="dropdown">
                    English <i class="w-4 h-4 ml-2" data-feather="chevron-down"></i>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-feather="activity" class="w-4 h-4 mr-2"></i>
                                <span class="truncate">English</span>
                            </a>
                            </a>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-feather="activity" class="w-4 h-4 mr-2"></i>
                                <span class="truncate">Indonesian</span>
                            </a>
                            </a>
                    </ul>
                </div>
            </div>
            <button type="button" class="btn box mr-2 flex items-center ml-auto sm:ml-0">
                <i class="w-4 h-4 mr-2" data-feather="eye"></i> Preview
            </button>
            <button type="button" class="btn box mr-2 flex items-center ml-auto sm:ml-0">
                <i class="w-4 h-4 mr-2" data-feather="eye"></i> Save
            </button>>

        </div>
    </div>

    <form class="pos intro-y grid grid-cols-12 gap-5 mt-5" enctype="multipart/form-data" method="post" action="{{ route('admin-post.store') }}">
        @csrf

        <div class="intro-y col-span-12 lg:col-span-8">
            <input
                type="text"
                name="post_title"
                class="intro-y form-control py-3 px-4 box pr-10"
                required
                value="{{ old('post_title') }}"
                placeholder="Title">
            <input
                type="text"
                name="post_slug"
                class="intro-y border input input--lg w-full box pr-10 placeholder-theme-13 mt-5"
                required
                value="{{ old('post_slug') }}"
                placeholder="Slug">

            <div class="post intro-y overflow-hidden box mt-5">
                <ul class="post__tabs nav nav-tabs flex-col sm:flex-row bg-slate-200 dark:bg-darkmode-800" role="tablist">
                    <li class="nav-item">
                        <button title="Fill in the article content" data-tw-toggle="tab" data-tw-target="#content" href="javascript:;" class="nav-link tooltip w-full sm:w-40 py-4 active" id="content-tab" role="tab" aria-controls="content" aria-selected="true">
                            <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Content
                        </button>
                    </li>
                    <li class="nav-item">
                        <button title="Adjust the meta title" data-tw-toggle="tab" data-tw-target="#meta-title" href="javascript:;" class="nav-link tooltip w-full sm:w-40 py-4" id="meta-title-tab" role="tab" aria-selected="false">
                            <i data-feather="code" class="w-4 h-4 mr-2"></i> Meta Title
                        </button>
                    </li>
                    <li class="nav-item">
                        <button title="Use search keywords" data-tw-toggle="tab" data-tw-target="#keywords" href="javascript:;" class="nav-link tooltip w-full sm:w-40 py-4" id="keywords-tab" role="tab" aria-selected="false">
                            <i data-feather="align-left" class="w-4 h-4 mr-2"></i> Keywords
                        </button>
                    </li>
                </ul>
                <div class="post__content tab-content">
                    <div id="content" class="tab-pane p-5 active" role="tabpanel" aria-labelledby="content-tab">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="font-medium flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Text Content
                            </div>
                            <div class="mt-5">
                                <textarea class="editor" name="post_content" required>
                                     {{ old('post_content', 'Content of post') }}
                                </textarea>
                            </div>
                        </div>
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5 mt-5">
                            <div class="font-medium flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Caption & Images
                            </div>
                            <div class="mt-5">
                                <div>
                                    <label for="post-form-7" class="form-label">Caption</label>
                                    <input id="post-form-7" type="text" class="form-control" placeholder="Write caption">
                                </div>
                                <div class="mt-3">
                                    <label class="form-label">Upload Image</label>
                                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                        <div class="flex flex-wrap px-4">
                                            <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                <img class="rounded-md" id="preview-thumbnail" alt="" src="{{ asset('images/default_post_200x200.jpg') }}">
                                                <div id="btn-remove_thumbnail" title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                                    <i data-feather="x" class="w-4 h-4"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                            <i data-feather="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">Upload a file</span> or drag and drop
                                            <input type="file" accept="image/*" id="input-thumbnail" name="post_thumbnail" class="w-full h-full top-0 left-0 absolute opacity-0">
                                            <input type="hidden" id="thumbnail-default" value="">
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
                        <button type="submit" class="button text-white bg-theme-1 shadow-md flex items-center">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- BEGIN: Post Info -->
        <div class="col-span-12 lg:col-span-4">
            <div class="intro-y box p-5">
                <div class="mt-3">
                    <label class="form-label">Categories</label>
                    <div class="mt-2">
                        <select data-placeholder="Select categories" class="tom-select w-full" name="post_category_id" multiple>
                            @foreach($category_list as $category)
                                <option value="{{ $category->id }}" @if(old('post_category_id') == $category->id) selected @endif >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-5">
                    <label class="form-label">Tags</label>
                    <div class="mt-2">
                        <input id="input-post_tags" class="input w-full border mb-2" type="text" value="">
                        <input id="post-tags" name="post_tags" class="input w-full border mb-2" type="hidden" value="{{ old('post_tags') }}">
                        <div class="w-full flex justify-start flex-wrap" id="wrap-post_tags">
                            @if(old('post_tags'))
                                @foreach(explode(",", old('post_tags')) as $tag)
                                    <span class="btn-remove_post_tag pl-2 pr-2 mb-3 cursor-pointer bg-theme-7 rounded text-gray mr-2 hover:bg-blue-400">{{ $tag }}</span>
                                @endforeach
                            @endif

                            <template id="tpl-item_tag">
                                <span class="btn-remove_post_tag pl-2 pr-2 mb-3 cursor-pointer bg-theme-7 rounded text-gray mr-2 hover:bg-blue-400">__VALUE__</span>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="form-check form-switch flex flex-col items-start mt-5">
                    <label class="form-check-label ml-0 mb-2">Published</label>
                    <div class="mt-2">
                        <input id="post-status" name="post_status" class="form-check-input" type="checkbox" @if(old('post_status')) checked @endif">
                    </div>
                </div>
            </div>
        </div>
    </form>

    @section('scripts')
        {{--<script src="{{ asset('js/ckfinder/ckfinder.js') }}"></script>--}}
        <script src="{{ asset('js/ckeditor-classic.js') }}"></script>
        <script>
            //CKFinder.config( { connectorPath: '/ckfinder/connector' } );
            (function () {
                console.log(1321231231);
                let fileInputStorage = [];
                let inputThumbnailTarget = $('#input-thumbnail');
                let previewThumbnailTarget = $('#preview-thumbnail');
                inputThumbnailTarget.on('change', function () {
                    if (this.files && this.files[0]) {
                        let pattern = /^.+.(png|jpg|jpeg)$/;
                        if (pattern.test(this.files[0].name)) {
                            if (this.files && this.files[0]) {
                                fileInputStorage[$(this).attr('id')] = this.files;
                                previewThumbnailTarget.attr('src', URL.createObjectURL(this.files[0]))
                            }

                        } else {
                            Toastify({
                                text: "File invalid.",
                                duration: 2000,
                                newWindow: true,
                                close: true,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#0e2c88",
                                stopOnFocus: true }).showToast();
                        }
                    } else {
                        if (fileInputStorage.hasOwnProperty($(this).attr('id'))) {
                            this.files = fileInputStorage[$(this).attr('id')];
                        }
                    }
                });

                let inputPostTagTarget = $('#input-post_tags');
                let wrapPostTagTarget = $('#wrap-post_tags');
                let postTagTarget = $('#post-tags');
                let postTagStorage = [];
                if (postTagTarget.val()) {
                    postTagTarget.val().split(",").forEach(function (value, index) {
                        postTagStorage[value] = value;
                    })
                }

                inputPostTagTarget.on('keypress', function (e) {
                    // Space or enter
                    if (e.keyCode === 32 || e.keyCode === 13) {
                        let val = $(this).val().trim();
                        if (val) {
                            if (!postTagStorage.hasOwnProperty(val)) {
                                let content = $('#tpl-item_tag').html();
                                content = content.replace(/__VALUE__/, val);
                                wrapPostTagTarget.append(content);
                                postTagStorage[val] = val;

                                // Save to hidden
                                if (postTagTarget.val()) {
                                    postTagTarget.val(postTagTarget.val() + ',' + val);
                                } else {
                                    postTagTarget.val(val);
                                }
                            }

                            $(this).val('');
                        }

                        e.preventDefault();
                        return false;
                    }
                });
                wrapPostTagTarget.on('click', '.btn-remove_post_tag', function (e) {
                    let value = $(this).html();

                    if (postTagStorage.hasOwnProperty(value)) {
                        postTagStorage = _.omit(postTagStorage, value);
                    }

                    postTagTarget.val('');
                    for (let i in postTagStorage) {
                        if (postTagTarget.val()) {
                            postTagTarget.val(postTagTarget.val() + ',' + i);
                        } else {
                            postTagTarget.val(i)
                        }
                    }

                    $(this).remove();
                })

                $('#btn-remove_thumbnail').on('click', function () {
                    if (helper.isset(fileInputStorage)) {
                        previewThumbnailTarget.attr('src', $('#thumbnail-default').val());
                        fileInputStorage = [];
                    } else {
                        Toastify({
                            text: "Default thumbnail. Could not remove.",
                            duration: 2000,
                            newWindow: true,
                            close: true,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#0e2c88",
                            stopOnFocus: true }).showToast();
                    }
                });
            })();

        </script>
    @endsection
</x-app-layout>
