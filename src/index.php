<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CourseSearch</title>
    <link rel="stylesheet" type="text/css" href="/styles/styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
</head>

<body>

    <?php include 'navbar.php'; ?>
    <section class="homepage-header">
        <div class="homepage-text">
            <h1>Welcome to CourseSearch!</h1>
            <p>Your one-stop shop for planning and visualizing your journey at the Univeristy of Guelph!</p>
            <a href="#services-offered" class="hero-btn">Learn More!</a>
        </div>
    </section>
    <section class="Services" id="services-offered">
        <h2> Services we Offer </h2>
        <p>Downloadable Excel Application, Prerequisite Mapper, Api interface, course searcher, grade calculator and more!</p>
        <div class="h_form even_space">
            <div class="service-column">
                <h3>Excel Application</h3>
                <p>Downloadable excel application with course data and functionality to suggest possible courses to take based on a user's course history.</p>
            </div>
            <div class="service-column">
                <h3>API</h3>
                <p>Our API provides access to courses so that you can easily find out more about them and what courses are available.</p>
            </div>
            <div class="service-column">
                <h3>Course Search</h3>
                <p>This is our CourseSearch GUI. It uses our PHP API and MySQL database which allows the users to search and filter potential courses based on their course history.</p>
            </div>
            <div class="service-column">
                <h3>Graph</h3>
                <p>This is our prerequisite visualizer. This allows you to visualize the path to taking a course using easy to follow graphs.</p>
            </div>
            <div class="service-column">
                <h3>Grade Calculator</h3>
                <p>Already in your courses? Use our grade calculator to figure out what percentages you need!</p>
            </div>
            <div class="service-column">
                <h3>Resources</h3>
                <p>Get in the know of helpful resources from our resources page!zx</p>
            </div>
        </div>
    </section>
    <footer>
        <p>&copy; 2023 CourseSearch</p>
    </footer>

</body>

</html>