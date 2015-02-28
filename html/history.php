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

        // find year-to-date range
        if ($_GET['range'] == 'ytd')
        {
            $_GET['range'] = date('z');
        }

        // lookup stock history
        $history = history($_GET['history_symbol'], $_GET['range']);

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
