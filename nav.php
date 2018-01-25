<?php

session_start();

?>

<html>

<head>
  <!--<link rel="stylesheet" type="text/css" href="userareastyle.css">-->
  <!--<link rel="stylesheet" type="text/css" href="loginstyle.css">-->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!--<meta name="viewport" content="width=device-width, initial-scale=1"> -->

</head>

<body>
<nav class="navbar navbar-inverse">
<div class="container-fluid">

<div class= "navbar-header">
<ul class= "nav navbar-nav">
  <li><a href="index.php" class="active">Home</a></li>
  <li><a href="Myrentals.php">My Rentals</a></li>
  <li><a href="Editinfo.php">Edit Information</a></li>
</ul>
</div>

<ul class="nav navbar-nav navbar-right">

  <li><a href="#"><span class="glyphicon glyphicon-user"></span>Welcome <?php echo $_SESSION['user']; ?></a></li>
  <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
</ul>


</div>
</nav>
</body>
</html>

<?php


if (!isset($_SESSION['user'])){
	//go away!!
	header('Location: Login.php');
}
else {
    //echo "<li><span class=\"glyphicon glyphicon-user\"></span>Welcome Back, ". $_SESSION['user']. "</li>";
}

?>