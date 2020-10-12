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