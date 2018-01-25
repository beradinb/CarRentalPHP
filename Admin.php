<?php

session_start();
//include 'edittable.js'; 

?>

<head>
  <!--<link rel="stylesheet" type="text/css" href="userareastyle.css">-->
  <!--<link rel="stylesheet" type="text/css" href="loginstyle.css">-->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</head>

<body>

<nav class="navbar navbar-inverse">
<div class="container-fluid">

<div class= "navbar-header">
<ul class= "nav navbar-nav">
  <li><a href="Admin.php" class="active">Home</a></li>
  <li><a href="adminreg.php">Create Admin User</a></li>
<li><a href="addcar.php">Add Car</a></li>
<!--<li><a href="editadmin.php">Edit Information</a></li>-->
</ul>
</div>

<ul class="nav navbar-nav navbar-right">

  <li><a href="#"><span class="glyphicon glyphicon-king"></span>Welcome <?php echo $_SESSION['user']; ?></a></li>
  <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
</ul>
</div>
</nav>
</body> 


<?php
session_start();


if (!isset($_SESSION['admin'])){
	//go away!!
	header('Location: Login.php');
}
else if($_SESSION['admin'] != true){
  header('Location: index.php');

}
else {
  echo "<h1>Welcome Back, ". $_SESSION['user']. "</h1>";

require_once 'Config.php';
$db = new PDO('mysql:host=localhost;dbname=DDW', $DB_USERNAME, $DB_PASSWORD);


$query = $db->prepare ("SELECT carID, make, model, costPD, quantity FROM cars");
$query->execute();
//$result = $query->fetch();
$count = $query->rowCount();

if ($count > 0) {

echo "<div class=\"container\">";
echo "<div class=\"table-responsive\">";
echo "<table class=\"table table-hover\">";
echo  "<thead>";
echo    "<tr>";
echo      "<th>Car Id</th>";
echo      "<th>Car Make</th>";
echo      "<th>Car Model</th>";
echo      "<th>Car Cost Per Day/£ </th>";
echo      "<th>Quantity</th>";
echo    "</tr>";
echo  "</thead>";

echo  "<tbody>";
     // output data of each row
     while($row = $query->fetch()) {
       echo "<tr onclick=\"document.location='edittable.php?carID=".$row["carID"]."'\" style=\"cursor:hand\" class=\"car\"> ";
       echo "<td>".$row["carID"]."</td>";
       echo "<td>".$row["make"]."</td>";
       echo "<td>".$row["model"]."</td>";
       echo "<td>".$row["costPD"]."</td>";
       echo "<td>".$row["quantity"]."</td>";
       echo "</tr>";
         
     }
echo  "</tbody>";
echo  "</table>";
echo  "</div>";
echo  "</div>";

   
} else {
     echo "0 results";
}




}

?>

