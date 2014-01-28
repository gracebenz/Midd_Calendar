
<?php

define('DB_SERVER', 'panther.cs.middlebury.edu');
define('DB_USERNAME', 'khihuac');
define('DB_PASSWORD', '12345abcde');
define('DB_DATABASE', 'khihuac_Calendar');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");

?>
<html>
<head>
<title> Yosaf! </title>
</head>

<body>

<div id="form">
<form action ="userconfirmation.php" method ="post">
Enter your Username:<input type = "text" name = "username"/>
Enter your pin:<input type = "text" name = "pin" />
</div>
<br>

<input type = "submit" name = "confirm_submit" value = "Create"/>
</form>

<?php
if(isset($_POST['confirm_submit']))
{

	$pin = $_GET["pin"]; 

	//if ($_POST['pin']== '123'){
	
	if ($pin == 	
		$sql =	"UPDATE Creators SET Confirmed=1 WHERE Username ='". $_POST[username]."'";
		if(!mysqli_query($con,$sql)){
			die('Error: ' . mysqli_error($con));
		}	

		echo "You ACTUALLY own that email adress, good!";
	}
	else {
		echo "this is clearly the wrong pin bro?" ;
	}

}

mysqli_close($con);

?>


</body>


</html>







