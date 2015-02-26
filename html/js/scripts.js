// load google api
google.load('visualization', '1.1', {packages: ['line']});

$(document).ready(function() {

    // if price div exists
    if ($('#price').length) {

        // update price every 10 sec
        setInterval(updatePrice, 10000);

        $.ajax({
            url: "history.php",
            data: {
                history_symbol: $("#symbol").html()
            },
            success: function(data) {

                // prepare array for google line chart
                var history = [];
                $.each(data, function(date, price) {
                    history.push([new Date(date), parseFloat(price)]);
                });

                google.setOnLoadCallback(drawChart(history));
            }
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

    var data = new google.visualization.DataTable();
    data.addColumn("date", "Date");
    data.addColumn("number", "Price");

    data.addRows(history);

    var options = {
        chart: {
            title: "History stock prices",
            subtitle: "Subtitle oh"
        },
        width: 900,
        height: 500
    };

    var chart = new google.charts.Line(document.getElementById("linechart_material"));

    chart.draw(data, options);
}
