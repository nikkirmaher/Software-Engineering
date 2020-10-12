<div id="instructorCreate">
    <p class = "title"> Create Instructor </p>
    <form name="search-instructor" method="get" action="./create.php">
        <input type="text" placeholder="Enter Instructor Here.." name="search-instructor">
        <button id="submitInstructor" type="submit"><i class="fa fa-search"></i></button>
    </form>

        <?php
        //If submit button is pressed.
        if (isset($_GET['addInstructor'])) 
        {
            include_once(" ./backend/db_connector.php");
            
            $email = $_GET['email'];
            $fname = $_GET['fname'];
            $lname = $_GET['lname'];
            $max_credits = $_GET['max_credits'];
            $min_credits = $_GET['min_credits'];
            $program = $_GET['program'];

            $sql = "INSERT INTO faculty (email, fname, lname, max_credits, min_credits, program)
                    VALUES ($email, $fname, $lname, $max_credits, $min_credits, $program)";


            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
        ?>
</div>