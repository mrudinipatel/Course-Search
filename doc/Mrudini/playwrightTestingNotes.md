### Playwright Installation on the VM
sudo apt update

sudo apt install nodejs

sudo apt install npm

npm init playwright@latest

- This should install nodejs, npm, and the latest version of playwright on the VM.
- When you run the last command, it might ask you some questions. I selected JavaScript, false for the GitHub question, and default ones for the rest of them.
- Once installation is complete, you should see some new folders in your main directory. This is fine.
- Inside the ```tests``` folder, there should be a file called ```example.spec.js```. This is where we wrote our test cases.

### Run Automated Testing File
- To run the ```example.spec.js``` file, we just need to run the command: ```npx playwright test```.
- You can run this from any directory, you don't have to be inside the ```tests``` directory.
- If all goes well, you should see all tests being passed (they do for sprint7). Otherwise, the command line will tell you which line number the test case failed on. This helps with debugging.


