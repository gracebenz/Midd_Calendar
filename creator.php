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
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';

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
		<form action="creator.php" method="post">
		Username: <input type="text" name="Username" required/> @middlebury.edu<br><br>		
		Password: <input type="password" name="Password" required/><br><br>
		Confirm Password: <input type="password" name="Password2" required/><br><br>

		<input type="submit" name="register_submit" value="Create"/>
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
		$password = $con->real_escape_string($_POST['Password']);
		$encrpass = encrypt_decrypt('encrypt', $password);
		//$verifyid = rand(10000000, 99999999);
		
		$sql = "INSERT INTO Creators (Username, Password) 
		VALUES ('$username', '$encrpass')";
		if (!mysqli_query($con, $sql)) 
			{
			die('Error: ' . mysqli_error($con));
			}
		
		$to = $username."@middlebury.edu";
		$subject = "Middlebury Events Calendar Account Confirmation";
		$message = "This email is to confirm ";
		$header = "From:noreply@noreply.org \r\n";

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
	}

mysqli_close ($con);
?>		

		</div>
	</body>

</html>
