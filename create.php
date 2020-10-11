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

	<div class="searches">
		<p class = "title"> Create User </p>
		<form name="search-user" method="get" action="...">
			<input type="text" placeholder="Enter User Here.." name="search-user">
			<button id="submitUser" type="submit"><i class="fa fa-search"></i></button>
		</form>

		<p class = "title"> Create Building </p>
		<form name="search-building" method="get" action="...">
			<input type="text" placeholder="Enter Building Here.." name="search-building">
			<button id="submitBuilding" type="submit"><i class="fa fa-search"></i></button>
		</form>

		<p class = "title"> Create Instructor </p>
		<form name="search-instructor" method="get" action="...">
			<input type="text" placeholder="Enter Instructor Here.." name="search-instructor">
			<button id="submitInstructor" type="submit"><i class="fa fa-search"></i></button>
		</form>
			
		<p class = "title"> Create Room </p>
		<form name="search-room" method="get" action="...">
			<input type="text" placeholder="Enter Room Here.." name="search-room">
			<button id="submitRoom" type="submit"><i class="fa fa-search"></i></button>
		</form>
	
		<p class = "title"> Create Course </p>
		<form name="search-course" method="get" action="...">
			<input type="text" placeholder="Enter Course Here.." name="search-course">
			<button id="submitCourse" type="submit"><i class="fa fa-search"></i></button>
		</form>
	</div>
</body>
	
</html>