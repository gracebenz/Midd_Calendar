<!--
Sam Hage
Grace Benz
Khi Chou
Alexa Gospodinoff

January 2014
-->


<html>
	<head>
		<!--<link type="text/css" rel="stylesheet" href="entryStylesheet.css"/>-->
		<title>Event Description</title>
	</head>
	
	<body>

		<?php
		//set up connection to the database
		define('DB_SERVER', 'panther.cs.middlebury.edu');
		define('DB_USERNAME', 'khihuac');
		define('DB_PASSWORD', '12345abcde');
		define('DB_DATABASE', 'khihuac_Calendar');

		$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");
		

		$EID = $_GET["EID"];
		$sql = "SELECT * FROM Events WHERE EID = '".$EID."'"; 
		
		if (!mysqli_query($con, $sql)) {
					die('Error: ' . mysqli_error());
				} else {
					$result_today = mysqli_query($con, $sql);
		}
		$row = mysqli_fetch_array($result_today);
		
	

		echo "Good Choice!<br><br>Name: $row[Name]<br>Location: $row[Location]
		<br>Organization: $row[Organization]<br>Date: $row[Date]<br>Start time: $row[StartTime]
		<br>End time: $row[EndTime]<br><br>";
		
		
		

		if (!mysqli_query($con, $sql)) {
			die('Error: ' . mysqli_error($con));
		}

		mysql_close ($con);
		?>


		<form action="mainPage.php" method="post">
			<input type="submit" value="Return to Calendar"/>
		</form>
	</body>
</html>
