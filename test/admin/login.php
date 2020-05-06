<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Adminstrative AreaOnline Quiz </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../quiz.css" rel="stylesheet" type="text/css">
<script src="../../jquery.min.js" charset="utf-8"></script>
<script src="../../bootstrap.min.js" charset="utf-8"></script>
<link href="../../bootstrap.min.css" rel="stylesheet" type="text/css">



</head>

<?php
include("header.php");
extract($_POST);
if(isset($submit))
{
	include("../database.php");
	$rs=mysqli_query($con ,"select * from mst_admin where loginid='$loginid' and pass='$pass'") or die(mysql_error());
	if(mysqli_num_rows($rs)<1)
	{
		echo "<BR><BR><BR><BR><div class=head1> Invalid User Name or Password<div>";
		exit;
	}
	$_SESSION['alogin']="true";
}
else if(!isset($_SESSION['alogin']))
{
	echo "<BR><BR><BR><BR><div class=head1> Your are not logged in<br> Please <a href=index.php>Login</a><div>";
		exit;
}
?>
<body>



				<div class="container">
					<div class="panel panel-default">
					<div class="panel-heading"><p class="head1">Welcome to Admistrative Area </p></div>
					<div class="panel-body">

						<p align="center" class="style7"><a href="subadd.php">Add Subject</a></p>
						<p align="center" class="style7"><a href="testadd.php">Add Test</a></p>
						<p align="center" class="style7"><a href="questionadd.php">Add Question </a></p>
						<p align="center" class="head1">&nbsp;</p>

					</div>
				</div>
				</div>


</body>
</html>
