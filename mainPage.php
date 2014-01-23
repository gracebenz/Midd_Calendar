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
		<title>Events Calendar</title>
	</head>
	
	<body>
		<div id="header">
			<h2>Events Calendar</h2>
		</div>
		
		<div id="forms">
		<script type="text/javascript">
			var d = new Date()
			var weekday = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday")
			var monthname = new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")
			document.write(weekday[d.getDay()] + ", ")
			document.write(monthname[d.getMonth()] + " ")
			document.write(d.getDate() + ", ")
			document.write(d.getFullYear() + "<br>")
		</script>
		</div>
		
		<div class="left">
			<!-- HTML for SEARCH BAR -->
			<div id="tfheader">
				<form id="tfnewsearch" method="get" action="http://www.google.com">
		        	<input type="text" class="tftextinput" name="q" size="21" maxlength="120"><input type="submit" value="search" class="tfbutton">
				</form>
				<div class="tfclear"></div>
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
			$sql = "SELECT * FROM Events WHERE Date='01/21/2014' ";
		
			if (!mysqli_query($con, $sql)) {
				die('Error: ' . mysqli_error());
			} else {
				$result_today = mysqli_query($con, $sql);
				
			}
			$hour = 0; 
			
			while($hour<25){
				
				$row = mysqli_fetch_array($result_today);
				while($row and $hour<25){ 
					$current = $row; 
					
					
	   				if (substr($current[StartTime], 6, 8) == 'PM') {
	   					$sTime = int(substr($row[StartTime], 0, 1))*2;
	   					
	   				}
	   				else {
	   					$sTime = substr($current[StartTime], 0, 2);

	   				}
	   				if ($sTime>=$hour and $sTime<($hour+1)){
	   					echo $hour."<br>"; 			
	 					echo $current[Name]."<br>"; 			
	 				}
	 				if ($current = mysqli_fetch_array($result_today)){
	 					//echo $current[Name]; 
	 					}
	 				
				}	
				//$row = mysqli_fetch_array($result_today)		
	  			$hour+=1; 
	
	  		}
			mysqli_close($con);
		?>
		</div>
		
	</body>
</html>