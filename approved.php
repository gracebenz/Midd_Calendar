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
			$update = "UPDATE Events SET Approved = 1 WHERE EID = '".$EID."'";
			
			if (!mysqli_query($con, $update)) {
						die('Error: ' . mysqli_error());
					} else {
						$approval_change = mysqli_query($con, $update);
			}			
			echo "Event approved!";

			mysqli_close($con);
		?>	
		
		<form action="mainPage.php" method="post">
			<input type="submit" value="Return to Calendar"/>
		</form>
		
	</body>
</html>
	