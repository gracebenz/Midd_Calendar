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
		<!--<link type="text/css" rel="stylesheet" href="entryStylesheet.css"/>-->
		<title>User Registration</title>
	</head>

	<body>

		<div id="header">
			<h2>Creator Confirmation</h2>
		</div>

		<div id="forms">
		<form action="creatorConfirm.php" method="post">
		Username: <input type="text" name="username"/><br /><br />
		Confirmation PIN: <input type="text" name="pin"/><br /><br />

		<input type="submit" name="confirm_submit" value="Confirm"/>
		</form>
		
		<form action="mainPage.php" method="post">
			<input type="submit" value="Return to Calendar"/>
		</form>
		</div>
		
		<div>

<?php
if(isset($_POST['confirm_submit']))
	{
	$username = $con->real_escape_string($_POST['username']);
	$pin = $con->real_escape_string($_POST['pin']); 
	$cnfrmpin = encrypt_decrypt('encrypt', $username);
	
	if ($pin == $cnfrmpin)
		{
		$sql = "UPDATE Creators SET Confirmed=1 WHERE Username ='". $username."'";
		if(!mysqli_query($con,$sql)){
			die('Error: ' . mysqli_error($con));
		}	
		echo "Thank you!";
		}
	else 
		{
		echo "Please try again.";
		}

	}

mysqli_close ($con);
?>		

		</div>
	</body>

</html>

