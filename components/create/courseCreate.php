<?php 
  	include_once("./backend/db_connector.php");

	//If submit button is pressed.
	if (isset($_POST['addCourse'])) 
	{   
		$name = $_POST['title'];
		$short_name = $_POST['short_name'];
		$is_active = $_POST['is_active'];
		$program = $_POST['program'];
		$required_RID = $_POST['required_RID'];
		$num_credits = $_POST['num_credits'];
		$contact_hours = $_POST['contact_hours'];
		$semester = $_POST['semester'];
		
		$sql = "INSERT INTO courses (`title`, `short_name`, `PROGRAM`, `is_active`, `required_RID`, `num_credits`, `contact_hours`, `semester_offered`)
				VALUES ('$name', '$short_name', '$program', '$is_active','$required_RID', '$num_credits', '$contact_hours', '$semester')";

		if ($dbconn->query($sql) === TRUE) {
			echo "Course successfully created";
		} 
		else {
			echo "Error: " . $sql . "<br>" . $dbconn->error;
		}
	}
	?>


<div class="card">
	<div class="card-header">
		<h2>Create Course</h2>
	</div>
	<div class="card-content">
		<form name="create-course" method="post" action="./create.php?createType=course">
			<div class="card-row">
				<div class="card-column">
					<label for="create-course">Course Title:</label> 
				</div>
				<div class="card-column">
					<input type="text" placeholder="Enter course name here..." name="title">
				</div>
			</div>
			<div class="card-row">
				<div class="card-column">
					<label id="add" for="create-course"> Course Short Name: </label> 
				</div>
				<div class="card-column">
					<input type="text" placeholder="Enter course short name here..." id="short_name" name="short_name">
				</div>
			</div>
			<div class="card-row">
				<div class="card-column">
					<label id="add" for="create-course">Program: </label> 
				</div>
				<div class="card-column">
					<select id="program" name="program">
						<option value="">Please select the program</option>
						<?php
							$sql = "SELECT * FROM `programs`";
							$query = mysqli_query($dbconn, $sql);
							while($row = mysqli_fetch_assoc($query)) {
								echo("<option value='" . $row['PROGRAM'] . "'>" . $row['PROGRAM'] . "</option>");
							}
						?>
					</select>
				</div>
			</div>
			<div class="card-row">
				<div class="card-column">
					<label for="semester">Semester:</label>
				</div>
				<div class="card-column">
					<select name="semester" id="semester">
						<option value="">Please select the semester</option>
						<?php
							$sql = "SELECT * FROM `semester`";
							$query = mysqli_query($dbconn, $sql);
							while($row = mysqli_fetch_assoc($query)) {
								$date = $row['start_date'];
								$year = explode('-', $date);
			
								echo("<option value='" . $row['SEID'] . "'>" . $row['season'] . " " . $year[0] . "</option>");
							}
						?>
					</select>
				</div>
			</div>
			<div class="card-row">
				<div class="card-column">
					<label for="select-building">Building: </label>
				</div>
				<div class="card-column">
					<select name="select-building" id="select-building">
						<option value="">Please select the building</option>
						<?php
						//Get all unique buildings from the database to populate the select.
						$sql = "SELECT * FROM `buildings`";
						$result = mysqli_query($dbconn, $sql);
						while ($row = mysqli_fetch_assoc($result)) {
							$bname = $row['building_name'];
							$BID = $row['BID'];
							echo("<option value='$BID'>$bname</option>");
						}
						?>
					</select>
				</div>
			</div>
			<div class="card-row">
				<div class="card-column">
					<label id="add" for="create-course"> Required Room (if applicable): </label> 
				</div>
				<div class="card-column">
					<select id="required_RID" name="required_RID">
						<option value="">Please select the required room</option>
						<?php
							$sql = "SELECT * FROM `rooms`";
							$query = mysqli_query($dbconn, $sql);
							while($row = mysqli_fetch_assoc($query)) {
								echo("<option value='" . $row['RID'] . "'>" . $row['short_name'] . "</option>");
							}
							?>
					</select>
				</div>
			</div>
			<div class="card-row">
				<div class="card-column">
					<label id="add" for="create-course"> Number of Credits: </label> 
				</div>
				<div class="card-column">
					<input type="text" placeholder="Enter number of credits..." name="num_credits" id="num_credits">
				</div>
			</div>
			<div class="card-row">
				<div class="card-column">
					<label id="add" for="create-course"> Contact Hours: </label> 
				</div>
				<div class="card-column">
					<input type="text" placeholder="Enter contact hours here..." name="contact_hours" id="contact_hours">
				</div>
			</div>
			<div class="card-row">
				<div class="card-column">
					<label for="create-course">Will this course be active this semester?</label>
				</div>
			</div>
			<div class="card-row">
				<div class="card-column" style="flex-direction:row;">
					<input type="radio" id="active" name="is_active" value="active">
					<label for="active">Yes</label>
				</div>
				<div class="card-column" style="flex-direction:row;">
					<input type="radio" id="inactive" name="is_active" value="inactive">
					<label for="not_active">No</label>
				</div>
			</div>
			<div class="card-row">
				<div class="card-column" style="align-items: center;">
					<button type="submit" name="addCourse">Create Course</button>
				</div>
			</div>
		</form>
	</div>
</div>