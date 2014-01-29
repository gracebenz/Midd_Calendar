<!doctype html>
<html lang="en-US">
<head>

  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>Midd Calenddar</title>

  <link rel="stylesheet" type="text/css" media="all" href="styles.css">
<script type="text/javascript" src="js/jquery.js"></script>
</head>

<body>


<div id="searchHeader">

	<div id="searchBar">
	<form id="search" method="post" action="search.php">
		<input type="text" class="textinput" name="searchInput" size="21" maxlength="120">
		<input type="submit" value="search" class="button">
	</form>
	<div class="clear"></div>
	</div>

	<div id="createButton">
	<form action="entry.php" method="post">
		<input type="submit" value="Create an event"/>
	</form>
	</div>

	<div id="loginButton">
	<form action="creator.php" method="post">
		<input type="submit" value="Create an account"/>
	</form>
	</div>
	
</div>


<div id="everything">
<div class="container">
	<h1>Middlebury Calendar</h1>
</div>
<div id="main" class = "container">
<div id="main1" class="container">
	<div class="main_image">
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

			$weekday = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
			$monthName = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
			$month = date(m);
			if ($month < 10)
				$month = substr($month, 1, 2);
			//echo $weekday[date(w)].", ".$monthName[$month - 1]." ".date(d).", 20".date(y)."<br>";
			
			$date = date(m)."/".date(d)."/20".date(y); //store as a variable for use in the sql query


			$hour=0;
			$count=1;
			while ($hour < 25) {
				$sql = "SELECT Name, StartTime, EndTime, EID, Description FROM Events WHERE Date='".$date."'";
				
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
			?>
						<li>
						<a href="images/banner<?php echo $count;?>.png"><img src="images/banner01_thumb.png" alt="Luigi Mansion" /></a>
						<div class="block">
							
							<h2><a href="showEvent.php?EID=<?php echo $row[EID];?>"><?php echo $row[Name];?></a></h2>
								<small><?php echo $row[StartTime]." - ";echo $row[EndTime];?></small>
					
								<p><?php echo $row[Description];?><br/></p>
						</div>
						</li>
			<?php 	
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
