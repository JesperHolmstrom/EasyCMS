#PHP CMS for course 1DV608 built upon Login solution by Daniel Toll

Author: Jesper Holmström

##Requirements
 * UC1 - Create new Page

 * Actors
 Admin - The person who wants to create a new page.
 System - In this case the AdminPanel

 * Preconditions
 Admin is authenticated.

 * Main scenario

 1. Starts when the admin is logged in to the System.
 2. System presents a list of actions the Admin can take.
 3. Admin selects 'Create new Page'.
 4. System asks for a page title, url and content of the new page.
 5. Admin provides the valid information.
 6. The System adds a new Page to the site and presents a message to the Admin.

 * Alternate Scenarios

 5a. Admin provides invalid information(Duplicate url, To long url/title/content)
 1. The System provides an error message to the Admin.
 6a. The system could not add a new Page(Could not connect to database).
 1.System presents an error message

 * UC2 - Read Page

  * Actors
  User - The person who wants to view a page.
  System - Handles the read request.

  * Main scenario

  1. Starts when the user loads the startpage.
  2. System presents a start page and a menu with different pages.
  3. User selects one of the pages in the menu
  4. System loads that page and display it to the user.
  5. Use case ended successfully.

  * Alternate Scenarios

  3a. User tries to view a page that does not exist. (By URL manipulation).
  1. The System shows the start page.

  * UC3 - Update page

  * Actors
  Admin - The person who wants to update a page.
  System - In this case the AdminPanel

  * Preconditions
  Admin is authenticated.

  * Main scenario

  1. Starts when the admin is logged in to the System.
  2. System presents a list of actions the Admin can take.
  3. Admin selects 'Update Page'.
  4. System presents a list of available pages.
  5. Admin selects one of the Pages to be updated.
  6. The System shows a form with title, url and content filled in with the pages current values.
  7. Admin changes the content of the page and press Update.
  8. The system updates the page and shows a message to the admin that the change was successfull.

  * Alternate Scenarios

  7a. Admin changes the url of the page and that url already exists.
    1. The System provides an error message to the Admin.
  7b. Admin changes the url of the page and that url don't already exist.
    1. The System updates the url and redirects the Admin to the new url and shows a message saying the update was successful.
  7c. Admin changes some value in the form and it does not meet the length requirements of title/url/content.
    1. The system shows an error message to the Admin.

  * UC4 - Delete page

  * Actors
  Admin - The person who wants to delete a page.
  System - In this case the AdminPanel

  * Preconditions
  Admin is authenticated.

  * Main scenario

  1. Starts when the admin is logged in to the System.
  2. System presents a list of actions the Admin can take.
  3. Admin selects 'Delete Page'.
  4. System presents a list of available pages.
  5. Admin selects one of the Pages to be deleted.
  6. The System shows a warning message and a button asking if the Admin really want to delete the page.
  7. Admin confirms that he wants to delete that page.
  8. The system deletes the page and presents a message saying the deletion was successful.

  * Alternate Scenarios

  7a. Admin does not confirm that he wants to delete the page.
    1. Nothing is deleted.
  8a. There is only one remaining page.
    1. The System does not delete the page and shows a message to the Admin saying that it is not possible to delete the last page.

##Testing
 * To be uploaded

##Installation and configuration

 * Upload files to server
 * Create a data folder
  * The data folder must be inaccessable to Apache but accessable to PHP
 * Create a MySQL database
 * Edit the information in Settings.php
 