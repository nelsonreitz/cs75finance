<?php

    /*
     * Apologizes to user with message.
     */
    function apologize($message)
    {
        render('header');
        render('apology', ['message' => $message]);
        render('footer');
        exit;
    }

    /*
     * Return a stock by symbol.
     */
    function lookup($symbol)
    {
        // reject symbols that start with ^
        if (preg_match("/^\^/", $symbol))
        {
            return false;
        }

        // reject symbols that contain commas
        if (preg_match("/,/", $symbol))
        {
            return false;
        }

        // open connection to Yahoo
        $handle = @fopen("http://download.finance.yahoo.com/d/quotes.csv?f=snl1&s=$symbol", "r");
        if ($handle === false)
        {
            // trigger error
            trigger_error('Could not connect to Yahoo!', E_USER_ERROR);
            exit;
        }

        // download first line of csv
        $data = fgetcsv($handle);
        if ($data === false | count($data) === 1)
        {
            return false;
        }

        // close connection to Yahoo
        fclose($handle);

        // ensure symbol was found
        if ($data[2] === '0.00')
        {
            return false;
        }

        // return stock price as an associative array
        return [
            'symbol' => $data[0],
            'name'   => $data[1],
            'price'  => $data[2]
        ];
    }

    /*
     * Renders a template padding in values.
     */
    function render($template, $values = [])
    {
        $path = __DIR__ . "/../views/$template" . '.php';
        if (file_exists($path))
        {
            extract($values);
            require($path);
        }
        else
        {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }

?>
