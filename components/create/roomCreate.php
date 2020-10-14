<div id="roomCreate">
    <p class = "title"> Create Room </p>
    <form name="create-room" method="get" action="./create.php">
		 <label id="add" for="create-room"> Select Building: </label>
		 <input type="text" placeholder="Enter room here..." name="select-building">
		 <br>

	 	 <label id="add" for="create-room"> Enter Room Number: </label>
	 	 <input type="text" id="room_num" name="room-number">
		 <br>
		 
		 <label id="add" for="create-room"> Enter Room Short Name: </label>
		 <input type="text" id="room_short" name="room-short-name">
		 <br>

		 <label id="add" for="create-room"> Is this for a required course? </label>
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
        if (isset($_GET['addRoom'])) 
        {
            include_once("./backend/db_connector.php");
            
            $building = $_GET['select-building'];
            $room_num = $_GET['room-number'];
            $short_name = $_GET['room-short-name'];
            $is_required = $_GET['is_req'];
            $max_seats = $_GET['Max_seats'];

            $sql = "INSERT INTO `room` (`building`, `room_num`, `short_name`, `is_required`, `max_seats`)
                    VALUES ('$building', '$room_num', '$short_name', '$is_required', '$max_seats')";


            if ($dbconn->query($sql) === TRUE) {
                echo "New record created successfully";
              } else {
                echo "Error: " . $sql . "<br>" . $dbconn->error;
              }
              $dbconn->close();
        }
        ?>