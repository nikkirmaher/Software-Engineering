<?php
    if(!isset($_SESSION))
    {
        session_start();
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
        <?php include_once('./html/header.html') ?>
        
        <!-- Navigation bar -->
        <?php include_once('./components/navbar.php') ?>
        
        <!-- Page Content -->
        <div class="content">

        </div>
    </body>
</html>