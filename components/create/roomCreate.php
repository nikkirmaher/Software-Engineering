<div id="roomCreate">
    <p class = "title"> Create Room </p>
    <form name="create-room" method="get" action="./create.php">
  	<label id="add" for="create-room"> Select Building: </label> 
				<select id="building" name="building">
					<option value="CHG">College Hall (CHG)</option>
					<option value="CHH">College Hall Honors (CHH)</option>
					<option value="CT">College Theatre (CT)</option>
					<option value="CSB">Coykendall Science Building (CSB)</option>
					<option value="EIH">Engineering Innovation Hub (EIH)</option>
					<option value="FOB">Faculty Office Building (FOB)</option>
					<option value="FAB">Fine Arts Building (FAB)</option>
					<option value="HUM">Humanities Building (HUM)</option>
					<option value="JFT">Jacobson Faculty Tower (JFT)</option>
					<option value="LC">Lecture Center (LC)</option>
					<option value="OFFCAM">Off Campus (OFFCAM)</option>
					<option value="OL">Old Library (OL)</option>
					<option value="OM">Old Main (OM)</option>
					<option value="ONLINE">Online (ONLINE)</option>
					<option value="PT">Parker Theatre (PT)</option>
					<option value="REH">Resnick Engineering Hall (REH)</option>
					<option value="SH">Science Hall (SH)</option>
					<option value="SAB">Smiley Arts Building (SAB)</option>
					<option value="SCB">South Classrooom Building (SCB)</option>
					<option value="VH">Van Den Berg Hall (VH)</option>
					<option value="WH">Wooster Hall (WH)</option>
	</select>

	<label id="add" for="create-room"> Enter Room Number: </label>
	<input type="text" id="room_num" name="Room Number">
	<br>
	<br>


	<label id="add" for="create-room"> Enter Room Short Name: </label>
	<input type="text" id="room_short" name="Room Short Name">
	<br>
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
	
        <input id="submit" type="submit" name="submit">
    </form>
    
   
        <?php
        //If submit button is pressed.
        if (isset($_GET['addBuilding'])) 
        {
            include_once(" ./backend/db_connector.php");
            
            $buidling = $_GET['building'];
            $room_num = $_GET['room_num'];
            $short_name = $_GET['short_name'];
            $is_required = $_GET['is_required'];
            $max_seats = $_GET['max_seats'];

            $sql = "INSERT INTO room (building, room_num, short_name, is_required, max_seats)
                    VALUES ($building, $room_num, $short_name, $is_required, $max_seats)";


            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
              $conn->close();
        }
        ?>
</div>