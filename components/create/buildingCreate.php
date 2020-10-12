<<<<<<< HEAD
<div id="buildingCreate">
    <p class = "title"> Create Building </p>
    <form name="search-building" method="get" action="./create.php">
        <input type="text" placeholder="Enter Building Here.." name="search-building">
        <button id="submitBuilding" type="submit"><i class="fa fa-search"></i></button>
    </form>

        <?php
        //If submit button is pressed.
        if (isset($_GET['addBuilding'])) 
        {
            include_once(" ./backend/db_connector.php");
            
            $buidling_name = $_GET['buidling_name'];
            $building_abbreviation = $_GET['building_abbreviation'];
           
            $sql = "INSERT INTO buildings (building_name, building_abbreviation)
                    VALUES ($building_name, $building_abbreviation)";


            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
              $conn->close();
        }
        ?>
</div>
=======
<p class = "title"> Create Building </p>
<form name="create-building" method="get" action="...">
    <label id="create" for="create-building"> Building Name: </label> 
	<input type="text" placeholder="Enter Building Name Here.." name="create-building-name">
	<br>
	<label id="create" for="create-building"> Building Abbreviation: </label> 
    <input type="text" placeholder="Enter Building Abbreviation Here.." name="create-building-abbreviation">
    <br>
	<input id="submit" type="submit" name="submit">
</form>
>>>>>>> e65d9d90845aa831c63ef457965e64181ccc7424
