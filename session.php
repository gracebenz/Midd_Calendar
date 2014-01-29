<?php session_start();

// store session data
$_SESSION['type'] = "Guest";
$_SESSION['username'] = "Guest";

header("Location: http://www.cs.middlebury.edu/~khihuac/index1.php");


?>

<html>
<body>



</body>
</html>
