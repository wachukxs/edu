<?php
session_start();
if (!isset($_SESSION['alogin']))
{
	echo "<br><h2>You are not Logged On Please Login to Access this Page</h2>";
	echo "<a href=index.php><h3 align=center>Click Here for Login</h3></a>";
	exit();
}
?>
<html>
<head>
<link href="../quiz.css" rel="stylesheet" type="text/css">
<script src="../../jquery.min.js" charset="utf-8"></script>
<script src="../../bootstrap.min.js" charset="utf-8"></script>
<link href="../../bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../quiz.css" rel="stylesheet" type="text/css">
</head>
<?php
require("../database.php");

include("header.php");


echo "<br><h2><div  class=head1>Add Test</div></h2>";

?>
<SCRIPT LANGUAGE="JavaScript">
function check() {
mt=document.form1.testname.value;
if (mt.length<1) {
alert("Please Enter Test Name");
document.form1.testname.focus();
return false;
}
tt=document.form1.totque.value;
if(tt.length<1) {
alert("Please Enter Total Question");
document.form1.totque.value;
return false;
}
return true;
}
</script>

<body>

<form name="form1" method="post" onSubmit="return check();">
  <table width="58%"  border="0" align="center">
    <tr>
      <td width="49%" height="32"><div align="left"><strong>Enter Subject ID </strong></div></td>
      <td width="3%" height="5">
      <td width="48%" height="32"><select name="subid">
<?php
$rs=mysqli_query($con, "Select * from mst_subject order by  sub_name");
	  while($row=mysqli_fetch_array($rs))
{
if($row[0]==$subid)
{
echo "<option value='$row[0]' selected>$row[1]</option>";
}
else
{
echo "<option value='$row[0]'>$row[1]</option>";
}
}
?>
      </select>

    <tr>
        <td height="26"><div align="left"><strong> Enter Test Name </strong></div></td>
        <td>&nbsp;</td>
	  <td><input name="testname" type="text" id="testname"></td>
    </tr>
    <tr>
      <td height="26"><div align="left"><strong>Enter Total Question </strong></div></td>
      <td>&nbsp;</td>
      <td><input name="totque" type="text" id="totque"></td>
    </tr>
    <tr>
      <td height="26"></td>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Add" ></td>
    </tr>
  </table>
</form>
<p>&nbsp; </p>
<?php

if (isset($_POST['submit'])) {
	# code...
	if($_POST['submit']=='submit' || strlen($_POST['subid'])>0 )
	{
	extract($_POST);
	mysqli_query($con, "insert into mst_test(sub_id,test_name,total_que) values ('$subid','$testname','$totque')") or die(mysql_error());
	echo "<p align=center>Test <b>\"$testname\"</b> Added Successfully.</p> <br> ";
	unset($_POST);

	echo "<a href='questionadd.php'> ADD QUESTIONS </a>";

	}

}

?>
</body>
</html>
