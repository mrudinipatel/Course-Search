<!DOCTYPE html>
<html lang="en-ca">
<head>
    <link rel="stylesheet" type="text/css" href="../styles/styles.css">
    <title>Mrudini's Page</title>
    <style>
        .content{
            max-width: 800px;
            margin: 0 auto; 
            padding: 20px;
            text-align: center;
        }
        #themeToggle {
            display: none;
        }

        .quotes{
            max-width: 800px;
            margin: 0 auto; 
            background-color: #1c1429;
            padding: 20px;
            border-radius: 12px;
        }
    </style>
</head>
<body style = 'color: #FFFFFF; background-color: #3c2959; justify-content: center; font-family: Monterrat, sans-serif; text-align: center;'>
    <header>
        <h1>Mrudini's Page</h1>
    </header>

    <?php include '../navbar.php'; ?>

    <br><br>

    <div class ="content">
        <h1>Hello there! My name is Mrudini Patel.</h1>

        <?php echo "Today's date: " . date('d/m/Y');?>

        <br>

        <h2 style="font-weight: light; font-size: 20px;">
            I'm currently in my 4th of Computer Science studies here at the University of Guelph. 
            This semester, I'm enrolled in 4 CIS courses which keep me pretty busy.
            When I'm not programming, I like to bake, read, and go on hikes.
        </h2>

        <br>

        <h3 style="font-weight: light; font-size: 20px;">
            This sprint, I researched about PHP, wrote a small PHP script, created my section on the 'about me' web page, and assisted with testing.
            I enjoyed learning about PHP as it was my first time ever doing so.
        </h3>
    </div>

    <h4>This cat is a visual representation of me: </h4>

    <img src='../images/snuggled_cat.jpg' alt="cat" style="width:540px; height:534px; border-radius:12px;"/>

    <br><br><br>
    
    <div class="quotes">
        <h3>Quote of the Day: </h3>
        <h4>(reload page for a new one!)</h4>
        
        <?php
        $quotes = [
            "We cannot do great things. Only smalls things with great love. - Mother Teresa",
            "Life is like riding a bicycle. To keep your balance, you must keep moving. - Albert Einstein",
            "The only way to do great work is to love what you do. - Steve Jobs",
        ];

        $randomQuote = $quotes[array_rand($quotes)];
        echo "<p>$randomQuote</p>";
        ?>
    </div>
    
    <br><br><br><br>

</body>
<?php include '../footer.php' ?>
</html>


