<div id="userSearch">
    <h2>Search User</h2>
    <form name="search-user" method="get" action=".">
        <input id="userInput" type="text" placeholder="Enter User Here.."></input>
        <button id="submitUser" type="submit"><i class="fa fa-search"></i></button>
    </form>
    <table id="userTable">
        <tr>
            <th>UID</th>
            <th>FID</th>
            <th>Username</th>
            <th>Password</th>
            <th>User Type</th>
            <th>Action</th>
        </tr>
        <?php 
            include_once("./backend/db_connector.php");

            $sql = "SELECT * FROM `user_data`";
            $result = mysqli_query($dbconn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $UID = $row['UID'];
                $FID = $row['FID'];
                $username = $row['username'];
                $password = $row['password'];
                $userType = $row['user_type'];
        ?>
        <tr>
            <td><?php echo $UID; ?></td>
            <td><?php echo $FID; ?></td>
            <td><?php echo $username; ?></td>
            <td><?php echo $password; ?></td>
            <td><?php echo $userType; ?></td>
            <td>Edit</td>
        </tr>
        <?php } ?>
    </table>
</div>