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
        
        //Check if the user arrived here from submitting the edit user or delete user form.
        if(isset($_POST['editUser'])) {
            $UID = $_POST['edit-uid'];
            $PID = $_POST['edit-usertype'];
            $email = $_POST['edit-email'];
            $password = $_POST['edit-password'];
            $firstname = $_POST['edit-first-name'];
            $lastname = $_POST['edit-last-name'];
            $maxcred = $_POST['edit-max-credits'];
            $mincred = $_POST['edit-min-credits'];
            $program = $_POST['edit-program'];
            
            $sql = "UPDATE `user_data`
                SET `PID` = '$PID', 
                    `email` = '$email', 
                    `password` = '$password', 
                    `first_name` = '$firstname', 
                    `last_name` = '$lastname', 
                    `max_credits` = '$maxcred', 
                    `min_credits` = '$mincred', 
                    `PROGRAM` = '$program'
                WHERE `UID` = $UID";
    
            if ($dbconn->query($sql) === TRUE) {
                echo "User edited successfully";
            } 
            else {
                echo "Error: " . $sql . "<br>" . $dbconn->error;
            }
        }
        else if(isset($_POST['removeUser'])) {
            /*  PHP for removing the selected user from the database.
                First, it has to delete foriegn key references, so the user's schedules are removed.

                Alternatively, we could set the user to a new "terminated" permission type keeping 
                their record but disallowing them to sign in or be scheduled. */
    
            $UID=$_POST['userID'];
    
            $sql = "DELETE FROM `user_schedule` WHERE `UID` = $UID";
            if ($dbconn->query($sql) === TRUE) {
                echo "<br>User's schedules removed successfully. ";
            } 
            else {
                echo "Error: " . $sql . "<br>" . $dbconn->error;
            }

            $sql = "DELETE FROM `user_data` WHERE `UID` = $UID";

            if ($dbconn->query($sql) === TRUE) {
                echo "User removed successfully.";
            } 
            else {
                echo "Error: " . $sql . "<br>" . $dbconn->error;
            }
        }
    }
?>

<div id="userSearch">
    <h2>Search User</h2>

    <!-- Input field for the table search filter -->
	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for user..">
    <br><br>

    <!-- User Table - lists all users from the database. -->
    <table class="search-table" id="userTable">
        <tr>
            <th>UID</th>
            <th>User Type</th>
            <th>Email</th>
            <th>Password</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Max Credits</th>
            <th>Min Credits</th>
            <th>Program</th>
            <th>Action</th>
			<th>Delete</th>
        </tr>
        <?php 
            $sql = "SELECT * FROM user_data
                        JOIN `permissions`
                            ON user_data.PID = `permissions`.PID";
            $result = mysqli_query($dbconn, $sql);
            $numResults = mysqli_num_rows($result);

            if($numResults < 1) {
                echo("<tr>
                    <td colspan='10'>No Users found</td>
                    </tr>");
            }
            else {
                $rowNum = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $UID = $row['UID'];
                    $PID = $row['user_type'];
                    $useremail = $row['email'];
                    $password = $row['password'];
                    $firstname = $row['first_name'];
                    $lastname = $row['last_name'];
                    $maxcred = $row['max_credits'];
                    $mincred = $row['min_credits'];
                    $program = $row['PROGRAM'];
        ?>
        <tr>
            <td><?php echo $UID; ?></td>
            <td><?php echo $PID; ?></td>
            <td><?php echo $useremail; ?></td>
            <td><?php echo $password; ?></td>
            <td><?php echo $firstname; ?></td>
            <td><?php echo $lastname; ?></td>
            <td><?php echo $maxcred; ?></td>
            <td><?php echo $mincred; ?></td>
            <td><?php echo $program; ?></td>
            <td><button type="button" onclick="displayModal(<?php echo ++$rowNum; ?>, 'userTable')">View</button></td>
			<td><button type="button" onclick="displayModal2(<?php echo $UID; ?>)">Delete</button></td>
        </tr>
        <?php 
                } 
            } 
        ?>
    </table>
</div>

<!-- The view modal for a selected user, it uses the same form-layout 
    for creating users and populates its fields with data from directly
    from the table instead of making another database call. -->
<div id="myModal" class="modal">
	<div class="modal-content">
		<span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit User</h2>
        <form name="edit-user" method="post" action="./search.php?searchType=user">
            <input type="hidden" id="edit-uid" name="edit-uid">
			<div class="card-row">
				<div class="card-column">
                    <label for="edit-email">Email:</label> 
				</div>
				<div class="card-column">
                    <input type="email" name="edit-email" id="edit-email" onkeyup="enableButton();">
				</div>
			</div>
			<div class="card-row">
				<div class="card-column">
                    <label for="edit-password">Password:</label> 
				</div>
				<div class="card-column">
                    <input type="password" name="edit-password" id="edit-password" onkeyup="enableButton();">
				</div>
			</div>
			<div class="card-row">
				<div class="card-column">
                    <label for="edit-first-name">First Name:</label> 
				</div>
				<div class="card-column">
                    <input type="text" name="edit-first-name" id="edit-first-name" onkeyup="enableButton();">
				</div>
			</div>
			<div class="card-row">
				<div class="card-column">
                    <label for="edit-last-name">Last Name:</label> 
				</div>
				<div class="card-column">
                    <input type="text" name="edit-last-name" id="edit-last-name" onkeyup="enableButton();">
				</div>
            </div>
            <!-- Min and Max credits are used to determine if the user is full or part time. -->
			<div class="card-row">
				<div class="card-column">
                    <label for="edit-max-credits">Max Credits:</label> 
				</div>
				<div class="card-column">
                    <input type="number" name="edit-max-credits" id="edit-max-credits" onchange="enableButton();">
				</div>
			</div>
			<div class="card-row">
				<div class="card-column">
                    <label for="edit-min-credits">Min Credits:</label> 
				</div>
				<div class="card-column">
                    <input type="number" name="edit-min-credits" id="edit-min-credits" onchange="enableButton();">
				</div>
			</div>
			<div class="card-row">
				<div class="card-column">
                    <!-- This select lists all possible user types from the permissions database table. -->
                    <label for="edit-usertype">User Type:</label>
                </div>
				<div class="card-column">
                    <select name="edit-usertype" id="edit-usertype" onchange="enableButton();">
                        <option id="usertype-select" value=""></option>
                        <?php
                            $sql = "SELECT * FROM `permissions`";
                            $query = mysqli_query($dbconn, $sql);
                            while($row = mysqli_fetch_assoc($query)) {
                                echo("<option value='" . $row['PID'] . "'>" . $row['user_type'] . "</option>");
                            }
                        ?>
                    </select>
                </div>
			</div>
			<div class="card-row">
				<div class="card-column">
                    <!-- This select lists all possible programs from the programs database table. -->
                    <label for="edit-program">Program:</label>
				</div>
				<div class="card-column">
                    <select name="edit-program" id="edit-program" onchange="enableButton();">
                        <option id="program-select" value=""></option>
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
                <div class="card-column" style="align-items: center;">
                    <button type="submit" name="editUser" id="editUser" disabled>Save Changes</button>
                </div>
                <div class="card-column" style="align-items: center;">
                    <button type="button" name="cancel" onclick="document.getElementById('myModal').style.display = 'none';">Cancel</button>
                </div>
            </div>
        </form>
            
        <h3>Availability</h3>
        <table id="availabilityTable">
        </table>
    </div>
</div>

<div id="myModal2" class="modal">
	<div class="modal-content">
        <span class="close" onclick="closeModal()">×</span>
        <div class="modal-text" id="modal2-text">
            <h2>Delete</h2>
            <p>Are you sure you want to delete?</p>
            <form action="./search.php?searchType=user" method="POST">
                <input type="hidden" name="userID" id="userID">
                <button type="submit" name="removeUser">Yes, delete</button>
                <button type="button" onclick="closeModal()">No, do not delete</button>
            </form>
	    </div>
    </div>
</div>	

<script>
    //Get the modals
	var modal = document.getElementById("myModal");
	var modal2 = document.getElementById("myModal2");

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
        document.getElementById('edit-uid').value = editRow.cells[0].innerText;
        document.getElementById('edit-email').value = editRow.cells[2].innerText;
        document.getElementById('edit-password').value = editRow.cells[3].innerText;
        document.getElementById('edit-first-name').value = editRow.cells[4].innerText;
        document.getElementById('edit-last-name').value = editRow.cells[5].innerText;
        document.getElementById('edit-max-credits').value = editRow.cells[6].innerText;
        document.getElementById('edit-min-credits').value = editRow.cells[7].innerText;

        //The program field requires the value and inner text attributes to be set.
        document.getElementById('program-select').value = editRow.cells[8].innerText;
        document.getElementById('program-select').innerText = editRow.cells[8].innerText;

        //The user type field requires the correct PID and user_type from the database.
        //This is currently hardcoded for lack of a better method (without making more database calls)
        if(editRow.cells[1].innerText === 'scheduler') {
            document.getElementById('usertype-select').value = 4;
            document.getElementById('usertype-select').innerText = editRow.cells[1].innerText;
        }
        else if (editRow.cells[1].innerText === 'viewer') {
            document.getElementById('usertype-select').value = 5;
            document.getElementById('usertype-select').innerText = editRow.cells[1].innerText;
        }
        showAvailability(editRow.cells[0].innerText);
    }
    // Only give the user the option to save changes if changes are made.
    function enableButton() {
        document.getElementById('editUser').disabled = false;
    }
	//Display Delete Modal
	function displayModal2(userID){
		modal2.style.display = "block";
        document.getElementById("userID").value = userID;
	}
	// When the user clicks on <span> (x), close the modal
	function closeModal() {
		modal.style.display = "none";
		modal2.style.display = "none";
	}
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    //Function to show the courses available in a selected department.
    function showAvailability(str) {
        if (str == "") {
            return;
        } 
        else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("availabilityTable").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "./backend/getAvailability.php?UID="+str, true);
            xmlhttp.send();
        }
    }
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("userTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;

                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } 
                else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>