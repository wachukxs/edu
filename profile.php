<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>STUDENT PROFILE</title>

    <style media="screen">
      #myChart{
        height: 500px !important;
        width: auto;
      }
    </style>

    <!---strat-date-piker---->
        <link rel="stylesheet" href="jquery-ui.css" />
        <script src="jquery.min.js"></script>
        <script src="jquery-ui.js"></script>
          <script>
              $(function() {
              $( "#datepicker,#datepicker1" ).datepicker({dateFormat:"yy-mm-dd" });
            });
          </script>
      <!---/End-date-piker---->

      <script src="bootstrap.min.js"></script>
    <link rel="stylesheet" href="bootstrap.min.css" />

  </head>
  <body>
    <div class="container">

<div class="page-header">
  STUDENT PROFILE [ANALYTICS]
</div>
<!--
<form class="" action="profile.php" method="post">
  <div class="form-group">
    <label for="login">Matric Number:</label> <input type="text" name="login" class="form-control" value="">
  </div>

  <div class="form-group">
    <label for="login">Start date:</label> <input id="datepicker1"  name="start_date" class="form-control" value="">
  </div>

  <div class="form-group">
    <label for="login">End date:</label> <input id="datepicker"  name="end_date" class="form-control" value="">
  </div>

  <input type="submit" class="btn btn-default" name="find" value="SUBMIT">
</form>

 -->
<form class="form-inline" role="form">
  <div class="form-group">
    <label for="login">Matric Number:</label> <input type="text" name="login" class="form-control" value="">
  </div>

  <div class="form-group">
    <label for="login">Start date:</label> <input id="datepicker1"  name="start_date" class="form-control" value="">
  </div>

  <div class="form-group">
    <label for="login">End date:</label> <input id="datepicker"  name="end_date" class="form-control" value="">
  </div>

  <input type="submit" class="btn btn-default" name="find" value="SUBMIT">
</form>
<!-- -->
<hr>

<script src="Chart.min.js" charset="utf-8"></script>
<?php

$con = mysqli_connect("localhost", "ossai", "ossai", "quiz" );
$WK1 =  $WK2 = $WK3 = $WK4 = 0 ;
if (isset($_POST['find'])) {

  if (mysqli_query($con, "SELECT login FROM mst_result WHERE test_date >= '".$_POST['start_date']."' AND test_date <= '".$_POST['end_date']."' AND login = '".$_POST['login']."'")) {
    # code...

          $diff7days = new DateInterval('P7D'); $diff14days = new DateInterval('P14D'); $diff21days = new DateInterval('P21D'); $diff30days = new DateInterval('P30D');
            foreach (mysqli_fetch_all(mysqli_query($con, "SELECT login, test_date FROM mst_result WHERE test_date >= '".$_POST['start_date']."' AND test_date <= '".$_POST['end_date']."' AND login = '".$_POST['login']."'")) as $key ) {
              # code...
              $e = new DateTime($key[1]);

              if ( $e < $e->add($diff7days) ) {
                # code...count the number of times in a week
                  $WK1++;
              }
              if ($e < $e->add($diff14days) && $e > $e->add($diff7days) ) {
                # code...count the number of times in 2 week
                  $WK2++;
              }
              if ($e < $e->add($diff21days) && $e > $e->add($diff14days) ) {
                # code...count the number of times in 3 week
                  $WK3++;
              }
              if ($e < $e->add($diff30days) && $e > $e->add($diff21days) ) {
                # code...count the number of times in 4 week
                  $WK4++;
              }


            }
  }
  # code...
}

?>
<?php
$d=strtotime("+1 Week");
$R = date("Y-m-d") ;
echo $R < date($R, $d) ;
?>



      <canvas id="myChart" ></canvas>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
      //  labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        labels: ["WK 1", "WK 2", "WK 3", "WK 4"],
        datasets: [{
            label: 'number of weekly visits per month',
            data: [<?php echo $WK1 ;?>, <?php echo $WK2; ?>, <?php echo $WK3; ?>, <?php echo $WK4 ?>],
          //  data: [41, 34, 15,12],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                },
                stacked: true
            }]
        }
    }
});
</script>

    </div>
  </body>
</html>
