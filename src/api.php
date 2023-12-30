<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CourseSearch API</title>
    <link rel="stylesheet" type="text/css" href="/styles/styles.css">
    <link rel="stylesheet" type="text/css" href="/styles/api_styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
</head>

<body>

    <?php include 'navbar.php' ?>
    <header id="home_header">
        <div class="header_container">
            <h1>CourseSearch API</h1>
        </div>
    </header>
    <main>
        <div id="overview">
            <section class="hero-section">
                <h2 class="hero-text">Overview</h2>
            </section>
            <p>
                Our API provides access to courses so that you can easily find out more about them and what courses are available.
            </p>
            <p>
                You can also find documentation of <a href="https://gitlab.socs.uoguelph.ca/cis3760_f23/f23_cis3760_301/-/wikis/API" target="_blank">our API on the wiki</a>.
            </p>
            <h3>Available Requests:</h3>
            <ul class="requestList">
                <li><a href="#get_indv">GET: Individual Course</a></li>
                <li><a href="#get_prereq_only">GET: Individual Course, Prerequisite Only</a></li>
                <li><a href="#get_all">GET: Available Courses</a></li>
                <li><a href="#post">POST: Create a Course</a></li>
                <li><a href="#put">PUT: Update a Course</a></li>
                <li><a href="#delete">DELETE: Remove a Course</a></li>
                <li><a href="#search_subject">GET: Search for Courses by Subject</a></li>
                <li><a href="#search_name">GET: Search for Courses by Name</a></li>
            </ul>
        </div>
        </br>
        <div id="get_indv" class="request">
            <section class="hero-section">
                <h2 class="hero-text">GET: Individual Course</h2>
            </section>
            <p>
                A basic request you can view on your browser is our GET request for an individual course. It lists all information about the course if it is found in the database.
            </p>

            <h3>Request Format</h3>
            <p>
                <code class="uri">https://cis3760f23-09.socs.uoguelph.ca/api/course_id/[Course ID]</code>
            </p>
            <p>
                The Course ID would be the combination of subject and number for a given course, for example CIS*3760 or ENGL*1080.
            </p>
            </br>
            <!-- integrating into site - allow user to enter a course id to call it -->
            <h3>Try it yourself here</h3>
            <form action="/api/course.php" method="get" class="api-form">
                <label class="formtext form-text" for="get_by_id_input">Enter CourseID:</label>
                <input type="text" name="course_id" class="input-field" id="get_by_id_input">
                <input type="submit" name="submit" value="Submit" class="submit-button" id="get_by_id">
            </form>
            <br />
            <h3>Response Format</h3>
            <h4>Success</h4>
            <p>
                Here is an example of a <a href="https://cis3760f23-09.socs.uoguelph.ca/api/course_id/CIS*3760" target="_blank">GET request for CIS*3760</a>. Note that the following example does not contain the entire <code class="json">Description</code> of the response.
            </p>
            <pre data-canonical-lang="JSON" class="json">
<code>{
    "message": "Course found.",
    "course_data": {
        "CourseID": "CIS*3760",
        "CourseName": "Software Engineering",
        "Description": "This course is an examination of the software engineering 
                        process, the production of reliable systems and techniques 
                        for the design and  development of complex software. Topics
                        include  object-oriented analysis, design and modeling,
                        software architectures, software reviews, software quality,
                        software engineering, ethics,  maintenance and formal 
                        specifications.",
        "Credit": 0.75,
        "Department": "School of Computer Science",
        "Prerequisites": "CIS*2750, CIS*3750",
        "Restrictions": "N/A",
        "Equate": "N/A",
        "UnParsedPrerequisites": "CIS*2750, CIS*3750",
        "Semester": "Fall"
    },
    "success": true
}</code></pre>

            <h4>Failure</h4>
            <p>
                When the given course cannot be found in the database, the following response is provided:
            </p>
            <pre data-canonical-lang="JSON" class="json">
<code>{
  "message": "Course not found.",
  "success": false
}</code></pre>
        </div>

        <div id="get_prereq_only" class="request">
            <section class="hero-section">
                <h2 class="hero-text">GET: Individual Course, Prerequisites Only</h2>
            </section>
            <p>
                This GET request lists only the ID and prerequisite(s) of the requested course if it is found in the database.
            </p>
            <h3>Request Format</h3>
            <p>
                <code class="uri">https://cis3760f23-09.socs.uoguelph.ca/api/course_id/[Course ID]/prereq_only</code>
            </p>
            <p>
                The Course ID would be the combination of subject and number for a given course, for example CIS*3760 or ENGL*1080.
            </p>
            </br>
            <!-- integrating into site - allow user to enter a course id to call it -->
            <h3>Try it yourself here</h3>
            <form action="/api/course.php" method="get" class="api-form">
                <label class="formtext form-text" for="get_by_id_prereq_only_input">Enter Course ID:</label>
                <input type="text" name="course_id" class="input-field" id="get_by_id_prereq_only_input">
                <input type="hidden" name="prereq_only" value="true" />
                <input type="submit" name="submit" value="Submit" class="submit-button">
            </form>
            <br />
            <h3>Response Format</h3>
            <h4>Success</h4>
            <p>
                Here is an example of a <a href="https://cis3760f23-09.socs.uoguelph.ca/api/course_id/CIS*3760/prereq_only" target="_blank">GET request for CIS*3760's prerequisite(s)</a>.
            </p>
            <pre data-canonical-lang="JSON" class="json">
<code>{
  "message": "Course found.",
  "course_data": {
    "CourseID": "CIS*3760",
    "Prerequisites": "CIS*2750, CIS*3750"
  },
  "success": true
}</code></pre>

            <h4>Failure</h4>
            <p>
                When the given course cannot be found in the database, the following response is provided:
            </p>
            <pre data-canonical-lang="JSON" class="json">
<code>{
  "message": "Course not found.",
  "success": false
}</code></pre>
        </div>

        <div id="get_all" class="request">
            <section class="hero-section">
                <h2 class="hero-text">GET: Available Courses</h2>
            </section>
            <h3>Request Format</h3>
            <p>
                <code class="uri">https://cis3760f23-09.socs.uoguelph.ca/api/available</code>
            </p>
            <h4>Optional Parameters</h4>
            <p>
                After "taken" is a hyphen-separated list of course IDs that the user has taken (whether actual or hypothetical). The individual course IDs are to be in the specified format subject-asterisk-number as the example provides.<br /><br />
                In place of [Semester] is the current semester (Fall, Winter or Summer).
            </p>
            <p>
                Resulting URI: <code class="uri">https://cis3760f23-09.socs.uoguelph.ca/api/available/taken/[Course ID 1]-[Course ID 2]-[etc]/[Semester]</code>
            </p>
            <h3>Try it yourself here</h3>
            <form action="/api/available.php" method="get" class="api-form">
                <label class="formtext form-text" for="get_taken_courses_input">Enter Taken CourseIDs:</label>
                <input type="text" name="taken" class="input-field" id="get_taken_courses_input">
                <br />
                <label class="formtext form-text" for="semester_input">Enter Semester:</label>
                <input type="text" name="sem" class="input-field" id="semester_input">
                <br />
                <input type="submit" name="submit" value="Submit" class="submit-button">
            </form>

            <h3>Response Format</h3>
            <h4>Success</h4>
            <p>
                The following is a result of a <a href="https://cis3760f23-09.socs.uoguelph.ca/api/available/taken/CIS*1500-ENGL*1080" target="_blank">GET request where CIS*1500 and ENGL*1080 were listed as 'taken'</a>. Note that the provided response sample does not contain all courses returned.
            </p>
            <pre data-canonical-lang="JSON" class="json"><code>{
  "courses": [
    {
      "CourseID": "ACCT*1220",
      "Prerequisites": "N/A",
      "Semester": "Summer",
      "Restrictions": "ACCT*2220. This is...",
      "Equate": "N/A"
    },
    {
      "CourseID": "AGR*1110",
      "Prerequisites": "N/A",
      "Semester": "Fall",
      "Restrictions": "AGR*1100. AGR*1250. Restricted to...",
      "Equate": "N/A"
    },
    {
      "CourseID": "ANSC*3120",
      "Prerequisites": "N/A",
      "Semester": "Fall",
      "Restrictions": "Registration in BSC(Agr) or  BSC.ABIO.",
      "Equate": "N/A"
    },
        .........
    ],
    "success": true
}</code></pre>
            <h4>Failure</h4>
            <p>
                Should not fail. If you don't enter any parameters, it would just return all courses without prerequisites.</p>
        </div>

        <div id="post" class="request">
            <section class="hero-section">
                <h2 class="hero-text">POST: Create a Course</h2>
            </section>
            <p>
                Insert a course into the database. Only the course ID, course name, and credit values are required. The rest is optional.
            </p>
            <h3>Request Format</h3>
            <p>
                Send a <code class="json">POST</code> request to <code class="uri">https://cis3760f23-09.socs.uoguelph.ca/api/create</code> with the body:
            </p>
            <p>
                This request requires basic authorization, which uses a username and password for validation/authentication.
            </p>
            <pre data-canonical-lang="JSON" class="json"><code>{
    "course_id": "[Course ID]",
    "course_name": "[Course Name]",
    "credit":"[Credit Weight]",
    "semesters": "[Course Available Semester(s)]",
    // Below are optional
    "description": "[Course Description]",
    "department": "[Course Department]",
    "prerequisites": "[Course Prerequisites]",
    "restrictions": "[Course Restrictions]",
    "equate": "[Course Equate]"
}</code></pre>
            <h3>Try it yourself here</h3>
            <div class="post-req vertical">
                <div class="h_form">
                    <div class="v_form">
                        <label class="formtext form-text" for="course_id">Course ID:</label>
                        <input type="text" id="course_id" class="input-field">
                    </div>
                    <div class="v_form">
                        <label class="formtext form-text" for="course_name">Course Name:</label>
                        <input type="text" id="course_name" class="input-field">
                    </div>
                    <div class="v_form">
                        <label class="formtext form-text" for="credit">Credit Weight:</label>
                        <input type="text" id="credit" class="input-field">
                    </div>
                </div>
                <div class="h_form">
                    <div class="v_form">
                        <label class="formtext form-text" for="description">Course Description:</label>
                        <input type="text" id="description" class="input-field">
                    </div>
                    <div class="v_form">
                        <label class="formtext form-text" for="department">Course Department:</label>
                        <input type="text" id="department" class="input-field">
                    </div>
                    <div class="v_form">
                        <label class="formtext form-text" for="prerequisites">Course Prerequisites:</label>
                        <input type="text" id="prerequisites" class="input-field">
                    </div>
                </div>
                <div class="h_form">
                    <div class="v_form">
                        <label class="formtext form-text" for="restrictions">Course Restrictions:</label>
                        <input type="text" id="restrictions" class="input-field">
                    </div>
                    <div class="v_form">
                        <label class="formtext form-text" for="equate">Course Equate:</label>
                        <input type="text" id="equate" class="input-field">
                    </div>
                    <div class="v_form">
                        <label class="formtext form-text" for="semesters">Course Semester:</label>
                        <input type="text" id="semesters" class="input-field">
                    </div>
                </div>
                <div class="h_form">
                    <div class="v_form">
                        <label class="formtext form-text" for="post_uname">Username:</label>
                        <input type="text" id="post_uname" class="input-field">
                    </div>
                    <div class="v_form">
                        <label class="formtext form-text" for="post_pass">Password:</label>
                        <input type="password" id="post_pass" class="input-field">
                    </div>
                </div>
                <div>
                    <button onclick="postRequest()" type="button" id="post_button" class="submit-button">
                        Submit
                    </button>
                </div>
            </div>
            <p id="post_result" style="font-weight: bolder;color:red"></p>
            <script>
                function postRequest() {
                    fetch("/api/course.php", {
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                "Authorization": `Basic ${btoa(`${document.getElementById("post_uname").value}:${document.getElementById("post_pass").value}`)}`
                            },
                            method: "POST",
                            body: JSON.stringify({
                                course_id: document.getElementById("course_id").value,
                                course_name: document.getElementById("course_name").value,
                                credit: document.getElementById("credit").value,
                                description: document.getElementById("description").value,
                                department: document.getElementById("department").value,
                                prerequisites: document.getElementById("prerequisites").value,
                                restrictions: document.getElementById("restrictions").value,
                                equate: document.getElementById("equate").value,
                                semesters: document.getElementById("semesters").value,
                            })
                        })
                        .then(function(res) {
                            return res.json()
                        }).then(function(data) {
                            document.getElementById("post_result").innerHTML = data.message;
                            if (data.success === true) {
                                document.getElementById("post_result").style.color = "green";
                            } else {
                                document.getElementById("post_result").style.color = "red";
                            }
                        })
                }
            </script>
            <h3>Response Format</h3>
            <h4>Success</h4>
            <p>
                A possible course to create could be
            </p>
            <pre data-canonical-lang="JSON" class="json"><code>{
    "course_id": "EXA*8080",
    "course_name": "Example Course Name",
    "credit":"0.75",
    "semesters": "Fall and Winter",
}</code></pre>
            <p>
                If the course is successfully created, you will receive the response:
            </p>
            <pre data-canonical-lang="JSON" class="json"><code>{
    "message": "Course created",
    "added_rows": {
        "offering_rows": 1,
        "course_rows": 1
    },
    "success": true
}</code></pre>
            <p>
                The response will have the same format for any given course created with valid data.
            </p>
            <h4>Failure</h4>
            <p>
                If the data provided in the body is invalid or missing, you will receive the response:
            </p>
            <div data-canonical-lang="JSON" class="json">
                <code>
                    {</br>
                    &emsp;&emsp;&emsp; "message": "Please provide the required parameters: course_id, course_name, and credit.", "success": false</br>
                    }
                </code>
            </div>
        </div>

        <div id="put" class="request">
            <section class="hero-section">
                <h2 class="hero-text">PUT: Update a Course</h2>
            </section>
            <p>
                Update a course in the database. Only the course ID, course name, and credit values can be updated.
            </p>
            <h3>Request Format</h3>
            <p>
                Send a <code class="json">PUT</code> request to <code class="uri">https://cis3760f23-09.socs.uoguelph.ca/api/update</code> with the body:
            </p>
            <p>
                This request requires basic authorization, which uses a username and password for validation/authentication.
            </p>
            <pre data-canonical-lang="JSON" class="json"><code>{
    "course_id": [Course ID],
    "update": {
        "course_name": "[Course Name]",
        "description": "[Description]",
        "credit": [Credit]
    }
}</code></pre>
            <h3>Try it yourself here</h3>
            <div class="put-req v_form">
                <div class="h_form">
                    <div class="v_form">
                        <label for="put_course_id" class="form-text">Course ID:</label>
                        <input type="text" id="put_course_id" class="input-field">
                    </div>
                    <div class="v_form">
                        <label for="put_course_name" class="form-text">Course Name:</label>
                        <input type="text" id="put_course_name" class="input-field">
                    </div>
                </div>
                <div class="h_form">
                    <div class="v_form">
                        <label for="put_description" class="form-text">Course Description:</label>
                        <input type="text" id="put_description" class="input-field">
                    </div>
                    <div class="v_form">
                        <label for="put_credit" class="form-text">Credit:</label>
                        <input type="text" id="put_credit" class="input-field">
                    </div>
                </div>
                <div class="h_form">
                    <div class="v_form">
                        <label for="put_uname" class="form-text">Username:</label>
                        <input type="text" id="put_uname" class="input-field">
                    </div>
                    <div class="v_form">
                        <label for="put_pass" class="form-text">Password:</label>
                        <input type="password" id="put_pass" class="input-field">
                    </div>
                </div>
                <div>
                    <button onclick="putRequest()" type="button" id="put_button" class="submit-button">Submit</button>
                </div>
            </div>
            <p id="put_result" style="font-weight: bolder;color:red"></p>
            <script>
                function putRequest() {
                    fetch("/api/course.php", {
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                "Authorization": `Basic ${btoa(`${document.getElementById("put_uname").value}:${document.getElementById("put_pass").value}`)}`
                            },
                            method: "PUT",
                            body: JSON.stringify({
                                course_id: document.getElementById("put_course_id").value,
                                update: {
                                    course_name: document.getElementById("put_course_name").value,
                                    description: document.getElementById("put_description").value,
                                    credit: document.getElementById("put_credit").value
                                }
                            })
                        })
                        .then(function(res) {
                            return res.json()
                        }).then(function(data) {
                            document.getElementById("put_result").innerHTML = data.message + '<br/>' + (data.changes ? data.changes.map(function(e) {
                                return Object.values(e)[0] + '<br/>'
                            }) : '');
                            if (data.success === true) {
                                document.getElementById("put_result").style.color = "green";
                            } else {
                                document.getElementById("put_result").style.color = "red";
                            }
                        })
                }
            </script>
            <br />
            <h3>Response Format</h3>
            <h4>Success</h4>
            <p>
                A possible course to update could be
            </p>
            <pre data-canonical-lang="JSON" class="json"><code>{
    "course_id": "TEST*4003",
    "update": {
        "course_name": "Test Name",
        "description": "Test Description",
        "credit": 0.5
    }
}</code></pre>
            <p>
                If the course is successfully updated, you will receive the response:
            </p>
            <pre data-canonical-lang="JSON" class="json"><code>{
    "message": "Updated course.",
    "changes": [
        {
            "course_name": "Course name updated to 'Test Name' from 'hello'."
        },
        {
            "description": "Course description updated to 'Test Description' from ''."
        },
        {
            "credit": "Credit weight updated to 0.5 from '0.75'."
        }
    ],
    "success": true
}</code></pre>
            <p>
                The response will have the same format for any given course created with valid data.
            </p>
            <h4>Failure</h4>
            <p>
                If the data provided in the body is invalid or missing, you will receive the response:
            </p>
            <pre data-canonical-lang="JSON" class="json"><code>{
&emsp;&emsp;&emsp; "message": "Unable to update course.",
    "success": false
}</code></pre>
        </div>

        <div id="delete" class="request">
            <section class="hero-section">
                <h2 class="hero-text">DELETE: Remove a Course</h2>
            </section>
            <p>
                Remove a course from the database.
            </p>
            <h3>Request Format</h3>
            <p>
                Send a <code class="json">DELETE</code> request to <code class="uri">https://cis3760f23-09.socs.uoguelph.ca/api/delete</code> with the body:
            </p>
            <p>
                This request requires basic authorization, which uses a username and password for validation/authentication.
            </p>
            <pre data-canonical-lang="JSON" class="json"><code>{
    "course_id": "[Course ID]"
}</code></pre>
            <h3>Try it yourself here</h3>
            <div class="delete-req vertical">
                <label for="delete_course_id" class="form-text">Course ID:</label>
                <input type="text" id="delete_course_id" class="input-field">
                <div class="h_form">
                    <div class="v_form">
                        <label for="delete_uname" class="form-text">Username:</label>
                        <input type="text" id="delete_uname" class="input-field">
                    </div>
                    <div class="v_form">
                        <label for="delete_pass" class="form-text">Password:</label>
                        <input type="password" id="delete_pass" class="input-field">
                    </div>
                </div>
            </div>
            <div>
                <button onclick="deleteRequest()" type="button" id="delete_button" class="submit-button">
                    Submit
                </button>
            </div>
            <p id="delete_result" style="font-weight: bolder;color:red"></p>
            <script>
                function deleteRequest() {
                    fetch("/api/course.php", {
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                "Authorization": `Basic ${btoa(`${document.getElementById("delete_uname").value}:${document.getElementById("delete_pass").value}`)}`
                            },
                            method: "DELETE",
                            body: JSON.stringify({
                                course_id: document.getElementById("delete_course_id").value
                            })
                        })
                        .then(function(res) {
                            return res.json()
                        }).then(function(data) {
                            document.getElementById("delete_result").innerHTML = data.message;
                            if (data.success === true) {
                                document.getElementById("delete_result").style.color = "green";
                            } else {
                                document.getElementById("delete_result").style.color = "red";
                            }
                        })
                }
            </script>

            <h3>Response Format</h3>
            <h4>Success</h4>
            <p>
                When deleting a course, such as:
            </p>
            <pre data-canonical-lang="JSON" class="json"><code>{
    "course_id": "EXA*8080"
}</code></pre>
            <p>
                If the course is successfully deleted, you will receive the response:
            </p>
            <pre data-canonical-lang="JSON" class="json"><code>{
    "message": "Course EXA*8080 deleted.",
    "rows": 1,
    "success": true
}</code></pre>
            <h4>Failure</h4>
            <p>
                If the data provided in the body is invalid or missing, you will receive the response:
            </p>
            <pre data-canonical-lang="JSON" class="json"><code>{
    "message": "Course not found",
    "rows": {
        "offering_rows": 0,
        "course_rows": 0
    },
    "success": false
}</code></pre>
        </div>

        <div id="search_subject" class="request">
            <section class="hero-section">
                <h2 class="hero-text">GET: Search for Courses by Subject</h2>
            </section>
            <p>
                This request will return a list of courses that match the given subject (e.g. `CIS`, `ENGL`).
            </p>

            <h3>Request Format</h3>
            <p>
                <code class="uri">https://cis3760f23-09.socs.uoguelph.ca/api/subject/[Subject]</code>
            </p>
            <p>
                The subject parameter is case insensitive and only accepts alphabetical characters.
            </p>
            <h3>Try it yourself here</h3>
            <form action="/api/course.php" method="get" class="api-form">
                <label class="formtext form-text" for="get_by_subject">Enter subject:</label>
                <input type="text" name="subject" class="input-field" id="get_by_subject">
                <input type="submit" name="submit" value="Submit" class="submit-button">
            </form>

            <br />
            <h3>Response Format</h3>
            <h4>Success</h4>
            <p>
                This example uses a <a href="https://cis3760f23-09.socs.uoguelph.ca/api/subject/CIS" target="_blank">GET request for the subject "CIS"</a>. Note that the following example does not contain the entire response.
            </p>
            <pre data-canonical-lang="JSON" class="json"><code>{
    "message": "Course(s) found.",
    "course_data": [
        {
            "CourseID": "CIS*1050",
            "CourseName": "Web Design and Development",
            "Description": "\"An introduction to...",
            "Credit": 0.5,
            "Department": "School of Computer Science",
            "Prerequisites": "N/A\r",
            "Restrictions": "N/A",
            "Equate": "N/A",
        },
        {
            "CourseID": "CIS*1200",
            "CourseName": "Introduction to Computing",
            "Description": "\"This course covers...",
            "Credit": 0.5,
            "Department": "School of  Computer Science",
            "Prerequisites": "N/A\r",
            "Restrictions": "CIS*1000. Not  available to...",
            "Equate": "N/A",
        },
        .....
        ],
    "success": true
}</code></pre>
            <h4>Failure</h4>
            <pre data-canonical-lang="JSON" class="json">
<code>{
    "message": "No courses found.",
    "success": false
}</code></pre>
        </div>

        <div id="search_name" class="request">
            <section class="hero-section">
                <h2 class="hero-text">GET: Search for Courses by Name</h2>
            </section>
            <p>
                This request will return a list of courses that contain the given string in their name.
            </p>

            <h3>Request Format</h3>
            <p>
                <code class="uri">https://cis3760f23-09.socs.uoguelph.ca/api/course_name/[Name]</code>
            </p>
            <p>
                The name parameter is case insensitive and only accepts alphabetical characters.
            </p>
            <h3>Try it yourself here</h3>
            <form action="/api/course.php" method="get">
                <label class="input-label" class="formtext form-text" for="get_by_name_input">Enter Course Name (full or partial):</label>
                <input class="input-field" type="text" name="course_name" id="get_by_name_input">
                <input type="submit" name="submit" value="Submit" class="submit-button">
            </form>

            <br />
            <h3>Response Format</h3>
            <h4>Success</h4>
            <p>
                This example uses a <a href="https://cis3760f23-09.socs.uoguelph.ca/api/course_name/Software" target="_blank">GET request for the string "Software"</a>. Note that the following example does not contain the entire response.
            </p>
            <pre data-canonical-lang="JSON" class="json"><code>{
    "message": "Course(s) found.",
    "course_data": [
        {
            "CourseID": "CIS*1250",
            "CourseName": "Software Design I",
            "Description": "\"This is an introductory course ...",
            "Credit": 0.5,
            "Department": "School of Computer Science",
            "Prerequisites": "N/A\r",
            "Restrictions": "Restricted to ...",
            "Equate": "N/A",
            "UnParsedPrerequisites": "N/A"
        },
        {
            "CourseID": "CIS*2250",
            "CourseName": "Software Design II",
            "Description": "\"This course focuses on ...",
            "Credit": 0.5,
            "Department": "School of Computer  Science",
            "Prerequisites": "CIS*1250^&^CIS*1300\r",
            "Restrictions": "Restricted to BCOMP.SENG  majors.",
            "Equate": "N/A",
            "UnParsedPrerequisites": "\"CIS*1250, CIS*1300\""
        },
        ............
    ],
    "success": true
}</code></pre>
            <h4>Failure</h4>
            <p>
                This example uses a <a href="https://cis3760f23-09.socs.uoguelph.ca/api/course_name/Softwareee" target="_blank">GET request for the string "Softwareee"</a>.
            </p>
            <pre data-canonical-lang="JSON" class="json">
<code>{
    "message": "No course found matching 'Softwareee'",
    "success": false
}</code></pre>
        </div>

    </main>

    <?php include 'footer.php' ?>

</body>

</html>