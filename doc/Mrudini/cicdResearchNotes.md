## CI/CD Research


### Links to Resources Used:
- https://www.redhat.com/en/topics/devops/what-is-ci-cd 
- https://about.gitlab.com/topics/ci-cd/cicd-pipeline/#ci-cd-pipeline-overview 
- https://docs.gitlab.com/ee/ci/quick_start/ 


### General Notes:
CI/CD stands for continuous integration and continuous deployment/delivery.

Continuous integration (CI) - includes build, test, merge.
Continuous delivery (CD) - automatically release to repo.
Continuous deployment (CD) - automatically deploy to production.

- Developers can make changes to code that is then automatically tested and pushed for delivery and deployment. 
- CI/CD helps reduce time needed for code releases and improve efficiency within the developmental lifecycle. 
- It also helps reduce human error in the deployment process.
- CI/CD requires merging changes made as often as possible. Ideally once per day?
- Actual automation is built into something called a CI/CD pipeline.
- Pipelines are generally run through CI/CD servers (i.e., Jenkins).
- GitLab seems to also host CI/CD pipelines (refer to 3rd link on GitLab quick start).
- Most example I came across online, consisted of .yml files. 


### Example .yml File Contents:
```c
build-job:
  stage: build
  script:
    - echo "Hello world!"

test-job1:
  stage: test
  script:
    - echo "This is a test."

deploy-prod:
  stage: deploy
  script:
    - echo "Meant to deploy something from the branch this .yml file is in."
  environment: production

```
- The above yaml code can be in a file in our GitLab branch called ".gitlab-ci.yml". 


