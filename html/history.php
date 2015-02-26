<?php

    // configuration
    require('../helpers/helpers.php');

    // if ajax request
    if (isset($_GET['history_symbol']))
    {
        // lookup stock
        $history = history($_GET['history_symbol'], 5);

        // set MIME type
        header('Content-type: application/json');

        // output JSON
        print(json_encode($history));
    }

?>
