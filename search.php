<?php
	//Starting a session.
	if(!isset($_SESSION)) {
		session_start();
	}
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Course Scheduler - Search</title>
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

		<!-- Main Content -->
		<div class="content">
			<?php include_once('./components/search/userSearch.php') ?>
			<?php include_once('./components/search/instructorSearch.php') ?>
			<?php include_once('./components/search/courseSearch.php') ?>
			<?php include_once('./components/search/buildingSearch.php') ?>
			<?php include_once('./components/search/roomSearch.php') ?>
		</div>
	</body>
</html>