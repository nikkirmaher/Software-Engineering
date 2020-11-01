<?php
    //Making the database connection
    include_once("./backend/db_connector.php");
    
    //PHP for gathering the user input and updating the record in the database.
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
        Alternatively, we could set the user to a new "terminated" 
        permission type keeping their record. */
        $sql = "UPDATE `user_data` 
            SET `PID` = 4
            WHERE `UID` = $UID";
        if ($dbconn->query($sql) === TRUE) {
            echo "User terminated successfully.";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $dbconn->error;
        }
    }
?>

<div id="userSearch">
    <h2>Search User</h2>

    <!-- Input field for the table search filter -->
    <input id="userInput" type="text" placeholder="Enter User Here.."></input>
    <button id="searchUser" type="button">Search</button>
    <br><br>

    <!-- User Table - lists all users from the database. -->
    <table id="userTable">
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
		<span class="close">&times;</span>
		<p class="title">Edit User</p>
        <form name="edit-user" method="post" action="./search.php?searchType=user">
            <input type="hidden" id="edit-uid" name="edit-uid">

            <label for="edit-email">Email:</label> 
            <input type="email" name="edit-email" id="edit-email" onkeyup="enableButton();">
            <br>

            <label for="edit-password">Password:</label> 
            <input type="password" name="edit-password" id="edit-password" onkeyup="enableButton();">
            <br>

            <label for="edit-first-name">First Name:</label> 
            <input type="text"  name="edit-first-name" id="edit-first-name" onkeyup="enableButton();">
            <br>

            <label for="edit-last-name">Last Name:</label> 
            <input type="text" name="edit-last-name" id="edit-last-name" onkeyup="enableButton();">
            <br>
            
            <!-- Min and Max credits are used to determine if the user is full or part time. -->
            <label for="edit-max-credits">Max Credits:</label> 
            <input type="number" name="edit-max-credits" id="edit-max-credits" onchange="enableButton();">
            <br>

            <label for="edit-min-credits">Min Credits:</label> 
            <input type="number" name="edit-min-credits" id="edit-min-credits" onchange="enableButton();">
            <br>

            <!-- This select lists all possible user types from the permissions database table. -->
            <label for="edit-usertype">User Type:</label>
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
            <br>

            <!-- This select lists all possible programs from the programs database table. -->
            <label for="edit-program">Program:</label>
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
            <br>

            <button type="submit" name="editUser" id="editUser" disabled>Save Changes</button>
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
    }

    // Only give the user the option to save changes if changes are made.
    function enableButton() {
        document.getElementById('editUser').disabled = false;
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