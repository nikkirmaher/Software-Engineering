<div id="roomCreate">
    <p class = "title"> Create Room </p>
    <form name="search-room" method="get" action="./create.php">
        <input type="text" placeholder="Enter Room Here.." name="search-room">
        <button id="submitRoom" type="submit"><i class="fa fa-search"></i></button>
    </form>
    
   
        <?php
        //If submit button is pressed.
        if (isset($_GET['addBuilding'])) 
        {
            include_once(" ./backend/db_connector.php");
            
            $buidling = $_GET['building'];
            $room_num = $_GET['room_num'];
            $short_name = $_GET['short_name'];
            $is_required = $_GET['is_required'];
            $max_seats = $_GET['max_seats'];

            $sql = "INSERT INTO room (building, room_num, short_name, is_required, max_seats)
                    VALUES ($building, $room_num, $short_name, $is_required, $max_seats)";


            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
              $conn->close();
        }
        ?>
</div>