<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CourseSearch</title>
    <link rel="stylesheet" type="text/css" href="/styles/calculator.css">
    <link rel="stylesheet" type="text/css" href="/styles/styles.css">
    <link rel="stylesheet" type="text/css" href="/styles/courseSearch_styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="js/gradeCalculator.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
</head>

<body>
    <?php include 'navbar.php' ?>
    <header id="home_header">
        <div class="header_container">
            <h1>Grade Calculator</h1>
        </div>
    </header>

    <main class='courseSearch_main'>
        <form id="gradeCalculatorForm">
            <div class="form vertical even_space">
                <div class="vertical even_space">
                    <table id="gradeInputs">
                        <tr>
                            <th>Assignment (optional)</th>
                            <th>Grade (%)</th>
                            <th>Weight (%)</th>
                        </tr>
                        <tr class="gradeInputRow">
                            <td><input type="text" name="name" class="form-input input-field" autocomplete="on" placeholder="Assignment name"></td>
                            <td><input type="number" name="grade" class="form-input input-field" placeholder="Enter grade" min="0" step="0.01"></td>
                            <td><input type="number" name="weight" class="form-input input-field" placeholder="Enter weight" min="0" step="0.01"></td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        </tr>
                    </table>

                    <div class="button-group">
                        <br><br><br><button type="button" onclick="addRow()">Add Row</button><br>
                    </div>

                    <div class="button-group">
                        <h4>Calculate the additional grade required to achieve an average of: &nbsp;</h4>
                        <input type="number" class="form-input input-field" id="targetGradeInput" placeholder="%" min="0" step="0.01"><br>
                    </div>

                    <div class="button-group">
                        <button type="submit">Calculate</button>
                        <button type="reset">Reset</button>
                    </div>

                    <div class="grade-info">
                        <h4>Average Grade:</h4>
                        <p class="grade-display"></p>
                        <h4>Additional Grade Required:</h4>
                        <p class="grade-display"></p>
                    </div>
                </div>
            </div>
            <div id="result">
            </div>
        </form>
    </main>
    <?php include 'footer.php' ?>
</body>

</html>