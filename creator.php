<!--
Sam Hage
Grace Benz
Khi Chou
Alexa Gospodinoff

January 2014
-->

<?php
define('DB_SERVER', 'panther.cs.middlebury.edu');
define('DB_USERNAME', 'khihuac');
define('DB_PASSWORD', '12345abcde');
define('DB_DATABASE', 'khihuac_Calendar');

$con = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");
?>

<html>
	<head>
		<link type="text/css" rel="stylesheet" href="entryStylesheet.css"/>
		<title>User Registration</title>
		
	
	</head>

	<body>
	
		<div id="header">
			<h2>User Registration</h2>
		</div>
		
		<div class="left"></div>
		<div class="right"></div>
		<div id="footer"></div>
		
	
		<div id="forms">
		<form action="creatorRegistration.php" method="post">
		Username: <input type="text" name="Username" /> @middlebury.edu<br><br>		
		Password: <input type="password" name="Password" /><br><br>
		Confirm Password: <input type="password" name="Password2" required/><br><br>
		
		
		
		</div>



		<br>

		<input type="submit" name = "registration_submit" value="Create"/>
		</form>
	</body>

</html>


<?php

	if(isset($_POST['register_submit'])){
		$errors = array();

		if(empty($_POST['Username'])){
		$errors[] = "this is dumb!";		
		}
		else{
			$Username = $mysqli->real_escape_string($_POST['Username']);
		}
		if(empty($_POST['Password'])){
		$errors[] = "this is dumbdafsaf!";		
		}
		else{
			$Password = $_POST['Password'];
		}
	
	}



?>
