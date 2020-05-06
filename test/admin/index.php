<?php
session_start()
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Administrative Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../quiz.css" rel="stylesheet" type="text/css">

<script src="../../jquery.min.js" charset="utf-8"></script>
<script src="../../bootstrap.min.js" charset="utf-8"></script>
<link href="../../bootstrap.min.css" rel="stylesheet" type="text/css">

</head>

<body>
<?php
include("header.php");
?>

<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
          <div class="head1">Adminstrative Login </div>
    </div>
      <div class="panel-body">
          <form name="form1" method="post" role-"form" action="login.php">
            <div class="form-group">
              <label for="logidid">Login ID:</label> <input name="loginid" class="form-control" type="text" id="loginid"  value="<?php echo $_SESSION['username'] ; ?>">
            </div>

          <div class="form-group">
              <label for="pass">Password:</label><input  name="pass" type="password" class="form-control" id="pass" value=" <?php echo $_SESSION['password'] ; ?> ">
          </div>

          <input name="submit" type="submit" id="submit" value="Login"> &nbsp; Re-type details
          </form>
        </div>
  </div>
</div>


</body>
</html>
