<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="../styles/styles.css">
<title>Sarah's Page</title>
</head>
<style>
    #themeToggle {
        display: none;
    }
</style>
<body style= "background-color: #fff;  font-family: Arial, Helvetica, sans-serif; justify-content: center;">
    
    <?php
    include '../navbar.php';
    ?>
    <main style= "margin-left: 10%; margin-right: 10%;text-align: left;">
    <h1 style="font-weight: bold; font-size: 75px;">Sarah Toll</h1>
    <h2 >Background:</h2>
    <p style = "font-weight: light; font-size: 16px;" >I'm 21 years old. I am in my fourth year of studying computer science and math.
    If I'm not doing schoolwork, I'm always listening to music, with friends, or asleep. I will be graduating in
    June 2024!
    The top reason I cried this year was coding.</p>
    <h2>Site:</h2>
    <p style= "font-weight: light; font-size: 16px;">This site was built in collaboration with a CIS*3760 class.
    We all have had to deal with issues figuring out what courses to take next, and this tool was built to help
    fix those issues by searching by prerequisites. We hope that this tool could assist students with academic
    planning.
   </p>
    <h2>PHP:</h2>
    <h3>This was my first time using PHP. Here is using PHP to show the date:</h3>
    <?php
        echo "todays date is: " . date('d/m/Y');
    ?>
    
    
    <h3>One of my favorite songs right now:</h3>
    <iframe style="border-radius:12px;" src="https://open.spotify.com/embed/track/2hLXUbsOU9cDb9RFva9FYr?utm_source=generator" width="100%" height="352" 
        frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
    </main>
    </body>
<?php
include '../footer.php'
?>
</html>