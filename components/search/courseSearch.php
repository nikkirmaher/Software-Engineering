<div id="courseSearch">
	<h2>Search Course</h2>
	<form name="search-course" method="get" action="...">
		<input type="text" placeholder="Enter Course Here.." name="search-course">
		<button id="submitCourse" type="submit"><i class="fa fa-search"></i></button>
	</form>

	<table>
		<tr>
			<th>CID</th>
			<th>Course Name</th> 
			<th>Course Short Name</th>
			<th>Requisite</th> 
			<th>Has Requisite</th>
			<th>Co-Requisite</th>
			<th>Program</th>
			<th>RID</th>
			<th>Number of Credits</th>
			<th>Semester</th>
			<th>Year</th>
			<th>Action</th>
		</tr>
	
		<?php 
			include_once("./backend/db_connector.php");

			$sql = "SELECT * FROM `courses`";
			$result = mysqli_query($dbconn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
				$courseID = $row['CID'];
				$courseName = $row['name'];
				$shortName = $row['short_name'];
				$isReq = $row['is_requisite'];
				$hasReq = $row['has_requisite'];
				$coReq = $row['co_requisite'];
				$program = $row['program'];
				$roomID = $row['RID'];
				$credits = $row['num_credits'];
				$semester = $row['semester'];
				$year = $row['year'];
		?>
		<tr>
			<td><?php echo $courseID; ?></td>
			<td><?php echo $courseName; ?></td>
			<td><?php echo $shortName; ?></td>
			<td><?php echo $isReq; ?></td>
			<td><?php echo $hasReq; ?></td>
			<td><?php echo $coReq; ?></td>
			<td><?php echo $program; ?></td>
			<td><?php echo $roomID; ?></td>
			<td><?php echo $credits; ?></td>
			<td><?php echo $semester; ?></td>
			<td><?php echo $year; ?></td>
			<td>Edit</td>
		</tr>
		<?php } ?>
	</table>
</div>
		<?php
		//Edit Section
        //If submit button is pressed.
        if (isset($_GET['editCourse'])) 
        {
            include_once("./backend/db_connector.php");
            
            $name = $_GET['course-name'];
            $short_name = $_GET['course-shortname'];
            $is_requisite = $_GET['is_requisite'];
            $has_requisite = $_GET['has_requisite'];
            $co_requisite = $_GET['co_requisite'];
            $is_alive = $_GET['alive'];
            $program = $_GET['program'];
            $num_credits = $_GET['num_credits'];
            $semester = $_GET['semester'];
            $year = $_GET['course-year'];

			//SQL Update Statement for courseSearch form
            $sql = "UPDATE `courses` (`name`, `short_name`, `is_requisite`, `has_requisite`, `co_requisite`, `is_alive`, `program`, `num_credits`, `semester`, `year`)
                    SET  course-name = $name, 
						 course-shortname = '$short_name', 
						 is_requisite = '$is_requisite', 
						 has_requisite = '$has_requisite', 
						 co_requisite = '$co_requisite', 
						 alive = '$is_alive', 
						 program = '$program', 
						 num_credits = '$num_credits', 
						 semester = '$semester', 
						 course-year = '$year';
					WHERE id=editCourse";


            if ($dbconn->query($sql) === TRUE) {
                echo "New record edited successfully";
              } else {
                echo "Error: " . $sql . "<br>" . $dbconn->error;
              }
              $dbconn->close();
        }
    ?>