<div id="userSearch">
    <h2>Search User</h2>
    <form name="search-user" method="get" action=".">
        <input id="userInput" type="text" placeholder="Enter User Here.."></input>
        <button id="submitUser" type="submit"><i class="fa fa-search"></i></button>
    </form>
    <table id="userTable">
        <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Action</th>
        </tr>
        <?php 
            include_once("./backend/db_connector.php");

            $sql = "SELECT * FROM `user_data`";
            $result = mysqli_query($dbconn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $username = $row['username'];
                $password = $row['password'];
        ?>
        <tr>
            <td><?php echo $username; ?></td>
            <td><?php echo $password; ?></td>
            <td>Edit</td>
        </tr>
        <?php } ?>
    </table>
</div>