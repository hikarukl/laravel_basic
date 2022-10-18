/**
 * Handle countdown time
 */
function handleCountdownTime(
    countdownTarget,
    countdownTime,
    messageCountdown = '',
    callbackWhileCountDown = function () {},
    callBackAfterCountDown = function () {}
) {
    let currentDateTime = new Date();
    let countdownDateTime = new Date(countdownTime);

    if (countdownDateTime > currentDateTime) {
        let contentCountDown = messageCountdown ? messageCountdown : "Thời gian còn lại: <strong>%H:%M:%S</strong>";

        countdownTarget.removeClass('hidden');
        countdownTarget.countdown(countdownTime, function (event) {
            callbackWhileCountDown();
            $(this).html(event.strftime(contentCountDown));
        }).on('finish.countdown', function (event) {
            callBackAfterCountDown();
            $(this).html('');
        });
    }
}

/**
 * Init tabulator table
 */
function initTabulatorTable(params)
{
    let table = new window.Tabulator(params.id, {
        ajaxURL: params.ajaxUrl,
        ajaxFiltering: true,
        ajaxSorting: true,
        printAsHtml: true,
        printStyled: true,
        pagination: "remote",
        paginationSize: 10,
        paginationSizeSelector: [10, 20, 30, 40],
        layout: "fitColumns",
        responsiveLayout: "collapse",
        placeholder: "No matching records found",
        columns: params.columns,
        renderComplete() {
            feather.replace({
                "stroke-width": 1.5,
            });
        },
    });

    // Redraw table onresize
    window.addEventListener("resize", () => {
        table.redraw();
        feather.replace({
            "stroke-width": 1.5,
        });
    });

    // On submit filter form
    $("#tabulator-html-filter-form")[0].addEventListener(
        "keypress",
        function (event) {
            let keycode = event.keyCode ? event.keyCode : event.which;
            if (keycode == "13") {
                event.preventDefault();
                filterHTMLForm(table);
            }
        }
    );

    // On click go button
    $("#tabulator-html-filter-go").on("click", function (event) {
        filterHTMLForm(table);
    });

    // Export
    $("#tabulator-export-csv").on("click", function (event) {
        table.download("csv", "data.csv");
    });

    $("#tabulator-export-json").on("click", function (event) {
        table.download("json", "data.json");
    });

    $("#tabulator-export-xlsx").on("click", function (event) {
        window.XLSX = xlsx;
        table.download("xlsx", "data.xlsx", {
            sheetName: "Sheet 1",
        });
    });

    $("#tabulator-export-html").on("click", function (event) {
        table.download("html", "data.html", {
            style: true,
        });
    });

    // Print
    $("#tabulator-print").on("click", function (event) {
        table.print();
    });

    return table;
}

/**
 * Apply filter value
 */
function filterHTMLForm(table) {
    let field = $("#tabulator-html-filter-field").val();
    let type = $("#tabulator-html-filter-type").val();
    let value = $("#tabulator-html-filter-value").val();
    table.setFilter(field, type, value);
}

