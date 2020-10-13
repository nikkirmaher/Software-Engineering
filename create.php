<?php
  //Starting a session.
  if(!isset($_SESSION)) {
    session_start();
  }
  if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    //header("Location: dashboard.php");
  }
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Course Scheduler - Create</title>
		<!-- Link for our main style sheet -->
		<link href="./css/scheduler.css" rel="stylesheet" type="text/css">
		<!-- Link for font awesome icons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></link>
	</head>

	<body>
		<!-- Header -->
		<?php include_once('./html/header.html') ?>
		<!-- Navigation bar -->
		<?php include_once('./components/sidebar.php') ?>

		<div class="content">
			<?php include_once('./components/create/buildingCreate.php') ?>
			<?php include_once('./components/create/courseCreate.php') ?>
			<?php include_once('./components/create/instructorCreate.php') ?>
			<?php include_once('./components/create/roomCreate.php') ?>
		</div>
	</body>
</html>