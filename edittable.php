<?php
session_start();
$car = $_GET['carID'];

$uid = $_SESSION['id'];
$idcar =$_POST['idcar'];
$carmake = $_POST['make'];
       $carmodel = $_POST['model'];
       $carprice = $_POST['price'];
       $carquantity = $_POST['quantity'];

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

<link rel="stylesheet" type="text/css" href="loginstyle.css">

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

<h1>Edit Car Details</h1>




<?php
if (!isset($_SESSION['admin'])){
	//go away!!
	header('Location: Login.php');
}
else if($_SESSION['admin'] != 1){
  header('Location: index.php');

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



    $query = $db->prepare ("SELECT * FROM cars WHERE carID = :carID");
    $query->bindParam(':carID', $_GET['carID']);
    
    $query->execute();
    $result = $query->fetch();
    

       $cid = $result["carID"];
       $make = $result["make"];
       $model = $result["model"];
       $price = $result["costPD"];
       $quantity = $result["quantity"];
   
       

//$result = $query->fetch();
//$conn->close();

if (!empty($carmake))
{
 $query = $db->prepare("UPDATE cars SET make =:make, model = :model, costPD = :price, quantity = :quantity WHERE carID= :carID ");
$query->bindParam(':carID', $idcar);
$query->bindParam(':make', $carmake);
$query->bindParam(':model', $carmodel);
$query->bindParam(':price', $carprice);
$query->bindParam(':quantity', $carquantity);
$result = $query->execute();

if($result){
      //print_r( $_POST );
      echo 'Car details have been updated.';
    } else {
  }

}



}


?>

<form id="form" name="Update"  action="edittable.php" method="POST">
  
  <input id="idcar" type="hidden" name="idcar" value="<?= $cid; ?>"/>

  <label for 'carmake'>Make: </label>
  <input id="make" type="text" name="make" value= "<?= $make?>" />
  <br/>
  
  <label for 'carmodel'>Model: </label>
  <input id="model" type="text" name="model" value= "<?= $model; ?>" />
  <br/>

  <label for 'price'>Price: </label>
  <input id="price" type="text" name="price" value= "<?= $price; ?>" />
  <br/>
  
  <label for 'quantity'>Quantity: </label>
  <input id="quantity" type="text" name="quantity" value= "<?= $quantity; ?>" />
  <br/>


  <br/>
  <button id= "submit" type="submit" class="btn btn-primary">Submit</button>
  <br/>

</form>

<form id="form" name="Update"  action="delete.php" method="POST">
<input id="idcar" type="hidden" name="idcar" value="<?= $car; ?>"/>

 <button name="delete" type="submit" class="btn btn-danger">Delete</button>
  <br/>
</form>


</body>
