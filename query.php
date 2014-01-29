<?php
	$sql = "SELECT $_POST[displayDropdown] from Events";
	
	if (!mysqli_query($con, $sql)) {
		die('Error: ' . mysqli_error());
	} else {
		$result = mysqli_query($con, $sql);
	}
	$col = $_POST[displayDropdown];
	echo $col.":<br>";
	while ($row = mysqli_fetch_array($result)) {
		echo $row[$col]."<br>";
	}
?>