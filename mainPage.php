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
		<title>Events Calendar | Middlebury College</title>
	</head>
	
	<body>
		<div id="header">
			<h2>Events Calendar</h2>
		</div>
		
		<div class="left">
			<div id="searchHeader">
				<form id="search" method="post" action="search.php">
		        	<input type="text" class="textinput" name="searchInput" size="21" maxlength="120">
		        	<input type="submit" value="search" class="button">
				</form>
				<div class="clear"></div>
			</div>
		</div>
		
		<div class="right"></div>
		<div id="footer"></div>
		
		<div>
		<?php
			define('DB_SERVER', 'panther.cs.middlebury.edu');
			define('DB_USERNAME', 'khihuac');
			define('DB_PASSWORD', '12345abcde');
			define('DB_DATABASE', 'khihuac_Calendar');

			$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");
			
			//display the date without using a bullshit script
			$weekday = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
			$monthName = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
			$month = date(m);
			if ($month < 10)
				$month = substr($month, 1, 2);
			echo $weekday[date(w)].", ".$monthName[$month - 1]." ".date(d).", 20".date(y)."<br>";
			$date = date(m)."/".date(d)."/20".date(y); //store as a variable for use in the sql query
			
			$hour = 0;
			while ($hour < 25) {
			
				//declare query and check connection
				//this has to be in the while loop because we need to execute the query 24 times (at least that's our shitty work-around)
				//in other words, for every hour, we check every event –– $row wasn't storing anything before, it was just a dummy variable
				//holding one iteration of the query at a time
				$sql = "SELECT Name, StartTime, EndTime FROM Events WHERE Date='".$date."'";
				if (!mysqli_query($con, $sql)) {
					die('Error: ' . mysqli_error());
				} else {
					$result_today = mysqli_query($con, $sql);
				}
				
				//format the hour
				$printHour = $hour." AM";
				if ($hour == 0)
					$printHour = (12)." AM";
				if ($hour > 12) 
					$printHour = ($hour - 12)." PM";
				
				//check if events fall within hour
				$displayHour = true;
				while($row = mysqli_fetch_array($result_today)) {
				
					//simple check (same as before)
					if (substr($row[StartTime], 6, 8) == 'PM') {
	   					$sTime = substr($row[StartTime], 0, 2) + 12;
	   				} else {
	   					$sTime = substr($row[StartTime], 0, 2);
	   				}
	   				
	   				if (($sTime >= $hour) and ($sTime < ($hour+1))){
	   					//only print the hour the first time, and only if there are events in that hour
	   					if ($displayHour == true) {
	   						echo "<br>".$printHour."<br>";
	   						$displayHour = false;
	   					}
	 					echo $row[StartTime]." - ";
	 					echo $row[EndTime].": ";	
	 					echo $row[Name]."<br>"; 		
	 				}
				}
				$hour++;
			}
			mysqli_close($con);
		?>
		
		<br>
		<form action="entry.php" method="post">
			<input type="submit" value="Create an event"/>
		</form>
		
		<!--
		<FORM>
			<INPUT TYPE="button" onClick="history.go(0)" VALUE="Refresh">
		</FORM>
		-->
		
		</div>
		
	</body>
</html>