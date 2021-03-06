<?php
ini_set('display_errors', 'On');
session_start();
	if(isset($_SESSION["dataDump"]))
	{
		$info = $_SESSION["dataDump"];
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
            <li><a href="index.php">Home</a></li>
            <li class="active"><a href="times.php">Stats</a></li>
            <li><a href="logout.php">Reset Data</a>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <!-- Main component for a primary marketing message or call to action -->
			<div class="col-md-6 col-md-offset-3 description">
      <h2 class="mainHeader">Current Stats</h2>
      </div>
      <div class="jumbotron jumbo-small">
        <table class="table table-hover custom-table">
          <thead>
            <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Time Played</th>
            </tr>
          </thead>
          <tbody>
	          <?php
	          if(isset($_SESSION["dataDump"])){
		          for($i = 0; $i < $_SESSION["count"]; $i++){
		          	$fname = "fname$i";
		          	$lname = "lname$i";
		          	$time = "time$i";
		            echo
		            "<tr>
		              <td>$info[$fname]</td>
		              <td>$info[$lname]</td>
		              <td>$info[$time]</td>
		            </tr>";
					}
	          }
	          ?>
          </tbody>
        </table>
      </div>
			<div class="col-md-12">
				<div class="col-md-6">
					<h1 class="mainHeader"> Average Time Played </h1>
					<h2 class="mainHeader">
						<?php
						if(isset($_SESSION["Time Played"]))
						{
							echo $_SESSION["Time Played"] . " Minutes";
						}
						?>
					</h2>
				</div>
				<div class="col-md-6">
					<h1 class="mainHeader"> Standard Deviation </h1>
					<h2 class="mainHeader">
						<?php
						if(isset($_SESSION["SD"]))
						{
							echo $_SESSION["SD"];
						}
						?>
					</h2>
				</div>
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
