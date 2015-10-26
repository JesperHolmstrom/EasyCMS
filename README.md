####EasyCMS for course 1DV608 built upon Login solution by Daniel Toll
Author: Jesper Holmström

##Vision

###Problem to solve
A lot of people know how to create simple HTML pages and style them, but it is tedious to manage big sites with a lot of .html documents, especially when changing the layout of the site.
Large CMS's like Wordpress/Joomla can be hard to setup and the user does not need the functionality it offers. A simple lightweight CMS is needed.

###What is EasyCMS?
This projects is intended to be used by people who knows how to create HTML pages but want an easier way of doing so.
After installation it should be quick and easy to edit the website contents through some sort of Admin Panel.
It should be possible to edit the entire sites layout without manually editing every single page of the site.
The CMS should allow for CREATING/READING/UPDATING/DELETING content of the site.

##Requirements
### UC1 - Create new Page

#####Actors
Admin - The person who wants to create a new page.
System - In this case the AdminPanel

#####Preconditions
Admin is authenticated.

#####Main scenario

1. Starts when the admin is logged in to the System.
2. System presents a list of actions the Admin can take.
3. Admin selects 'Create new Page'.
4. System asks for a page title, url and content of the new page.
5. Admin provides the valid information.
6. The System adds a new Page to the site and presents a message to the Admin.

#####Alternate Scenarios

5a. Admin provides invalid information(Duplicate url, To long url/title/content)
1. The System provides an error message to the Admin.
6a. The system could not add a new Page(Could not connect to database).
1.System presents an error message

###UC2 - Read Page

#####Actors
User - The person who wants to view a page.
System - Handles the read request.

#####Main scenario

1. Starts when the user loads the startpage.
2. System presents a start page and a menu with different pages.
3. User selects one of the pages in the menu
4. System loads that page and display it to the user.
5. Use case ended successfully.

#####Alternate Scenarios

3a. User tries to view a page that does not exist. (By URL manipulation).
1. The System shows the start page.

###UC3 - Update page

#####Actors
Admin - The person who wants to update a page.
System - In this case the AdminPanel

#####Preconditions
Admin is authenticated.

#####Main scenario

1. Starts when the admin is logged in to the System.
2. System presents a list of actions the Admin can take.
3. Admin selects 'Update Page'.
4. System presents a list of available pages.
5. Admin selects one of the Pages to be updated.
6. The System shows a form with title, url and content filled in with the pages current values.
7. Admin changes the content of the page and press Update.
8. The system updates the page and shows a message to the admin that the change was successfull.

#####Alternate Scenarios

7a. Admin changes the url of the page and that url already exists.
1. The System provides an error message to the Admin.
7b. Admin changes the url of the page and that url don't already exist.
1. The System updates the url and redirects the Admin to the new url and shows a message saying the update was successful.
7c. Admin changes some value in the form and it does not meet the length requirements of title/url/content.
1. The system shows an error message to the Admin.

###UC4 - Delete page

#####Actors
Admin - The person who wants to delete a page.
System - In this case the AdminPanel

#####Preconditions
Admin is authenticated.

#####Main scenario

1. Starts when the admin is logged in to the System.
2. System presents a list of actions the Admin can take.
3. Admin selects 'Delete Page'.
4. System presents a list of available pages.
5. Admin selects one of the Pages to be deleted.
6. The System shows a warning message and a button asking if the Admin really want to delete the page.
7. Admin confirms that he wants to delete that page.
8. The system deletes the page and presents a message saying the deletion was successful.

#####Alternate Scenarios

7a. Admin does not confirm that he wants to delete the page.
1. Nothing is deleted.
8a. There is only one remaining page.
1. The System does not delete the page and shows a message to the Admin saying that it is not possible to delete the last page.

##Testing
###Test case 1.1 Successfully create new Page

Admin creates a page. Page is created and a message is shown.

#####Input:
Fill in the form with: title = A new page, url = anurl, content = Some content.
Press 'Create Page'.

#####Output:
"Successful" message is shown.

###Test case 1.2 Fail to create duplicate page

Admin creates a page. Page is not created and an error message is shown.

#####Input:
Test case 1.1.
Fill in the form with: title = A new page, url = anurl, content = Some content.
Press 'Create Page'.

#####Output:
"Duplicate entry 'anurl' for key 'url'" message is shown.

###Test case 1.3 Fail to create page with no title

Admin creates a page. Page is not created and an error message is shown.

#####Input:
Fill in the form with: url = anurl, content = Some content.
Leave title blank.
Press 'Create Page'.

#####Output:
"You need to fill in a Title." message is shown.

###Test case 1.4 Fail to create page with invalid title

Admin creates a page. Page is not created and an error message is shown.

#####Input:
Fill in the form with:, url = anurl, content = Some content.
Fill in title with a string < 3 characters or > 35 characters.
Press 'Create Page'.

#####Output:
"Title need to be between 3 and 35 characters long." message is shown.

###Test case 1.5 Fail to create page with no url

Admin creates a page. Page is not created and an error message is shown.

#####Input:
Fill in the form with: title = Title, content = Some content.
Leave url blank.
Press 'Create Page'.

#####Output:
"You need to fill in an URL." message is shown.

###Test case 1.6 Fail to create page with invalid url

Admin creates a page. Page is not created and an error message is shown.

#####Input:
Fill in the form with:, title = Title, content = Some content.
Fill in url with a string < 3 characters or > 35 characters.
Press 'Create Page'.

#####Output:
"URL need to be between 3 and 25 characters long." message is shown.

###Test case 1.7 Fail to create page with no content

Admin creates a page. Page is not created and an error message is shown.

#####Input:
Fill in the form with: title = Title, url = anurl.
Leave content blank.
Press 'Create Page'.

#####Output:
"You need to fill in some content." message is shown.

###Test case 1.8 Fail to create page with invalid content

Admin creates a page. Page is not created and an error message is shown.

#####Input:
Fill in the form with:, title = Title, url = anurl.
Fill in content with < 3 characters or > 10000 characters.
Press 'Create Page'.

#####Output:
"Content need to be between 3 and 10000 characters long." message is shown.

###Test case 2.1 Successfully update a page

Admin updates a page. Page is updated and a message is shown saying the operation was successful.

#####Input:
Press Update Page and choose one of the pages.
Change the content, url and title (3 < title.length > 35, 3 < url.length > 25, 3 < content.length > 10000 )
Press 'Update Page'.

#####Output:
Page is updated with the new values.
The menu to the left is updated with the new title if it was changed.
The user is redirected to the new url if the url was changed.

###Test case 2.2 Updating page failed because of duplicate url

Admin updates a page. Page is not updated and a message is shown saying the operation was not successful.

#####Input:
Press Update Page and choose one of the pages.
Change the url to one that already exists.
Press 'Update Page'.

#####Output:
Page is not updated.
"Duplicate entry 'apage' for key 'url'" message is shown.

###Test case 3.1 Successfully delete a page

Admin deletes a page. Page is deleted and a message is shown saying the operation was successful.

#####Input:
Press Delete Page and choose one of the pages.
Press 'Yes,delete this page'.

#####Output:
Page is deleted.
The menu to the left is updated and does not contain the deleted page.

###Test case 3.2 Deleting page failed because there was not enough pages.

Admin tries to delete a page. Page is not deleted and a message is shown saying the operation was not successful.

#####Input:
Delete pages until there is only 1 page left.
Press Delete Page and choose the last page.
Press 'Yes,delete this page'.

#####Output:
Page is not deleted.
"You can not delete the last page." message is shown.

##Installation and configuration

* Upload files to server
* Create a data folder
* The data folder must be inaccessable to Apache but accessable to PHP
* Create a MySQL database
* Run the sql code found in sql-installation.txt in your database. (Replace 'cms' with your table name)
* Edit the information in Settings.php
