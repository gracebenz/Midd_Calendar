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

$sql = "INSERT INTO Events (EID, Name, Date, startTime, endTime, Location, Organization, Description) 
VALUES ('$_POST[EID]', '$_POST[eventName]', '$_POST[eventDate]', '$_POST[startEventTime]', '$_POST[endEventTime]', '$_POST[eventLocation]', '$_POST[eventOrganization]', '$_POST[eventDescription]')";

$sql = "INSERT INTO Tags (Tag_Name, EID)
VALUES ('$_POST[tag]', $_POST[EID]')"; 

echo $sql;

if (!mysqli_query($con, $sql)) {
	die('Error: ' . mysqli_error($con));
}

echo "New record added";

mysql_close ($con);
?>
