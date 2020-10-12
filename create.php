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
		<link href="./css/search.css" rel="stylesheet" type="text/css">
	</head>

<body>
	<!-- Header -->
	<?php include_once('./html/header.html') ?>
	<!-- Navigation bar -->
	<?php include_once('./components/navbar.php') ?>

	<div class="create">
			<?php include_once('./components/create/buildingCreate.php') ?>
			<?php include_once('./components/create/courseCreate.php') ?>
			<?php include_once('./components/create/instructorCreate.php') ?>
			<?php include_once('./components/create/roomCreate.php') ?>
	</div>
</body>
</html>