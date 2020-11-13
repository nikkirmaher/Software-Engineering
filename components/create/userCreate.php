<?php 
    include_once("./backend/db_connector.php");

    //If submit button is pressed.
    if(isset($_POST['addUser'])) {
        $permissions = $_POST['create-usertype'];
        $email = $_POST['create-email'];
        $password = $_POST['create-password'];
        $firstname = $_POST['create-first-name'];
        $lastname = $_POST['create-last-name'];
        $maxcred = $_POST['create-max-credits'];
        $mincred = $_POST['create-min-credits'];
        $program = $_POST['create-program'];

        $sql = "INSERT INTO `user_data` (`PID`, `email`, `password`, `first_name`, `last_name`, `max_credits`, `min_credits`, `program`) 
                    VALUES ('$permissions', '$email', '$password', '$firstname', '$lastname', '$maxcred', '$mincred', '$program')";

        if ($dbconn->query($sql) === TRUE) {
            echo "User successfully added.";
        } 
        else {
            echo "Error adding new user: " . $sql . "<br>" . $dbconn->error;
        }
        //Check if availability was provided
        if($_POST['availability-rows'] > 0 ) {
            $numberRows = $_POST['availability-rows'];

            $sql = "SELECT * FROM `user_data` WHERE `email` = '$email'";
            $query = mysqli_query($dbconn, $sql);
            $row = mysqli_fetch_assoc($query);

            $userID = $row['UID'];
            $semesterID = $_POST['semester'];

            for($i = 0; $i < $numberRows; ++$i) {
                $day = $_POST['day' . $i];
                $startTime = $_POST['start' . $i];
                $endTime = $_POST['end' . $i];
                
                $sql = "INSERT INTO 'user_schedule' (`UID`,`SEID`,`day`,`available_time`,`end_time`)
                            VALUES ('$userID', '$semesterID', '$day', '$startTime', '$endTime')";
                if ($dbconn->query($sql) === TRUE) {
                    echo "User availability updated sucessfully";
                } 
                else {
                    echo "Error updating user availability: " . $sql . "<br>" . $dbconn->error;
                }
            }
        }
    }
?>
<div id="userCreate">
    <form name="create-user" method="post" action="./create.php?createType=user">
        <div>
            <h2>Create User</h2>
            <label for="create-email">Email:</label>
            <input type="email" placeholder="Enter user's email here.." name="create-email">
            <br>
            <label for="create-password">Password:</label>
            <input type="password" placeholder="Enter password here.." name="create-password">
            <br>
            <label for="create-first-name">First Name:</label>
            <input type="text" placeholder="Enter user's first name here.." name="create-first-name">
            <br>
            <label for="create-last-name">Last Name:</label>
            <input type="text" placeholder="Enter user's last name here.." name="create-last-name">
            <br>
            <!-- Min and Max credits are used to determine if the user is full or part time. -->
            <label for="create-max-credits">Max Credits:</label>
            <input type="number" placeholder="Credit-Hour Maximum" name="create-max-credits">
            <br>
            <label for="create-min-credits">Min Credits:</label>
            <input type="number" placeholder="Credit-Hour Minimum" name="create-min-credits">
            <br>
            <!-- This select lists all possible user types from the permissions database table. -->
            <label for="create-usertype">User Type:</label>
            <select name="create-usertype" id="create-usertype">
                <option value="">Please select the user type.</option>
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
            <label for="create-program">Program:</label>
            <select name="create-program" id="create-program">
                <option value="">Please select a program</option>
                <?php
                    $sql = "SELECT * FROM `programs`";
                    $query = mysqli_query($dbconn, $sql);
                    while($row = mysqli_fetch_assoc($query)) {
                        echo("<option value='" . $row['PROGRAM'] . "'>" . $row['PROGRAM'] . "</option>");
                    }
                ?>
            </select>
            <br>
        </div>

        <div id="userAvailability" style="display: none;">
            <h2>User Availability</h2>
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
            <br>
            <label for="available-day">Day Available:</label>
            <select name="available-day" id="available-day">
                <option value="">Please choose a day.</option>
                <option value="Sunday">Sunday</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
            </select>
            <label for="startTime">Start Time</label>
            <input type="time" name="startTime" id="startTime">
            <label for="endTime">End Time</label>
            <input type="time" name="endTime" id="endTime">
            <button type="button" onclick='addAvailability()'>Add</button>
            <br><br>

            <input type="hidden" name="availability-rows" id="availability-rows" value=0>
            <table name="availability-table" id="availability-table">
                <tr>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>
                </tr>
            </table>
            <br><br>
        </div>

        <button type="submit" name="addUser">Add User</button>
        <button type="button" id="showAvailability" onclick="document.getElementById('userAvailability').style.display='block';">Add Availability</button>
    </form>
</div>

<script>
    //function for adding the selected availability information to the availability table
    function addAvailability() {
        document.getElementById('showAvailability').style.display='none';
        
        var semester = document.getElementById('semester').value;
        var dayAvail = document.getElementById('available-day').value;
        var startTime = document.getElementById('startTime').value;
        var endTime = document.getElementById('endTime').value;

        if(dayAvail != "" && startTime != "" && endTime != "" && semester != "") {
            var table = document.getElementById('availability-table');

            //Inserting a new row in the availability table.
            var row = table.insertRow();
            document.getElementById('availability-rows').value++;
            var rowNumber = table.rows.length - 1;

            //Creating inputs element to add to the corresponding columns with the user selected values.
            var cell1 = row.insertCell(0);
            var dayAvailable = document.createElement("INPUT");
            dayAvailable.setAttribute("type", "text");
            dayAvailable.setAttribute("value", dayAvail);
            dayAvailable.setAttribute("name", "day" + rowNumber);
            dayAvailable.setAttribute("readonly", true);
            cell1.appendChild(dayAvailable);
            
            var cell2 = row.insertCell(1);
            var startAvailable = document.createElement("INPUT");
            startAvailable.setAttribute("type", "time");
            startAvailable.setAttribute("value", startTime);
            startAvailable.setAttribute("name", "start" + rowNumber);
            cell2.appendChild(startAvailable);

            var cell3 = row.insertCell(2);
            var endAvailable = document.createElement("INPUT");
            endAvailable.setAttribute("type", "time");
            endAvailable.setAttribute("value", endTime);
            endAvailable.setAttribute("name", "end" + rowNumber);
            cell3.appendChild(endAvailable);

            var cell4 = row.insertCell(3);
            var removeButton = document.createElement("BUTTON");
            removeButton.setAttribute("type", "button");
            removeButton.setAttribute("onclick", "removeRow(" + rowNumber + ")");
            removeButton.innerText = "Remove";
            cell4.appendChild(removeButton);
        }
        else {
            alert("Please enter something in each user-availability field.");
        }
    }
    //Function for removing a row from the availability table.
    function removeRow(tableRow) {
        var table = document.getElementById('availability-table');
        document.getElementById('availability-rows').value--;
        table.deleteRow(tableRow);
    }
</script>