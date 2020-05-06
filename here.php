<?php
session_start();

if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
  //Do Nothing
} else {
  $redirect = $_SERVER['PHP_SELF'];
  header("Refresh: 3; URL=index.php");
  echo "<h1>First LOGIN !</h2>";
  echo "(But if your browser doesn’t support this, " .
  "<a href=\"index.php\">click here</a>)";
  die();
}

$con=mysqli_connect("localhost","root","","connarts_edu");
$p = mysqli_real_escape_string($con, $_SESSION['password']);
$u = mysqli_real_escape_string($con, $_SESSION['username']);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

        <script src="jquery.min.js" charset="utf-8"></script>
        <script src="bootstrap.min.js" charset="utf-8"></script>
        <link rel="stylesheet" href="bootstrap.min.css">

    <title>And You're Here.</title>
  </head>
  <body>






    <div class="container">
      <div class="jumbotron">
        <h2>Teach. Direct.</h2>
        <p>

          <form name="classmaterials" enctype="multipart/form-data" action="here.php" method="POST">

              <label for="title">Course Title for the uploaded material:</label> <input type="text" name="title" value="">
              <br><br>
              <label for="code">Course Code for the uploaded material:</label> <input type="text" name="code" value="">
              <br><br>
              <label for="units">Course Unit for the uploaded material:</label>
              <input type="radio" name="units" value="1" checked> 1 Unit
              <input type="radio" name="units" value="2"> 2 Units
              <input type="radio" name="units" value="3"> 3 Units
              <input type="radio" name="units" value="4"> 4 Units
              <input type="radio" name="units" value="5"> 5 Units
              <br><br>
              <input type="hidden" name="MAX_FILE_SIZE" value="70000000">
             <input name="uploads" type="file" multiple="true" accept="file_extension|audio/*|video/*|image/*|media_type,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
             <br>
             <input type="submit" value="Upload" >
             <hr/>

          </form>

          <form class="" action="here.php" method="post">
            <label for="noti"> Notifications: </label>
            <br>
            <textarea name="noti" rows="4" cols="80"></textarea>
            <br>
            <input type="date" name="date" value="">
            <br>
            <input  type="submit" name="dd" value="Notify">
          </form>

        </p>
      </div>


      <p><button type="button" name="button"> <a href="logout.php"> out you go </a> </button> | <button type="button" name="button"> <a href="test/admin/index.php"> manage questions </a> </button> | Upload study materials and drop assignments or any important news if need be.</p>
    </div>
  </body>

  <?php
#for dealing with dealines and notifications
  if (isset($_POST['dd'])) {
    # code...
    if (mysqli_query($con, "INSERT INTO assignments (deadline, information) VALUES ('".$_POST['date']."', '".$_POST['noti']."')" )) {
      # code...
      echo "<script>alert('Done!!!!');</script>";
    }
  }
   ?>
  <?php
#for dealing with the uploaded materials
  define ("FILEPICs","C:\\xampp\\htdocs\\nubi\\uploads\\pictures\\");
    define ("FILEVIDs","C:\\xampp\\htdocs\\nubi\\uploads\\videos\\");
      define ("FILEPDFs","C:\\xampp\\htdocs\\nubi\\uploads\\pdfs\\");

  if (!empty($_FILES['uploads'])) {
    # code...
    $realname =  strtolower(preg_replace("/'/","_",$_FILES['uploads']['name'])) ;
    echo "You uploaded \"".$realname."\""  ;
    echo "of type " . $_FILES['uploads']['type'];

    if ($_FILES['uploads']['error'] !== UPLOAD_ERR_OK ) {
      # code...
      if ($_FILES['uploads']['error'] == 2) {
        echo "An error occcured. ERROR CODE: " . $_FILES['uploads']['error'] . "  an attempt to upload a file whose size exceeds the value of the MAX_FILE_SIZE directive in HTML Form.\n";
      } elseif ($_FILES['uploads']['error'] == 3) {
        echo "An error occcured. ERROR CODE: " . $_FILES['uploads']['error'] . " file was not completely uploaded.\n";
      } elseif ($_FILES['uploads']['error'] == 4){
        echo "An error occcured. ERROR CODE: " . $_FILES['uploads']['error'] . " user submits the form without specifying a file for upload.\n";
      }elseif ($_FILES['uploads']['error'] == 1) {
        echo "An error occcured. ERROR CODE: " . $_FILES['uploads']['error'] . " an attempt to upload a file whose size exceeds the value specified by the upload_max_filesize directive.\n";
      }

      exit;

    }

# this function---preg_replace("'","_",preg_replace("'","_",$_FILES['uploads']['name']))--- removes the apostrophe from the names n replaces it with underscore, this prevents mess up in loading files for the students
    #verify file type as image, pdf or video and store appropraitely
    $picArrTypes = array("video/mp4" , "video/flv" , "video/mkv" , "video/avi");
    $imgArrTypes = array("image/png" , "image/jpg" , "image/jpeg" , "image/gif");

    if ( in_array($_FILES['uploads']['type'], $picArrTypes) ) {
      # code...

      if (move_uploaded_file($_FILES['uploads']['tmp_name'], FILEVIDs . $realname)) {
        # code...moved uploaded files
        if (mysqli_query($con, "INSERT INTO materials (name, code, title, units) VALUES (\"".$realname."\", \"".$_POST['code']."\",\"".$_POST['title']."\",\"".$_POST['units']."\")")) {
          # code...details saved in db
        } else {
          # code...nahh, details didn't save in db
          echo "<script>alert(\"Details didn't save in the database.\");</script>";
        }
        echo " Done. Moved video file.\n";
      } else {
        echo "Nope. Unmoved.\n";
      }
    }

    else if ($_FILES['uploads']['type'] == "application/pdf") {
      # code...
      if (move_uploaded_file($_FILES['uploads']['tmp_name'], FILEPDFs . $realname)) {
        # code...moved uploaded files
        if (mysqli_query($con, "INSERT INTO materials (name, code, title, units) VALUES (\"".$realname."\", \"".$_POST['code']."\",\"".$_POST['title']."\",\"".$_POST['units']."\")")) {
          # code...details saved in db
        } else {
          # code...nahh, details didn't save in db
          echo "<script>alert(\"Details didn't save in the database.\");</script>";
        }
        echo " Done. Moved pdf file.\n";
      } else {
        echo "Nope. Unmoved.\n";
      }
    }

    else if ( in_array($_FILES['uploads']['type'], $imgArrTypes) ) {
      # code...
      if (move_uploaded_file($_FILES['uploads']['tmp_name'], FILEPICs . $realname)) {
        # code...moved uploaded files
        if (mysqli_query($con, "INSERT INTO materials (name, code, title, units) VALUES (\"".$realname."\", \"".$_POST['code']."\",\"".$_POST['title']."\",\"".$_POST['units']."\")")) {
          # code...details saved in db
        } else {
          # code...nahh, details didn't save in db
          echo "<script>alert(\"Details didn't save in the database.\");</script>";
        }
        echo " Done. Moved picture file.\n";
      } else {
        echo "Nope. Unmoved.\n";
      }
    }

  }
   ?>

</html>
