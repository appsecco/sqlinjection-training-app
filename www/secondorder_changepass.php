<?php
ob_start();
session_start();
include("db_config.php");
if (!$_SESSION["id"]){
header('Location:secondorder_register.php?msg=1');
}
ini_set('display_errors', 1);
?>


<!-- Enable debug using ?debug=true" -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Change Password Page - SQL Injection Training App</title>

    <link href="./css/htmlstyles.css" rel="stylesheet">
	</head>

  <body>
  <div class="container-narrow">
		
		<div class="jumbotron">
			<p class="lead" style="color:white">
				Change Password page</a>
				</p>
		</div>
		
	
		<div class="response">
		
			<p style="color:white">
			<table class="response">
			<form method="POST" autocomplete="off">
			
			<tr>
				<td>
					Enter new password:  
				</td>
				<td>
					<input type="password" id="newpassword1" name="newpassword1"><br />
				</td>
			</tr>

			<tr>
				<td>
					Repeat password: 
				</td>
				<td>
					<input type="password" id="newpassword2" name="newpassword2">
				</td>
			</tr>

			
			<td>
				<br />
			</td>
		</tr>
			<tr>
				<td>
					<input type="submit" id="changepass" name="changepass" value="Change Password!"/>
				</td>
				
			</tr>			
			</table>
				
			</p>

		</form>
        </div>

<?php

if (!empty($_REQUEST['changepass']) && !empty($_REQUEST['newpassword1'] && !empty($_REQUEST['newpassword2']))) {

$npass1 = $_REQUEST['newpassword1'];
$npass2 = $_REQUEST['newpassword2'];

if ($npass1 === $npass2){

	$q = "UPDATE users set password = '".md5($npass1)."' where username= '".$_SESSION["username"]."'";

	if (!mysqli_query($con,$q))
	{
		echo('Error: ' . mysqli_error($con));
	}else{
	
	$result = mysqli_query($con,$q);

	if (mysqli_warning_count($con)) { 
   $e = mysqli_get_warnings($con); 
   if ($e){
   do { 
       echo "Warning: $e->errno: $e->message\n"; 
   } while ($e->next()); }
} 
}
}else{

	echo "<div style=\"border:1px solid #FF0000; padding: 10px;color:#FF0000\">Passwords do not match. Please try again!</div><br />";

}


}else{
		$q = "Select * from users where username = '".$_SESSION["username"]."'";

		$result = mysqli_query($con,$q);
		if (!$result)
		{
			echo('Error: '.mysqli_error($con));
		}else{
		$e = mysqli_get_warnings($con); 
		
		if ($e){
			do { 
			echo "Warning: $e->errno: $e->message<br />"; 
			} while ($e->next()); 
		}
		$row = mysqli_fetch_array($result);
	
		if ($row){
		$_SESSION["username"] = $row[1];
		$_SESSION["name"] = $row[3];
		$_SESSION["descr"] = $row[4];
}
}
}

if (isset($_GET['debug']))
{
	if ($_GET['debug']=="true")
{
	$msg="<div style=\"border:1px solid #4CAF50; padding: 10px\">".$q."</div><br />";
	echo $msg;
	}
}

?>		
		<br />
		
      <div class="row marketing">
        <div class="col-lg-6">

	</div>
	</div>
	  
	  
	  <div class="footer">
		<p><h4><a href="index.php">Home</a><h4></p>
      </div>
	  
	  
	  <div class="footer">
		<p><a href="https://appsecco.com">Appsecco</a> | Riyaz Walikar | <a href="https://twitter.com/riyazwalikar">@riyazwalikar</a></p>
      </div>

	</div> <!-- /container -->
</body>
</html>