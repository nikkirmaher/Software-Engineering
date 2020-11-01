<?php
  //Starting a session.
  if(!isset($_SESSION)) {
    session_start();
  }
  if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    //header("Location: dashboard.php");
  }
?>

<!doctype html>
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
                        $_SESSION['loggedIn'] = true;
                        $_SESSION['user'] = $email;
                        $_SESSION['user_name'] = $row['first_name'] . " " . $row['last_name'];
                        header("Location: home.php");
                    }
                    else {
                        echo('<div class="login-error-msg">Invalid Username/Password.</div>');
                    }   
                }
            ?>
            <form class="login-form" method="POST">
                <label for="email">Username:</label>
                <input type="email" name="email" class="login-form-field">
                <br>
                <label for="password">Password:</label>
				<input type="password" name="password" class="login-form-field">
				<br>
				<input class="login-form-submit" type="submit" value="Login" name="login">
			</form>
        </div>
        <div>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
        <br>
    </div>
</body>
</html>
