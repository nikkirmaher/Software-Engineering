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
	//Making the database connection
	include_once("./backend/db_connector.php");

	//Edit Section
	//If submit button is pressed.
	if (isset($_POST['editRoom'])) {		
		$rID = $_POST['edit-rid'];
		$building = $_POST['edit-bid'];
		$room_num = $_POST['edit-room-number'];
		$short_name = $_POST['edit-short-name'];
		$is_required = $_POST['edit-required'];
		$is_exclusive = $_POST['edit-exclusive'];
		$max_seats = $_POST['edit-max-seats'];
		
		//SQL Update Statement for roomSearch form
		$sql = "UPDATE `rooms` 
			SET `BID` = $building, 
				`room_num` = '$room_num', 
				`short_name` = '$short_name', 
				`is_required` = '$is_required',
				`is_exclusive` = '$is_exclusive',
				`max_seats` = '$max_seats'
			WHERE `RID`='$rID'";

		if ($dbconn->query($sql) === TRUE) {
			echo "Room edited successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $dbconn->error;
		}
	}
?>

<div id="roomSearch">
	<h2>Search Room</h2>

	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for room..">
	<br><br>

	<!-- Room table - lists all rooms from the database. -->
	<table id="roomTable" style="display:block; max-width:fit-content; overflow-y:auto; max-height:300px;">
	<tr>
		<th>RID</th>
		<th>BID</th>
		<th>Room Number</th>
		<th>Room Short Name</th> 
		<th>Required?</th>
		<th>Exclusive?</th>
		<th>Maximum Seats</th>
		<th>Action</th>
		<th>Delete</th>
	</tr>
	<?php 
		$sql = "SELECT * FROM `rooms`";
		$result = mysqli_query($dbconn, $sql);
		$numResults = mysqli_num_rows($result);

		if($numResults < 1) {
			echo("<tr>
				<td colspan='10'>No Rooms found</td>
				</tr>");
		}
		else {
			$rowNum = 0;
			while ($row = mysqli_fetch_assoc($result)) {
				$rid = $row['RID'];
				$bid = $row['BID'];
				$roomnum = $row['room_num'];
				$roomshort = $row['short_name'];
				$required = $row['is_required'];
				$exclusive = $row['is_exclusive'];
				$maxseats = $row['max_seats'];
	?>
	<tr>
		<td><?php echo $rid; ?></td>
		<td><?php echo $bid; ?></td>
		<td><?php echo $roomnum; ?></td>
		<td><?php echo $roomshort; ?></td>
		<td><?php echo $required; ?></td>
		<td><?php echo $exclusive; ?></td>
		<td><?php echo $maxseats; ?></td>
		<td><button type="button" onclick="displayModal(<?php echo ++$rowNum ?>, 'roomTable')">View</button></td>
		<td><button type="button" onclick="displayModal2()">Delete</button></td>
	</tr>
	<?php 
			}
		}
	?>
	</table>
</div>

<!-- The view modal for a selected room, it uses the same form-layout 
    for creating rooms and populates its fields with data from directly
    from the table instead of making another database call. -->
<div id="myModal" class="modal">
	<div class="modal-content">
		<span class="close" onclick="closeModal()">&times;</span>
		<p class="title">Edit Room</p>
		<form name="edit-room" method="post" action="./search.php?searchType=room">
			<input type="hidden" name="edit-rid" id="edit-rid"> 

			<label for="edit-bid">Building:</label>
			<input type="text" name="edit-bid" id="edit-bid" onkeyup="enableButton();">
			<br>
			<label for="edit-room-number">Room Number:</label>
			<input type="text" name="edit-room-number" id="edit-room-number" onkeyup="enableButton();">
			<br>
			<label for="edit-short-name">Room Short Name:</label>
			<input type="text" name="edit-short-name" id="edit-short-name" onkeyup="enableButton();">
			<br>

			Is this room Required by any courses?<br>
			<input type="radio" name="edit-required" id="edit-required-yes" value="1" onchange="enableButton();">
			<label for="edit-required">Yes</label>
			<input type="radio" name="edit-required" id="edit-required-no" value="0" onchange="enableButton();">
			<label for="edit-required">No</label>
			<br>

			Is this room Exclusively for any courses?<br>
			<input type="radio" name="edit-exclusive" id="edit-exclusive-yes" value="1" onchange="enableButton();">
			<label for="edit-exclusive-yes">Yes</label>
			<input type="radio" name="edit-exclusive" id="edit-exclusive-no" value="0" onchange="enableButton();">
			<label for="edit-exclusive-no">No</label>
			<br>

			
			<label for="edit-max-seats">Max Seats:</label>
			<input type="number" name="edit-max-seats" id="edit-max-seats" onchange="enableButton();">
			<br>

			<button type="submit" name="editRoom" id="editRoom" disabled>Save Changes</button>
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
		document.getElementById('edit-rid').value = editRow.cells[0].innerText;
		document.getElementById('edit-bid').value = editRow.cells[1].innerText; 
		document.getElementById('edit-room-number').value = editRow.cells[2].innerText;
		document.getElementById('edit-short-name').value = editRow.cells[3].innerText;

		//Required and Exclusive fields have boolean values and require
		//user input to be either yes or no.
		if(editRow.cells[4].innerText === "0") {
			document.getElementById('edit-required-no').checked = true;
			document.getElementById('edit-required-yes').checked = false;
		}
		else if(editRow.cells[4].innerText === "1") {
			document.getElementById('edit-required-yes').checked = true;
			document.getElementById('edit-required-no').checked = false;
		}
		
		if(editRow.cells[5].innerText === "0") {
			document.getElementById('edit-exclusive-no').checked = true;
			document.getElementById('edit-exclusive-yes').checked = false;
		}
		else if(editRow.cells[5].innerText === "1") {
			document.getElementById('edit-exclusive-yes').checked = true;
			document.getElementById('edit-exclusive-no').checked = false;
		}

		document.getElementById('edit-max-seats').value = editRow.cells[6].innerText;
	}

	// Only give the user the option to save changes if changes are made.
    function enableButton() {
        document.getElementById('editRoom').disabled = false;
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
  table = document.getElementById("roomTable");
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