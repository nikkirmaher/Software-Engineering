<div id="userCreate">
    <p class="title"> Create User </p>
    <form name="create-user" method="post" action="./create.php?createType=user">
        <label for="create-username">Username:</label> 
        <input type="text" placeholder="Enter username here.." name="create-username">
        <br>

        <label for="create-password">Password:</label> 
        <input type="password" placeholder="Enter password here.." name="create-password">
        <br>
        
        <!-- Using a hard-coded select because we know there will only be three user types for the application -->
        <label id="create" for="create-usertype"> User Type: </label>
        <select name="create-usertype" id="create-usertype">
            <option value="administrator">Administrator</option>
            <option value="chair">Chair</option>
            <option value="secretary">Secretary</option>
        </select>
        <br>

        <button type="submit" name="addUser">Add User</button>
    </form>
</div>

<?php
    //If submit button is pressed.
    if(isset($_POST['addUser'])) 
    {
        include_once("./backend/db_connector.php");
        
        $username = $_POST['create-username'];
        $password = $_POST['create-password'];
        $usertype = $_POST['create-usertype'];
        
        $sql = "INSERT INTO `user_data` (`username`, `password`, `user_type`) VALUES ('$username', '$password', '$usertype')";

        if ($dbconn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $dbconn->error;
        }
        $dbconn->close();
    }
?>