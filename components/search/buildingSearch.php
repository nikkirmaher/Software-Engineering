<?php
	//Check to see if the user is signed in and has access to this information.
    if(!isset($_SESSION['user'])) {
        echo("Please sign in to view this content.");
        exit();
    }
    else if($_SESSION['user_type'] == 'viewer') {
        echo("<br>You do not have permission access to this information.");
        exit();
    }
    else {
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
		else if(isset($_POST['removeBuilding'])) {
			//Removing the building only works when it's not associated with anything else.
			//A future version might allow different types of deletes where references are either saved or removed.
			$BID = $_POST['buildingID'];
            $sql = "DELETE FROM `buildings` WHERE `BID` = $BID";
			
			if ($dbconn->query($sql) === TRUE) {
                echo "<br>Building removed successfully.";
            } 
            else {
                echo "Error: " . $sql . "<br>" . $dbconn->error;
            }
		}
	}
?>

<div id="buildingSearch">
	<h2>Search Building</h2>
	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for building..">

	<!-- Building Table - lists all buildings from the database. -->
	<table class="search-table" id="buildingTable">
		<tr>
			<th>BID</th>
			<th>Building Name</th>
			<th>Building Abbreviation</th>
			<th>Action</th>
			<th>Delete</th>
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
			<td><button type="button" onclick="displayModal2(<?php echo $bid; ?>)">Delete</button></td>
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
		<span class="close"  onclick="closeModal()">&times;</span>
		<h2>Edit Building</h2>
		<form name="edit-building" method="post" action="./search.php?searchType=building">
			<input type="hidden" name="edit-bid" id="edit-bid"> 
			
			<div class="card-row">
				<div class="card-column">
					<label for="edit-building-name"> Building Name: </label>
				</div>
				<div class="card-column">
					<input type="text" name="edit-building-name" id="edit-building-name" onkeyup="enableButton();">
				</div>
			</div>
			<div class="card-row">
				<div class="card-column">
					<label for="edit-building-abbreviation"> Building Abbreviation: </label>
				</div>
				<div class="card-column">
					<input type="text" name="edit-building-abbreviation" id="edit-building-abbreviation" onkeyup="enableButton();">
				</div>
			</div>
			<div class="card-row">
				<div class="card-column" style="align-items: center;">
					<button type="submit" name="editBuilding" id="editBuilding" disabled>Save Changes</button>
				</div>
				<div class="card-column" style="align-items: center;">
					<button type="button" name="cancel" onclick="document.getElementById('myModal').style.display = 'none';">Cancel</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div id="myModal2" class="modal">
	<div class="modal-content">
      <span class="close" onclick="closeModal()">×</span>
	  <div class="modal-text" id="modal2-text">
		<h2>Delete</h2>
		<p>Are you sure you want to delete?</p>
		<form action="./search.php?searchType=building" method="POST">
			<input type="hidden" name="buildingID" id="buildingID">
			<button type="submit" name="removeBuilding">Yes, delete</button>
			<button type="button" onclick="closeModal()">No, do not delete</button>
		</form>
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
		document.getElementById('edit-bid').value = editRow.cells[0].innerText;
		document.getElementById('edit-building-name').value = editRow.cells[1].innerText; 
		document.getElementById('edit-building-abbreviation').value = editRow.cells[2].innerText;
	}
	//Display Delete Modal
	function displayModal2(buildingID){
		modal2.style.display = "block";
        document.getElementById("buildingID").value = buildingID;
	}

	// Only give the user the option to save changes if changes are made.
    function enableButton() {
        document.getElementById('editBuilding').disabled = false;
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
  table = document.getElementById("buildingTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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
</script>