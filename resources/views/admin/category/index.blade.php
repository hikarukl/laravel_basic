<x-app-layout>
    <div class="w-full">
        @include('admin.components.breadcrumb', ['route' => route('category.index'), 'pageName' => 'Category'])

        <div class="w-full grid grid-cols-12">
            <h4 class="mt-3 mb-5 text-xl">Category</h4>

            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report mt-2">
                    <thead>
                    <tr>
                        <th class="whitespace-nowrap">Name</th>
                        <th class="text-center whitespace-nowrap">Slug</th>
                        <th class="text-center whitespace-nowrap">Route</th>
                        <th class="text-center whitespace-nowrap">Menu Parent</th>
                        <th class="text-center whitespace-nowrap">Priority</th>
                        <th class="text-center whitespace-nowrap">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($category_list as $category)
                        <tr class="intro-x">
                            <td class="w-40">{{ $category->name }}</td>
                            <td class="text-center">{{ $category->slug }}</td>
                            <td class="text-center">{{ $category->route }}</td>
                            <td class="text-center w-40">{{ $category->frontendMenu->name }}</td>
                            <td class="text-center">{{ $category->priority }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="javascript:void(0)">
                                        <i class="far fa-edit mr-2"></i> {{ trans('common.btn_edit') }}
                                    </a>
                                    <a class="flex items-center text-theme-6 ml-2" href="javascript:void(0)" data-toggle="modal" data-target="#delete-confirmation-modal">
                                        <i class="far fa-trash-alt mr-2"></i> {{ trans('common.btn_inactive') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center justify-between">
                <select class="w-20 input box mt-3 sm:mt-0" name="select-limit_search">
                    @foreach(\App\Constants\CommonConstants::DEFAULT_SEARCH_LIMIT_LIST as $numberLimit)
                        <option>{{ $numberLimit }}</option>
                    @endforeach
                </select>
                @if($category_list->total())
                    {{ $category_list->links('vendor.pagination.tailwind') }}
                @endif
            </div>
        </div>
    </div>
    @include('modals.confirm_modal', [
        'modalId'        => 'delete-confirmation-modal',
        'modalClasses'   => 'mt-0 ml-0 pl-0',
        'modalTitle'     => trans('modal.modal_inactive.title'),
        'modalContent'   => trans('modal.modal_inactive.content'),
        'btnCancelName'  => trans('common.btn_cancel'),
        'btnConfirmName' => trans('common.btn_inactive'),
    ])
</x-app-layout>