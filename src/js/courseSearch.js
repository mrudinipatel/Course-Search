let plannedCourses = [];

$(document).ready(async function () {
  const allCourses = await getAllCourses();
  // Displays all courses with course code and course name
  allCourses.forEach(function (course) {
    $("#takenCourse").append(
      '<div><label for="' +
        course.CourseID +
        '_checkbox"><b>' +
        course.CourseID +
        "</b> | " +
        course.CourseName +
        '</label><input type="checkbox" name="type" value="' +
        course.CourseID +
        '" id="' +
        course.CourseID +
        '_checkbox"/></div>'
    );
  });

  // Displays all subjects in the subject dropdown
  const allSubjects = [
    ...new Set(
      allCourses.map((course) => {
        return course.CourseID.substring(0, course.CourseID.indexOf("*"));
      })
    ),
  ];

  allSubjects.forEach(function (subject) {
    $("#courseSearch_subjects").append(
      '<option value="' + subject + '">' + subject + "</option>"
    );
  });

  // Event listener for the submit button.
  $("#submitTaken").on("click", async function () {
    console.log("submit form");
    const takenCourses = [];
    // Append every course code from the selected chekboxes to the taken courses array.
    $("#takenCourse input:checkbox[name=type]:checked").each(function () {
      takenCourses.push($(this).val());
    });

    // Get all the available courses and restricted courses.
    let availableCourses = await getAvailableCourses(
      takenCourses,
      $("#courseSearch_includeNA").is(":checked"),
      $("#courseSearch_semester").val()
    );
    console.log("available courses");
    console.log(availableCourses);

    // Extract credits from the result
    const credits = availableCourses.credits;
    availableCourses = availableCourses.result;

    //Filter by subject
    const selectedSubject = $("#courseSearch_subjects").val();
    if (selectedSubject !== "any") {
      //filters subjects selected
      availableCourses = filterBySubject(availableCourses, selectedSubject);
    }

    // Filter by course name
    const name = $("#courseSearch_name").val();
    if (name !== "") {
      //filters by courses that contain the name the user entered
      availableCourses = availableCourses.filter(function (e) {
        return e.CourseName.includes(name);
      });
    }

    // Filter by level
    const level = $("#courseSearch_level").find(":selected").val();
    if (level !== "0") {
      //filters by courses that have the same level as the user chose
      availableCourses = availableCourses.filter(function (e) {
        return level === e.CourseID[e.CourseID.indexOf("*") + 1];
      });
    }

    // Clean up the results first.
    $("#results > #courses").html("");
    $("#totalCredits").html(credits.toFixed(2) + " Credits");

    // filter out any potential duplicates of courses from the API response(https://www.javascripttutorial.net/array/javascript-remove-duplicates-from-array/)
    const uniqueAvailableCourses = [
      ...new Map(availableCourses.map((c) => [c.CourseID, c])).values(),
    ];
    console.log("unique available courses");
    console.log(uniqueAvailableCourses);

    // Show all the remaning courses (after filters) in the (unique)availableCourses array.
    uniqueAvailableCourses.forEach(function (course) {
      if (course.CourseID == null) return;
      // const buttonID = `addCourseButton_${course.CourseID.replace(/\s+/g, "")}`;
      // determine what the add/remove toggle should say when loading the list (based on what's in plannedCourses already)
      add_or_remove =
        typeof plannedCourses.find((c) => c.CourseID == course.CourseID) !==
        "undefined"
          ? "Remove"
          : "Add";
      $("#results > #courses").append(`
            <div class='courseCard'>
                <div class='horizontal'>
                    <button type="button" onclick="toggleCourse(this)" class="collapsible"><b>${course.CourseID}</b></button>
                    <button type="button" onclick="updatePlan(this)" class="add-to-plan-btn">${add_or_remove}</button>
                </div>
                <div style="display:none;" class="collapsible_content"></div>
            </div>`);
    });
  });

  //Event listener for the reset button
  $("#resetTaken").on("click", function () {
    console.log("reset form");
    // Deselect all courses
    $("#takenCourse input:checkbox[name=type]:checked").each(function () {
      $(this).prop("checked", false);
    });
    //Clears dropdown and resets to any
    $("#courseSearch_subjects").val("any");
    $("#courseSearch_semester").val("any");
    $("#courseSearch_level").val("0");
    $("#totalCredits").html("0.0 Credits");
    //Clears other filters and results
    $("#courseSearch_name").val("");
    $("#courseSearch_includeNA").prop("checked", false);
    $("#results > #courses").html("");
    plannedCourses = [];
    document.getElementById("plannedList").setAttribute("value", "");
  });

  // Even listener for search input
  $("#courseSearch_Searchtaken").on("input", function () {
    const input = $(this).val();

    // If empty, show all courses.
    if (input === "") {
      // $("#takenCourse > div").each(function () {
      $("#takenCourse > div").each(function () {
        $(this).show();
      });
    } else {
      // Hide all courses first.
      $("#takenCourse > div").each(function () {
        $(this).hide();
      });

      // Show all courses that include the search term in their course code.
      $("#takenCourse input:checkbox[name=type]").each(function () {
        courseCode = $(this).val();
        if (courseCode.includes(input.toUpperCase())) {
          $(this).parent().show();
        }
      });
    }
  });
});

// Opens and closes course that is clicked on,
async function toggleCourse(event) {
  // If already visible then hide it and return
  if ($(event).parent().next().is(":visible")) {
    $(event).parent().next().hide();
    return;
  }

  $(event).parent().next().show();

  // const content = $(event).parent().siblings(".courseSearch_content")[0];
  const content = $(event).parent().siblings(".collapsible_content")[0];
  // Call the API if it's not been called before
  if ($(content).is(":empty")) {
    const course = await getIndividualCourse($(event).text());
    content.innerHTML = `<p><b>Name:</b> ${course.CourseName}  </p>
    <p><b>Prerequisites:</b> ${course.UnParsedPrerequisites}</p>
    <p><b>Restrictions:</b> ${course.Restrictions}</p>
    <p><b>Semesters:</b> ${course.Semester}</p>
    <p><b>Description:</b> ${course.Description}</p>
    <p><b>Credit:</b> ${course.Credit}</p>
    <p><b>Department:</b> ${course.Department}</p>
    <p><b>Equate:</b> ${course.Equate}</p>`;
  }
}
//Returns all information of an individual course based off the course id
async function getIndividualCourse(courseID) {
  //calls a get request
  const res = await fetch("/api/course_id/" + courseID, {
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    method: "GET",
  });

  const data = await res.json();
  return data.course_data;
}

// Returns all the available courses based on taken courses
async function getAvailableCourses(takenCourses, isNA, semester) {
  console.log(takenCourses);
  console.log(isNA);
  console.log(semester);
  let result = [];
  let credits = 0;
  let queryString = "/";
  //add all courses taken to the query string
  takenCourses.forEach(function (courseID, i) {
    queryString += takenCourses.length - 1 === i ? courseID : courseID + "-";
  });
  console.log(queryString);

  //if taken isnt empty, call the api
  if (queryString !== "/") {
    if (semester !== "any") queryString += "/" + semester;
    const res = await fetch("/api/available" + queryString, {
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      method: "GET",
    });
    //return the data
    const data = await res.json();
    credits = data.credits;
    result = result.concat(data.courses);
  }

  // Get all the courses that have no prerequisites
  if (isNA === true) {
    console.log(".....................");
    queryString = "";
    if (semester !== "any") queryString += semester;
    const res = await fetch("/api/available/" + queryString, {
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      method: "GET",
    });

    const data = await res.json();
    result = result.concat(data.courses);
  }

  return { result, credits };
}

// Returns all the courses in the database
async function getAllCourses() {
  //uses wrapper to call api endpoint to get all courses
  const res = await fetch("/api/allCourses/", {
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    method: "GET",
  });

  const data = await res.json();

  return data.courses;
}

//returns courses which match selected filter
function filterBySubject(courses, selectedSubject) {
  if (selectedSubject === "any") {
    return courses; // If 'any' subject is selected, return all courses
  } else {
    // Filter courses that start with the selected subject
    let filteredCourses = courses.filter((course) =>
      course.CourseID.startsWith(selectedSubject)
    );

    return filteredCourses;
  }
}

async function updatePlan(event) {
  const courseID = $(event).prev().text();
  const find_course = plannedCourses.find(
    (course) => course.CourseID === courseID
  );
  // Check if the course is not already in the plannedCourses array
  if (typeof find_course === "undefined") {
    const course = await getIndividualCourse(courseID);
    // console.log($(event).parent().next());
    plannedCourses.push(course);
    console.log("Course added to plan: ", courseID);
    $(event).text("Remove");
  } else {
    console.log("Course removed from plan:", courseID);
    // https://www.delftstack.com/howto/javascript/javascript-remove-object-from-array/
    locn_rmv = plannedCourses.indexOf(find_course);
    plannedCourses.splice(locn_rmv, 1); // remove only the one course
    $(event).text("Add");
  }
  document
    .getElementById("plannedList")
    .setAttribute("value", JSON.stringify(plannedCourses));
}

// forward info & navigate to a new page

// // results section originally:
// $("#results > #courses").append(`
//             <div class='courseCard'>
// <button type="button" onclick="toggleCourse(this)" class="courseSearch_collapsible"><b>${
//   course.CourseID
// }</b></button>
//                 <div style="display:none;" class="courseSearch_content"></div>
//             </div>`);
