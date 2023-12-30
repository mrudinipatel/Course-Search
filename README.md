# Course-Search
Website URL: https://cis3760f23-09.socs.uoguelph.ca/

Course Search is a full-stack, team project that allows users to browse, search, plan, and visualize over 1900 courses offered at the University of Guelph (all campuses). This project was developed for CIS*3760 (Software Engineering), taught by Greg Klotz, in the Fall 2023 semester.
### Project
Course Search is a full-stack, team project that allows users to browse, search, plan, and visualize over 1900 courses offered at the University of Guelph (all campuses). This project was developed for CIS*3760 (Software Engineering), taught by Greg Klotz, in the Fall 2023 semester. This web application is responsive across all screensizes and offers users both light/dark-mode view. 

### Components
The 'Course Search' webpage makes use of our customized php API and MySQL database, allowing users to search and filter potential courses based on their course history. Users may perform the search by simply scrolling through the list of courses and checking off the box beside the course(s) they have already taken. We realize this may be exhaustive so we have also offered users the option to search for courses in the search bar for more ease. The filters include subject (i.e., department), course name, semester offered, or the level (i.e., 1000 for first year, 2000 for second year, etc). Users may select mulitple filters at a given time. Users are also able to add courses from the search results into a 'planned courses' list. Users can then choose to download this list onto their local computer.

The 'Excel' webpage offers the same search functionality in the form of an interactive Excel application. Upon downloading this Excel spreadsheet, users can enter the courses they have already taken (or are currently taking) and the VBA application will inform users which courses they are eligible to take in the future. This feature is offered for people who may prefer to view information in a more linear, concise, and clear manner.
@@ -17,15 +19,49 @@ The 'About Me' webpage offers a brief introduction to each of the 7 members of o

Lastly, the 'Resources' webpage provides additional course selection related resources such as the university's own undergraduate calender, course catalog (different from ours), WebAdvisor (university's own course registration and tuition payment site), academic advising, and CourseLink (site where class material is posted for courses you are registered for).

### Compilation Commands
1. [Install Docker Desktop.](https://www.docker.com/products/docker-desktop/) and clone this git repository onto your local pc.
2. Open the Docker Desktop app and set up as shown on Docker's webpage. You do not need to sign up for an account as this is optional. Just make sure no containers are running. If any are, please stop/shut down the container(s).
3. Open a Terminal window and while standing inside the cloned repo (directory with the docker-compose.yml file), run: ```git pull```, then: ```docker compose build```, and finally: ```docker-compose up -d```. Now the server/container will be running in the background and accessible on localhost.
4. To access the MySQL instance that is on the school VM, on a separate Terminal window, run: ```ssh -o StrictHostKeyChecking=no -L 3307:localhost:3306 socs@cis3760f23-09.socs.uoguelph.ca```. To run this, you must be connect to the school's VPN (using Cisco AnyConnect Secure Mobility Client). After running this command, you will be prompted for the school VM's password. If you are a UoGuelph staff/student, you will know this password.
5. Leave this ssh Terminal window running to stay connected. If you wish to access MySQL from Docker (in php code), use this address: ```host.docker.internal:3307 (user:cis3760, password:pass1234, db name: CourseSearch)```.
6. Now when you open the Docker Desktop app again, you can click the 'open' button with the VS Code logo next to it. This will open a VS Code window that allows you to locally develop your code and push it onto the VM (using git add/commit/push).
7. Please remember to ```git pull``` before adding, committing, and/or pushing to merge any versions of changes made to the project. This will help avoid overwriting code.
8. Now, you can view your local changes to the Course Search web application using localhost on a browser of choice (e.g., 'http://localhost/api/available/ACCT*1220' or just 'localhost')
9. Once you're done developing, you can stop the container using the Docker Desktop app and exit the terminal/ssh.
10. In case of any NGINX configuration changes or unknown issues with the Docker container try rebuilding the Docker container (step 3).

### Deploying on VM Using Linux SCP
1. SSH onto the school's VM first and delete everything in the ```/var/www/html/``` directory (you can quit the Teriminal after this).
2. While in this project directory, run: ```scp -r ./src/* socs@cis3760f23-09.socs.uoguelph.ca:/var/www/html/```.
3. SSH to the VM again and go to: ```https://cis3760f23-09.socs.uoguelph.ca/``` to confirm it loads successfully.

### Video Demonstration
There is a good chance the website is no longer up and running when you click the link, as it is taken off the school servers every semester, so here is a video demo of it:

https://github.com/mrudinipatel/Course-Search/assets/68040676/0540fe7b-fd24-4fc1-9b8e-f241456441a2

(I know. The video quality is horrible cus github only allows 10MB uploads lol)

### Tech Stack
To summarize, this project was created using the following languages/frameworks:
* Microsoft Excel VBA
* HTML/CSS
* php
* JavaScript
* MySQL
* vis.js
* NGINX (school servers)
* NGINX (school server)
* Docker

There is a good chance the website is no longer up and running when you click the link, as it is taken off the school servers every semester, so here is a video demo of it:
### Future Improvements
Currently, personal pages of each team member is only availble in light-mode. It may be worthwhile to modify these pages so dark-mode can be applied as well to make these webpages more consistent with the rest of the web application.

### Authors
Olivia Biancucci
Burak Duruk
Jennifer Lithgow 
Rashi Mathur
Mrudini Patel
Cavaari Taylor
Sarah Toll
