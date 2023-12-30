<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta lang="en-US">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Jen</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../styles/styles.css">
    <style>
        /* custom styling just for my page */
        html {
            background-color: #80E090;
        }

        main {
            font-size: 1.1rem;
            text-align: left;
        }
        #themeToggle {
            display: none;
        }

        p,
        li {
            font-size: 1.1rem;
            line-height: 1.7rem;
        }

        li {
            margin-bottom: 2%;
        }

        .datetime {
            background-color: forestgreen;
            padding: 1px;
            text-align: center;
        }

        .datetime p {
            font-size: 1.7rem;
            font-weight: bold;
            color: aliceblue;
        }
    </style>
</head>

<body>
    <?php include '../navbar.php'; ?>
    <header>
        <h1>About Jen</h1>
    </header>

    <main>
        <?php
        function oddOrEven($num)
        {
            if ($num % 2 == 0) {
                return "even";
            }
            return "odd";
        }
        date_default_timezone_set("America/New_York");
        $dayAtLoad = date("j");
        $monthYearAtLoad = date(" F, Y");
        $timeAtLoad = date("H:i:s");
        $colour = date("Hsi");
        ?>
        <p>
            Using a mix of PHP and HTML, I can show some information that changes between each refresh of the page. For example, the date and time upon generating this page is:
        </p>
        <div class="datetime">
            <p>
                <?php echo $dayAtLoad . $monthYearAtLoad . " at " . $timeAtLoad; ?>
            </p>
        </div>
        <p>Which means that:</p>
        <ul>
            <li><?php echo "The hour is an " . oddOrEven(substr($timeAtLoad, 0, 2)) . " number" ?></li>
            <li><?php echo "The minute is an " . oddOrEven(substr($timeAtLoad, 3, 2)) . " number" ?></li>
            <li><?php echo "The second is an " . oddOrEven(substr($timeAtLoad, 6, 2)) . " number" ?></li>
        </ul>
        <p>
            Similarly, I can determine that the date, <?php echo $dayAtLoad . ", is an " .  oddOrEven($dayAtLoad) ?> number.
        </p>

        <?php
        echo '<p>I can even create colours using the current time:</p>';
        echo '<div style="height: 60px;width: 60px; border-colour:purple;background-color:' . $colour . ';"></div>';
        ?>
    </main>
</body>
<?php include '../footer.php' ?>

</html>