function checkUser() {
    var username = document.getElementById("username").value;
    // retrieves the username from the HTML form
    var dataString = 'username=' + username;
    // create the datastring we're going to need in our AJAX request, there could be multiple values passed here, but in this case just one
    $.ajax({ 
      // create the AJAX request using JQuery method
        type: "POST", // method is post
        url: "checkuser.php", // the PHP script we want to communicate with
        data: dataString, // the data we're passing
        success: function(data) {
          if (data.availability === false){ // checkuser.php will send us back a JSON response containing a value named availability
              $("#message").html("username is unavailable, please choose another"); // send a message to the user
              $("#username").css("background-color","#f99"); // change the CSS to give user feedback
              $("#submit").prop('disabled',true); // disable the submit button
          }
          else if (data.availability === true){
              $("#message").html("username is available, please proceed"); // send a message to the user
              $("#username").css("background-color","#9f9"); // change the CSS to give user feedback
              $("#submit").prop('disabled',false); // enable the submit button
          }
        }, 
        dataType: "json" // returned data type is going to be JSON
    });
}

function checkempty(){
    var first_name = document.getElementById("first_name").value;
    var surname = document.getElementById("surname").value;
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var email = document.getElementById("email").value;
    
    if (first_name === '' || surname === '' || username === '' || password === '' || email === '') {
    alert("Please Fill All Fields");
    return false;
    }
    else {
    return true;
    }
}
