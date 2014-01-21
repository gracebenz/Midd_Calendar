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
		<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
		<title>Event Entry</title>
		
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

		<!--time widget-->
		

        <link rel="stylesheet" type="text/css" href="jquery.ptTimeSelect.css" />
        <script type="text/javascript" src="jquery.ptTimeSelect.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"></script>
        <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		
    	<script type="text/javascript">
        $(document).ready(function(){
            $('input[name="startEventTime"]').ptTimeSelect();
        });
    	</script>
		<!---->	
	</head>

	<body>
		<h2>Create an Event</h2>
	
		<form action="storeEvent.php" method="post">
		EID: <input type="text" name="EID" required/><br><br>
		Event name: <input type="text" name="eventName" required/><br><br>
		Date: <input type="text" id="datepicker" name="eventDate" maxlength="10" required/><br><br>
		Start Time: <input type="text" name="startEventTime" required/><br><br>
		End Time: <input type="text" name="endEventTime" required/><br><br>
		Location: <input type="text" name="eventLocation" required/><br><br>
		Do you have this location reserved?:<br>
			<input type="radio" name="locationAppr" value="approved"/>Yes
			<input type="radio" name="locationAppr" value="not approved"/>No<br><br>	
		Organization: <input type="text" name="eventOrganization" required/><br><br>

		Description: <br><textarea name="eventDescription" rows="5" cols="40" maxlength="200"></textarea><br><br>

		
		<h3>Tags</h3>
		
		<div>
		<h4>Athletics</h4>
		<input type="checkbox" name="tag" value="mens"/>Men's<br>
		<input type="checkbox" name="tag" value="womens"/>Women's<br>
		<input type="checkbox" name="tag" value="varsity"/>Varsity<br>
		<input type="checkbox" name="tag" value="jv"/>JV<br>
		<input type="checkbox" name="tag" value="baseball"/>Baseball<br>
		<input type="checkbox" name="tag" value="basketball"/>Basketball<br>
		<input type="checkbox" name="tag" value="crossCountry"/>Cross Country<br>
		<input type="checkbox" name="tag" value="football"/>Football<br>
		<input type="checkbox" name="tag" value="frisbee"/>Frisbee<br>
		<input type="checkbox" name="tag" value="golf"/>Golf<br>
		<input type="checkbox" name="tag" value="hockey"/>Hockey<br>
		<input type="checkbox" name="tag" value="intramural"/>Intramural<br>
		<input type="checkbox" name="tag" value="paddleball"/>Paddleball<br>
		<input type="checkbox" name="tag" value="quidditch"/>Quidditch<br>
		<input type="checkbox" name="tag" value="alpine"/>Skiing, alpine<br>
		<input type="checkbox" name="tag" value="nordic"/>Skiing, nordic<br>
		<input type="checkbox" name="tag" value="soccer"/>Soccer<br>
		<input type="checkbox" name="tag" value="softball"/>Softball<br>
		<input type="checkbox" name="tag" value="tennis"/>Tennis<br>
		<input type="checkbox" name="tag" value="track"/>Track<br>
		<input type="checkbox" name="tag" value="waterPolo"/>Water Polo<br><br>
		</div>
		
		<div>
		<h4>Activities</h4>
		<input type="checkbox" name="tag" value="climbing"/>Climbing<br>
		<input type="checkbox" name="tag" value="hiking"/>Hiking<br>
		<input type="checkbox" name="tag" value="outdoors"/>Outdoors<br>
		<input type="checkbox" name="tag" value="screening"/>Screening<br>
		<input type="checkbox" name="tag" value="spinning"/>Spinning<br>
		<input type="checkbox" name="tag" value="yoga"/>Yoga<br>
		<input type="checkbox" name="tag" value="zumba"/>Zumba<br><br>
		</div>
		
		<div>
		<h4>Arts / Performance</h4>
		<input type="checkbox" name="tag" value="acapella"/>A capella<br>
		<input type="checkbox" name="tag" value="band"/>Band<br>
		<input type="checkbox" name="tag" value="ceramics"/>Ceramics<br>
		<input type="checkbox" name="tag" value="choir"/>Choir<br>
		<input type="checkbox" name="tag" value="concert"/>Concert<br>
		<input type="checkbox" name="tag" value="dance"/>Dance<br>
		<input type="checkbox" name="tag" value="drawing"/>Drawing<br>
		<input type="checkbox" name="tag" value="film"/>Film<br>
		<input type="checkbox" name="tag" value="gallery"/>Gallery<br>
		<input type="checkbox" name="tag" value="live"/>Live<br>
		<input type="checkbox" name="tag" value="music"/>Music<br>
		<input type="checkbox" name="tag" value="musical"/>Musical<br>
		<input type="checkbox" name="tag" value="orchestra"/>Skiing, nordic<br>
		<input type="checkbox" name="tag" value="painting"/>Painting<br>
		<input type="checkbox" name="tag" value="piano"/>Piano<br>
		<input type="checkbox" name="tag" value="poetry"/>Poetry / spoken word<br>
		<input type="checkbox" name="tag" value="theater"/>Theater<br>
		<input type="checkbox" name="tag" value="track"/>Track<br><br>
		</div>
		
		<div>
		<h4>Other</h4>
		<input type="checkbox" name="tag" value="animals"/>Animals<br>
		<input type="checkbox" name="tag" value="career"/>Career<br>
		<input type="checkbox" name="tag" value="comedy"/>Comedy / improv<br>
		<input type="checkbox" name="tag" value="cultural"/>Cultural<br>
		<input type="checkbox" name="tag" value="food"/>Food<br>
		<input type="checkbox" name="tag" value="gluten"/>Gluten-free<br>
		<input type="checkbox" name="tag" value="internship"/>Internship<br>
		<input type="checkbox" name="tag" value="lecture"/>Lecture<br>
		<input type="checkbox" name="tag" value="lgbt"/>LGBT<br>
		<input type="checkbox" name="tag" value="nightlife"/>Nightlife<br>
		<input type="checkbox" name="tag" value="plusone"/>Plus-one<br>
		<input type="checkbox" name="tag" value="recruiting"/>Recruiting<br><br>
		<input type="checkbox" name="tag" value="religion"/>Religion<br>
		<input type="checkbox" name="tag" value="science"/>Science<br>
		<input type="checkbox" name="tag" value="singles"/>Singles<br>
		</div>
		
		<input type="submit" value="Submit"/>
		</form>
	</body>

</html>
