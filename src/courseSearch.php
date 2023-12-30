<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CourseSearch</title>
    <link rel="stylesheet" type="text/css" href="/styles/styles.css">
    <link rel="stylesheet" type="text/css" href="/styles/courseSearch_styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/courseSearch.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="js/index.js"></script>
</head>

<body>
    <?php include 'navbar.php' ?>
    <header id="home_header">
        <div class="header_container">
            <h1>CourseSearch</h1>
            <p>Course Planner</p>
        </div>
    </header>
    <main class='courseSearch_main'>
        <!-- <div id="description"> </div> -->
        <section class="hero-section">
            <h2 class="hero-text">Course Search Form</h2>
        </section>
        <p>This is our CourseSearch GUI. It uses our PHP API and MySQL database.</p>
        <p>To start, search and select the courses you have taken using the first form.
            <br>After that, you can apply filters to the second form to search for courses that you can take.<br>Click "Search" after you're done and the results will be displayed below the forms, along with the total number of credits you've taken.
        </p>
        <br>
        <div class="form vertical even_space">
            <div class="vertical even_space">
                <h3 style="margin: 0;">Courses taken</h3>
                </br>
                <label class="input-label" for="courseSearch_Searchtaken">Search Course List:</label>
                <input class="input-field" type="text" id="courseSearch_Searchtaken"> </input>
                </br>
                <fieldset id="takenCourse">
                    <legend>Taken Courses:</legend>
                </fieldset>
            </div>

            <div class="horizontal">
                <input class="input-field" id="courseSearch_includeNA" type="checkbox" name="type" />
                <label class="input-label" for="courseSearch_includeNA">
                    Include courses that have no prerequisites
                </label>
            </div>
        </div>

        <br><br>

        <div class="form vertical even_space">
            <div class="filters_section">
                <h3 style="margin: 0;">Filters</h3>
                <div class="vertical even_space">
                    <div class="vertical">
                        <label class="input-label" for="courseSearch_subjects">Subject:</label>
                        <select id="courseSearch_subjects">
                            <option value="any">Any</option>
                        </select>
                    </div>
                    <div class="vertical">
                        <label class="input-label" for="courseSearch_name">Name:</label>
                        <input class="input-field" type="text" id="courseSearch_name"> </input>
                    </div>
                    <div class="vertical">
                        <label class="input-label" for="courseSearch_semester">Semester:</label>
                        <select id="courseSearch_semester">
                            <option value="any">Any</option>
                            <option value="Fall">Fall</option>
                            <option value="Winter">Winter</option>
                            <option value="Summer">Summer</option>
                        </select>
                    </div>
                    <div class="vertical">
                        <label class="input-label" for="courseSearch_level">Level:</label>
                        <select id="courseSearch_level">
                            <option value="0">Any</option>
                            <option value="1">1000</option>
                            <option value="2">2000</option>
                            <option value="3">3000</option>
                            <option value="4">4000</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="horizontal submitButtons">
            <button id="submitTaken">SUBMIT</button>
            <button id="resetTaken">RESET</button>
        </div>


        <section class="hero-results">
            <h2 >Results</h2>
            <p style="font-size:1.3rem;" id="totalCredits">0.0 Credits</p>
        </section>

        <div>
            <form method="post" id="plannedCoursesForm" action="plannedCourses">
                <input class="input-field" type="hidden" name="PlannedList" id="plannedList" value="" />
                <input class="input-field" type="submit" name="View Planned Courses" id="submitPlanned" value="View Planned Courses" />
            </form>
        </div>
        <div id="results">
            <div id="courses">
            </div>
        </div>
    </main>
    <?php include 'footer.php' ?>
</body>

</html>