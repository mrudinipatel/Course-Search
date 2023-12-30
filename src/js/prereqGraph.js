$(document).ready(async function () {
  const allCourses = await getAllCourses();
  //displays all courses with course code and course name
  function displayCourses(courses) {
    $("#course_dropdown").empty();
    courses.forEach(function (course) {
      $("#course_dropdown").append(
        '<option value="' +
          course.CourseID +
          '">' +
          course.CourseID +
          "</b> | " +
          course.CourseName +
          "</option>"
      );
    });
  }

  displayCourses(allCourses);

  $("#createGraph").on("click", async function () {
    $("#loader").show();
    $("#visualizationContainer").empty();

    let nodes = [];
    let edges = [];

    async function recursive(prereqs, parent) {
      // console.log(parent + " " + prereqs);

      // Base case, done recursing
      if (prereqs === "N/A" || prereqs == null) return; //if there are no prereqs or the end is reached
      const andConditions = prereqs.split("&"); //split the prereqs by the '&' character
      let orNodeCount = 0; //increment the OR ID

      for (let and of andConditions) {
        //for each of the conditions within the '&'
        const orConditions = and.split("|").map((curr) => curr.trim()); //split the prerequisites by the '|' symbol if applicable and trim any leading or trailing whitespace

        let currentOrNodeId = null;
        if (orConditions.length > 1 && parent) {
          //if there is an OR and ensure that it has a parent node (or else it creates an OR for every course)
          currentOrNodeId = `${parent}_OR${++orNodeCount}`; //creates a unique OR node id or else it would all map to the same one
          nodes.push({ id: currentOrNodeId, label: "OR", color: "#81CF84" }); //display the OR node in a different colour
          edges.push({ from: parent, to: currentOrNodeId, arrows: "to" }); //add an arrow to the OR node from the parent
        }

        for (let condition of orConditions) {
          //for each section in the split courses
          let courses = condition.split("^"); //split up the courses

          for (let course of courses) {
            //for each course
            let prereq = course.trim().replace(/^\(|\)$/g, ""); //remove the unneccessary characters used in parsing

            if (getCourseIdValidation(prereq)) {
              //if the course exists in the database
              const prereqAllData = await getCourseData(prereq); //gets the course data by calling the API
              if (prereqAllData == null) {
                //if it does not exist, return
                return;
              }

              const prereqData = prereqAllData["Prerequisites"];

              // create 'tooltip' with name of course & prereqs
              var titleElement = document.createElement("div");
              titleElement.classList = "node_div";
              titleElement.innerHTML = `
              <div class="node_div">
                <div class="node_top"><p class="node_p node_p_name">${prereqAllData[
                  "CourseName"
                ].replace(/['"]+/g, "")}</p><p class="node_p">${
                prereqAllData["Credit"]
              }</p></div>
                <p class="node_p"><b>Description: </b>${prereqAllData[
                  "Description"
                ].replace(
                  /['"]+/g,
                  ""
                )}</p><p class="node_p"><b>Prerequisites: </b>${prereqAllData[
                "UnParsedPrerequisites"
              ].replace(/['"]+/g, "")}</p></div>
              `;

              nodes.push({ id: prereq, label: prereq, title: titleElement }); //add the course node
              let edgeFrom = currentOrNodeId ? currentOrNodeId : parent; //if there is an OR node created for this case assign the edge to stem from it, else, from the parent node
              edges.push({ from: edgeFrom, to: prereq, arrows: "to" }); //add the edge
              await recursive(prereqData, prereq); //recursively call with the prereq evaluated as the new parent
            } else {
              console.log(prereq);
            }
          }
        }
      }
    }

    await recursive($("#course_dropdown").val());

    // nodes[nodes.findIndex((obj => obj.id === $("#course_dropdown").val()))].color = '#6E6EFD'; // highlight the selected course
    nodes[
      nodes.findIndex((obj) => obj.id === $("#course_dropdown").val())
    ].color = "#B68AE4"; // highlight the selected course
    nodes = new vis.DataSet(
      nodes.filter((v, i, a) => nodes.findIndex((v2) => v2.id === v.id) === i)
    );
    const uniqueEdges = [
      ...new Map(edges.map((e) => [e.from + "-" + e.to, e])).values(),
    ];

    $("#loader").hide();
    startNetwork({ nodes: nodes, edges: uniqueEdges });
  });

  // Even listener for search input
  $("#course_search").on("input", function () {
    const searchInput = $(this).val().toUpperCase();
    const filteredCourses = allCourses.filter((course) => {
      return (
        course.CourseID.toUpperCase().includes(searchInput) ||
        course.CourseName.toUpperCase().includes(searchInput)
      );
    });
    displayCourses(filteredCourses);

    // If empty, show all courses.
    if (searchInput === "") {
      // $("#Course > div").each(function () {
      $("#Course > div").each(function () {
        $(this).show();
      });
    } else {
      // Hide all courses first.
      $("#Course > div").each(function () {
        $(this).hide();
      });

      // Show all courses that include the search term in their course code.
      $("#Course input:dropdown[name=type]").each(function () {
        courseCode = $(this).val();
        if (
          course.courseID.includes(
            input.toUpperCase() ||
              course.CourseName.includes(input.toUpperCase())
          )
        ) {
          $(this).parent().show();
        }
      });
    }
  });
});

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

async function getCourseData(courseID) {
  //calls a get request
  // const res = await fetch("/api/course_id/" + courseID + "/prereq_only", {
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

// initializes vis graph
function startNetwork(data) {
  const container = $("#visualizationContainer")[0];
  options = {
    layout: {
      hierarchical: {
        direction: "UD",
        sortMethod: "directed",
      },
    },
    physics: {
      forceAtlas2Based: {
        springLength: 150,
        avoidOverlap: 1.5,
        damping: 1,
      },
      solver: "forceAtlas2Based",
    },
  };
  network = new vis.Network(container, data, options);
}

function getCourseIdValidation(courseID) {
  const parts = courseID.split("*");
  if (parts.length != 2) {
    return false;
  }
  if (!/^[A-Za-z]+$/.test(parts[0])) {
    return false;
  }
  if (!/^[0-9]+$/.test(parts[1])) {
    return false;
  }
  return true;
}
