<?php
session_start();
include("nav.php");
$uid = $_SESSION['id'];


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




<?php

if (!isset($_SESSION['user'])){
	//go away!!
	header('Location: Login.php');
}
else {
  //echo 'Welcome Back: ';


require_once 'Config.php';
$db = new PDO('mysql:host=localhost;dbname=DDW', $DB_USERNAME, $DB_PASSWORD);


$query = $db->prepare ("SELECT bookingID, carID, puday, doday, price FROM booking WHERE UserID = :uid");
$query->bindParam(':uid', $uid);
$query->execute();
//$result = $query->fetch();
$count = $query->rowCount();

if ($count > 0) {

echo "<div class=\"container\">";
echo "<div class=\"table-responsive\">";
echo "<table class=\"table table-hover\">";
echo  "<thead>";
echo    "<tr>";
echo      "<th>Booking ID</th>";
echo      "<th>Car ID</th>";
echo      "<th>Pick Up Date </th>";
echo      "<th>Drop Off Date </th>";
echo      "<th>Car Cost Per Day/£ </th>";
echo    "</tr>";
echo  "</thead>";

echo  "<tbody>";
     // output data of each row
     while($row = $query->fetch()) {
       echo "<tr>";
       echo "<td>".$row["bookingID"]."</td>";
       echo "<td>".$row["carID"]."</td>";
       echo "<td>".$row["puday"]."</td>";
       echo "<td>".$row["doday"]."</td>";
       echo "<td>".$row["price"]."</td>";
       echo "</tr>";
         
     }
echo  "</tbody>";
echo  "</table>";
echo  "</div>";
echo  "</div>";

   
} else {
     echo "You do not have any rentals yet.";
}


}

?>