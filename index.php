<?php
session_start();
ob_start();
$_SESSION['logged'] = 0;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <script src="jquery.min.js" charset="utf-8"></script>
    <script src="bootstrap.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>LEARNING E-SYSTEM FOR CIT </title>
  </head>

  <script type="text/javascript" src="js/jq.js"></script>

  <script type="text/javascript">
  $(document).ready(function() {
      $("body").css("display", "none");

      $("body").fadeIn(4000);

  	$("a.transition").click(function(event){
  		event.preventDefault();
  		linkLocation = this.href;
  		$("body").fadeOut(1000, redirectPage);
  	});

  	function redirectPage() {
  		window.location = linkLocation;
  	}
  });
  </script>




  <style type="text/css">@import 'validation.css';</style>
  <style type="text/css">
  	.button
  	{
  		margin-right:50px;
  		height:30px;
  		width:100px;
  		background-color:#000000;
  		color:#999999;
  		border:#999999 solid 2px;
  		border-radius:10px;
  	}
    input{
      color: black;
    }
  	</style>

  <body background="bg1.jpg">
  <table style="width:100%">

	<tr bgcolor="white">
	<td align="right" colspan="2">

    <form role="form" class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                 <!--<div class="form-group">-->
                 <label for="username">Username:</label> <input type="text" name="username" value="">
               <!--</div>-->

               <!--<div class="form-group">-->
                 <label for="password">Password:</label> <input type="password" name="password" value="">
               <!--</div>-->
                 <input type="submit" name="submit" value="SUBMIT">
      </form>
	</td> </tr>



	<!-- This is for the registration on the homepage-->
	<tr><td style="width:70%">


				<!-- CIT WRITING GOES HERE -->

	</td>
	<td style="width:30%" >
	<font color="white">
	<p> &nbsp; </p>
	<p> &nbsp; </p><p> &nbsp; </p>
	<h2>CIT'S E-LEARNING SYSTEM</h2>
	<marquee effect="alternate" width="300">
	New? Sign Up here
	</marquee>

  <form role="form" class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form-group">
    <label for="Rusername">Username:</label> <input type="text" name="Rusername" placeholder="Enter username" value="">
  </div>

  <div class="form-group">
    <label for="Rpassword">Password:</label> <input type="password" name="Rpassword" placeholder="Enter matric number" value="">
  </div>

  <div class="form-group">
    <label for="Rfullname">Fullname:</label> <input type="text" name="Rfullname" placeholder="Enter fullname" value="">
  </div>


    <input type="submit" name="Rsubmit" value="SUBMIT">
  </form>


	</td>
	</tr>
	</table>
  </body>
</html>


<?php
  $con=mysqli_connect("localhost","root","","connarts_edu");

  if ( (isset($_POST['submit'])) && (!empty($_POST['username'])) && (!empty($_POST['password'])) ) {

    $u = htmlspecialchars($_POST["username"]);

    $p = htmlspecialchars($_POST["password"]);

    if (mysqli_query($con, "SELECT username, password FROM teachers WHERE password = '$p' AND username = '$u'")) {
      # code... check if it was an admin that tried loggining in
      if (mysqli_affected_rows($con) == 0) {
        # code...if it wasn't an admin, it must be a student then
        if (mysqli_query($con, "SELECT username, password FROM students WHERE password = '$p' AND username = '$u'")) {
          # code...if it was a student, log them in
          if (mysqli_affected_rows($con) >= 1) {
            # code...
            ob_clean();
            $_SESSION['logged'] = 2;
            $_SESSION['password'] = $p;
            $_SESSION['username'] = $u;
            header ("Location: where.php");
          }
        } else {
          # code...if it wasn't an admin\student
          echo "<script>alert(\"Wrong Details. Try Again\");</script>";
        }

      } else {
        # code...
        ob_clean();
        $_SESSION['logged'] = 1;
        $_SESSION['password'] = $p;
        $_SESSION['username'] = $u;
        header ("Location: here.php");
      }
    }
  }
  ?>
<!-- for registration -->
<?php
if ( (isset($_POST['Rsubmit'])) && (!empty($_POST['Rusername'])) && (!empty($_POST['Rpassword'])) && (!empty($_POST['Rfullname']))  ) {
  # code...

  $Ru = htmlspecialchars($_POST["Rusername"]);
  $Rf = htmlspecialchars($_POST["Rfullname"]);
  $Rp = htmlspecialchars($_POST["Rpassword"]);

  if (mysqli_query($con, "SELECT username, password FROM students WHERE password = '$Rp' AND username = '$Ru'")) {
    # code...if nobody has taken those details then register them
    if (mysqli_affected_rows($con) == 0) {
      # code...
      mysqli_query($con, "INSERT INTO students (username, password, fullname) VALUES ('$Ru', '$Rp', '$Rf')");


     mysqli_query($con, "INSERT INTO mst_user (login, pass, fullname) VALUES ('$Ru', '$Rp', '$Rf')");

      echo "<script>alert(\"You've been registered. Now Learn.\");</script>";
    }
  }

}

 ?>
