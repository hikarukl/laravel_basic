<x-app-layout>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">List Posts</h2>
        <div class="w-full grid grid-cols-12">
            <div class="col-span-12 flex justify-between items-center mt-2">
                <h2 class="text-lg font-medium mr-auto">Post List</h2>
                <a href="{{ route('admin-post.create') }}" class="button text-white bg-theme-1 shadow-md mr-5">Add New Post</a>
            </div>

            <div class="intro-y col-span-12 box p-5 mt-5">
                @include('tables.header_filter_tabulator', ['field_search' => [
                    'title',
                    'tags'
                ]])

                <div class="overflow-x-auto">
                    <table class="table table-report mt-2" id="tabulator-post_list"></table>
                </div>
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

    @section('scripts')
        <script type="text/javascript">
            window.dom.ready(function () {
                let tabulatorParams = {
                    id: "#tabulator-post_list",
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
                            title: "Title",
                            minWidth: 200,
                            responsive: 0,
                            field: "name",
                            vertAlign: "middle",
                            print: false,
                            download: false,
                            formatter(cell, formatterParams) {
                                return `<div>
                                    <div class="font-medium whitespace-nowrap">${
                                    cell.getData().title
                                }</div>
                                    <div class="text-gray-600 text-xs whitespace-nowrap">${
                                    cell.getData().category.name
                                }</div>
                                </div>`;
                            },
                        },
                        {
                            title: "Description",
                            minWidth: 200,
                            field: "images",
                            vertAlign: "middle",
                            print: false,
                            download: false,
                            formatter(cell, formatterParams) {
                                return `<div>
                                    <div class="font-medium whitespace-nowrap">${
                                    cell.getData().description
                                }</div>
                                </div>`;
                            },
                        },
                        {
                            title: "Tags",
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
                            title: "Status",
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
                        },
                    ]
                };
                let table = initTabulatorTable(tabulatorParams);

                // On reset filter form
                cash("#tabulator-html-filter-reset").on("click", function (event) {
                    cash("#tabulator-html-filter-field").val("title");
                    cash("#tabulator-html-filter-type").val("=");
                    cash("#tabulator-html-filter-value").val("");
                    filterHTMLForm(table);
                });
            });
        </script>
    @endsection
</x-app-layout>
