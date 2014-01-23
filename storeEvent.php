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

<script type="text/javascript">
	var eid = Math.floor((Math.random() * 98999999) + 10000000);
	window.location.href = "storeEvent.php?eid=" + eid;
</script>

//$eid = $_GET[eid];
//echo eid;

$sql = "INSERT INTO Events (EID, Name, Date, StartTime, EndTime, Location, Organization, Description) 
VALUES ('$_GET[eid]', '$_POST[eventName]', '$_POST[eventDate]', '$_POST[startEventTime]', '$_POST[endEventTime]', '$_POST[eventLocation]', '$_POST[eventOrganization]', '$_POST[eventDescription]')";

$sql_2 = "INSERT INTO Tags (Tag_Name, EID)
VALUES ('$_POST[tag]', $_POST[EID]')"; 

echo $sql;

echo $sql_2; 


if (!mysqli_query($con, $sql)) {
	die('Error: ' . mysqli_error($con));
}

echo "New record added";

mysql_close ($con);
?>
