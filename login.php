<!--
Sam Hage
Grace Benz
Khi Chou
Alexa Gospodinoff

January 2014
-->

<?php
	session_start();
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
define('DB_SERVER','panther.cs.middlebury.edu');
define('DB_USERNAME','khihuac');
define('DB_PASSWORD','12345abcde');

define('DB_DATABASE','khihuac_Calendar');

$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");


if(isset($_POST['register-submit'])){
  	//Create an errors array
	$errors = array();

	//Check to make sure the fields are not empty
	if(empty($_POST['username'])){
        	$errors[] = "Please enter a username";
		echo "dude enter some username";
    	}
	else{
   		$username = $mysqli->real_escape_string($_POST['username']);
	}

	if(empty($_POST['password'])){
    		$errors[] = "Please enter a password";
		echo "bro, why no password? Do you even english?";
	}else{
        	$password = $_POST['password'];
		
		
	}

 	   //If there are no errors
    	if(empty($errors)){
		//encrypt the password
    		$encrypted_txt = encrypt_decrypt('encrypt', $password);
		
		//get the row corresponding to this user
   		$sql = "SELECT Password FROM Creators WHERE Username ='". $_POST[username]."'";
		$sql1 = "SELECT Confirmed FROM Creators WHERE Username ='". $_POST[username]."'";
		$sql2 = "SELECT Administrator FROM Creators WHERE Username ='". $_POST[username]."'";
    		 
		if (!mysqli_query($mysqli, $sql) || !mysqli_query($mysqli, $sql1)){
  			echo "Registration Error: ";
			die('Error: ' . mysqli_error($mysqli));
		}
		else{
			
			//result will be rows corresponding to this user
			$result = mysqli_query($mysqli,$sql);	
			$result1 = mysqli_query($mysqli,$sql1);
			$result2 = mysqli_query($mysqli,$sql2);
		
			//row will be single row for this result
			$row = mysqli_fetch_array($result);
			$row1 = mysqli_fetch_array($result1);
			$row2 = mysqli_fetch_array($result2);
			//echo $row[];
		
			$confirmed = $row1[0];
			$admin = $row2[0];
			
			
			if($confirmed == 1){

	//}
	//else{
				$fetchedpass = $row[0];			

				//echo "fetched password: $fetchedpass <br> <br>";
		
				//decrypted_txt is decrypted password (result)
				//$decrypted_txt = encrypt_decrypt('decrypt', $fetchedpass);	

				//echo "decrypted_txt: $decrypted_txt <br> <br>";

				//check if decrypted_txt == password
				if($fetchedpass == $password){
		
					if ($admin == 1) {
						$_SESSION["type"] = "Admin";
					
					}
					else {
						$_SESSION["type"] = "Creator";
					}

					//echo "username: ".$username."<br>";
 
					$_SESSION['username'] = $username;
					echo "Login Successful.";
					
					
		
					
				}
				else{
					echo "Invalid Username and/or Password.";
				}
			}
			else{
				echo "Invalid Username and/or Password.";
			}
		}

   	 }
}

?>


<html>
<title>Login</title>
<body>
<h1>Login</h1>
<form method="post" action="login.php">
    
        <label for="username">Username</label>
        <input type="text" name="username" id="username"> <br> <br>
   
        <label for="password">Password</label>
        <input type="password" name="password" id="password"> <br> <br>
   
	<input type="submit" name="register-submit" value="Login">
	<input type="submit" name="Logout" value="logout"/>
	<form action="index1.php" method="post">
			<input type="submit" value="Return to Calendar"/>
	</form>
</form>
</body>
</html>

