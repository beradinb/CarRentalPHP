<?php

    session_start();
?>

<head>
    <link rel="stylesheet" type="text/css" href="loginstyle.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="checkscript.js"></script>
    <script>
        $( document ).ready(function() {
        $("#submit").prop('disabled',true);
        });
</script>
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
<form id="form" name="Registration" action="adminreg.php" onsubmit="return checkempty();" method="POST">
  
  <label for 'first_name'>First name: </label>
  <input id="first_name" type="text" name="first_name"/>
  <br/>
  
  <label for 'surname'>Surname: </label>
  <input id="surname" type="text" name="surname"/>
  <br/>

  <label for 'email'>Email: </label>
  <input id="email" type="text" name="email" required pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?" title="Email must be in a valid format" />
  <br/>
  
  <label for 'username'>Username: </label>
  <input id="username" type="text" name="username" onblur="checkUser()" ><span id="message"></span>
  <br/>

  <label for 'password'>Password: </label>
  <input id="password" type="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 7 or more characters"/>

  
  <br/>
  <button id= "submit" type="submit" class="btn btn-primary">Submit</button>
  <br/>
  <button id= "button" type="button" class="btn btn-primary" onclick="location.href='Login.php';" >Existing User? Login Here</button>
  
  <br/>

</form>
<?php
if (!isset($_SESSION['admin'])){
	//go away!!
	header('Location: Login.php');
}
else if($_SESSION['admin'] != true){
  header('Location: index.php');

}
else {
	require_once 'Config.php';
  $db = new PDO('mysql:host=localhost;dbname=DDW', $DB_USERNAME, $DB_PASSWORD);
	
	$username = $_POST[ 'username' ];
	$password = $_POST[ 'password' ];
	$first_name = $_POST[ 'first_name' ];
	$surname = $_POST[ 'surname' ];
	$email = $_POST[ 'email' ];

  $password = password_hash($password, PASSWORD_BCRYPT);

  $query = $db->prepare("INSERT INTO reg_users ( username, password, first_name, surname, email, isAdmin ) VALUES ( :username, :password, :first_name, :surname, :email, TRUE )");
  $query->bindParam(':username', $username);
  $query->bindParam(':password', $password);
  $query->bindParam(':first_name', $first_name);
  $query->bindParam(':surname', $surname);
  $query->bindParam(':email', $email);
	
  $result = $query->execute();

  if($result){
      //print_r( $_POST );
      echo 'Thank you. You have been registered';
    } else {
      //echo var_dump($result);
      //echo $query->fetch();
  }

 
}
?>