<?php
require_once 'Config.php';
    if (isset($_POST['username'])) { //Check if form data has actually been posted
        $username = $_POST['username']; //Retrieve username from POST data
        try{
            
            $db = new PDO('mysql:host=localhost;dbname=DDW', $DB_USERNAME, $DB_PASSWORD);
            //Establishing Connection with Server, your database name may differ
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
        $jsonReply = array(); //Create an array for the JSON response
        $query = $db->prepare ("SELECT * FROM reg_users WHERE username = :username"); //Write the query
        $query->bindParam(':username', $username); //Bind parameters
        $query->execute(); //Run the query
        $count = $query->rowCount();
        if ($count > 0) { //Do we have any results?
        $jsonReply['availability'] = false; //Set availability to false
            header('Content-Type:application/json;');
            echo json_encode($jsonReply); //Encode the array to JSON
        } else {
        $jsonReply['availability'] = true; //Set availability to true
            header('Content-Type:application/json;');
            echo json_encode($jsonReply); //Encode the array to JSON
        }
    }
?>