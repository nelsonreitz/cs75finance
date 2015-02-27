<?php

    // configuration
    require('../helpers/helpers.php');

    // if ajax request
    if (isset($_GET['history_symbol']))
    {
        // validate submission
        if (empty($_GET['history_symbol']))
        {
            apologize('You must provide a symbol');
        }

        // lookup stock
        $history = history($_GET['history_symbol'], 5);

        // validate symbol provided
        if ($history == false)
        {
            apologize('Symbol not found');
        }

        // set MIME type
        header('Content-type: application/json');

        // output JSON
        print(json_encode($history));
    }

?>
