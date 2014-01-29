<!--
Sam Hage
Grace Benz
Khi Chou
Alexa Gospodinoff

January 2014
-->

<?php
//set up the connection to the database
define('DB_SERVER', 'panther.cs.middlebury.edu');
define('DB_USERNAME', 'khihuac');
define('DB_PASSWORD', '12345abcde');
define('DB_DATABASE', 'khihuac_Calendar');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");
?>

<html>
	<head>
		<link type="text/css" rel="stylesheet" href="styles.css"/>
		<title>Email Signup</title>
	</head>

	<body>
		<div id="otherPage">
		
		<div id="header">
			<h1>Email Signup<br></h1>
		</div>
		
		<div class="left"></div>
		<div class="right"></div>
		<div id="footer"></div>
		
		
		<form action="signup.php" method="post">
		<span id="descriptor"><br>Sign up to receive emails about upcoming events at Midd.</span><br/><br/>
		<input type="text" name="Username" placeholder="username" required/> @middlebury.edu<br /><br />
		
		<input type="submit" name="signup_submit" value="Subscribe"/><br><br>
		</form>
		
		<form action="index1.php" method="post">
			<input type="submit" value="Return to Calendar"/>
		</form>
		
		</div>
		</div>

<?php
if(isset($_POST['signup_submit']))
	{
		$username = $con->real_escape_string($_POST['Username']);
		
		$sql = "INSERT INTO Subscribers (Username) 
		VALUES ('$username')";
		if (!mysqli_query($con, $sql)) 
			{
			die('Error: ' . mysqli_error($con));
			}
		
		
		$to = $username."@middlebury.edu";
		$subject = "Midd Events Subscription Confirmation";
		$message = "Hi, ".$username."! Welcome to the Midd Events Calendar!\r\n\r\nYou're receiving this email because you recently asked to receive emails about upcoming events at Middlebury College.\r\n\r\nIf you do not wish to receive these emails, click on the following link to unsubscribe: http://www.cs.middlebury.edu/~agospodinoff/unsubscribe.php?Username=".$username;
		$header = "From:MiddleburyEvents@gmail.com \r\n";

		$retval = mail($to, $subject, $message, $header);

		if($retval == true)  
			{
			echo "Account creation successful. <br />";
			echo "Please check your email address for a confirmation email.";
			}
		else
			{
			echo "Message could not be sent...";
			}
	}

mysqli_close ($con);
?>		

		</div>
	</body>

</html>
