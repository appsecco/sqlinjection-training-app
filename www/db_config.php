<?php
// Create connection
$DBUSER = 'root';
$DBPASS = 'root';

$con=mysqli_connect('db',$DBUSER,$DBPASS,'sqlitraining');

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "<font style=\"color:#FF0000\">Could not connect:". mysqli_connect_error()."</font\>";
  }
?>