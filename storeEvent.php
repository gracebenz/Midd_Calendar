<!--
Sam Hage
Grace Benz
Khi Chou
Alexa Gospodinoff

January 2014
-->
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="styles.css"/>
		<title>Thank You!</title>
	</head>
	
	<body>
	<div id="otherPage">
		<?php
		//set up connection to the database
		define('DB_SERVER', 'panther.cs.middlebury.edu');
		define('DB_USERNAME', 'khihuac');
		define('DB_PASSWORD', '12345abcde');
		define('DB_DATABASE', 'khihuac_Calendar');

		$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");
		$eid = rand(10000000, 99999999);

		$sql = "INSERT INTO Events (EID, Name, Date, StartTime, EndTime, Location, Organization, Description, Tags) 
		VALUES ('$eid', '$_POST[eventName]', '$_POST[eventDate]', '$_POST[startEventTime]', '$_POST[endEventTime]',
		'$_POST[eventLocation]', '$_POST[eventOrganization]', '$_POST[eventDescription]', '$_POST[tags]')";

		?><span id="descriptor"><?php
		echo "Thank you!<br><br>Name: $_POST[eventName]<br>Event ID: $eid<br>Location: $_POST[eventLocation]
		<br>Organization: $_POST[eventOrganization]<br>Date: $_POST[eventDate]<br>Start time: $_POST[startEventTime]
		<br>End time: $_POST[endEventTime]<br><br>";

		if (!mysqli_query($con, $sql)) {
			die('Error: ' . mysqli_error($con));
		}

		mysql_close ($con);
		?>
		</span>
		<form action="index1.php" method="post">
			<input type="submit" value="Return to Calendar"/>
		</form>
	</div>
	</body>
</html>
