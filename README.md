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

 5a. Admin provides invalid information(Duplicate url, Duplicate title, To long url/title/content)
 1. The System provides an error message to the Admin.
 6a. The system could not add a new Page(Could not connect to database).
 1.System presents an error message

##Testing
 * To be uploaded

##Installation and configuration

 * Upload files to server
 * Create a data folder
  * The data folder must be inaccessable to Apache but accessable to PHP
 * Create a MySQL database
 * Edit the information in Settings.php
 