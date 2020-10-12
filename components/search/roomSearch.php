<div id="roomSearch">
	<p class = "title"> Search Room </p>
	<form name="search-room" method="get" action="...">
		<input type="text" placeholder="Enter Room Here.." name="search-room">
		<button id="submitRoom" type="submit"><i class="fa fa-search"></i></button>
	</form>

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
</div>