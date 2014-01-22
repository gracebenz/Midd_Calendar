<!--
Sam Hage
Grace Benz
Khi Chou
Alexa Gospodinoff

January 2014
-->

<html>
	<head>
		<link type="text/css" rel="stylesheet" href="mainStylesheet.css"/>
		<title>Events Calendar</title>
	</head>
	
	<body>
		<h2>Events Calendar</h2>
		
		<script type="text/javascript">
			var d = new Date()
			var weekday = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday")
			var monthname = new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")
			document.write(weekday[d.getDay()] + ", ")
			document.write(monthname[d.getMonth()] + " ")
			document.write(d.getDate() + ", ")
			document.write(d.getFullYear() + "<br>")
		</script>
		
		
		<?php
			define('DB_SERVER', 'panther.cs.middlebury.edu');
			define('DB_USERNAME', 'khihuac');
			define('DB_PASSWORD', '12345abcde');
			define('DB_DATABASE', 'khihuac_Calendar');

			$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");
			$sql = "SELECT * FROM Events";
			//echo "connected";
			if (!mysqli_query($con, $sql)) {
				die('Error: ' . mysqli_error());
			} else {
				$result = mysqli_query($con, $sql);
			}
			//echo "test";
			while($row = mysqli_fetch_array($result)) {
	   		// Write the value of the column (which is now in the array $row)
	 			echo $row[eventName] . "<br>";
	  		}
			mysqli_close($con);
		?>
		
		

		
		
		<!--
		<script language="javascript">
			function validate() {
				fm = document.thisForm
				//validate that the user entered information correctly
				fm.submit()
			}
		</script>
		
		<form name="displayFormat" method="POST" action="query.php">
		<select size="1" name="displayDropdown">
			<option value="eventName">Event Name</option>
			<option value="eventDate">Event Date</option>
		</select>
		<input type="button" value="Submit" name="btm_submit" onclick="validate()">
		</form>
		-->
	
	</body>
</html>