<?php 
  include_once("./backend/db_connector.php");
?>

<div id="roomCreate">
  <p class = "title"> Create Room </p>
  <form name="create-room" method="post" action="./create.php?createType=room">
    <label id="add" for="create-room"> Select Building: </label>
    <select name="select-building" id="select-building">
    <?php
      //Get all unique buildings from the database to populate the select.
      $sql = "SELECT * FROM `buildings`";
      $result = mysqli_query($dbconn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
        $bname = $row['building_name'];
        $bshort = $row['building_abbreviation'];
        echo("<option value='$bshort'>$bname</option>");
      }
    ?>
    </select>
    <br>

    <label id="add" for="create-room"> Enter Room Number: </label>
    <input type="text" id="room_num" name="room-number">
    <br>

    <label id="add" for="create-room">Do any courses require this room?</label>
    <input type="radio" id="req" name="is_req" value="Required">
    <label for="req">Required</label>
    <input type="radio" id="not_req" name="is_req" value="Not Required">
    <label for="not_req">Not Required</label><br>	
    <br>

    <label id="add" for="create-room"> Enter maximum number of seats: </label>
    <input type="text" id="max_seats" name="Max_seats">
    <br>

    <input id="submit" type="submit" name="addRoom">
  </form>
</div>
<?php
//If submit button is pressed.
if (isset($_POST['addRoom'])) 
{  
    $building = $_POST['select-building'];
    $room_num = $_POST['room-number'];
    $short_name = $_POST['select-building'] . $_POST['room-number'];
    $is_required = $_POST['is_req'];
    $max_seats = $_POST['Max_seats'];

    $sql = "INSERT INTO `room` (`room_num`, `short_name`, `is_required`, `max_seats`)
            VALUES ('$room_num', '$short_name', '$is_required', '$max_seats')";

    if ($dbconn->query($sql) === TRUE) {
      echo "New record created successfully";
    } 
    else {
      echo "Error: " . $sql . "<br>" . $dbconn->error;
    }
    $dbconn->close();
}
?>