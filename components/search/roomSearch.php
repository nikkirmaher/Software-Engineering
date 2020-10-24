<div id="roomSearch">
	<h2>Search Room</h2>
	<form name="search-room" method="get" action="...">
		<input type="text" placeholder="Enter Room Here.." name="search-room">
		<button id="submitRoom" type="submit"><i class="fa fa-search"></i></button>
	</form>

	<table>
	<tr>
		<th>RID</th>
		<th>BID</th> 
		<th>Building Name</th>
		<th>Room Number</th>
		<th>Room Short Name</th> 
		<th>Required?</th>
		<th>Maximum Seats</th>
		<th>Action</th>
	</tr>
	
	<?php 
		include_once("./backend/db_connector.php");

		$sql = "SELECT * FROM `room`";
		$result = mysqli_query($dbconn, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			$roomID = $row['RID'];
			$buildingID = $row['BID'];
			$building = $row['building'];
			$roomNum = $row['room_num'];
			$shortName = $row['short_name'];
			$isRequired = $row['is_required'];
			$maxSeats = $row['max_seats'];
	?>
	<tr>
		<td><?php echo $roomID; ?></td>
		<td><?php echo $buildingID; ?></td>
		<td><?php echo $building; ?></td>
		<td><?php echo $roomNum; ?></td>
		<td><?php echo $shortName; ?></td>
		<td><?php echo $isRequired; ?></td>
		<td><?php echo $maxSeats; ?></td>
		<td>Edit</td>
	</tr>
	<?php } ?>
	</table>
</div>
		<?php
		//Edit Section
        //If submit button is pressed.
        if (isset($_GET['editRoom'])) 
        {
            include_once("./backend/db_connector.php");
            
            $building = $_GET['select-building'];
            $room_num = $_GET['room-number'];
            $short_name = $_GET['room-short-name'];
            $is_required = $_GET['is_req'];
            $max_seats = $_GET['Max_seats'];
			
			//SQL Update Statement for roomSearch form
            $sql = "UPDATE `room` (`building`, `room_num`, `short_name`, `is_required`, `max_seats`)
                    SET select-building = '$building', 
						room-number = '$room_num', 
						room-short-name = '$short_name', 
						is_req = '$is_required', 
						Max_seats = '$max_seats';
					WHERE id=editRoom";


            if ($dbconn->query($sql) === TRUE) {
                echo "New record edited successfully";
              } else {
                echo "Error: " . $sql . "<br>" . $dbconn->error;
              }
              $dbconn->close();
        }
        ?>