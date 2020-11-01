<?php 
    include_once("./backend/db_connector.php");

    //If submit button is pressed.
    if(isset($_POST['addUser'])) 
    {
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
        $dbconn->close();
    }
?>
<div id="userCreate">
    <p class="title">Create User</p>
    <form name="create-user" method="post" action="./create.php?createType=user">
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
        <input type="number" placeholder="Credit-Hour Cap" name="create-max-credits">
        <br>

        <label for="create-min-credits">Min Credits:</label> 
        <input type="number" placeholder="Credit-Hour Minimum" name="create-min-credits">
        <br>

        <!-- This select lists all possible user types from the permissions database table. -->
        <label for="create-usertype">User Type:</label>
        <select name="create-usertype" id="create-usertype">
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
            <?php
                $sql = "SELECT * FROM `programs`";
                $query = mysqli_query($dbconn, $sql);
                while($row = mysqli_fetch_assoc($query)) {
                    echo("<option value='" . $row['PROGRAM'] . "'>" . $row['PROGRAM'] . "</option>");
                }
            ?>
        </select>
        <br>

        <button type="submit" name="addUser">Add User</button>
    </form>
</div>
