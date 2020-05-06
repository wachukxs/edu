<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Online Quiz  - Result </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../bootstrap.min.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
include("header.php");
include("database.php");
extract($_SESSION);
$rs=mysqli_query($con, "select t.test_name,t.total_que,r.test_date,r.score from mst_test t, mst_result r where t.test_id=r.test_id and r.login='$login'") or die(mysqli_error($rs));

echo "<div class='container'>";

echo "<div class='panel panel-default'>
  <div class='panel-heading'>";

echo "<h1> Result </h1>";
echo "</div>	<div class='panel-body'>";
if(mysqli_num_rows($rs)<1)
{
	echo "<br><br><h1 class=head1> You have not given any quiz</h1>";
	exit;
}
echo "<table class='table table-hover'><thead>
      <tr>
        <th>Test Name</th>
        <th>Total Question</th>
        <th>Score</th>
      </tr>
    </thead> <tbody>";
while($row=mysqli_fetch_row($rs))
{
echo "<tr><td>$row[0] </td><td > $row[1] <td/>$row[3] </tr>";
}
echo "</tbody> </table>";

echo "</div>
			</div>";

echo "</div>";
?>
</body>
</html>
