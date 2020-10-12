<div id="courseCreate">
    <p class = "title"> Create Course </p>
    <form name="search-course" method="get" action="./create.php">
        <input type="text" placeholder="Enter Course Here.." name="search-course">
        <button id="submitCourse" type="submit"><i class="fa fa-search"></i></button>
    </form>

        <?php
        //If submit button is pressed.
        if (isset($_GET['addCourse'])) 
        {
            include_once(" ./backend/db_connector.php");
            
            $name = $_GET['name'];
            $short_name = $_GET['short_name'];
            $is_requisite = $_GET['is_requisite'];
            $has_requisite = $_GET['has_requisite'];
            $co_requisite = $_GET['co_requisite'];
            $is_alive = $_GET['is_alive'];
            $program = $_GET['program'];
            $num_credits = $_GET['num_credits'];
            $semester = $_GET['semester'];
            $year = $_GET['year'];

            $sql = "INSERT INTO courses (name, short_name, is_requisite, has_requisite, co_requisite, is_alive, program, num_credits, semester, year)
                    VALUES ($name, $short_name, $is_requisite, $has_requisite, $co_requisite, $is_alive, $program, $num_credits, $semester, $year)";


            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
              $conn->close();
        }
        ?>
</div>