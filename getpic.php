<?php
// Array with names
$con=mysqli_connect("localhost","ossai","ossai","ife");

$a = array();

foreach (mysqli_fetch_all/*SELECT all the different course codes from the db*/(mysqli_query($con, "SELECT DISTINCT code FROM materials"))  as $value){
foreach (mysqli_fetch_all/*SELECT all the different videos for a particular course code in a group from the db*/(mysqli_query($con, "SELECT name FROM materials WHERE code = '$value[0]' AND (name LIKE '%.png' or name LIKE '%.jpg' or name LIKE '%.jpeg' or name LIKE '%.gif')")) as $nw){

  $a[] = $nw[0] ;

}
}

/*
"<div onclick='set(this.innerHTML)'>".
"<video controls title='". $name ."' id=''>".
  "<source src='uploads/videos/"  . $name .  "' type='video/".substr($name,strlen($name)-3 ,strlen($name))."'>".
  "Your browser does not support HTML5 video.".
"</video>".
"</div>"
*/
// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {

              $hint =   "<a target='_blank' href='uploads/pictures/".$name."'>".
                          "<img height='200'  src='uploads/pictures/". $name."' alt='".$name."' >".
                        "</a>".
                        "<div class='desc'>".$name."</div>"
                          ;

                #$hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no suggestion" : $hint;
?>
