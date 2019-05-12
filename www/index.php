<?php
//function to check if sqlitraining database is created or not.
ob_start();
session_start();
include("db_config.php");
ini_set('display_errors', 1);
?>
<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>SQL Injection</title>

    <link href="./css/htmlstyles.css" rel="stylesheet">
	</head>

  <body>

    <div class="container-narrow">
        <div class="jumbotron">
			<h1 style="color:white">SQL Injection - Training App</h1>
			<p class="lead" style="color:white">
				An application designed to practice and learn manual detection and exploitation of SQL Injection flaws
			</p>
        </div>
		<br />
    <div class="row marketing">
        <div style="border:1px solid #000000; padding: 10px">
          <b>You can use the following users or register your own for the various exercises in the application.</b><br />
        <ul>
          <li>bob:password</li>
          <li>voldemort:horcrux</li>
        </ul>
        </div>
        <br />
        <div style="border:1px solid #000000; padding: 10px">
        <b>Additional information</b>
        <ul>
        <li>The database needs to be setup before beginning. To (re)set the database, navigate to <a href="resetdb.php">reset database</a>.</li>
        <li>Most pages support a debug view to see the query being run. Add <b>?debug=true</b> to the URL to enable this.</li>
        <li>The application is meant to be a deliberately insecure to practice and learn SQL Injection attacks. <b>Do not run on a server exposed to the Internet or in untrusted environments!</b></li>
        </ul>
        </div>
    </div>		
      <div class="row marketing">
        <div class="col-lg-6">

    <div style="border:1px solid #000000; padding: 10px">
		  <h4><a href="register.php" style="color:#B31D14">register.php - user registration page</a></h4>
          <p>This page can be used to create users that will be used throughout the application.</p>
		
          <h4><a href="login1.php" style="color:#B31D14">login1.php - basic injection page</a></h4>
          <p>This page contains the most simplistic form of SQL injection flaw. Verbose errors, can be used to enumerate columns and bypass user authentication altogether</p>

		  <h4><a href="login2.php" style="color:#B31D14">login2.php - basic injection page with brackets</a></h4>
          <p>This page contains the most simplistic form of SQL injection flaw. Verbose errors, can be used to enumerate columns and bypass user authentication altogether. Backend query uses brackets to enclose variables. Very common on the Internet.</p>
		  
          <h4><a href="searchproducts.php" style="color:#B31D14">searchproducts.php - multiple exercises</a></h4>
          <p>Page contains code that fetches multiple entries from the DB, can be abused to extract arbitrary data</p>

          <h4><a href="secondorder_register.php" style="color:#B31D14">secondorder_register.php - allows registration with quotes</a></h4>
          <p>Page allows user registration even with quotes. Quotes are nullified by appending a second quote to make them literals. Data is stored to backend tables without being verified if data was clean or not. The problem with doubling-up approach arises in more complex situations where the same item of data passes through several SQL queries, being written to the database and then read back more than once.</p>
		  		  
		  <h4><a href="secondorder_changepass.php" style="color:#B31D14">secondorder_changepass.php - allows users to change their password</a></h4>
          <p>Retrieves the username from the database as is and uses it to construct a new query without sanitising. An example of how data coming from backend databases is also input to an application. Generates SQL errors if the data stored to the DB is unclean (using Second Order Register for example).</p>
		  
		  <h4><a href="blindsqli.php?user=<?php echo $_SESSION['username'];?>"  style="color:#B31D14">blindsqli.php - vulnerable to content and time based blind SQLi</a></h4>
          <p>Page is vulnerable to blind sql injection using both changes in content as well as response times. Data can be extracted using true and false statements.</p>
		  
		  <h4><a href="os_sqli.php?user=<?php echo $_SESSION['username'];?>" style="color:#B31D14">os_sqli.php - can be used to interact with the filesystem and the OS via the MySQL databases</a></h4>
          <p>Can be used to interact with the OS, including reading and writing of files and other tasks.</p>
        </div>
      </div>

</div>
      <div class="footer">
		<p><a href="https://appsecco.com">Appsecco</a> | Riyaz Walikar | <a href="https://twitter.com/riyazwalikar">@riyazwalikar</a></p>
      </div>

    </div> <!-- /container -->

  

</body></html>