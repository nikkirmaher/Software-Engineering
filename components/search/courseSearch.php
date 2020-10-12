<div id="courseSearch">
	<p class = "title"> Search Course </p>
	<form name="search-course" method="get" action="...">
		<input type="text" placeholder="Enter Course Here.." name="search-course">
		<button id="submitCourse" type="submit"><i class="fa fa-search"></i></button>
	</form>

	<?php 
		include_once("./backend/db_connector.php");

		$sql = "SELECT * FROM `courses`";
		$result = mysqli_query($dbconn, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			$courseID = $row['CID'];
			$buildingName = $row['name'];
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
		<td><?php echo $buildingName; ?></td>
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
</div>