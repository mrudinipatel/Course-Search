<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graph of Prerequisites</title>
    <link rel="stylesheet" type="text/css" href="/styles/styles.css">
    <link rel="stylesheet" type="text/css" href="/styles/graph_styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis-network.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis-network.min.css">
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/prereqGraph.js"></script>
</head>

<body>
    <?php include 'navbar.php' ?>
    <header id="home_header">
        <div class="header_container">
            <h1>Graphing Area</h1>
        </div>
    </header>
    <main class='main'>
        <section class="hero-section">
            <h2 class="hero-text">Prerequisites Graph</h2>
        </section>
        <p>This is our prerequisite Graph GUI. It uses our PHP API, vis.js to render all prerequisites and MySQL database.</p>
        <p>To start, search the course you would like to find the prerequisites for and click "Create" after you're done
            and the results will be displayed below in the form.
        </p>
        <div class="form-section">
            <label for="course_search" class="input-label">Search for a course:</label>
            <input type="text" id="course_search" class="input-field" />
            <br />
            <label for="course_dropdown" class="input-label">Selected course:</label>
            <select id="course_dropdown"></select>
        </div>
        <button id="createGraph">CREATE</button>
        <div id="loader" style="display: none;padding-top:15px;"><svg width="38" height="38" viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg" stroke="black">
                <g fill="none" fill-rule="evenodd">
                    <g transform="translate(1 1)" stroke-width="2">
                        <circle stroke-opacity=".5" cx="18" cy="18" r="18"></circle>
                        <path d="M36 18c0-9.94-8.06-18-18-18">
                            <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="1s" repeatCount="indefinite"></animateTransform>
                        </path>
                    </g>
                </g>
            </svg></div>
        <div id="visualizationContainer" style="height: 590px;">
            <!-- <div id="courseGraph" style="height: 600px;"> -->
            <!-- Or try 100%? flexbox for centering? -->
        </div>
    </main>
    <?php include 'footer.php' ?>
</body>

</html>