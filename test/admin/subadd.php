<?php
session_start();
require("../database.php");
include("header.php");

?>
<head>
	<title>Add Subject</title>
	<link href="../quiz.css" rel="stylesheet" type="text/css">
	<script src="../../jquery.min.js" charset="utf-8"></script>
	<script src="../../bootstrap.min.js" charset="utf-8"></script>
	<link href="../../bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../quiz.css" rel="stylesheet" type="text/css">
</head>

<?php

echo "<BR>";
if (!isset($_SESSION['alogin']))
{
	echo "<br><h2><div  class=head1>You are not Logged On Please Login to Access this Page</div></h2>";
	echo "<a href=index.php><h3 align=center>Click Here for Login</h3></a>";
	exit();
}


?>
<SCRIPT LANGUAGE="JavaScript">
function check() {
mt=document.form1.subname.value;
if (mt.length<1) {
alert("Please Enter Subject Name");
document.form1.subname.focus();
return false;
}
return true;
}
</script>



<form name="form1" method="post" onSubmit="return check();">
  <table width="41%"  border="0" align="center">
    <tr>
      <td width="45%" height="32"><div align="center"><strong>Enter Subject Name </strong></div></td>
      <td width="2%" height="5">
      <td width="53%" height="32">
        <input name="subname" type="text" id="subname">
    <tr>
        <td height="26"> </td>
        <td>&nbsp;</td>
	  <td>&nbsp;</td>
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
	extract($_POST);


	echo "<BR><h3 class=head1>Subject Add </h3>";

	echo "<table width=100%>";
	echo "<tr><td align=center></table>";
	if($submit=='submit' || strlen($subname)>0 )
	{
	$rs=mysqli_query($con,"select * from mst_subject where sub_name='$subname'");
	if (mysqli_num_rows($rs)>0)
	{
		echo "<br><br><br><div class=head1>Subject Already Exists</div>";
		exit;
	}
	mysqli_query($con,"insert into mst_subject(sub_name) values ('$subname')") or die(mysqli_error());
	echo "<p align=center>Subject  <b> \"$subname \"</b> Added Successfully.</p>";
	$submit="";
	}
}
?>
