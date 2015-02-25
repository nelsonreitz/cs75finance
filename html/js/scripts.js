$(document).ready(function() {

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

    // if price div exists
    if ($('#price').length) {
        setInterval(updatePrice, 10000);
    }

});
