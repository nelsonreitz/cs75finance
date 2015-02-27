<?php

    // configuration
    require('../helpers/helpers.php');

    // if ajax request
    if (isset($_GET['ajax_symbol']))
    {
        // lookup stock
        $stock = lookup($_GET['ajax_symbol']);

        // set MIME type
        header('Content-type: application/json');

        // output JSON
        print(json_encode($stock));
    }
    // if form was submitted
    else if (isset($_GET['symbol']))
    {
        // validate submission
        if (empty($_GET["symbol"]))
        {
            apologize('You must provide a symbol');
        }

        // lookup stock
        $stock = lookup($_GET['symbol']);

        // validate symbol provided
        if ($stock == false)
        {
            apologize('Symbol not found.');
        }
        else
        {
            render('header');
            render('lookup_form');
            render('quote', ['stock' => $stock]);
            render('footer');
        }
    }
    else
    {
        render('header');
        render('lookup_form');
        render('footer');
    }

?>
