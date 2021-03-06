<?php
ini_set('display_errors', 'On');

if(isset($_POST['submit'])){
  $count = 0;
  $totalTime = 0;
  $e = 0;
  $info = array();


  for($i = 0; $i < 12; $i++)
  {
    if((!empty($_POST["fname$i"])) && (!empty($_POST["lname$i"])) && (!empty($_POST["time$i"])))
    {
      $info["fname$count"] = $_POST["fname$i"];
      $info["lname$count"] = $_POST["lname$i"];
      $info["time$count"] = $_POST["time$i"];
      $totalTime += $_POST["time$i"];

      if($_POST["time$i"] > 40)
      {
        $num = $i + 1;
        $errors[$e] = "Player $num's time played exceeds 40 minutes limit";
        $e++;
      }
      $count++;
    }
    elseif(empty($_POST["fname$i"]) && empty($_POST["lname$i"]) && empty($_POST["time$i"]))
    {
      continue;
    }
    elseif(empty($_POST["fname$i"]) || empty($_POST["lname$i"]) || empty($_POST["time$i"]))
    {
      $num = $i + 1;
      $errorOutput = "Player $num is missing information: ";

      if(empty($_POST["fname$i"]))
        $errorOutput .= "[First Name] ";
      if(empty($_POST["lname$i"]))
        $errorOutput .= "[Last Name] ";
      if(empty($_POST["time$i"]))
        $errorOutput .= "[Time Played] ";

      //echo $errorOutput;
      $errors[$e] = $errorOutput;
      $e++;
    }
  }

  //Check if time exceed 200 Minutes
  if($totalTime > 200)
  {
      $errors[$e] = "Total Time is $totalTime, total time cannot exceed 200 minutes";
      $e++;
  }

  if(empty($errors) && ($count > 0))
  {
    //Calculate average time played
    $averageTime = $totalTime/$count;

    $sd = 0;

    //Calculate the summation
    for($i = 0; $i < $count; $i++)
    {
        $sd = $sd + pow(($info["time$i"]-$averageTime),2);
    }
    //Calcualte the SD
    $sd = sqrt($sd / ($count));

  	session_start();
    $_SESSION["Time Played"] = $averageTime;
    $_SESSION["SD"] = round($sd,2);
  	$_SESSION["count"] = $count;
    $_SESSION["dataDump"] = $info;
    header("Location:times.php");
  }
  if($count == 0 && empty($errors))
  {
  	$errors[0] = "Please fill in at least one record";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>CPSC 431 - BasketBall Stats</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Basketball Stats</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="times.php">Stats</a></li>
            <li><a href="logout.php">Reset Data</a>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <div class="col-md-6 col-md-offset-3">
      <h2 class="mainHeader">Basketball Entry Form</h2>
      </div>
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbo-small">
        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <?php
            if(isset($errors))
            {
              echo "<div class='col-md-9 alert alert-danger'>";
              foreach($errors as $error)
              {
                echo "<small>$error</small><br />";
              }
              echo "</div>";
            }
          ?>
          <?php
          for($i = 0; $i < 12; $i++)
          {
            $t = $i + 1;
            echo "<div class='form-group'>
              <label class='col-md-12'>Player $t</label>
              <div class='col-sm-3'><input type='text' class='form-control' placeholder='First Name' name='fname$i'></div>
              <div class='col-sm-3'><input type='text' class='form-control' placeholder='Last Name' name='lname$i'></div>
              <div class='col-sm-3'><input type='text' class='form-control' placeholder='Time Played' name='time$i'></div>
            </div>";
          }
          ?>
            <button type="submit" class="btn btn-primary " name="submit">Submit</button>
        </form>
      </div>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.js"></script>
  </body>
</html>
