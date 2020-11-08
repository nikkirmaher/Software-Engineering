<?php
	include_once("./backend/db_connector.php");
	//Edit Section
	//If submit button is pressed.
	if (isset($_POST['editCourse'])) 
	{
		$cID = $_POST['edit-cid'];
		$title = $_POST['edit-title'];
		$shortname = $_POST['edit-short-name'];
		$isactive = $_POST['edit-active'];
		$program = $_POST['edit-program'];
		$requiredrid = $_POST['edit-required'];
		if($requiredrid == '') {
			$requiredrid = 'NULL';
		}
		$numcredits = $_POST['edit-number-credits'];
		$contacthours = $_POST['edit-contact-hours'];
		$semester = $_POST['edit-semester-offered'];
		//SQL Update Statement for courseSearch form
		$sql = "UPDATE `courses` 
				SET  `title` = '$title', 
						`short_name` = '$shortname', 
						`is_active` = $isactive, 
						`PROGRAM` = '$program', 
						`required_RID` = $requiredrid, 
						`num_credits` = '$numcredits', 
						`contact_hours` = '$contacthours',
						`semester_offered` = '$semester'
				WHERE `CID`=$cID";

		if ($dbconn->query($sql) === TRUE) {
			echo "Course edited successfully";
		} 
		else {
			echo "Error: " . $sql . "<br>" . $dbconn->error;
		}
	}
?>
<div id="courseSearch">
	<h2>Search Course</h2>
	<input id="userInput" type="text" placeholder="Enter Course Here.." name="search-course">
	<button id="searchCourse" type="button">Search</button>
	<br><br>

	<table id="courseTable">
		<tr>
			<th>CID</th>
			<th>Title</th> 
			<th>Course Short Name</th>
			<th>Is-Active</th>
			<th>Program</th>
			<th>Required RID</th>
			<th>Number of Credits</th>
			<th>Contact Hours</th>
			<th>Semester</th>
			<th>Action</th>
		</tr>
		<?php 
			$sql = "SELECT * FROM `courses`";
			$result = mysqli_query($dbconn, $sql);
			$numResults = mysqli_num_rows($result);

		if($numResults < 1) {
			echo("<tr>
				<td colspan='10'>No Courses found</td>
				</tr>");
		}
		else {
			$rowNum = 0;
			while ($row = mysqli_fetch_assoc($result)) {
				$courseID = $row['CID'];
				$courseName = $row['title'];
				$shortName = $row['short_name'];
				$isActive = $row['is_active'];
				$program = $row['PROGRAM'];
				$requiredRoomID = $row['required_RID'];
				$credits = $row['num_credits'];
				$contactHours = $row['contact_hours'];
				$semesterOffered = $row['semester_offered'];
		?>
		<tr>
			<td><?php echo $courseID; ?></td>
			<td><?php echo $courseName; ?></td>
			<td><?php echo $shortName; ?></td>
			<td><?php echo $isActive; ?></td>
			<td><?php echo $program; ?></td>
			<td><?php echo $requiredRoomID; ?></td>
			<td><?php echo $credits; ?></td>
			<td><?php echo $contactHours; ?></td>
			<td><?php echo $semesterOffered; ?></td>
			<td><button type="button" onclick="displayModal(<?php echo ++$rowNum ?>, 'courseTable')">View</button></td>
		</tr>
		<?php 
			}
		}
	?>
	</table>
</div>
<!-- The view modal for a selected course, it uses the same form-layout 
    for creating courses and populates its fields with data from directly
    from the table instead of making another database call. -->
	<div id="myModal" class="modal">
	<div class="modal-content">
		<span class="close">&times;</span>
		<p class="title">Edit Course</p>
		<form name="edit-course" method="post" action="./search.php?searchType=course">
			<input type="hidden" name="edit-cid" id="edit-cid"> 

			<label for="edit-title">title:</label>
			<input type="text" name="edit-title" id="edit-title" onkeyup="enableButton();">
			<br>
			<label for="edit-short-name">Course Short Name:</label>
			<input type="text" name="edit-short-name" id="edit-short-name" onkeyup="enableButton();">
			<br>

			Is this course active?<br>
			<input type="radio" name="edit-active" id="edit-active-yes" value="1" onchange="enableButton();">
			<label for="edit-active">Yes</label>
			<input type="radio" name="edit-active" id="edit-active-no" value="0" onchange="enableButton();">
			<label for="edit-active">No</label>
			<br>

			<label for="edit-program">Program:</label>
			<input type="text" name="edit-program" id="edit-program" onkeyup="enableButton();">
			<br>

			<label for="edit-required">If this Course Requires a specific room please choose that room.</label><br>
			<select name="edit-required" id="edit-required" onchange="enableButton();">
				<option id="requiredRoom" value=""></option>
				<?php
                    $sql = "SELECT * FROM `rooms`";
                    $query = mysqli_query($dbconn, $sql);
                    while($row = mysqli_fetch_assoc($query)) {
                        echo("<option value='" . $row['RID'] . "'>" . $row['short_name'] . "</option>");
                    }
                ?>
			</select>
			
			<br>

			<label for="edit-number-credits">Number Of Credits:</label>
			<input type="number" name="edit-number-credits" id="edit-number-credits" onchange="enableButton();">
			<br>

			<label for="edit-contact-hours">Contact Hours:</label>
			<input type="number" name="edit-contact-hours" id="edit-contact-hours" onchange="enableButton();">
			<br>

			<label for="edit-semester-offered">Semester Offered:</label>
			<input type="number" name="edit-semester-offered" id="edit-semester-offered" onchange="enableButton();">
			<br>

			<button type="submit" name="editCourse" id="editCourse" disabled>Save Changes</button>
            <button type="reset" name="reset" onclick="document.getElementById('myModal').style.display = 'none';">Cancel</button>
		</form>
	</div>
</div><script>
	//Get the modal
	var modal = document.getElementById("myModal");

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks the button, open the modal and populate the fields
	// with information from the selected table row.
	function displayModal(tableRow, tableID) {
		var editRow = document.getElementById(tableID).rows[tableRow];
		modal.style.display = "block";

		//Start populating the fields.
		document.getElementById('edit-cid').value = editRow.cells[0].innerText;
		document.getElementById('edit-title').value = editRow.cells[1].innerText; 
		document.getElementById('edit-short-name').value = editRow.cells[2].innerText;

		if(editRow.cells[3].innerText === "0") {
			document.getElementById('edit-active-no').checked = true;
			document.getElementById('edit-active-yes').checked = false;
		}
		else if(editRow.cells[3].innerText === "1") {
			document.getElementById('edit-active-yes').checked = true;
			document.getElementById('edit-active-no').checked = false;
		}
		document.getElementById('edit-program').value = editRow.cells[4].innerText;
		document.getElementById('requiredRoom').value = editRow.cells[5].innerText;
		document.getElementById('requiredRoom').innerText = editRow.cells[5].innerText;
		document.getElementById('edit-number-credits').value = editRow.cells[6].innerText;
		document.getElementById('edit-contact-hours').value = editRow.cells[7].innerText;
		document.getElementById('edit-semester-offered').value = editRow.cells[8].innerText;
	}

	// Only give the user the option to save changes if changes are made.
    function enableButton() {
        document.getElementById('editCourse').disabled = false;
	}
	
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
		modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
</script>