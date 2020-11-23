<?php
	//Starting a session.
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
		<title>Course Scheduler - Search</title>
		<!-- Link for our main style sheet -->
		<link href="./css/scheduler.css" rel="stylesheet" type="text/css">
		<!-- Link for font awesome icons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></link>
	</head>

	<body>
		<!-- Header -->
		<?php include_once('./components/header.php') ?>
		<!-- Navigation bar -->
		<?php include_once('./components/sidebar.php') ?>

		<!-- Main Content -->
		<div class="content">
			<!-- List of available Searches -->
			<div>
				<a href="./search.php?searchType=user">User</a>
				<a href="./search.php?searchType=course">Course</a>
				<a href="./search.php?searchType=building">Building</a>
				<a href="./search.php?searchType=room">Room</a>
			</div>
			<?php 
				if(isset($_GET['searchType'])) {
					if($_GET['searchType'] == 'user') {
						include_once('./components/search/userSearch.php');
					}
					else if($_GET['searchType'] == 'course') {
						include_once('./components/search/courseSearch.php');
					}
					else if($_GET['searchType'] == 'building') {
						include_once('./components/search/buildingSearch.php');
					}
					else if($_GET['searchType'] == 'room') {
						include_once('./components/search/roomSearch.php');
					}
				} 
			?>
		</div>
	</body>
</html>