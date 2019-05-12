<?php
$DBUSER = 'root';
$DBPASS = 'root';

//system('mysql -h \'db\' -u '.$DBUSER.' -p'.$DBPASS.' < sqlitraining.sql');

$sql = file_get_contents('sqlitraining.sql');

$mysqli = new mysqli('db', $DBUSER, $DBPASS);
if (mysqli_connect_errno()) { /* check connection */
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* execute multi query */
if ($mysqli->multi_query($sql)) {
    echo "DB reset!<br/>";
    echo "Go back to <a href='/'>Home</a>";
} else {
   echo "DB was not reset! Check logs to see what happened :(";
}

?>
