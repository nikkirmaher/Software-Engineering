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
<p class = "title"> Create Instructor </p>
<form name="create-instructor" method="get" action="...">
	<label id="add" for="create-instructor"> Instructor Email: </label> 
	<input type="text" placeholder="Enter instructor email here..." name="create-instructor">
	<br>

	<label id="add" for="create-instructor"> Instructor First Name: </label> 
	<input type="text" placeholder="Enter instructor first name here..." name="instructor-fname">
	<br>
		
	<label id="add" for="create-instructor"> Instructor Last Name: </label> 
	<input type="text" placeholder="Enter instructor last name here..." name="instructor-lname">
	<br>

	<label id="add" for="create-instructor"> Maximum Credits: </label> 
	<input type="text" placeholder="Enter instructor maximum number of credits here..." name="instructor-maxcredits">
	<br>

	<label id="add" for="create-instructor"> Minimum Credits: </label> 
	<input type="text" placeholder="Enter instructor minimum number of credits here..." name="instructor-mincredits">
	<br>

	<label id="add" for="create-instructor"> Program: </label> 
	<select id="program" name="program">
		<option value="EE">Electrical Engineering (EE)</option>
		<option value="ME">Mechanical Engineering (ME)</option>
		<option value="CE">Computer Engineering (CE)</option>
	</select>
	<br>

    <input id="submit" type="submit" name="submit">
</form>
