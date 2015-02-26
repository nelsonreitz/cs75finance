// load google api
google.load('visualization', '1.1', {packages: ['line']});

$(document).ready(function() {

    // if price div exists
    if ($('#price').length) {

        // update price every 10 sec
        setInterval(updatePrice, 10000);

        google.setOnLoadCallback(drawChart);
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
function drawChart() {

    var data = new google.visualization.DataTable();
    data.addColumn("date", "Date");
    data.addColumn("number", "Price");

    data.addRows([
        [new Date("2015-02-19"), 130],
        [new Date("2015-02-20"), 140],
        [new Date("2015-02-23"), 156],
        [new Date("2015-02-24"), 120],
        [new Date("2015-02-25"), 133],
    ]);

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
