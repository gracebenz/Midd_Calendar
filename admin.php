<?php

define('DB_SERVER','panther.cs.middlebury.edu');
define('DB_USERNAME','khihuac');
define('DB_PASSWORD','12345abcde');

define('DB_DATABASE','khihuac_Calendar');

$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");

$sql = "SELECT EID 
FROM Events
WHERE Approved = 0";

$retval = mysqli_query($sql, $);


?>

<html>
<title>Admin</title>
<body>

<form action = "admin.php" method = "post">
<input type = "submit" name = "approve" value = "Approve">
<input type = "submit" name = "approve" value = "REJECT!">


</body>
</html>
