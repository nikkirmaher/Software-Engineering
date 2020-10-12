<div id="buildingSearch">
	<p class = "title"> Search Building </p>
	<form name="search-building" method="get" action="...">
		<input type="text" placeholder="Enter Building Here.." name="search-building">
		<button id="submitBuilding" type="submit"><i class="fa fa-search"></i></button>
	</form>

	<?php 
		include_once("./backend/db_connector.php");

		$sql = "SELECT * FROM `buildings`";
		$result = mysqli_query($dbconn, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			$bid = $row['BID'];
			$bname = $row['building_name'];
			$babrv = $row['building_abbreviation'];
	?>
	<tr>
		<td><?php echo $bid; ?></td>
		<td><?php echo $bname; ?></td>
		<td><?php echo $babrv; ?></td>
		<td>Edit</td>
	</tr>
	<?php } ?>
</div>