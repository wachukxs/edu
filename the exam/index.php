<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Welcome to Test Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="quiz.css" rel="stylesheet" type="text/css">
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
		$found="N";
	}
	else
	{
		$_SESSION['login']=$loginid;
	}
}
if (isset($_SESSION['login']))
{
echo "<h1 class='style8' align=center>Welcome to Online Exam</h1>";
		echo '<table width="28%"  border="0" align="center">
  <tr>
    <td width="7%" height="65" valign="bottom"><img src="image/HLPBUTT2.JPG" width="50" height="50" align="middle"></td>
    <td width="93%" valign="bottom" bordercolor="#0000FF"> <a href="sublist.php" class="style4">Subject for Quiz </a></td>
  </tr>
  <tr>
    <td height="58" valign="bottom"><img src="image/DEGREE.JPG" width="43" height="43" align="absmiddle"></td>
    <td valign="bottom"> <a href="result.php" class="style4">Result </a></td>
  </tr>
</table>';

		exit;


}


?>
<div align="center" class="style1">User Login </div>

    <form name="form1" method="post" action="">
    Login ID <input name="loginid" type="text" id="loginid2"></td>
    <span class="style2">Password</span><input name="pass" type="password" id="pass2">
		<span class="errors">
            <?php
		  if(isset($found))
		  {
		  	echo "Invalid Username or Password";
		  }
		  ?>
          </span>
          <div colspan=2 align=center class="errors">
		  <input name="submit" type="submit" id="submit" value="Login">		  </div>
<div align="center"><span class="style4">New User ? <a href="signup.php">Signup Free</a></span></div>


    </form>

</body>
</html>
