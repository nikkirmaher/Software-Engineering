<div id="buildingSearch">
	<h2>Search Building</h2>
	<form name="search-building" method="get" action="...">
		<input type="text" placeholder="Enter Building Here.." name="search-building">
		<button id="submitBuilding" type="submit"><i class="fa fa-search"></i></button>
	</form>

	<table>
		<tr>
			<th>BID</th>
			<th>Building Name</th>
			<th>Building Abbreviation</th>
			<th>Action</th>
		</tr>
		
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
	</table>
</div>