<?php 
include 'conn.php';
if(isset($_POST['submit'])){
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password2 = $_POST['password2'];
  if(!empty($username) and !empty($email) and !empty($password) and !empty($password2)){
    if($password == $password2){
      $query = "Insert into users(email, username, password)values('$email','$username','$password')";
      mysqli_query($conn, $query);
      header("Location: login.php");
    }else{
      echo "Passwords didnot match";
    }
  }
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Validation</title>
    <link rel="stylesheet" href="style.css" />
    <!-- <script defer src="script.js"></script> -->
  </head>
  <body>
    <div class="container">
      <form action="" name="form" method="post" id="form"">
        <div class="form_container">
          <div class="heading">
            <h2>Registration Form</h2>
          </div>
          <div id="error"></div><br>
          <div class="main_form">

            <div class="email">
              <label for="email">Email</label>
              <input id="email" type="text" name="email" />
              <!-- <div id="email" class="error email_error">
                Please enter your email
              </div> -->
            </div>

            <div class="username">
              <label for="username">Username</label>
              <input id="username" type="text" name="username" />
              <!-- <div id="email" class="error email_error">
                Please enter your email
              </div> -->
            </div>
            <div class="password">
              <label for="password">Password</label>
              <input id="password" type="password" name="password" />
              <!-- <div id="password" class="error password_error">
                Please enter your password
              </div> -->
            </div>
            <div class="password2">
              <label for="password2">Confirm Password</label>
              <input id="password2" type="password" name="password2" />
              <!-- <div id="password" class="error password_error">
                Please enter your password
              </div> -->
            </div>
          </div>
          <div class="submit">
            <button type="submit" name="submit">Submit</button>
            <p>Forgot your password??</p>
             <p>Already registered? <a href="login.php">Login here</a></p>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
