<!-- This file is used with AJAX to get and return a user's availability
the information is returned in the form of table rows -->

<?php
    include_once('./config.php');
    include_once('./db_connector.php');
    
    $userID = $_GET['UID'];

    $sql="SELECT * FROM `user_schedule` WHERE `UID` = '". $userID ."'";
    $result = mysqli_query($dbconn, $sql);

    if(mysqli_num_rows($result) > 0) {
        echo("<tr>
            <th>Week Day</th>
            <th>Start Time</th>
            <th>End Time</th>
        </tr>");

        while($row = mysqli_fetch_array($result)) {
            echo("<tr>
                    <td>" . $row['day'] . "</td>"
                    . "<td>" . $row['start_time'] . "</td>"
                    . "<td>" . $row['end_time'] . "</td>"
                . "</tr>");   
        }
    }
    else {
        echo("No Availability Found, or user is full-time.");
    }
    mysqli_close($dbconn);

?>