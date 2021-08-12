<x-app-layout>
    <div class="w-full">
        @include('admin.components.breadcrumb', ['route' => route('admin-post.index'), 'pageName' => 'Posts'])

        <div class="w-full">
            <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">Edit Post</h2>
            </div>
            <x-jet-validation-errors class="rounded-md mt-3 p-5 border border-red-600" />

            <form class="pos intro-y grid grid-cols-12 gap-5 mt-5" enctype="multipart/form-data" method="post" action="{{ route('admin-post.update', ['admin_post' => $post->id]) }}">
                <input type="hidden" name="_method" value="put">
                @csrf

                <div class="intro-y col-span-12 lg:col-span-8">
                    <input
                        type="text"
                        name="post_title"
                        class="intro-y input input--lg w-full box pr-10 placeholder-theme-13"
                        value="{{ $post->title }}"
                        placeholder="Title">

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
                                        <textarea class="editor" name="post_content">
                                            {{ $post->content }}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5 mt-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                                        <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Description & Thumbnail
                                    </div>
                                    <div class="mt-5">
                                        <div>
                                            <label>Description</label>
                                            <textarea name="post_description" class="input w-full border mt-2 text-left"> {!! $post->description !!}</textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label>Upload Thumbnail</label>
                                            <div class="border-2 border-dashed dark:border-dark-5 rounded-md mt-3 pt-4">
                                                <div class="flex flex-wrap px-4">
                                                    <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                        <img class="rounded-md" id="preview-thumbnail" alt="" src="{{ $post->thumbnail ? asset("uploads/{$post->thumbnail}") : asset("images/categories/{$post->category->slug}_default.png") }}">
                                                        <div id="btn-remove_thumbnail" title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">
                                                            <i data-feather="x" class="w-4 h-4"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                                    <i data-feather="image" class="w-4 h-4 mr-2"></i> <span class="text-theme-1 dark:text-theme-10 mr-1">Upload a file</span>
                                                    <input type="file" accept="image/*" id="input-thumbnail" name="post_thumbnail" class="w-full h-full top-0 left-0 absolute opacity-0">
                                                    <input type="hidden" id="thumbnail-default" value="{{ asset("images/categories/{$post->category->slug}_default.png") }}">
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
                            <button type="submit" class="button text-white bg-theme-1 shadow-md flex items-center">
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
                                <select data-placeholder="Select categories" class="tail-select w-full" name="post_category_id">
                                    @foreach($category_list as $category)
                                        <option value="{{ $category->id }}" @if($post->category->id == $category->id) selected @endif >{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-5">
                            <label>Tags</label>
                            <div class="mt-2">
                                <input id="input-post_tags" class="input w-full border mb-2" type="text" value="">
                                <input id="post-tags" name="post_tags" class="input w-full border mb-2" type="hidden" value="{{ $post->tags }}">

                                <div class="w-full flex justify-start flex-wrap" id="wrap-post_tags">
                                    @if($post->tags)
                                        @foreach(explode(",", $post->tags) as $tag)
                                            <span class="btn-remove_post_tag pl-2 pr-2 mb-3 cursor-pointer bg-theme-7 rounded text-white mr-2 hover:bg-blue-400">{{ $tag }}</span>
                                        @endforeach
                                    @endif

                                    <template id="tpl-item_tag">
                                        <span class="btn-remove_post_tag pl-2 pr-2 mb-3 cursor-pointer bg-theme-7 rounded text-white mr-2 hover:bg-blue-400">__VALUE__</span>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <label>Published</label>
                            <div class="mt-2">
                                <input name="post_status" class="input input--switch border" type="checkbox">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('scripts')
        <script src="{{ asset('js/ckfinder/ckfinder.js') }}"></script>
        <script>
            CKFinder.config( { connectorPath: '/ckfinder/connector' } );

            $(document).ready(function () {
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

                            //readDataExcelCsvToTable(this.files[0], previewThumbnailTarget, inputThumbnailTarget);
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
                let btnRemoveTagTarget = $('.btn-remove_post_tag');
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
                $(document).on('click', '.btn-remove_post_tag', function (e) {
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
            })
        </script>
    @endsection
</x-app-layout>