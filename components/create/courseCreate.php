<p class = "title"> Create Course </p>
<form name="create-course" method="get" action="...">

	<label id="add" for="create-course"> Course Name: </label> 
	<input type="text" placeholder="Enter course name here..." name="course-name">
	<br>
	<br>

	<label id="add" for="create-course"> Course Short Name: </label> 
	<input type="text" placeholder="Enter course short name here..." name="course-shortname">
	<br>
	<br>

	<label id="add" for="create-course"> Is this course a requisite of a future course? </label>
	<br>
	<br>
	
	<input type="radio" id="requisite" name="is_requisite" value="Requisite">
	<label for="requisite">Yes - Requisite</label>
	<br>
	<br>

  	<input type="radio" id="not_requisite" name="is_requisite" value="Not Requisite">
  	<label for="not_requisite">No - Not Requisite</label><br>	
	<br>
	<br>
	<br>

	<label id="add" for="create-course"> Is this course a co-requisite? </label>
	<br>
	<br>

	<input type="radio" id="co_requisite" name="co_requisite" value="co_requisite">
	<label for="corequisite">Yes - Co-requisite</label>
	<br>
	<br>

  	<input type="radio" id="not_co_requisite" name="not_co_requisite" value="Not co_requisite">
  	<label for="not_requisite">No - Not Co-requisite</label><br>	
	<br>
	<br>
	<br>

	<label id="add" for="create-course"> Will this course be alive? </label>
	<br>
	<br>

	<input type="radio" id="alive" name="alive" value="alive">
	<label for="corequisite">Yes</label>
	<br>
	<br>

  	<input type="radio" id="not_alive" name="not_alive" value="Not alive">
  	<label for="not_alive">No</label><br>	
	<br>
	<br>
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
	<br>	


	<label id="add" for="create-course"> Semester: </label>
	<br>
	<br>

	<input type="radio" id="fall" name="semester" value="fall">
	<label for="fall">Fall</label>
	<br>
	<br>

	<input type="radio" id="spring" name="semester" value="spring">
	<label for="spring">Spring</label>
	<br>
	<br>

	<input type="radio" id="summer" name="semester" value="summer">
	<label for="summer">Summer</label>
	<br>
	<br>

	<input type="radio" id="winter" name="semester" value="winter">
	<label for="winter">Winter</label>
	<br>
	<br>
	
	<label id="add" for="create-course"> Year (YY): </label> 
	<input type="text" placeholder="YY" name="course-year">
	<br>
	<br>


    <input id="submit" type="submit" name="submit">
</form>