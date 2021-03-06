<?php 
session_start(); 
if($_SESSION['type'] == "Guest"){
header("Location: http://www.cs.middlebury.edu/~shage/creator.php");
}
echo $_SESSION['type'];

?>


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
		<title>Create An Event</title>
		
		<!--calendar widget-->		
		<meta charset="utf-8">
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script>
			$(function() {
			$("#datepicker").datepicker();
		});
		</script>
		<!---->
		
	</head>

	<body>
	
		<?php
		define('DB_SERVER', 'panther.cs.middlebury.edu');
		define('DB_USERNAME', 'khihuac');
		define('DB_PASSWORD', '12345abcde');
		define('DB_DATABASE', 'khihuac_Calendar');

		$con = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");
		?>
		<div id="otherPage">
	
		<div id="header">
			<h1>Create an Event</h1>
		</div>
		
		<div class="left"></div>
		<div class="right"></div>
		<div id="footer"></div>
		
	
		<div id="descriptor">
		<form action="storeEvent.php" method="post">
		<br>Event name: <input type="text" name="eventName" required/><br><br>
		Date: <input type="text" id="datepicker" name="eventDate" maxlength="10" required/><br><br>
		Start Time: <input type="text" name="startEventTime" placeholder = "hh:mm AM/PM" required/><br><br>
		End Time: <input type="text" name="endEventTime" placeholder = "hh:mm AM/PM" required/><br><br>
		Location: <input type="text" name="eventLocation" required/><br><br>
		Do you have this location reserved?:
			<input type="radio" name="locationAppr" value="approved"/>Yes
			<input type="radio" name="locationAppr" value="not approved"/>No<br><br>	
		Organization: <input type="text" name="eventOrganization" required/><br><br>
		Description: <br><textarea name="eventDescription" rows="5" cols="40" maxlength="500"></textarea><br><br>
		Enter tags separated by commas:<br>(a capella, basketball, food, etc.)
		<br><textarea name="tags" rows="5" cols="40" maxlength="200"></textarea><br>
		</div>
		
		<br>
		<input type="submit" value="Create"/><br><br>
		</form>
		
		<form action="index1.php" method="post">
			<input type="submit" value="Return to Calendar"/><br><br><br><br>
		</form>
		
		</div>
		
	</body>

</html>
