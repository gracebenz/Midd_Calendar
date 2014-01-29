<?php
	session_start();
?>
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
define('DB_SERVER','panther.cs.middlebury.edu');
define('DB_USERNAME','khihuac');
define('DB_PASSWORD','12345abcde');

define('DB_DATABASE','khihuac_Calendar');

$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");


if(isset($_POST['register-submit']))
	{
  	$username = $mysqli->real_escape_string($_POST['username']);
	$password = $mysqli->real_escape_string($_POST['password']);
	 	
	//encrypt the password
    	$encrpass = encrypt_decrypt('encrypt', $password);

		
	//get the row corresponding to this user
   	$sql = "SELECT Password FROM Creators WHERE Username ='".$username."'";
	$sql1 = "SELECT Confirmed FROM Creators WHERE Username ='".$username."'";
	$sql2 = "SELECT Administrator FROM Creators WHERE Username ='".$username."'";
    	 
	if (!mysqli_query($mysqli, $sql) || !mysqli_query($mysqli, $sql1))
		{ 		
		die('Error: ' . mysqli_error($mysqli));
		}
	else
		{
		//result will be rows corresponding to this user
		$result = mysqli_query($mysqli,$sql);	
		$result1 = mysqli_query($mysqli,$sql1);
		$result2 = mysqli_query($mysqli,$sql2);
	
		//row will be single row for this result
		$row = mysqli_fetch_array($result);
		$row1 = mysqli_fetch_array($result1);
		$row2 = mysqli_fetch_array($result2);
	
		$confirmed = $row1[0];
		$admin = $row2[0];

		if($confirmed == 1)
			{
			$fetchedpass = $row[0];
						
			if($fetchedpass == $encrpass)
				{
				if ($admin == 1){
					$_SESSION["type"] = "Admin";
				
				}
				else{
					$_SESSION["type"] = "Creator";
				}
					$_SESSION['username'] = $username;
					echo "Login Successful.";
				}
			else
				{
				echo "Invalid Username and/or Password.";
				}
			}
		else
			{
			echo "Invalid Username and/or Password.";
			}
		}
	}
?>
<!doctype html>
<html lang="en-US">
<head>
	<!-- calendar widget 
  <meta charset="utf-8">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
--> 

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>


  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>Midd Calendar</title>

  <link rel="stylesheet" type="text/css" media="all" href="styles.css">
  <!--<script type="text/javascript" src="js/jquery.js"></script>-->
</head>

<body>



<div id="loginFields">
	<form method="post" action="index1.php">
    
        <label for="username"></label>
        <input type="text" name="username" id="username" placeholder="username" required />
   
        <label for="password"></label>
        <input type="password" name="password" id="password" placeholder="password" required/>
   
		<input type="submit" name="register-submit" value="Login">
		<input type="submit" name="Logout" value="logout"/>
		
	</form>
</div>

<div id="searchHeader">
	
	<div id="logoutButton">
		<a href="logout.php">Sign out</a>
	</div>
	
	<div id="createEventButton">
		<a href="entry.php">Create an event</a>
	</div>
	
	<div id="signupButton">
		<a href="signup.php">Sign up</a>
	</div>
</div>


<?php
$weekday = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
$monthName = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
$month = date(m);
if ($month < 10)
	$month = substr($month, 1, 2);
?>

<div class="container">
	<h1>Middlebury Events Calendar</h1>
	<h3><?php echo $weekday[date(w)].", ".$monthName[$month - 1]." ".date(d).", 20".date(y)."<br>";?></h3>
</div>

	
	<div id="searchBar">
		<form id="search" method="post" action="search.php">
			<input type="text" class="textinput" name="searchInput" size="21" maxlength="120">
			<input type="submit" value="search" class="button">
		</form>
		<div class="clear"></div>
		<br>
	</div>	
	

<div id="main" class = "container">
<div id="main1" class="container">
	<div class="main_image">
		<?php
		if (date(n) 
		<img src="images/chateau.jpg" alt="- banner1" />
		<div class="desc">
			<div class="block">
				<h2>Events at Middlebury</h2>
			</div>
		</div>
	</div>
</div>

<div id="main2" class="container">
	<div class="image_thumb">
		<ul>
			<?php 
			define('DB_SERVER', 'panther.cs.middlebury.edu');
			define('DB_USERNAME', 'khihuac');
			define('DB_PASSWORD', '12345abcde');
			define('DB_DATABASE', 'khihuac_Calendar');

			$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");

			?>
				<!-- calendar widget --> 
			<div class="calendar">
			<form action="index1.php" method="post">
   			<p>Search by Date: <input type="text" id="datepicker" name="searchDate">
   			
   				<input type="submit" value="search" class="button">
   			</form>
   			</p>
   			 
			<script>
			$( "#datepicker" ).datepicker();
			</script>
			
			
			
			<?php
			$searchDate = $_POST[searchDate]; 
			echo $earchDate;
			?>
			
			Events for: <?php echo $searchDate;?>
						
			<?php 
			
			if (searchDate== NULL) {
				$searchDate = date(m)."/".date(d)."/20".date(y); //store as a variable for use in the sql query
			}
			
			$hour=0;
			$count=1;
			while ($hour < 25) {
				$sql = "SELECT Name, StartTime, EndTime, EID, Description FROM Events WHERE Date='".$searchDate."'";
				
				if (!mysqli_query($con, $sql)) {
					die('Error: ' . mysqli_error());
				} else {
					$result_today = mysqli_query($con, $sql);
				}
				while($row = mysqli_fetch_array($result_today)) {
					if (substr($row[StartTime], 6, 8) == 'PM') {
	   					$sTime = substr($row[StartTime], 0, 2) + 12;
	   				} else {
	   					$sTime = substr($row[StartTime], 0, 2);
	   				}
	   				
	   				if (($sTime >= $hour) and ($sTime < ($hour+1))){
	   					//only print the hour the first time, and only if there are events in that hour
	   					if ($displayHour == true) {
	   						echo "<br>".$printHour."<br>";
	   						$displayHour = false;
	   					}
	   					
	   					//if ($row[Approved] == 1) {
						?>
							<li>
							<a href="images/banner<?php echo $count;?>.png"><img src="images/calendar-icon.jpg" alt="Luigi Mansion" /></a>
							<div class="block">
							
							<h2><a href="showEvent.php?EID=<?php echo $row[EID];?>"><?php echo $row[Name];?></a></h2>
							<small><?php echo $row[StartTime]." - ";echo $row[EndTime];?></small>
							<p><?php echo $row[Description];?><br/></p>
							</div>
							</li><?php
						//}
							
					$count++;					
					}
				}

			$hour++;
			}
			
			mysqli_close($con);
		?>

		</ul>

	</div>
</div>
</div>



<script type="text/javascript">
var intervalId;
var slidetime = 5000; // milliseconds between automatic transitions

$(document).ready(function() {	

  // Comment out this line to disable auto-play
	intervalID = setInterval(cycleImage, slidetime);

	$(".main_image .desc").show(); // Show Banner
	$(".main_image .block").animate({ opacity: 0.85 }, 1 ); // Set Opacity

	// Click and Hover events for thumbnail list
	$(".image_thumb ul li:first").addClass('active'); 
	$(".image_thumb ul li").click(function(){ 
		// Set Variables
		var imgAlt = $(this).find('img').attr("alt"); //  Get Alt Tag of Image
		var imgTitle = $(this).find('a').attr("href"); // Get Main Image URL
		var imgDesc = $(this).find('.block').html(); 	//  Get HTML of block
		var imgDescHeight = $(".main_image").find('.block').height();	// Calculate height of block	
		
		if ($(this).is(".active")) {  // If it's already active, then...
			return false; // Don't click through
		} else {
			// Animate the Teaser				
			$(".main_image .block").animate({ opacity: 0, marginBottom: -imgDescHeight }, 250 , function() {
				$(".main_image .block").html(imgDesc).animate({ opacity: 0.85,	marginBottom: "0" }, 250 );
				$(".main_image img").attr({ src: imgTitle , alt: imgAlt});
			});
		}
		
		$(".image_thumb ul li").removeClass('active'); // Remove class of 'active' on all lists
		$(this).addClass('active');  // add class of 'active' on this list only
		return false;
		
	}) .hover(function(){
		$(this).addClass('hover');
		}, function() {
		$(this).removeClass('hover');
	});
			
	// Toggle Teaser
	$("a.collapse").click(function(){
		$(".main_image .block").slideToggle();
		$("a.collapse").toggleClass("show");
	});
	
	// Function to autoplay cycling of images
	// Source: http://stackoverflow.com/a/9259171/477958
	function cycleImage(){
    var onLastLi = $(".image_thumb ul li:last").hasClass("active");       
    var currentImage = $(".image_thumb ul li.active");
    
    
    if(onLastLi){
      var nextImage = $(".image_thumb ul li:first");
    } else {
      var nextImage = $(".image_thumb ul li.active").next();
    }
    
    $(currentImage).removeClass("active");
    $(nextImage).addClass("active");
    
		// Duplicate code for animation
		var imgAlt = $(nextImage).find('img').attr("alt");
		var imgTitle = $(nextImage).find('a').attr("href");
		var imgDesc = $(nextImage).find('.block').html();
		var imgDescHeight = $(".main_image").find('.block').height();
					
		$(".main_image .block").animate({ opacity: 0, marginBottom: -imgDescHeight }, 250 , function() {
      $(".main_image .block").html(imgDesc).animate({ opacity: 0.85,	marginBottom: "0" }, 250 );
      $(".main_image img").attr({ src: imgTitle , alt: imgAlt});
		});
  };
	
});// Close Function
</script>
</body>
</html>
