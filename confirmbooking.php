<?php

include("nav.php");
$car = $_GET['carID'];
$uid = $_SESSION['id'];

?>

<body>

<form id="form" name="Car" action="confirmbooking.php?" method="GET">



</form>

<h1>Confirmed Rentals</h1>

</body>

<?php
require_once 'Config.php';
$db = new PDO('mysql:host=localhost;dbname=DDW', $DB_USERNAME, $DB_PASSWORD);

$query = $db->prepare ("SELECT * FROM cars WHERE carID = :carID");
    $query->bindParam(':carID', $_GET['carID']);
    
    $query->execute();
    $result = $query->fetch();
    $price = $result["costPD"];
    $make = $result["make"];
    $model = $result["model"];

    	$puday= $_GET[ 'puday' ];
        $doday= $_GET[ 'doday' ];
    $query = $db->prepare("INSERT INTO booking ( carID, userID, puday, doday, price) VALUES ( :car, :uid, :puday, :doday, :price)");
    $query->bindParam(':car', $car);
    $query->bindParam(':uid', $uid);
    $query->bindParam(':puday', $puday);
    $query->bindParam(':doday', $doday);
    $query->bindParam(':price', $price);
      $result = $query->execute();

      if($result){
      //print_r( $_POST );
      echo 'Thank you. Rental has been confirmed for '; 
      echo $make; 
      echo ' ';
       echo $model;
       $query = $db->prepare ("SELECT * FROM cars WHERE carID = :carID");
    $query->bindParam(':carID', $car);
    $query->execute();
    $result = $query->fetch();
    $quantity = $result["quantity"];
    $quantity--;
     $query = $db->prepare("UPDATE cars SET quantity = :quantity WHERE carID = :carID");
     $query->bindParam(':carID', $car);
     $query->bindParam(':quantity', $quantity);
     $query->execute();




    } else {
      echo var_dump($result);
      echo $query->fetch();
  }


?>
