<?php

  if ( empty( $_POST ) ) {
?>
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
</ul>
</div>

<ul class="nav navbar-nav navbar-right">

    <li><a href="Login.php"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
  <li><a href="Registration.php"><span class="glyphicon glyphicon-check"></span> Register</a></li>
</ul>
</div>
</nav>
</body>
<head>
  <link rel="stylesheet" type="text/css" href="loginstyle.css">
  
</head>

<form id="form" name="Login" action="Login.php" method="POST">

  <label for 'username'>Username: </label>
  <input type="text" name="username"/>
  <br/>

  <label for 'password'>Password: </label>
  <input type="password" name="password"/>
  
  <br/>
  <button type="Submit" class="btn btn-primary">Login</button>
  <br/>
  <button id= "button" type="button" class="btn btn-primary" onclick="location.href='Registration.php';" >Not Registered? Register Here</button>

</form>


<?php
} else {

require_once 'Config.php';
$db = new PDO('mysql:host=localhost;dbname=DDW', $DB_USERNAME, $DB_PASSWORD);

$form = $_POST;
$username = $form[ 'username' ];
$password = $form[ 'password' ];

$query = $db->prepare('SELECT * FROM reg_users WHERE username = :username');
$query->bindParam(':username', $_POST['username']);
$query->execute();
$result = $query->fetch();
$count = $query->rowCount();

if ($count > 0) {

    if (password_verify($password, $result['password'])) {
      session_start();
    if ($result['isAdmin'] != 1)
    {
      //Success, do something 
    $_SESSION["loggedin"] = TRUE;
    $_SESSION["user"] = $_POST['username'];
    $_SESSION["admin"] = FALSE;
    $_SESSION["first_name"] = $result['first_name'];
    $_SESSION["surname"] = $result['surname'];
    $_SESSION["email"] = $result['email'];
    $_SESSION["username"] = $result['username'];
    $_SESSION["id"] = $result['id'];
    header('Location: index.php');
    
    
    }
    else
    {
      //Success, do something 
    //echo "Success";
    $_SESSION["loggedin"] = TRUE;
    $_SESSION["user"] = $_POST['username'];
    $_SESSION["admin"] = TRUE;
    $_SESSION["id"] = $result['id'];
    header('Location: Admin.php');
    }    
    
  } else {
    echo "try again";
    //echo $password;
    }
}
else {
	//Failure, do something different
    echo "Failed";
}

}
?>