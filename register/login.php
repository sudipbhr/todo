<?php
include('conn.php');


if(isset($_POST['login'])){
  $username = $_POST['username'];
$pass= $_POST['password'];
  $query = "select * from users where username='$username' and password ='$pass'";
$result = mysqli_query($conn, $query);
if($row=mysqli_fetch_assoc($result)){
  session_start();
  $_SESSION['id']=$row['id'];
  $_SESSION['username']=$row['username'];
 
 header("location: ../index.php");
}

}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login: TODO</title>
    <link rel="stylesheet" href="style.css" />
    <script defer src="script.js"></script>
  </head>
  <body>
    <div class="container">
      <form action="" name="form" method="post" id="form"">
        <div class="form_container">
          <div class="heading">
            <h2>Login Form</h2>
          </div>
          <div id="error"></div><br>
          <div class="main_form">


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
        
          </div>
          <div class="submit">
            <button name="login" type="submit" value="login">Login</button>
            <p>Forgot your password??</p>
            <p>Haven't registered yet? <a href="register.php">Sign up here</a></p>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
