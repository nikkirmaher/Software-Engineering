<?php
    //Start the session
    session_start();

    //Remove all the session variables 
    session_unset();

    //End the session
    session_destroy();

    //Go back to Login Page
    header("location: ./index.php");
?>