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
		<title>Search Results</title>
	</head>
	
	<body>
	<div id="otherPage">
		<div id="header">
			<h1>Search Results</h1><br>
		</div>
		
		<form action="index1.php" method="post">
			<input type="submit" value="Return to Calendar"/><br><br>
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
				
				$no_results = true;
	
				while($row = mysqli_fetch_array($searchResult)) {
					if ($row[Approved] == 1) {
						?><span id="descriptor"><a href="showEvent.php?EID=<?php echo $row[EID];?>"><?php echo $row[Name]."<br>";?></a><?php
						echo $row[StartTime]."-".$row[EndTime]."<br>";
						echo $row[Location]."<br><br>";?>
						</span><?php
						$no_results = false;
					}
				}
				if ($no_results)
					echo "Sorry, your search did not return any results.<br><br>";
		?>
		
	</div>	
	</body>

</html>