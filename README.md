# Sprint 9: Improving Our Product

## Description

Our Group's Site: <https://cis3760f23-09.socs.uoguelph.ca/>

## How to run this server locally (Windows or MacOS)

1. [Install Docker Desktop.](https://www.docker.com/products/docker-desktop/)
2. Downloading/pull the contents of the repository to your own local project directory.
3. While in the project directory (the directory where docker-compose.yml file is), run `docker-compose up -d` (Make sure it's not already running).
4. The server/container will be running in the background and accessible on localhost.
5. If you want to access the MySQL instance that's on the VM, on a separate terminal window, run: `ssh -o StrictHostKeyChecking=no -L 3307:localhost:3306 socs@cis3760f23-09.socs.uoguelph.ca` (Make sure you're connected to the vpn).
6. Leave the terminal window running to stay connected. To access it from docker (in php code), use this address host.docker.internal:3307 (user:cis3760, password:pass1234, db name: CourseSearch).
7. Once you're done developing, you can stop the container using Docker's GUI Dashboard and exit the terminal/ssh.

### Rebuilding the server locally

In the case that NGINX configuration has been changed or there are unknown issues with the container, rebuilding may be an option.

1. Ensure the container is stopped/shut down first
2. Rebuild the container: `docker-compose build`
3. Start up the rebuilt container: `docker-compose up -d`

## Deploying on the VM

### Using Linux scp

1. SSH to the VM first and delete everything in the /var/www/html/ directory, you can quit the teriminal after this.
2. While in this project directory, run: `scp -r ./src/* socs@cis3760f23-09.socs.uoguelph.ca:/var/www/html/`
3. SSH to the VM.
4. Go to `https://cis3760f23-09.socs.uoguelph.ca/` to confirm it loads successfully.

## Roadmap (for Sprint 9)

- Review past sprints for areas of improvement
- Provide ideas for features we consider useful or helpful to students, as students
- Implement selected features/improvements
  - Update homepage
  - Update about pages
  - Refine Course Search/Update API (improved responses)
  - Update URIs ('prettier' for users to use)
  - Update Visualization
    - Hierarchy
    - Colours
  - Add Grade Calculator
  - Add Resources Page (link to relevant external resources UoG already provides)

## Authors and Acknowledgment

### Team Lead

Jennifer Lithgow  

### Other Members

Olivia Biancucci  
Sarah Toll  
Mrudini Patel  
Burak Duruk  
Rashi Mathur  
Cavaari Taylor  

## Project status

Current state: Reviewing past sprints
