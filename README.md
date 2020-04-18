<h1 align="center">Video Streaming System</h1>
<h3>Project Scope</h3>
<p>The application will have two types of users such as Admin and Users</p>
<p>Admin Can:</p>
<ul>
    <li>Create and manage events with video upload (Currently validated with 1 MB of video upload size).</li>
    <li>Bulk upload of events with basic error handling (CSV upload).</li>
    <li>Dashboard: List of past events history, events list based on date</li>
    <li>Event details: with Joined user list, with like count.</li>
</ul>

<p>User Can:</p>
    <ul>
        <li>Register/Login.</li>
        <li>View only today's events list.</li>
        <li>User can Join the events once before event start time + 10 mins, After he can not join the event.</li>
        <li>User can like that video.</li>
        <li>List my events(Past & future).</li>
    </ul>

<h3>Installation Details</h3>
<ol>
    <li>After Pull, go inside project folder and composer update</li>
    <li>Now create database with name elv in phpmyadmin(mysql).</li>
    <li>Enter DB Credentials in .env file</li>
    <li>Now in terminal or cmd go inside the elv folder and type the below following commands:</li>
        <ul>
            <li>php artisan migrate (Migrates all the Database Tables).</li>
            <li>php artisan db:seed --class=UsersTableDataSeeder (Creates a user with admin role).</li>
            <li>Open terminal and go inside project directory and type sudo chmod 777 -R storage/ bootstrap/ - For permission setup in Linux</li>
            <li>Go inside public directory inside project directory in terminal and sudo chmod 777 -R uploads/ - For permission setup to store video files.</li>
        </ul>
    <li>Now go to browser and type the folder url.</li>
    <li>Sample files to upload video and csv files can be found at sample_files directory.</li>
</ol>

<p>If you find any bug or need to correct me, just mail me at <a href="mailto:jerinmonish007@gmail.com">jerinmonish007@gmail.com</a></p>

<p>Thanks</p>
