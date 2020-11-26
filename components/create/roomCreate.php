<?php
    include_once("./backend/db_connector.php");
    //If submit button is pressed.
    if (isset($_POST['addRoom'])) 
    {  
      $building = $_POST['select-building'];
      $room_num = $_POST['room-number'];
      $short_name = $_POST['select-building'] . $_POST['room-number'];
      $is_required = $_POST['is_req'];
      $is_exclusive = $_POST['is_exclusive'];
      $max_seats = $_POST['Max_seats'];

      $sql = "INSERT INTO `rooms` (`BID`, `room_num`, `short_name`, `is_required`, `is_exclusive`, `max_seats`)
              VALUES ('$building','$room_num', '$short_name', '$is_required', '$is_exclusive','$max_seats')";

      if ($dbconn->query($sql) === TRUE) {
        echo "New record created successfully";
      } 
      else {
        echo "Error: " . $sql . "<br>" . $dbconn->error;
      }
    }
?>

<div id="roomCreate">
  <h2>Create Room</h2>
  <form name="create-room" method="post" action="./create.php?createType=room">
    <label id="add" for="create-room">Building: </label>
    <select name="select-building" id="select-building">
      <option value="">Please select the building</option>
      <?php
        //Get all unique buildings from the database to populate the select.
        $sql = "SELECT * FROM `buildings`";
        $result = mysqli_query($dbconn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          $bname = $row['building_name'];
          $BID = $row['BID'];
          echo("<option value='$BID'>$bname</option>");
        }
      ?>
    </select>
    <br>

    <label id="add" for="create-room">Room Number:</label>
    <input type="text" id="room_num" name="room-number" placeholder="Enter the room number.">
    <br>

    <label id="add" for="create-room">Do any courses require this room?</label><br>
    <input type="radio" id="req" name="is_req" value="Required">
    <label for="req">Required</label>
    <input type="radio" id="not_req" name="is_req" value="Not Required">
    <label for="not_req">Not Required</label>
    <br>	

    <label id="add" for="create-room">Is this room exculisve for any course?</label><br>
    <input type="radio" id="req" name="is_exclusive" value="Required">
    <label for="req">Exclusive</label>
    <input type="radio" id="not_req" name="is_exclusive" value="Not Required">
    <label for="not_req">Not Exclusive</label>
    <br>

    <label id="add" for="create-room">Seats:</label>
    <input type="text" id="max_seats" name="Max_seats" placeholder="Enter the maximum number of seats.">
    <br>

    <button type="submit" name="addRoom">Create Room</button>
  </form>
</div>
