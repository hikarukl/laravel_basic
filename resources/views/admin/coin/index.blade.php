<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Coin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                @livewire('admin.coin-calculate-form')

                <div class="overflow-x-auto mt-10">
                    <table class="table w-full text-left">
                        <thead>
                            <tr>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Percent</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Value</th>
                            </tr>
                        </thead>
                        <tbody id="wrap-body_table_content">

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

    @push('scripts')
        <script>
          window.addEventListener('calculate-coin', event => {
            $('#wrap-body_table_content').html('');
            // Validate time countdown
            let contentTable = $('#row-calculate').html();
            for (var key in event.detail.data) {
              let content = contentTable.replace(/__PERCENT__/, key).replace(/__VALUE__/, event.detail.data[key]);
              $('#wrap-body_table_content').append(content);
            }
          })
        </script>
    @endpush
</x-app-layout>