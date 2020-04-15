1) After Pull, go inside project folder and composer update

2) Now create database with name elv in phpmyadmin(mysql).

3) Enter DB Credentials in .env file

4) Now in terminal or cmd go inside the elv folder and type the below following commands:
	1) php artisan migrate (Migrates all the Database Tables).
	2) php artisan db:seed --class=UsersTableDataSeeder (Creates a user with admin role).
	3) Open terminal and go inside project directory and type sudo chmod 777 -R storage/ bootstrap/ - For permission setup in Linux
	4) Go inside public directory inside project directory in terminal and sudo chmod 777 -R uploads/ - For permission setup to store video files.

5) Now go to browser and type the folder url.

6) Sample files to upload video and csv files can be found at sample_files directory.

Thanks
