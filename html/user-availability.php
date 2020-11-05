<h2>User Availability</h2>

<!-- Trigger/Open The Modal -->
<table id="roomTable">
	<tr>
    <th>Instructor</th>
	<th>Days Available</th> 
    <th>Monday Availability</th> 
    <th>Tuesday Availability</th> 
    <th>Wednesday Availability</th> 
    <th>Thursday Availability</th> 
    <th>Friday Availability</th> 
      <th>Action</th>
    </tr>
    <tr>
      <td>Tony Denizard</td>
	  <!-- Get the form data and insert in the rows below-->
	  <td>Monday, Thursday</td> 
      <td>3PM-6PM</td>
	  <td>3PM-6PM</td>
	  <td>3PM-6PM</td>
	  <td>3PM-6PM</td>
	  <td>3PM-6PM</td>
	  <td><button type="button" onclick="displayModal(1, 'availabilityTable')">View</button></td>
    </tr>
</table>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3 class="title"> Enter User Availability </h3>

		<form name="availability" method="get" action="./add.php">
		
		<label for="user-dates"> <h3> Availability Dates: </h3> </label>		
		  <input type="checkbox" id="monday" name="dates" value="Monday">
		  <label for="Monday"> Monday</label><br>
		  <input type="checkbox" id="Tuesday" name="dates" value="Tuesday">
		  <label for="Tuesday"> Tuesday</label><br>
		  <input type="checkbox" id="Wednesday" name="dates" value="Wednesday">
		  <label for="Wednesday"> Wednesday</label><br>
		  <input type="checkbox" id="Thursday" name="dates" value="Thursday">
		  <label for="Thursday">Thursday</label><br>
		  <input type="checkbox" id="Friday" name="dates" value="Friday">
		  <label for="Friday"> Friday</label>
		 <br>
		 <br>
		
		<h4> If available for multiple periods throughout the day, enter respectively and seperated with a semicolon. </h4> 
		<label for="Mon_start"> Monday Start Time: </label>
		<input type="text" id="Mon_start" name="Monday Start">
		<br>
		
		<label for="Mon_end">  Monday End Time: </label>
		<input type="text" id="Mon_end" name="Monday End">
		<br>
		<br>
		
		<label for="Tues_start">  Tuesday Start Time: </label>	
		<input type="text" id="Tues_start" name="Tuesday Start">
		<br>
		<label for="Tues_end">  Tuesday End Time:  </label>
		<input type="text" id="Tues_end" name="Tuesday End">
		<br>
		<br>
		<label for="Wed_start">  Wednesday Start Time:  </label>	
		<input type="text" id="Wed_start" name="Wednesday Start">
		<br>
		<label for="Wed_end">  Wednesday End Time:  </label>	
		<input type="text" id="Wed_end" name="Wednesday End">
		<br>
		<br>
		<label for="Thurs_start">  Thursday Start Time: </label>
		<input type="text" id="Thurs_start" name="Thursday Start">
		<br>
		<label for="Thurs_end"> Thursday End Time:  </label>
		<input type="text" id="Thurs_end" name="Thursday End">
		<br>
		<br>
		<label for="Fri_start">  Friday Start Time: </label>
		<input type="text" id="Fri_start" name="Friday Start">
		<br>
		<label for="Fri_end"> Friday End Time:  </label>
		<input type="text" id="Fri_end" name="Friday End">
		<br>
		<br>
			<input id="submit" type="submit" name="userAvailability">
		</form>
  </div>

</div>
		
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
function displayModal(tableRow, tableID) {
  modal.style.display = "block";
  document.getElementById('user-dates').value = document.getElementById(tableID).rows[tableRow].cells[1].innerText; 
  document.getElementById('Monday-avail-times').value = document.getElementById(tableID).rows[tableRow].cells[2].innerText; 
  document.getElementById('Tuesday-avail-times').value = document.getElementById(tableID).rows[tableRow].cells[3].innerText; 
  document.getElementById('req').value = document.getElementById(tableID).rows[tableRow].cells[5].innerText; 
  document.getElementById('max_seats').value = document.getElementById(tableID).rows[tableRow].cells[6].innerText; 
  

}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>