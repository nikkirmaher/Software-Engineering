<div id="courseCreate">
    <p class = "title"> Create Course </p>
	<form name="create-course" method="get" action="./create.php">
		<label id="add" for="course-name"> Course Name: </label>
		<input type="text" placeholder="Enter Course Here.." name="course-name">
		<br>

		<label id="add" for="create-course"> Course Short Name: </label> 
		<input type="text" placeholder="Enter course short name here..." name="course-shortname">
		<br>
		
		<label id="add" for="is-requisite"> Is this course a requisite of a future course? </label>		
		<br>
		<input type="radio" id="requisite" name="is_requisite" value="Requisite">
		<label for="requisite">Yes - Requisite</label>
		<br>

		<input type="radio" id="not_requisite" name="is_requisite" value="Not Requisite">
		<label for="not_requisite">No - Not Requisite</label>	
		<br>

		<label id="add" for="create-course"> Does this course have a requisite of a future course? </label>
		<br>

		<input type="radio" id="has_requisite" name="has_requisite" value="Has Requisite">
		<label for="has_requisite">Yes</label>
		<br>

		<input type="radio" id="no_requisite" name="has_requisite" value="No Requisite">
		<label for="no_requisite">No</label>
		<br>
		
		<label id="add" for="create-course"> Is this course a co-requisite? </label>
		<br>

		<input type="radio" id="co_requisite" name="co_requisite" value="co_requisite">
		<label for="corequisite">Yes - Co-requisite</label>
		<br>

		<input type="radio" id="not_co_requisite" name="not_co_requisite" value="Not co_requisite">
		<label for="not_requisite">No - Not Co-requisite</label>
		<br>
		
		<label id="add" for="create-course"> Will this course be alive? </label>
		<br>

		<input type="radio" id="alive" name="alive" value="alive">
		<label for="corequisite">Yes</label>
		<br>

		<input type="radio" id="not_alive" name="not_alive" value="Not alive">
		<label for="not_alive">No</label>
		<br>
		

		<label id="add" for="create-course"> Program: </label> 
		<select id="program" name="program">
			<option value="EE">Electrical Engineering (EE)</option>
			<option value="ME">Mechanical Engineering (ME)</option>
			<option value="CE">Computer Engineering (CE)</option>
		</select>
		<br>

		<label id="add" for="create-course"> Number of Credits: </label> 
		<input type="text" placeholder="Enter number of credits..." name="num_credits">
		<br>
			
		<label id="add" for="create-course"> Semester: </label>
		<br>

		<input type="radio" id="fall" name="semester" value="fall">
		<label for="fall">Fall</label>
		<br>

		<input type="radio" id="spring" name="semester" value="spring">
		<label for="spring">Spring</label>
		<br>

		<input type="radio" id="summer" name="semester" value="summer">
		<label for="summer">Summer</label>
		<br>

		<input type="radio" id="winter" name="semester" value="winter">
		<label for="winter">Winter</label>
		<br>
		
		<label id="add" for="create-course"> Year (YY): </label> 
		<input type="text" placeholder="YY" name="course-year">
		<br>
		
		<input id="submit" type="submit" name="addCourse">
</form>
    <?php
        //If submit button is pressed.
        if (isset($_GET['addCourse'])) 
        {
            include_once("./backend/db_connector.php");
            
            $name = $_GET['course-name'];
            $short_name = $_GET['course-shortname'];
            $is_requisite = $_GET['is_requisite'];
            $has_requisite = $_GET['has_requisite'];
            $co_requisite = $_GET['co_requisite'];
            $is_alive = $_GET['alive'];
            $program = $_GET['program'];
            $num_credits = $_GET['num_credits'];
            $semester = $_GET['semester'];
            $year = $_GET['course-year'];

            $sql = "INSERT INTO courses (`name`, `short_name`, `is_requisite`, `has_requisite`, `co_requisite`, `is_alive`, `program`, `num_credits`, `semester`, `year`)
                    VALUES ('$name', '$short_name', '$is_requisite', '$has_requisite', '$co_requisite', '$is_alive', '$program', '$num_credits', '$semester', '$year')";


            if ($dbconn->query($sql) === TRUE) {
                echo "New record created successfully";
              } else {
                echo "Error: " . $sql . "<br>" . $dbconn->error;
              }
              $dbconn->close();
        }
    ?>
</div>