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
		<title>Search Results</title>
	</head>
	
	<body>
		<div id="header">
			<h2>Search Results</h2>
		</div>
		
		<form action="mainPage.php" method="post">
			<input type="submit" value="Return to Calendar"/>
		</form>
		
		<?php
			define('DB_SERVER', 'panther.cs.middlebury.edu');
			define('DB_USERNAME', 'khihuac');
			define('DB_PASSWORD', '12345abcde');
			define('DB_DATABASE', 'khihuac_Calendar');

			$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");
			//Search by tags, name, and location
			$sql = "SELECT * FROM Events WHERE Tags LIKE '%".$_POST[searchInput]."%' 
											OR Name LIKE '%".$_POST[searchInput]."%'
											OR Location LIKE '%".$_POST[searchInput]."%'";
			
				if (!mysqli_query($con, $sql)) {
					die('Error: ' . mysqli_error());
				} else {
					$searchResult = mysqli_query($con, $sql);
				}
				
				while($row = mysqli_fetch_array($searchResult)) {
					echo $row[Name]."<br>";
					echo $row[StartTime]."-".$row[EndTime]."<br>";
					echo $row[Location]."<br><br>";
				}
			
		?>
		
		<form action="mainPage.php" method="post">
			<input type="submit" value="Return to Calendar"/>
		</form>
		
	</body>

</html>