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
<div id="buildingCreate">
    <h2>Create Building</h2>
    <form name="create-building" method="post" action="./create.php?createType=building">
        <label id="create" for="create-building"> Building Name: </label> 
        <input type="text" placeholder="Enter Building Name Here.." name="create-building-name">
        <br>

        <label id="create" for="create-building"> Building Abbreviation: </label> 
        <input type="text" placeholder="Enter Building Abbreviation Here.." name="create-building-abbreviation">
        <br>
        
        <button type="submit" name="addBuilding">Create Building</button>
    </form>
</div>