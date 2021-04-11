<x-app-layout>
    <div class="page-content">

        <div class="container-fluid">
            <div class="row">
                {{-- Page title and Breadcrumb --}}
                @include("admin.share.page_information");

                {{-- Page content --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @livewire('admin.coin-calculate-form')

                            <div class="overflow-x-auto mt-10">
                                <h3 class="mt-0 header-title">Calculate Top 3</h3>
                                <table class="table mb-0 table-centered">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Percent</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Value</th>
                                    </tr>
                                    </thead>
                                    <tbody id="wrap-body_table_content"></tbody>
                                </table>

                                <h3 class="mt-3 header-title">Summary Future</h3>
                                <table class="table mb-0 table-centered">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Percent</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Value</th>
                                    </tr>
                                    </thead>
                                    <tbody id="wrap-body_table_future_content">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <template id="row-calculate">
                    <tr>
                        <td class="border-b dark:border-dark-5">__PERCENT__</td>
                        <td class="border-b dark:border-dark-5">__VALUE__</td>
                    </tr>
                </template>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
          window.addEventListener('calculate-coin', event => {
            // Initial
            $('#wrap-body_table_content').html('');
            $('#wrap-body_table_future_content').html('');

            let contentTable = $('#row-calculate').html();

            for (var key in event.detail.data.bottom_3) {
              var content = contentTable.replace(/__PERCENT__/, key).replace(/__VALUE__/, event.detail.data.bottom_3[key]);
              $('#wrap-body_table_content').append(content);
            }

            $('#value-bottom_2_down').html(event.detail.data.bottom_2['percent'] + '%');

            // Future table
            for (var key in event.detail.data.future_list) {
              var content =  contentTable.replace(/__PERCENT__/, key)
                .replace(/__VALUE__/, event.detail.data.future_list[key]);

              $('#wrap-body_table_future_content').append(content);
            }
          })
        </script>
    @endpush
</x-app-layout>