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
		<?php 
		//Edit Section 
        //If submit button is pressed.
        if (isset($_GET['editBuilding'])) 
        {
            include_once("./backend/db_connector.php");
            
            $building_name = $_GET['update-building-name'];
            $building_abbreviation = $_GET['update-building-abbreviation'];
		   
			//SQL Update Statement for buildingSearch form
			$sql = "UPDATE `buildings` (`building_name`, `building_abbreviation`)
                SET update-building-name = '$building_name', 
					update-building-abbreviation = '$building_abbreviation';
				WHERE id=editBuilding";

            if ($dbconn->query($sql) === TRUE) {
                echo "New record edited successfully";
              } else {
                echo "Error: " . $sql . "<br>" . $dbconn->error;
              }
              $dbconn->close();
        }
        ?>