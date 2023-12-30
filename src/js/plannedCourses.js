function toggleCourse(event) {
  // If already visible then hide it and return
  if ($(event).next().is(":visible")) {
    $(event).next().hide();
    return;
  }
  $(event).next().show();
}

// https://stackoverflow.com/questions/13405129/create-and-save-a-file-with-javascript
// Function to download data to a file
function download(course_data) {
  filename = "plannedCourseList.txt";
  processed_data = process_courses(course_data);
  console.log(processed_data);
  var file = new Blob([processed_data], { type: "text/plain" });
  if (window.navigator.msSaveOrOpenBlob) {
    // IE10+
    window.navigator.msSaveOrOpenBlob(file, filename);
  } else {
    // Others
    var a = document.createElement("a"),
      url = URL.createObjectURL(file);
    a.href = url;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    setTimeout(function () {
      document.body.removeChild(a);
      window.URL.revokeObjectURL(url);
    }, 0);
  }
}

function process_courses(course_data) {
  str_all_courses = "";
  course_data.forEach((course) => {
    str_course = "";
    str_course +=
      "Course ID: " +
      course.CourseID +
      "\nCourse Name: " +
      course.CourseName +
      "\nPrerequisites: " +
      course.UnParsedPrerequisites +
      "\nRestrictions: " +
      course.Restrictions +
      "\nSemester: " +
      course.Semester +
      "\nDescription: " +
      course.Description +
      "\nCredit: " +
      course.Credit +
      "\nDepartment: " +
      course.Department +
      "\nEquate: " +
      course.Equate;
    str_all_courses += str_course + "\n\n";
  });
  return str_all_courses;
}
