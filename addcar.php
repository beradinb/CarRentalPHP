<?php
session_start();

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

<link rel="stylesheet" type="text/css" href="loginstyle.css">

</head>

<form id="form" name="Car" action="edittable.php?" method="GET">


</form>

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

<h1>Add a New Car</h1>

<form id="form" name="AddCar"  action="addcar.php"  method="POST">
  
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

  <button id= "submit" type="submit" class="btn btn-primary">Add Car</button>
  <br/>

</form>

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

$carmake = $_POST[ 'make' ];
$carmodel = $_POST[ 'model' ];
$carprice = $_POST[ 'price' ];
$carquantity = $_POST[ 'quantity' ];

$query = $db->prepare("INSERT INTO cars (make, model, costPD, quantity) VALUES (:make, :model, :price, :quantity) ");
$query->bindParam(':make', $carmake);
$query->bindParam(':model', $carmodel);
$query->bindParam(':price', $carprice);
$query->bindParam(':quantity', $carquantity);
$result = $query->execute();

if($result){
      //print_r( $_POST );
      echo 'You have just added ';
      echo $carmake;
      echo " ";
      echo $carmodel;
    } else {
    
  }



}


?>


