In order to run the project, download the project files, including images, on a web server and run it. 
This project was tested on a bitnami VM that was hosted on Google Cloud,
hosting the front end codebase, associated images, and Database.
In order to run the code with custom databse, connection string in the config file may be required to be altered, 
if you intend to run the server with your database, as we may not continue to host
the Database for universal access after Winter 2023 quarter.

The project is simple and therefore, we separated each page in a unique folder, associated with the role of a page.
If you plan to run it with another file structure, certain paths to the .php files may be changed,
as for production testing, we combined all of the files in a single folder to minimize need to interact
with VM folder structure. All of the images should be available to index.php, as it hosts all of them, and logo should
be available to all web pages.

In order to deploy it, download the files and run it in a single folder, our DB currently provides appropriate privilages to testuser.
