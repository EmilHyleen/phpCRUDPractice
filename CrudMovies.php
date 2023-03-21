<?php    
    $movies =
        [
            [
                'Name' => 'Minions: The Rise of Gru',
                'Rating' => '8/10',
                'Description' => 'minions',
                'Date' => '01-07-2022'
            ],
            [
                'Name' => 'Avatar: The Way of Water',
                'Rating' => '7.8/10',
                'Description' => 'blue man',
                'Date' => '14-12-2022'
            ],
            [
                'Name' => 'Puss in Boots: The Last Wish',
                'Rating' => '7.9/10',
                'Description' => 'death',
                'Date' => '21-12-2022'
            ]
        ];

    $exit = false;

    while ($exit == false)
    {
        PrintMenu($movies);
        
        $input = readline("Enter: ");

        switch ($input)
        {
            case 1:
                ReadAll($movies);
                break;
            case 2:
                CreateEntry($movies);
                break;
            case 3:
                EditEntry($movies);
                break;
            case 4:
                DeleteEntry($movies);
                break;
            case 5:
                $exit = true;
                break;
        }
    }

    function PrintMenu(&$aMovieList)
    {
        echo '-----------' . PHP_EOL;
        echo '[Main Menu]' . PHP_EOL;
        echo '-----------' . PHP_EOL;
        echo '[1] View Movie List (' . sizeof($aMovieList) . ')' . PHP_EOL;
        echo '[2] Create Movie Entry' . PHP_EOL;
        echo '[3] Edit Movie Entry' . PHP_EOL;
        echo '[4] Delete Movie Entry' . PHP_EOL;
        echo '[5] Exit' . PHP_EOL;
    }

    function CreateEntry(&$aMovieList)
    {
        echo '--------------' . PHP_EOL;
        echo '[Create Entry]' . PHP_EOL;
        echo '--------------' . PHP_EOL;
        $mName = readline('Name: ');
        $mRating = readline('Rating: ');
        $mDesc = readline('Description: ');
        $mDate = readline('Date (dd-mm-yyyy): '); //should have some error handling on these but its late and im lazy :^)

        $aMovieList[] = [ 'Name' => $mName, 'Rating' => $mRating, 'Description' => $mDesc, 'Date' => $mDate ];
    }

    function ReadEntry($aMovie)
    {
        echo '  Name:' . $aMovie['Name'] . PHP_EOL;
        echo '  Rating: ' . $aMovie['Rating'] . PHP_EOL;
        echo '  Description: ' . $aMovie['Description'] . PHP_EOL;
        echo '  Date: ' . $aMovie['Date'] . PHP_EOL;
    }

    function EditEntry(&$aMovieList)
    {
        echo '--------------' . PHP_EOL;
        echo '[Edit Entry]' . PHP_EOL;
        echo '--------------' . PHP_EOL;
        
        EInputID:
        $mID = readline('Entry ID (number): ');

        if (is_numeric($mID) == false)
        {
            echo '<error> ID Must Be Numeric' . PHP_EOL;
            goto EInputID;
        }

        if ($mID < 0 || $mID >= sizeof($aMovieList))
        {
            echo '<error> ID Not Within Bounds' . PHP_EOL;
            goto EInputID;
        }

        $sMovie = $aMovieList[$mID];
        echo 'Entry Selected:' . PHP_EOL;
        ReadEntry($sMovie);
        echo PHP_EOL;

        EInputMenu:
        echo 'Edit:' . PHP_EOL;
        echo '[1] Name' . PHP_EOL;
        echo '[2] Rating' . PHP_EOL;
        echo '[3] Descrition' . PHP_EOL;
        echo '[4] Date' . PHP_EOL;
        echo '[x] Back To Menu' . PHP_EOL;
        $eAction = readline('Action: ');

        if ($eAction == 'x')
        {
            return;
        }

        if (is_numeric($eAction) == false)
        {
            echo '<error> Input Must Be Numeric' . PHP_EOL;
            goto EInputMenu;
        }

        if ($eAction < 1 || $eAction > 4)
        {
            echo '<error> Unknown Action' . PHP_EOL;
            goto EInputMenu;
        }

        switch ($eAction)
        {
            case 1:
                echo 'Current Name: ' . $sMovie['Name'] . PHP_EOL;
                $aMovieList[$mID]['Name'] = readline('New Name: ');
                break;
            case 2:
                echo 'Current Rating: ' . $sMovie['Rating'] . PHP_EOL;
                $aMovieList[$mID]['Rating'] = readline('New Rating: ');
                break;
            case 3:
                echo 'Current Descrition: ' . $sMovie['Descrition'] . PHP_EOL;
                $aMovieList[$mID]['Descrition'] = readline('New Descrition: ');
                break;
            case 4:
                echo 'Current Date: ' . $sMovie['Date'] . PHP_EOL;
                $aMovieList[$mID]['Date'] = readline('New Date: ');
                break;
        }
    }

    function DeleteEntry(&$aMovieList)
    {
        echo '--------------' . PHP_EOL;
        echo '[Delete Entry]' . PHP_EOL;
        echo '--------------' . PHP_EOL;
        echo '[x] Back To Menu' . PHP_EOL;
        echo PHP_EOL;

        DInputID:
        $mID = readline('Entry ID (number): ');

        if ($mID == 'x')
        {
            return;
        }

        if (is_numeric($mID) == false)
        {
            echo '<error> ID Must Be Numeric' . PHP_EOL;
            goto DInputID;
        }

        if ($mID < 0 || $mID >= sizeof($aMovieList))
        {
            echo '<error> ID Not Within Bounds' . PHP_EOL;
            goto DInputID;
        }

        $sMovie = $aMovieList[$mID];
        echo 'Entry Selected:' . PHP_EOL;
        ReadEntry($sMovie);
        echo PHP_EOL;
        DInputAction:
        $dInput = readline('Delete Selected Entry? (y/n): ');

        if ($dInput == 'y')
        {
            \array_splice($aMovieList, $mID, 1);
        }
        else if ($dInput == 'n')
        {
            return;
        }
        else
        {
            echo '<error> Input Not Recognized' . PHP_EOL;
            goto DInputAction;
        }
    }

    function ReadAll(&$aMovieList)
    {
        $index = 0;
        echo PHP_EOL;
        foreach ($aMovieList as $movie)
        {
            echo '  ID: ' . $index . PHP_EOL;
            ReadEntry($movie);
            echo PHP_EOL;
            $index++;
        }
    }    
?>