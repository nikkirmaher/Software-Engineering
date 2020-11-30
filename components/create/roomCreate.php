<?php
    include_once("./backend/db_connector.php");
    //If submit button is pressed.
    if (isset($_POST['addRoom'])) 
    {  
      $building = $_POST['select-building'];
      $room_num = $_POST['room-number'];
      $short_name = $building . $room_num;
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

<div class="card">
  <div class="card-header">
    <h2>Create Room</h2>
  </div>
  <div class="card-content">
    <form name="create-room" method="post" action="./create.php?createType=room">
      <div class="card-row">
        <div class="card-column">
          <label for="select-building">Building: </label>
        </div>
        <div class="card-column">
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
        </div>
      </div>
      <div class="card-row">
        <div class="card-column">
          <label for="create-room">Room Number:</label>
        </div>
        <div class="card-column">
          <input type="text" id="room_num" name="room-number" placeholder="Enter the room number.">
        </div>
      </div>
      <div class="card-row">
        <div class="card-column">
          <label for="create-room">Number of Seats:</label>
        </div>
        <div class="card-column">
          <input type="number" id="max_seats" name="Max_seats" placeholder="Enter the maximum number of seats.">
        </div>
      </div>
      <div class="card-row">
        <div class="card-column">
          <label>Do any courses require this room?</label>
        </div>
      </div>
      <div class="card-row">
        <div class="card-column" style="flex-direction:row;">
          <input type="radio" name="is_req" value="Required">
          <label for="req">Required</label>
        </div>
        <div class="card-column" style="flex-direction:row;">
          <input type="radio" name="is_req" value="Not Required">
          <label for="not_req">Not Required</label>
        </div>
      </div>
      <div class="card-row">
        <div class="card-column">
          <label for="exclusive">Is this room exculisvely for any course?</label>
        </div>
      </div>
      <div class="card-row">
        <div class="card-column" style="flex-direction:row;">
          <input type="radio" name="exclusive" value="1">
          <label>Exclusive</label>
        </div>
        <div class="card-column" style="flex-direction:row;">
          <input type="radio" name="exclusive" value="0">
          <label>Not Exclusive</label>
        </div>
      </div>
      <div class="card-row">
        <div class="card-column" style="align-items: center;">
          <button type="submit" name="addRoom">Create Room</button>
        </div>
      </div>
    </form>
  </div>
</div>
