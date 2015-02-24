<?php

    // configuration
    require('../helpers/helpers.php');

    // if form was submitted
    if (isset($_GET['symbol']))
    {
        // validate submission
        if (empty($_GET["symbol"]))
        {
            apologize("You must provide a symbol.");
        }

        // lookup stock
        $stock = lookup($_GET['symbol']);

        // validate symbol provided
        if ($stock == false)
        {
            apologize("Symbol not found.");
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
