<?php
    //If submit button is pressed.
    if (isset($_POST['addBuilding'])) 
    {
        include_once("./backend/db_connector.php");
        
        $building_name = $_POST['create-building-name'];
        $building_abbreviation = $_POST['create-building-abbreviation'];
        
        $sql = "INSERT INTO `buildings` (`building_name`, `building_abbreviation`) 
            VALUES ('$building_name', '$building_abbreviation')";
            
        if ($dbconn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $dbconn->error;
        }
        $dbconn->close();
    }
?>

<div class="card">
	<div class="card-header">
        <h2>Create Building</h2>
	</div>
	<div class="card-content">
        <form name="create-building" method="post" action="./create.php?createType=building">
			<div class="card-row">
				<div class="card-column">
                    <label id="create" for="create-building"> Building Name: </label> 
				</div>
				<div class="card-column">
                    <input type="text" placeholder="Enter Building Name Here.." name="create-building-name">
				</div>
			</div>
			<div class="card-row">
				<div class="card-column">
                    <label id="create" for="create-building"> Building Abbreviation: </label> 
				</div>
				<div class="card-column">
                    <input type="text" placeholder="Enter Building Abbreviation Here.." name="create-building-abbreviation">
				</div>
            </div>
			<div class="card-row">
				<div class="card-column" style="align-items: center;">
                    <button type="submit" name="addBuilding">Create Building</button>
				</div>
			</div>
		</form>
	</div>
</div>