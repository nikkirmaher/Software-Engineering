<?php
  //Starting a session.
  if(!isset($_SESSION)) {
    session_start();
  }
?>

<html>
    <head>
        <meta charset="UTF-8" content="width=device-width, initial-scale=1">
        <title>Reset Password</title>
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
                <p>Please Enter your Email, if you have an account a new password will be emailed to you:</p>
                <?php 
                    //If the login button was pressed.
                    if(isset($_POST['reset']))
                    {
                        include_once('backend/db_connector.php');
                        $email = $_POST['email'];

                        $sql = "SELECT * FROM `user_data` WHERE `email` = '$email'";
                        $result = mysqli_query($dbconn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $count = mysqli_num_rows($result);

                        if($count == 1) {

                        }
                        else {
                            echo('<div class="login-error-msg">Email not found.</div>');
                        }   
                    }
                ?>
                <form class="login-form" method="POST">
                    <label for="email">Email:</label><br>
                    <input type="email" name="email" class="login-form-field" required>
                    <br>
                    <button type="submit" name="reset" class="login-form-submit">Reset</button>
                    <br>
                    <button type="button" name="backBtn" class="login-form-submit" onclick="location.href = './index.php'">Back</button>
                </form>
            </div>
        </div>
    </body>
</html>
