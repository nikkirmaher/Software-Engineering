<?php
    //Resuming the session
    if(!isset($_SESSION)) {
        session_start();
    }
    //Checking if the user is signed in.
    if(!isset($_SESSION['user'])) {
        header("Location: index.php");
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Course Scheduler - Home</title>
        <link href="./css/scheduler.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <!-- Header -->
        <?php include_once('./components/header.php'); ?>
        
        <!-- Navigation bar -->
        <?php include_once('./components/sidebar.php'); ?>
        
        <!-- Page Content -->
        <div class="content">
            <p>
                Welcome, <?php echo $_SESSION['user_name']; ?>
                <br><br>You may use the sidebar to navigate.
            </p>
        </div>
    </body>
</html>