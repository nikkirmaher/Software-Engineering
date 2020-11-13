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
		$semester_offered = $_POST['semester_offered'];
		

		$sql = "INSERT INTO courses (`title`, `short_name`, `PROGRAM`, `is_active`, `required_RID`, `num_credits`, `contact_hours`, `semester_offered`)
				VALUES ('$name', '$short_name', '$program', '$is_active','$required_RID', '$num_credits', '$contact_hours', '$semester_offered')";


		if ($dbconn->query($sql) === TRUE) {
			echo "New record created successfully";
			} else {
			echo "Error: " . $sql . "<br>" . $dbconn->error;
			}
			$dbconn->close();
	}
?>

<p class = "title"> Create Course </p>
<form name="create-course" method="post" action="./create.php?createType=course">
	<label id="add" for="create-course"> Course Title: </label> 
	<input type="text" placeholder="Enter course name here..." name="title" id="title">
	<br>
	<br>

	<label id="add" for="create-course"> Course Short Name: </label> 
	<input type="text" placeholder="Enter course short name here..." id="short_name" name="short_name">
	<br>
	<br>

	<label id="add" for="create-course"> Is this course active this semester? </label>
	<br>
	<br>
	
	<input type="radio" id="active" name="is_active" value="active">
	<label for="active">Yes</label>
	<br>
	<br>

  	<input type="radio" id="inactive" name="is_active" value="inactive">
  	<label for="not_active">No</label><br>	
	<br>
	<br>
	<br>


	<label id="add" for="create-course"> Program: </label> 
	<select id="program" name="program">
	<?php
		$sql = "SELECT * FROM `programs`";
		$query = mysqli_query($dbconn, $sql);
		while($row = mysqli_fetch_assoc($query)) {
			echo("<option value='" . $row['PROGRAM'] . "'>" . $row['PROGRAM'] . "</option>");
		}
    ?>
	</select>
	<br>
	<br>
	
	<label id="add" for="create-course"> Required Room ID: </label> 
	<select id="required_RID" name="required_RID">
	<?php
		$sql = "SELECT * FROM `rooms`";
		$query = mysqli_query($dbconn, $sql);
		while($row = mysqli_fetch_assoc($query)) {
			echo("<option value='" . $row['RID'] . "'>" . $row[''] . "</option>");
		}
	?>
	</select>
	<br>
	<br>

	
	<label id="add" for="create-course"> Number of Credits: </label> 
	<input type="text" placeholder="Enter number of credits..." name="num_credits" id="num_credits">
	<br>
	<br>	

	<label id="add" for="create-course"> Contact Hours: </label> 
	<input type="text" placeholder="Enter contact hours here..." name="contact_hours" id="contact_hours">
	<br>
	<br>	

	<label for="semester">Semester:</label>
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
	
    <input id="submit" type="submit" name="addCourse">
</form>
    