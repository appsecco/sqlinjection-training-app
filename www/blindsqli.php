<?php
ob_start();
session_start();
include("db_config.php");
if (!$_SESSION["username"]){
header('Location:login1.php?msg=2');
}
ini_set('display_errors', 0);
?>

<!-- Enable debug using ?debug=true" -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Blind SQL Injection - SQL Injection Training App</title>

    <link href="./css/htmlstyles.css" rel="stylesheet">
	</head>

  <body>
  <div class="container-narrow">
		
		<div class="jumbotron">
			<p class="lead" style="color:white">
				Blind SQL Injection (via content response and time delays)</a>
				</p>
		</div>

		<?php
if (isset($_GET["user"])){
		$user = $_GET["user"];
		$q = "Select * from users where username = '".$user."'";

		if (!mysqli_query($con,$q))
	{
		//die('Error: ' . mysqli_error($con));
	}else{
		$result = mysqli_query($con,$q);
		

		$row = mysqli_fetch_array($result);
		

		if ($row){
		$_SESSION["username"] = $row[1];
		$_SESSION["name"] = $row[3];
		$_SESSION["descr"] = $row[4];
		
}
	}
}//end if isset

?>		

		
		<div class="response">
		
			<p style="color:white">
			<table class="response">
			
			<tr>
				<td>
					Username:  
				</td>
				<td>
					<?php echo $row[1]; ?>
				</td>
			</tr>

			<tr>
				<td>
					Password Hash:  
				</td>
				<td>
					<?php echo $row[2]; ?>
				</td>
			</tr>

			<tr>
				<td>
					Name:  
				</td>
				<td>
					<?php echo $row[3]; ?>
				</td>
			</tr>

			<tr>
				<td>
					Description: 
				</td>
				<td>
					<?php echo $row[4]; ?>
				</td>
			</tr>
			</table>
				
			</p>

        </div>
<?php
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
  
	  
	  <div class="footer">
		<p><h4><a href="blindsqli.php?user=<?php echo $_SESSION['username'];?>">Profile</a> | <a href="logout.php">Logout</a> | <a href="index.php">Home</a><h4></p>
      </div>
	  
	  
	  <div class="footer">
		<p><a href="https://appsecco.com">Appsecco</a> | Riyaz Walikar | <a href="https://twitter.com/riyazwalikar">@riyazwalikar</a></p>
      </div>

	</div> <!-- /container -->
  
</body>
</html>