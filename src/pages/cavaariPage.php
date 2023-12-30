<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta lang="en-US">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/styles.css">
    <title>Background Colour Changer - Cavaari</title>
</head>
<style>
    /* Personal stylesheet for background colour */
    body {
        margin: 0;
        padding: 0;
    }
    #themeToggle {
        display: none;    
    }
    .color-button {
        display: inline-block;
        font: Arial;
        /* font-style: bold; */
        font-size: 14px;
        margin-right: 10px;
        padding: 10px 20px;
        background-color: white; /* Default background colour for buttons */
        border: none;
        cursor: pointer;
        color: black; /* Set the text color to black */
    }
    .form-section {
        /* Styles for form section */
        outline: solid #0077c0 2px;
        padding: 5px;
        margin-bottom: 10px;
        display: flex;
        flex-direction: column; /* Changed to column layout */
        justify-content: center; /* Horizontally center */
        align-items: center; /* Vertically center */
        box-sizing: border-box; /* Ensure consistent box sizing */
        outline: solid #0077c0 2px; /* Border style */
        padding: 5%;
    }
</style>
<body id="pageBody">
    <header>
        <h1>Cavaari's Page</h1>
    </header>
    <?php include '../navbar.php'; ?>
    <main>
        <div id="about" class="form-section">
        
            <h1>About Me</h1>
            <p>  Hi, I'm Cavaari Taylor. I love web development and programming. 
                 I hail from the island of Saint Lucia in the Caribbean. A lovely island
                 in the Caribbean where the colours are bright and lively! In Canada the
                 same cannot be said as half of the year things are usually dull and bland
                 so my goal today is to provide some colour. This is why I am sharing this
                 wonderful tool that can help you be as colourful as you wish. Do Enjoy! 
            </p>
            <img src='../images/SaintLucia.jpg' alt='A beautiful landscape of Saint Lucia' style='width:540px; height:400px'/>

</div>
        
        <h2>Background Colour Changer</h2>

        <div class="form-section">
            <p>Choose a background colour:</p>
            <button class="color-button" style="background-color: white;"><a href="?color=white">White</a></button><br>
            <button class="color-button" style="background-color: lightblue;"><a href="?color=lightblue">Light Blue</a></button><br>
            <button class="color-button" style="background-color: lightgreen;"><a href="?color=lightgreen">Light Green</a></button><br>
            <button class="color-button" style="background-color: orange;"><a href="?color=lightcoral">Light Coral</a></button><br>
            <button class="color-button" style="background-color: lightyellow;"><a href="?color=lightyellow">Light Yellow</a></button><br>
            <button class="color-button" style="background-color: pink;"><a href="?color=pink">Pink</a></button><br>
            <button class="color-button" style="background-color: aqua;"><a href="?color=teal">Teal</a></button><br>
            <button class="color-button" style="background-color: plum;"><a href="?color=purple">Purple</a></button><br>
            <button class="color-button" style="background-color: skyblue;"><a href="?color=darkblue">Dark Blue</a></button><br>
            <button class="color-button" style="background-color: lime;"><a href="?color=darkgreen">Dark Green</a></button><br>
        </div>

    <script>
        // Function to change the background color
        function changeBackgroundColor(color) {
            document.getElementById('pageBody').style.backgroundColor = color;
        }

        // Check if a color is selected and call the function to change the background color
        window.onload = function() {
            // Get the color from the URL parameter
            const urlParams = new URLSearchParams(window.location.search);
            const selectedColor = urlParams.get('color');

            // Update the background color if a color is selected
            if (selectedColor) {
                changeBackgroundColor(selectedColor);
            }
    };
    </script>

    </main>    
    <footer>
        <p>&copy; <?php echo date("Y"); ?> CourseSearch</p>
    </footer>

</body>
</html>
