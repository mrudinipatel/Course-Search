# Course-Search

Course Search is a full-stack, team project that allows users to browse, search, plan, and visualize over 1900 courses offered at the University of Guelph (all campuses). This project was developed for CIS*3760 (Software Engineering), taught by Greg Klotz, in the Fall 2023 semester.

The 'Course Search' webpage makes use of our customized php API and MySQL database, allowing users to search and filter potential courses based on their course history. Users may perform the search by simply scrolling through the list of courses and checking off the box beside the course(s) they have already taken. We realize this may be exhaustive so we have also offered users the option to search for courses in the search bar for more ease. The filters include subject (i.e., department), course name, semester offered, or the level (i.e., 1000 for first year, 2000 for second year, etc). Users may select mulitple filters at a given time. Users are also able to add courses from the search results into a 'planned courses' list. Users can then choose to download this list onto their local computer.

The 'Excel' webpage offers the same search functionality in the form of an interactive Excel application. Upon downloading this Excel spreadsheet, users can enter the courses they have already taken (or are currently taking) and the VBA application will inform users which courses they are eligible to take in the future. This feature is offered for people who may prefer to view information in a more linear, concise, and clear manner.

In the 'Graph' webpage, users can enter the courses they are interested in taking and view the complete, dynamic graphical breakdown of the courses required to register for the interested course. This feature makes use of the vis.js library to render each course as a specific node in the graph visualizer. Users can hover their mouse over each node/course-code to view the course's full name, description, prerequisite(s), and credit value. The nodes/arrows are colour coded (logical operators such as 'OR' are green, course codes are blue, and the interested course is purple) _and_ all nodes follow a heirarchical flow such that the interested course is located at the top of the heirarchy. Users can zoom in/out using their cursor and move the nodes in any direction they like for more clarity and interactiveness.

The 'API' webpage, provides users with additional information on our php API. This page serves as a documentation guide to all the possible requests one can make using our API. There are 8 possible requests and upon clicking one of them in the list at the top of the webpage, the user will be guided to a section of the webpage that allows them to test out that specific request.

In the 'Grade Calculator' webpage, users can determine their current grade average in a particular course _or_ the grades needed to acheive a certain average.

The 'About Me' webpage offers a brief introduction to each of the 7 members of our team. Users may click on the each team member's personal page to learn more about each individual.

Lastly, the 'Resources' webpage provides additional course selection related resources such as the university's own undergraduate calender, course catalog (different from ours), WebAdvisor (university's own course registration and tuition payment site), academic advising, and CourseLink (site where class material is posted for courses you are registered for).

To summarize, this project was created using the following languages/frameworks:
* Microsoft Excel VBA
* HTML/CSS
* php
* JavaScript
* MySQL
* vis.js
* NGINX (school servers)
* Docker

There is a good chance the website is no longer up and running when you click the link, as it is taken off the school servers every semester, so here is a video demo of it:

