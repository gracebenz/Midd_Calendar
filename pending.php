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
		<title>Pending Events</title>
	</head>

	<body>
	<div id="otherPage">
		<div id="header">
			<h1>Pending Events</h1><br>
		</div>
	
		<?php
		//set up connection to the database
		define('DB_SERVER', 'panther.cs.middlebury.edu');
		define('DB_USERNAME', 'khihuac');
		define('DB_PASSWORD', '12345abcde');
		define('DB_DATABASE', 'khihuac_Calendar');

		$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");
		$sql = "SELECT * FROM Events WHERE Approved = 0";
		
		if (!mysqli_query($con, $sql)) {
				die('Error: ' . mysqli_error());
			} else {
				$result_today = mysqli_query($con, $sql);
		}
		
		while($row = mysqli_fetch_array($result_today)) {?>
			<span id="descriptor"><a href="showEvent.php?EID=<?php echo $row[EID];?>"><?php echo $row[Name]."<br>";?></a></span>
		<?php
		}
		?>
	</div>
	</body>
</html>