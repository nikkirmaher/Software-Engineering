<?php
  //Starting a session.
  if(!isset($_SESSION)) {
    session_start();
  }
  //If the user is already signed in redirect to the home page.
  if(isset($_SESSION['user'])) {
    header("Location: home.php");
  }
?>

<html>
    <head>
        <meta charset="UTF-8" content="width=device-width, initial-scale=1">
        <title>Log In</title>
        <link href="css/index.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="main-holder">
            <div class="logo-image">
                <div class="image-holder">
                    <img src="images/Capture.PNG" alt="logo">
                </div>
            </div>

            <div>
                <h2>Log In:</h2>
                <?php 
                    //If the login button was pressed.
                    if(isset($_POST['login']))
                    {
                        include_once('backend/db_connector.php');
                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        $sql = "SELECT * FROM `user_data` WHERE `email` = '$email' AND `password` = '$password'";
                        $result = mysqli_query($dbconn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $count = mysqli_num_rows($result);

                        if($count == 1) {
                            //Validate user credentials.
                            $_SESSION['user'] = $email;
                            $_SESSION['user_name'] = $row['first_name'] . " " . $row['last_name'];
                            header("Location: home.php");
                        }
                        else {
                            echo('<div class="login-error-msg">Invalid Email/Password.</div>');
                        }   
                    }
                ?>
                <form class="login-form" method="POST">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="login-form-field" required>
                    <br>
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="login-form-field" required>
                    <br>
                    <button type="submit" class="login-form-submit" name="login">Login</button>
                </form>
            </div>
            <div>
                <span class="psw">Forgot <a href="./resetPassword.php">password?</a></span>
            </div>
        </div>
    </body>
</html>
