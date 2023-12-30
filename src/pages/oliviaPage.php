<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta lang="en-US">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/styles.css">
    <title>About Us - Olivia</title>
</head>

<!-- Styling just applicable to my page - the submit button in this case -->
<style> 
    input[type=button], input[type=submit], input[type=reset] {
        background-color: #0077c0;
        font-family: monospace;
        font-size: 20px;
        color: white;
        padding: 16px 32px;
        margin: 2px 1px;
        cursor: pointer;
    }
    #themeToggle {
        display: none;
    }
</style>

<body style="font-family: monospace; font-size: 20px">
    
    <header>
        <h1>Olivia's Page</h1>
    </header>

<?php
	include '../navbar.php'
?>
    <center>
        <br>

        <img src = "../images/olivia.jpg" alt="A girl sitting at a computer." style = "width:540px; height:400px">
       
	 <p>
            Hello! My name is Olivia Biancucci, and I am in my fourth year of Computer Science.
            My favourite courses I have taken so far are CIS*1050, CIS*3210, and PSYC*3570.
        </p>

        <br><br>

            <p>
                How about you? Tell me about yourself:
            </p>

	    <!-- Form that takes in user input and makes a post request when they submit to display back their information. -->
        <form method="post">
            <label for="name">Name:</label> 
            <input type="text" id="name" name="name" autocomplete="name"><br><br>

            <label for="course">Favourite Course:</label> 
            <input type="text" id="course" name="course"><br><br>

            <input type="submit" value="Submit">
        </form>

        <br>
	
	<!-- Post request handling - displays the information once submitted. -->
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"]) && isset($_POST["course"])) {
                $name = $_POST["name"];
                $course = $_POST["course"];
                echo "<p>Hello, $name!<br>Your favourite course is $course.</p>";
            }
        ?>
	</br>
    </center>

</body>

<?php
    include '../footer.php'
?>
</html>
