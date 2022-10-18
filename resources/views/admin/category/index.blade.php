<x-app-layout>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">List Categories</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="{{ route('admin-category.create') }}" class="btn btn-primary shadow-md mr-2">Add New Category</a>
        </div>
    </div>

    <div class="intro-y box p-5 mt-5">
        @include('tables.header_filter_tabulator', ['field_search' => [
            'title',
            'tags'
        ]])

        <div class="overflow-x-auto scrollbar-hidden">
            <div id="tabulator-post_category" class="mt-5 table-report table-report--tabulator"></div>
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

    {{--<div class="w-full">
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
    </div>--}}

    @section('scripts')
        <script type="text/javascript">
            (function () {
                let tabulatorParams = {
                    id: "#tabulator-post_category",
                    ajaxUrl: "/admin/admin-post/ajax/list",
                    columns: [
                        {
                            formatter: "responsiveCollapse",
                            width: 40,
                            minWidth: 30,
                            align: "center",
                            resizable: false,
                            headerSort: false,
                        },

                        // For HTML table
                        {
                            title: "Name",
                            minWidth: 200,
                            responsive: 0,
                            field: "name",
                            vertAlign: "middle",
                            print: false,
                            download: false,
                            formatter(cell, formatterParams) {
                                return `<div>
                                    <div class="font-medium whitespace-nowrap">${
                                    cell.getData().name
                                }
                                </div>`;
                            },
                        },
                        {
                            title: "Slug",
                            minWidth: 200,
                            field: "images",
                            vertAlign: "middle",
                            print: false,
                            download: false,
                            formatter(cell, formatterParams) {
                                return `<div>
                                    <div class="font-medium whitespace-nowrap">${
                                    cell.getData().slug
                                }</div>
                                </div>`;
                            },
                        },
                        {
                            title: "Route",
                            minWidth: 200,
                            field: "images",
                            vertAlign: "middle",
                            print: false,
                            download: false,
                            formatter(cell, formatterParams) {
                                return `<div>
                                    <div class="font-medium whitespace-nowrap">${
                                    cell.getData().tags
                                }</div>
                                </div>`;
                            },
                        },
                        {
                            title: "Menu Parent",
                            minWidth: 200,
                            field: "status",
                            vertAlign: "middle",
                            print: false,
                            download: false,
                            formatter(cell, formatterParams) {
                                return `<div class="flex items-center lg:justify-center ${
                                    cell.getData().status
                                        ? "text-theme-9"
                                        : "text-theme-6"
                                }">
                                    <i data-feather="check-square" class="w-4 h-4 mr-2"></i> ${
                                    cell.getData().status ? "Active" : "Inactive"
                                }
                                </div>`;
                            },
                        },
                        {
                            title: "Priority",
                            minWidth: 200,
                            field: "actions",
                            responsive: 1,
                            vertAlign: "middle",
                            print: false,
                            download: false,
                            formatter(cell, formatterParams) {
                                return `<div class="flex lg:justify-center items-center">
                                    <a class="flex items-center mr-3" href="${
                                    cell.getData().url_edit
                                }">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                                    </a>
                                    <a class="flex items-center text-theme-6" href="#">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                    </a>
                                </div>`;
                            },
                        },
                        {
                            title: "Actions",
                            minWidth: 200,
                            field: "actions",
                            responsive: 1,
                            vertAlign: "middle",
                            print: false,
                            download: false,
                            formatter(cell, formatterParams) {
                                return `<div class="flex lg:justify-center items-center">
                                    <a class="flex items-center mr-3" href="${
                                    cell.getData().url_edit
                                }">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                                    </a>
                                    <a class="flex items-center text-theme-6" href="#">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                    </a>
                                </div>`;
                            },
                        }
                    ]
                };
                let table = initTabulatorTable(tabulatorParams);

                // On reset filter form
                $("#tabulator-html-filter-reset").on("click", function (event) {
                    $("#tabulator-html-filter-field").val("title");
                    $("#tabulator-html-filter-type").val("=");
                    $("#tabulator-html-filter-value").val("");
                    filterHTMLForm(table);
                });
            })();
        </script>
    @endsection
</x-app-layout>
