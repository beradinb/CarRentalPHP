<?php

include("nav.php");
$car = $_GET['carID'];
$uid = $_SESSION['id'];
$price = $_POST['price'];


?>


<?php
if (!isset($_SESSION['user'])){
	//go away!!
	header('Location: Login.php');
}
else {

require_once 'Config.php';
$db = new PDO('mysql:host=localhost;dbname=DDW', $DB_USERNAME, $DB_PASSWORD);
//$carID = $_GET[ 'carID' ];
$carID = $_POST[ 'carID' ];
	$userID = $_POST[ 'userID' ];
	$puday = $_POST[ 'puday' ];
	$doday = $_POST[ 'doday' ];
  $price = $_POST[ 'price' ];


if (isset($_GET['carID'])) {

    
    $query = $db->prepare ("SELECT * FROM cars WHERE carID = :carID");
    $query->bindParam(':carID', $_GET['carID']);
    
    $query->execute();
    $result = $query->fetch();

    echo "<div class=\"container\">";
    echo "<div class=\"container col-md-8\">";
    echo "<div class=\"page-header\">";
    echo "<h1>Book " .$result["make"]. " " .$result["model"]. "</h1>";
    echo "</div>";

    echo "<div class=\"container\">";
    echo "<dl class=\"dl-horizontal\">";
       echo "<dt scope=\"row\">Car ID</dt>";
       echo "<dd>".$result["carID"]."</dd>";
       echo "<dt scope=\"row\">Car Make</dt>";
       echo "<dd>".$result["make"]."</dd>";
       echo "<dt scope=\"row\">Car Model</dt>";
       echo "<dd>".$result["model"]."</dd>";
       echo "<dt scope=\"row\">Car Cost Per Day/£ </dt>";
       echo "<dd>".$result["costPD"]."</dd>";
       echo "<dt scope=\"row\">Car Quantity</dt>";
       echo "<dd>".$result["quantity"]."</dd>";
   echo "</dl>";
   echo "</div>";




}


//$result = $query->fetch();



}


?>

<head>

<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/themes/smoothness/jquery-ui.css"> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script> 
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script>
 $( document ).ready(function() {
        $('#puday').datepicker({dateFormat: "dd/mm/yy", minDate: +1, maxDate: +29});
        });
</script>
<script>
 $( document ).ready(function() {
        $('#doday').datepicker({dateFormat: "dd/mm/yy", minDate: +2, maxDate: +30});
        });
</script>




</head>

<body>

<form id="form" name="Car" action="confirmbooking.php?" method="GET">
<label>Pick up date: </label>
<input id= "puday" type="text" name="puday" >
</br>

<label>Drop off date: </label>
<input id= "doday" type="text" name="doday">

<input type="hidden" id="carID" name="carID" value="<?= $car; ?>" />
<input type="hidden" id="uID" name="uID" value="<?= $uid; ?>" />
<input type="hidden" id="price" name="price" value="<?= $price; ?>" />

<button id= "submit" type="submit" class="btn btn-primary">Submit</button>

  <br/>
</form>
</body>