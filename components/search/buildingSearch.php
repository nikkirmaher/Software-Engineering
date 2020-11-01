<?php
	//Making the database connection
	include_once("./backend/db_connector.php");

	//Edit Section 
	//If submit button is pressed.
	if (isset($_POST['editBuilding'])) {	
		$bID = $_POST['edit-bid'];
		$building_name = $_POST['edit-building-name'];
		$building_abbreviation = $_POST['edit-building-abbreviation'];
		
		//SQL Update Statement for buildingSearch form
		$sql = "UPDATE `buildings`
			SET `building_name` = '$building_name', 
				`building_abbreviation` = '$building_abbreviation'
			WHERE BID=$bID";
		
		if ($dbconn->query($sql) === TRUE) {
			echo "Building edited successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $dbconn->error;
		}
	}
?>

<div id="buildingSearch">
	<h2>Search Building</h2>
	
	<input id="userInput" type="text" placeholder="Enter Building Here.." name="search-building">
	<button id="searchBuilding" type="button">Search</button>
	<br><br>

	<!-- Building Table - lists all buildings from the database. -->
	<table id="buildingTable">
		<tr>
			<th>BID</th>
			<th>Building Name</th>
			<th>Building Abbreviation</th>
			<th>Action</th>
		</tr>		
		<?php 
			$sql = "SELECT * FROM `buildings`";
			$result = mysqli_query($dbconn, $sql);
			$numResults = mysqli_num_rows($result);

			if($numResults < 1) {
                echo("<tr>
                    <td colspan='10'>No Buildings found</td>
                    </tr>");
            }
            else {
				$rowNum = 0;
				while ($row = mysqli_fetch_assoc($result)) {
					$bid = $row['BID'];
					$bname = $row['building_name'];
					$babrv = $row['building_abbreviation'];
		?>
		<tr>
			<td><?php echo $bid; ?></td>
			<td><?php echo $bname; ?></td>
			<td><?php echo $babrv; ?></td>
			<td><button type="button" onclick="displayModal(<?php echo ++$rowNum ?>, 'buildingTable')">View</button></td>
		</tr>
		<?php 
				}
			}
		?>
	</table>
</div>

<!-- The view modal for a selected building, it uses the same form-layout 
    for creating buildings and populates its fields with data from directly
    from the table instead of making another database call. -->
<div id="myModal" class="modal">
	<div class="modal-content">
		<span class="close">&times;</span>
		<p class="title">Edit Building</p>
		<form name="edit-building" method="post" action="./search.php?searchType=building">
			<input type="hidden" name="edit-bid" id="edit-bid"> 

			<label for="edit-building-name"> Building Name: </label>
			<input type="text" name="edit-building-name" id="edit-building-name" onkeyup="enableButton();">
			<br>
			
			<label for="edit-building-abbreviation"> Building Abbreviation: </label>
			<input type="text" name="edit-building-abbreviation" id="edit-building-abbreviation" onkeyup="enableButton();">
			<br>

			<button type="submit" name="editBuilding" id="editBuilding" disabled>Save Changes</button>
            <button type="button" name="cancel" onclick="document.getElementById('myModal').style.display = 'none';">Cancel</button>
		</form>
	</div>
</div>

<script>
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
		document.getElementById('edit-bid').value = editRow.cells[0].innerText;
		document.getElementById('edit-building-name').value = editRow.cells[1].innerText; 
		document.getElementById('edit-building-abbreviation').value = editRow.cells[2].innerText;
	}

	// Only give the user the option to save changes if changes are made.
    function enableButton() {
        document.getElementById('editBuilding').disabled = false;
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