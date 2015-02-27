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
     * Returns a daily history of stock prices.
     */
    function history($symbol, $range = 5)
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

        // set timezone to EST like Yahoo
        date_default_timezone_set('EST');

        // find current date
        $day = date('d');
        $month = date('n') - 1;
        $year = date('Y');

        // open connection to Yahoo
        $handle = @fopen("http://real-chart.finance.yahoo.com/table.csv?s=$symbol&a=$month&b=$day&c=2005&d=$month&e=$day&f=$year&g=d&ignore=.csv", "r"); 
        if ($handle === false)
        {
            // trigger error
            trigger_error('Could not connect to Yahoo!', E_USER_ERROR);
            exit;
        }

        // declare history array
        $history = [];
        $i = 0;

        // read $range number of lines in csv
        while (!feof($handle) && $i < $range + 1) 
        {
            $data = fgetcsv($handle);

            // store date as key and close price as value in history array
            if (is_numeric($data[1]))
            {
                $history[$data[0]] = $data[4];
            }

            ++$i;
        }

        // sort history dates in ascending order
        ksort($history);
        return $history;
    }

    /*
     * Returns a stock by symbol.
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
