<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Online Quiz - Quiz List</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="quiz.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
include("header.php");
include("database.php");
echo "<h2 > Select Subject to Give Quiz </h2>";
$rs=mysqli_query($con ,"select * from mst_subject");
echo "<ul class='list-group'>";
while($row=mysqli_fetch_row($rs))
{
	echo "<li class='list-group-item'>	<a href=showtest.php?subid=$row[0]>	$row[1]	</a>	</li>";
}
echo "</ul>";
?>
</body>
</html>
