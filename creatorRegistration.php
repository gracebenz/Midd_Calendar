<?php
/*
Sam Hage
Grace Benz
Khi Chou
Alexa Gospodinoff

January 2014
*/

//set up connection to the database
define('DB_SERVER', 'panther.cs.middlebury.edu');
define('DB_USERNAME', 'khihuac');
define('DB_PASSWORD', '12345abcde');
define('DB_DATABASE', 'khihuac_Calendar');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");


$sql = "INSERT INTO Creators (Username, Password) 
VALUES ('$_POST[Username]', '$_POST[Password]')";
echo $sql;




}

if (!mysqli_query($con, $sql)) {
	die('Error:' . mysqli_error($con));




}

echo 'Please check your email address for a confirmation email.';
mysqli_close ($con);
?>
