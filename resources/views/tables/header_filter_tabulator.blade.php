<div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
    <form class="xl:flex sm:mr-auto" id="tabulator-html-filter-form">
        <div class="sm:flex items-center sm:mr-4">
            <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Field</label>
            <select class="input w-full sm:w-32 xxl:w-full mt-2 sm:mt-0 sm:w-auto border" id="tabulator-html-filter-field">
                @foreach($field_search as $field)
                    <option value="{{ $field }}">{{ $field }}</option>
                @endforeach
            </select>
        </div>
        <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
            <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Type</label>
            <select class="input w-full mt-2 sm:mt-0 sm:w-auto border" id="tabulator-html-filter-type">
                <option value="=" selected>=</option>
                <option value="<"><</option>
                <option value="<="><=</option>
                <option value=">">></option>
                <option value=">=">>=</option>
                <option value="!=">!=</option>
                <option value="like">like</option>
            </select>
        </div>
        <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
            <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Value</label>
            <input type="text" class="input w-full sm:w-40 xxl:w-full mt-2 sm:mt-0 border" id="tabulator-html-filter-value" placeholder="Search...">
        </div>
        <div class="mt-2 xl:mt-0">
            <button type="button" class="button w-full sm:w-16 bg-theme-1 text-white" id="tabulator-html-filter-go">Search</button>
            <button type="button" class="button w-full sm:w-16 mt-2 sm:mt-0 sm:ml-1 bg-gray-200 text-gray-600 dark:bg-dark-5 dark:text-gray-300" id="tabulator-html-filter-reset">Reset</button>
        </div>
    </form>
    <div class="flex mt-5 sm:mt-0">
        <div class="dropdown w-1/2 sm:w-auto">
            <button class="dropdown-toggle button w-full sm:w-auto flex items-center border text-gray-700 dark:bg-dark-5 dark:text-gray-300">
                <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export <i data-feather="chevron-down" class="w-4 h-4 ml-auto sm:ml-2"></i>
            </button>
            <div class="dropdown-box w-40">
                <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                    <a href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md" id="tabulator-export-csv">
                        <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export CSV
                    </a>
                    <a href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md" id="tabulator-export-xlsx">
                        <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export XLSX
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>