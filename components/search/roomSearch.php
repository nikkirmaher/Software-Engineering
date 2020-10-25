<div id="roomSearch">
	<h2>Search Room</h2>
	<form name="search-room" method="get" action="...">
		<input type="text" placeholder="Enter Room Here.." name="search-room">
		<button id="submitRoom" type="submit"><i class="fa fa-search"></i></button>
	</form>

	<table>
	<tr>
		<th>RID</th>
		<th>Room Number</th>
		<th>Room Short Name</th> 
		<th>Required?</th>
		<th>Exclusive?</th>
		<th>Maximum Seats</th>
		<th>Action</th>
	</tr>
	
	<?php 
		include_once("./backend/db_connector.php");

		$sql = "SELECT * FROM `room`";
		$result = mysqli_query($dbconn, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			$roomID = $row['RID'];
			$roomNum = $row['room_num'];
			$shortName = $row['short_name'];
			$isRequired = $row['is_required'];
			$isExclusive = $row['is_exclusive'];
			$maxSeats = $row['max_seats'];
	?>
	<tr>
		<td><?php echo $roomID; ?></td>
		<td><?php echo $roomNum; ?></td>
		<td><?php echo $shortName; ?></td>
		<td><?php echo $isRequired; ?></td>
		<td><?php echo $isExclusive; ?></td>
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
			
			$rID = $_GET['editRoom'];
            $building = $_GET['select-building'];
            $room_num = $_GET['room-number'];
            $short_name = $_GET['room-short-name'];
            $is_required = $_GET['is_req'];
            $max_seats = $_GET['Max_seats'];
			
			//SQL Update Statement for roomSearch form
            $sql = "UPDATE `room` 
                    SET building = '$building', 
						room_num = '$room_num', 
						short_name = '$short_name', 
						is_required = '$is_required', 
						max_seats = '$max_seats';
					WHERE id=$rID";


            if ($dbconn->query($sql) === TRUE) {
                echo "New record edited successfully";
              } else {
                echo "Error: " . $sql . "<br>" . $dbconn->error;
              }
              $dbconn->close();
        }
        ?>