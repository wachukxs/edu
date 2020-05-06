<?php
session_start();

if (isset($_SESSION['logged']) && $_SESSION['logged'] == 2) {
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


  <head lang="en">
    <meta charset="utf-8">


    <script>
    //funtion to search the videos from the db, it takes the characters written in the search input field and searches the db
      function showVid(str) {
          if (str.length == 0) {
              document.getElementById("lil").innerHTML = "";
              return;
          } else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                      document.getElementById("lil").innerHTML = xmlhttp.responseText;
                  }
              };
              xmlhttp.open("GET", "getvid.php?q=" + str, true);
              xmlhttp.send();
          }
      }


      //funtion to search the pdf from the db, it takes the characters written in the search input field and searches the db
      function showPDF(str) {
          if (str.length == 0) {
              document.getElementById("lil0").innerHTML = "";
              return;
          } else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                      document.getElementById("lil0").innerHTML = xmlhttp.responseText;
                  }
              };
              xmlhttp.open("GET", "getpdf.php?q=" + str, true);
              xmlhttp.send();
          }
      }

            //funtion to search the pictures from the db, it takes the characters written in the search input field and searches the db
            function showPic(str) {
                if (str.length == 0) {
                    document.getElementById("lil1").innerHTML = "";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("lil1").innerHTML = xmlhttp.responseText;
                        }
                    };
                    xmlhttp.open("GET", "getpic.php?q=" + str, true);
                    xmlhttp.send();
                }
            }
      </script>

        <style>
    div.img {
        margin: 5px;
        border: 1px solid #ccc;
        float: left;
        width: 180px;
    }

    body{

      background-repeat: no-repeat;
    background-position: center;
    margin-right: 20px;
    background-size: cover;
    background-attachment: fixed;

    }

    div.img:hover {
        border: 1px solid #777;
    }

    div.img img {
        width: 100%;
        height: auto;
    }

    div.desc {
        padding: 15px;
        text-align: center;
    }

    #ss{
      width: 320px ;
      height: 240px ;
    }
    </style>

    <script src="jquery.min.js" charset="utf-8"></script>
    <script src="bootstrap.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Students Leran.</title>

    <style media="screen">
    video {
      width: 100%;
      height: auto;
      }
    </style>

  </head>
  <body>

    <?php

     ?>

    <div class="container">



          <div class="page-header">
            <!--<h1 class="">Just Learn.</h1>-->
            <a href="test\index.php"> <button type="button" class="btn btn-primary"> Take a Test </button> </a>
          </div>

          <div class="panel panel-primary">
            <div class="panel-heading">NOTIFICATIONS</div>
            <div class="panel-body">
              <marquee id="not">

                <?php
                #output the notifications that hasn't exipired.
                $out = "" ;
                foreach (mysqli_fetch_all(mysqli_query($con, "SELECT information, deadline FROM assignments WHERE deadline > '".date('Y-m-d')."'")) as $ke) {
                  # code...
                  $out .= $ke[0] . " before " . $ke[1] . " ; ";
                }
                echo $out;
                 ?>

             </marquee>  </div>
          </div>

      <ul class="nav nav-tabs nav-justified">
        <li class="active"><a data-toggle="tab" href="#vid">VIDEOS</a></li>
        <li><a data-toggle="tab" href="#pdf">PDFs</a></li>
        <li><a data-toggle="tab" href="#pic">PICTURES</a></li>
      </ul>
      <!-- the contents of the tabs-->
      <div class="tab-content">
        <div id="vid" class="tab-pane fade in active">

          <h4>Search Videos: <input type="text" onkeyup="showVid(this.value)" name="" value=""></h4>
          <p id="lil"> </p>


          <div class="row">
            <div class="col-sm-8"> <!-- the first section-->

              <div class="jumbotron">
                <h2>Tutorials</h2>
                <div id="asdf">
                  <video controls title="Teaching" id="currentV">
                    <source id="watch" src="uploads/videos/<?php echo mysqli_fetch_all/*SELECT a random video from the db*/(mysqli_query($con, "SELECT name FROM materials WHERE (name LIKE '%.mp4' or name LIKE '%.flv' or name LIKE '%.avi' or name LIKE '%.mkv') LIMIT 1"))[0][0] ; ?>" type="video/mp4">
                    Your browser does not support HTML5 video.
                  </video>
                </div>

              </div>

            </div>
            <div class="col-sm-4"><!-- the second section-->


                <h2>Others.</h2>
                <div class="panel-group">
                  <!--<div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse1">Collapsible panel 1.</a>
                      </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div onclick="set()">
                        <video controls title="Teaching" id="current1">
                          <source src="uploads/videos/What.I.Wasn'tTaughtInSchool.mp4" type="video/mp4">
                          Your browser does not support HTML5 video.
                        </video>
                      </div>
                      <hr>
                      </div>
                      <div class="panel-footer">Panel Footer</div>
                    </div>
                  </div>      just a sample test code-->



                  <?php
                  $inc = 0;

                  foreach (mysqli_fetch_all/*SELECT all the different course codes from the db*/(mysqli_query($con, "SELECT DISTINCT code FROM materials")) as $value) {
                    # code...print a collaspable group panel for the materials of each course code

                    $incc = $inc++ ;
                    echo

                    "<div class='panel panel-default'>".
                      "<div class='panel-heading'>".
                        "<h4 class='panel-title'>".
                          "<a data-toggle='collapse' href='#collapse". $incc ."'>" . $value[0] . "</a>".
                        "</h4>".
                      "</div>".
                      "<div id='collapse". $incc ."' class='panel-collapse collapse'>".
                        "<div class='panel-body'>";
                        /*embeding all the videos for a particular course code in a group*/
/*
                        <div onclick='set()'>
                        <video controls title='Teaching' id='current1'>
                          "<source src='uploads/videos/"  . scandir("uploads/videos/")[++$z] .  "' type='video/mp4'>" --substr("dfhgfd.MP4",strlen("dfhgfd.MP4")-3 ,strlen("dfhgfd.MP4"))
                          Your browser does not support HTML5 video.
                        </video>
                      </div>
                      <hr> ---this is also a test code

*/
                        foreach (mysqli_fetch_all/*SELECT all the different videos for a particular course code in a group from the db*/(mysqli_query($con, "SELECT name FROM materials WHERE code = '$value[0]' AND (name LIKE '%.mp4' or name LIKE '%.flv' or name LIKE '%.avi' or name LIKE '%.mkv')")) as $nw){
                          echo


                                                  "<div onclick='set(this.innerHTML)'>".
                                                  "<video controls title='". $nw[0] ."' id=''>".
                                                    "<source src='uploads/videos/"  . $nw[0] .  "' type='video/".substr($nw[0],strlen($nw[0])-3 ,strlen($nw[0]))."'>".
                                                    "Your browser does not support HTML5 video.".
                                                  "</video>".
                                                "</div>".
                                                "<hr>"

                          ;
                        }


                        echo
                        "</div>".
                        "<div class='panel-footer'> </div>".
                      "</div>".
                    "</div>"

                    ;
                  }



                   ?>

                </div>



            </div>
          </div>


        </div>



        <div id="pdf" class="tab-pane fade">

          <h4>Search PDFs: <input type="text" onkeyup="showPDF(this.value)" name="" value=""></h4>
          <p id="lil0"> </p>


          <?php


            $inc = 0;

          foreach (mysqli_fetch_all/*SELECT all the different course codes from the db*/(mysqli_query($con, "SELECT DISTINCT code FROM materials")) as $valu){
              $incc = $inc++ ;
            # code...print a collaspable group panel for the materials of each course code


            echo

            "<div class='panel panel-default'>".
              "<div class='panel-heading'>".
                "<h4 class='panel-title'>".
                  "<a data-toggle='collapse' href='#collap". $incc ."'>" . $valu[0] . "</a>".
                "</h4>".
              "</div>".
              "<div id='collap". $incc ."' class='panel-collapse collapse'>".
                "<div class='panel-body'>".

                "<ul class='list-group'>"
                ;
                /*embeding all the videos for a particular course code in a group*/
/*
                <div onclick='set()'>
                <video controls title='Teaching' id='current1'>
                  "<source src='uploads/videos/"  . scandir("uploads/videos/")[++$z] .  "' type='video/mp4'>" --substr("dfhgfd.MP4",strlen("dfhgfd.MP4")-3 ,strlen("dfhgfd.MP4"))
                  Your browser does not support HTML5 video.
                </video>
              </div>
              <hr> ---this is also a test code

*/
                foreach (mysqli_fetch_all/*SELECT all the different pdfs for a particular course code in a group from the db*/(mysqli_query($con, "SELECT name FROM materials WHERE code = '$valu[0]' AND (name LIKE '%.pdf')")) as $nww){
                  echo


                                      "<li class='list-group-item'>".
                                            "<a href='uploads/pdfs/"  . $nww[0] . "' >". $nww[0] . " </a>".
                                        "</li>"

                  ;
                }


                echo
                "</ul>".
                "</div>".
              "</div>".
            "</div>"

            ;

          } ?>



        </div>



        <div id="pic" class="tab-pane fade">


          <h4>Search Pictures: <input type="text" onkeyup="showPic(this.value)" name="" value=""></h4>
          <p id="lil1"> </p>


          <div class="panel panel-default">
            <div class="panel-heading">All Pictures ...</div>
            <div class="panel-body">


                        <?php

                          #var_dump(mysqli_fetch_all(mysqli_query($con, "SELECT name from materials WHERE (name LIKE '%.jpg' or name LIKE '%.png' or name LIKE '%.jpeg')"))[0]);

                          foreach (mysqli_fetch_all(mysqli_query($con, "SELECT name from materials WHERE (name LIKE '%.jpg' or name LIKE '%.png' or name LIKE '%.jpeg' or name LIKE '%.gif')")) as $key) {
                            # code...

                            echo

                            "<div class='img'>".
                            "<a target='_blank' href='uploads/pictures/".$key[0]."'>".
                              "<img src='uploads/pictures/". $key[0]."' alt='".$key[0]."' width='300' height='200'>".
                            "</a>".
                            "<div class='desc'>".$key[0]."</div>".
                            "</div>"

                            ;
                          }
                         ?>


            </div>
          </div>


        </div>




      </div>


      <hr>
      <a href="test/signout.php"> <button class="btn btn-default pull-right" type="button" name="button"> out you go </button> </a>
      <br>
      <hr>

    </div>



<script type="text/javascript">
function set(hereToo) {
    document.getElementById('asdf').innerHTML = hereToo ;
  }


</script>

  </body>
</html>
