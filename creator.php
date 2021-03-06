<!--
Sam Hage
Grace Benz
Khi Chou
Alexa Gospodinoff

January 2014
-->

<?php
/**
 * simple method to encrypt or decrypt a plain text string
 * initialization vector(IV) has to be the same when encrypting and decrypting
 * PHP 5.4.9
 *
 * this is a beginners template for simple encryption decryption
 * before using this in production environments, please read about encryption
 *
 * @param string $action: can be 'encrypt' or 'decrypt'
 * @param string $string: string to encrypt or decrypt
 *
 * @return string
 */
function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is our secret key';
    $secret_iv = 'This is our secret iv';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

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
		<title>User Registration</title>
	</head>

	<body>
	<div id="otherPage">
		<div id="header">
			<h1>Creator Registration</h1><br>
		</div>

		<div id="descriptor">
		<form action="creator.php" method="post">
		Username: <input type="text" name="Username" required/> @middlebury.edu<br /><br />
		Password: <input type="password" name="Password" required/><br /><br />
		Confirm Password: <input type="password" name="Password2" required/><br /><br />
		<input type="checkbox" name="Admin" value="yes" />I am an administrator of events scheduling for Middlebury.<br /><br />

		<input type="submit" name="register_submit" value="Create"/><br><br>
		</form>

		<form action="index1.php" method="post">
			<input type="submit" value="Return to Calendar"/>
		</form>
		</div>

		<div>
<?php
if(isset($_POST['register_submit']))
	{
	if ($_POST['Password'] != $_POST['Password2']) 
		{
		echo 'Error: passwords do not match.';
		}
	else
		{
		$username = $con->real_escape_string($_POST['Username']);
		$cnfrmpin = encrypt_decrypt('encrypt', $username);
		$password = $con->real_escape_string($_POST['Password']);
		$encrpass = encrypt_decrypt('encrypt', $password);
		
		$sql = "INSERT INTO Creators (Username, Password) 
		VALUES ('$username', '$encrpass')";
		if (!mysqli_query($con, $sql)) 
			{
			die('Error: ' . mysqli_error($con));
			}

		$to = $username."@middlebury.edu";
		$subject = "Midd Events Signup Confirmation";
		$message = "Hi, ".$username."!\r\n\r\nLooks like you recently signed up to create events for the Middlebury Events Calendar. To confirm your account, please visit the following page:\r\n\r\nhttp://www.cs.middlebury.edu/~agospodinoff/creatorConfirm.php\r\n\r\nYour confirmation PIN is:\r\n\r\n".$cnfrmpin."\r\n\r\nThanks and welcome to the calendar!\r\n\r\n";
		if ($_POST['Admin'] == "yes")
			{
			$message = $message."You have requested administrator status.";
			}
		$header = "From:MiddleburyEvents@gmail.com \r\n";
	
		$tp = "MiddleburyEvents@gmail.com";
		$messagf = $username." has registered as a creator.";
		if ($_POST['Admin'] == "yes")
			{
			$messagf = $messagf." They have requested administrator status. To confirm their administrator request, click the following link: http://www.cs.middlebury.edu/~agospodinoff/adminConfirm.php?Username=".$username;
			}

		$retval = mail($to, $subject, $message, $header);
		
		if($retval == true)  
			{
			echo "Account creation successful. <br />";
			echo "Please check your email address for a confirmation email.";
			$retvam = mail($tp, $subject, $messagf, $header);
			}
		else
			{
			echo "Message could not be sent...";
			}
		}
	}

mysqli_close ($con);
?>
	</div>
		</div>

	</body>

</html>
