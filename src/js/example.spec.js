// @ts-check
const { test, expect } = require('@playwright/test');

// Checks to see if the title matches expected title
test('course search title', async ({ page }) => {
  await page.goto('https://cis3760f23-09.socs.uoguelph.ca/courseSearch.php');

  // Expect a title "to contain" a substring.
  await expect(page).toHaveTitle(/CourseSearch/);
});

//checks that there is a submit button and a heading of course search form
test('button and heading', async ({ page }) => {
  await page.goto('https://cis3760f23-09.socs.uoguelph.ca/courseSearch.php');

  // click on the 'SUBMIT' button in the form
  await page.getByRole('button', { name: 'SUBMIT' }).click();

  // Expects page to have a heading with Course Search Form.
  await expect(page.getByRole('heading', { name: 'Course Search Form' })).toBeVisible();
});

//checks that there is a checkbox and verifies you can check it
test('test checkbox', async ({ page }) => {
  await page.goto('https://cis3760f23-09.socs.uoguelph.ca/courseSearch.php');
  //checks the first checkbox
  await page.check('input[type=checkbox]:nth-child(1)');
  //ensures it is checked
  expect(await page.isChecked('input[type=checkbox]:nth-child(1)')).toBeTruthy();
  //ensures a the taken course is there
  await expect(page.locator('#takenCourse')).toBeVisible();
});

//checks that there is a checkbox and verifies you can check it
test('one course taken check', async ({ page }) => {
  await page.goto('https://cis3760f23-09.socs.uoguelph.ca/courseSearch.php');
  //checks the prerequisites checkbox
  await page.getByLabel('Include courses that have no prerequisites').check();
  //check first course in list
  await page.getByLabel('ACCT*1220').check();
 
  // click on the 'SUBMIT' button in the form
  await page.getByRole('button', { name: 'SUBMIT' }).click();
  //make sure courses are visible
  await expect(page.locator('#courses')).toBeVisible();
  //ensure acc*2230 is visible and can click
  await page.getByLabel('ACCT*2230').click();
  //ensure after clicking the name management accounting shows up
  await page.getByLabel('" Management Accounting "');
});

//checks for some of the expected courses if we select CIS*1300 and CIS*1910 in the form
test('two courses taken check', async ({ page }) => {
  await page.goto('https://cis3760f23-09.socs.uoguelph.ca/courseSearch.php');

  await page.getByLabel('CIS*1300').check();
  await page.getByLabel('CIS*1910').check();
 
  // click on the 'SUBMIT' button in the form
  await page.getByRole('button', { name: 'SUBMIT' }).click();
  //make sure courses are visible
  await expect(page.locator('#courses')).toBeVisible();
  //ensure two of the expected courses are visible in the results list
  await page.getByLabel('CIS*2030').click();
  await page.getByLabel('CIS*2170').click();
  //ensure after clicking the expected courses the course names are as expected (verifying)
  await page.getByLabel('"Structure and Application of Microcomputers"');
  await page.getByLabel('"User Interface Design"');
});
