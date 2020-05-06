<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Welcome to Test Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="quiz.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="../bootstrap.min.css">

</head>

<body>
<?php
include("header.php");
include("database.php");
extract($_POST);

if(isset($submit))
{

	$rs=mysqli_query($con, "SELECT * from mst_user where login='$loginid' and pass='$pass'");
	if(mysqli_num_rows($rs)<1)
	{
		$found = "N" ;
	}
	else
	{
		$_SESSION['login'] = $loginid;
	}
}
if (isset($_SESSION['login']))
{
echo "<h1 >Welcome to Online Exam</h1>";
		echo '
     <a href="sublist.php" class="style4">Subject for Quiz </a>
    <a href="result.php" class="style4">Result </a>
  </tr>
</table>';

		exit;


}


?>


<!-------- -->

		<div class="container">




		<div align="center" class="pull-right">
			<div class="panel panel-default">
				<div class="panel-heading">	<div align="center" class="style1">User Login </div>	</div>
				<div class="panel-body">

					<h4>Sign in here.</h4>

					<form name="form1" role="form" class="" action="" method="post">
						<div class="form-group">
						<label for="username">Login ID :</label> <input placeholder="enter your username" name="loginid" type="text" id="loginid2">

					</div>

					<div class="form-group">
						<label for="pass">Password:</label> <input name="pass" type="password" id="pass2">

					</div>
						<input name="submit" type="submit" id="submit" value="Login">
					</form>


					<hr>

					<div class="well">
						<span class="errors">
										<?php
							if(isset($found))
							{
								echo "Invalid Username or Password";
							}
							?>
									</span>
					</div>


				</div>
			</div>
		</div>


		</div>






</body>
</html>
