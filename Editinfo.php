<?php

  include("nav.php");
  
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

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="loginstyle.css">

</head>



<body>

<h1>Edit your info </h1>

<form id="form" name="Update" action="Editinfo.php"  method="POST">
  
  <input id="id" type="hidden" name="id" value="<?= $_SESSION['id']; ?>"/>

  <label for 'first_name'>First name: </label>
  <input id="first_name" type="text" name="first_name" value= "<?= $_SESSION['first_name'] ?>" />
  <br/>
  
  <label for 'surname'>Surname: </label>
  <input id="surname" type="text" name="surname" value= "<?= $_SESSION['surname'] ?>" />
  <br/>

  <label for 'email'>Email: </label>
  <input id="email" type="text" name="email" value= "<?= $_SESSION['email'] ?>" required pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?" title="Email must be in a valid format" />
  <br/>
  
  <!-- <label for 'username'>Username: </label>
  <input id="username" type="text" name="username" value= "<?= $_SESSION['first_name'] ?>" onblur="checkUser()" ><span id="message"></span>
  <br/> -->

 <label for 'password'>Password: </label>
  <input id="password" type="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>

  
  <br/>
  <button id= "submit" type="submit" class="btn btn-primary">Submit</button>
  <br/>
</form>



</body>


<?php



if (!isset($_SESSION['user'])){
	//go away!!
	header('Location: Login.php');
}
else {
  //echo 'Welcome Back: ';


  	require_once 'Config.php';
  $db = new PDO('mysql:host=localhost;dbname=DDW', $DB_USERNAME, $DB_PASSWORD);
	
  
	//$username = $_POST[ 'username' ];
	$password = $_POST[ 'password' ];
	$first_name = $_POST[ 'first_name' ];
	$surname = $_POST[ 'surname' ];
	$email = $_POST[ 'email' ];
  $id = $_POST[ 'id' ];

  $password = password_hash($password, PASSWORD_BCRYPT);

  $query = $db->prepare("UPDATE reg_users SET password= :password, first_name= :first_name, surname= :surname, email= :email WHERE id= :id ");
  //$query->bindParam(':username', $username);
  $query->bindParam(':password', $password);
  $query->bindParam(':first_name', $first_name);
  $query->bindParam(':surname', $surname);
  $query->bindParam(':email', $email);
	$query->bindParam(':id', $id);
  $result = $query->execute();


}


?>