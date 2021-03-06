<head>
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>
</head>

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

<!-- Course Search -->
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for courses..">
<br>
<br>
	<table id="courseTable"style="display:block; max-width:fit-content; overflow-y:auto; max-height:300px;">
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
			<th>Delete</th>
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
			<td><button type="button" onclick="displayModal2()">Delete</button></td>
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
		<span class="close" onclick="closeModal()">&times;</span>
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
</div>

<div id="myModal2" class="modal">

	<div class="modal-content">
      <span class="close" onclick="closeModal()">×</span>
	  <div class="modal-text" id="modal2-text">
      <h2>Delete</h2>
    
      <p>Are you sure you want to delete?</p>
	  <button type="button">Yes, delete</button>
	  <button type="button" onclick="closeModal()">No, do not delete</button>
	  </div>
  </div>

</div>	

<script>
	//Get the modal
	var modal = document.getElementById("myModal");
	var modal2 = document.getElementById("myModal2");
	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

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
	//Display Delete Modal
	function displayModal2()
	{
		modal2.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	function closeModal()
	{
		modal.style.display = "none";
		modal2.style.display = "none";
	}

	// Only give the user the option to save changes if changes are made.
    function enableButton() {
        document.getElementById('editCourse').disabled = false;
	}
	
	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
</script>

<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("courseTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    	for (j = 0; j < table.rows[0].cells.length; j++){
		td = tr[i].getElementsByTagName("td")[j];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
   	}
  }
}
</script>