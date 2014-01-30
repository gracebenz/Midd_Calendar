<!--
Sam Hage
Grace Benz
Khi Chou
Alexa Gospodinoff

January 2014
-->

<?php
//set up the connection to the database
define('DB_SERVER', 'panther.cs.middlebury.edu');
define('DB_USERNAME', 'khihuac');
define('DB_PASSWORD', '12345abcde');
define('DB_DATABASE', 'khihuac_Calendar');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");

$username = $_GET['Username'];
$sql = "DELETE FROM Subscribers WHERE Username='$username'";

if (!mysqli_query($con, $sql)) 
	{
	die('Error: ' . mysqli_error($con));
	}

mysqli_close ($con);
?>

<html>
	<head>
		<link type="text/css" rel="stylesheet" href="styles.css"/>
		<title>Unsubscribe</title>
	</head>

	<body>

		<div id="otherPage">
		You have been unsubscribed from the Midd Events email list.
		<br /><br />
		<form action="index1.php" method="post">
			<input type="submit" value="Return to Calendar"/>
		</form>
		</div>
	</body>

</html>
