// default time range for history
var DEFAULT_RANGE = 5;

$(document).ready(function() {

    // if price div exists
    if ($('#price').length) {

        // update price every 10 sec
        setInterval(updatePrice, 10000);

        // draw chart
        queryChart();

        // history time range form
        $("#timerange").submit(function() {

            var range = $("input[type=submit][clicked=true]").attr("name");
            queryChart(range);

            return false;
        });

        // give clicked attribute to clicked inputs
        $("#timerange input[type=submit]").click(function() {
            $("input[type=submit]", $(this).parents("form")).removeAttr("clicked");
            $(this).attr("clicked", "true");
        });
    }
});

/*
 * Updates stock price with ajax.
 */
function updatePrice() {

    $.ajax({
        url: "index.php",
        data: {
            ajax_symbol: $("#symbol").html()
        },
        success: function(data) {
            $("#price").html(data.price);
        }
    });
}

/*
 * Draws a google line chart.
 */
function drawChart(history) {

    var data = new google.visualization.arrayToDataTable(history);

    var options = {
        //title: "Historical Prices",
        legend: "none",
        width: 960,
        height: 500,
        tooltip: {textStyle: {fontName: "Helvetica Neue", fontSize: 14, bold: false}},
        vAxis: {
            textStyle: {fontName: "Helvetica Neue", fontSize: 14},
        },
        hAxis: {textStyle: {fontName: "Helvetica Neue", fontSize: 14}}
        //chartArea: {backgroundColor: {stroke: 'black', strokeWidth: 1}}
    };

    var chart = new google.visualization.LineChart(document.getElementById("chart"));

    // format data
    var formatter_date = new google.visualization.DateFormat({formatType: "short"});
    var formatter_number = new google.visualization.NumberFormat({prefix: "$", decimalSymbol: ".", fractionDigits: 2}); 
    formatter_date.format(data, 0);
    formatter_number.format(data, 1);

    chart.draw(data, options);
}

/*
 * Queries history chart with ajax.
 */
function queryChart(range) {

    // range default value
    range = typeof range !== "undefined" ? range : DEFAULT_RANGE;

    $.ajax({
        url: "history.php",
        data: {
            history_symbol: $("#symbol").html(),
            range: range
        },
        success: function(data) {

            // prepare data for Google form
            var history = [["Date", "Price"]]
            $.each(data, function(date, price) {
                history.push([new Date(date), parseFloat(price)]);
            });

            google.setOnLoadCallback(drawChart(history));
        }
    });
}
