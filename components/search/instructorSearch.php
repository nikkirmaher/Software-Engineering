<div id="instructorSearch">
    <h2>Search Instructor</h2>
	<form name="search-instructor" method="get" action="...">
		<input type="text" placeholder="Enter Instructor Here.." name="search-instructor">
		<button id="submitInstructor" type="submit"><i class="fa fa-search"></i></button>
	</form>

	<table>
		<tr>
			<th>FID</th>
			<th>email</th> 
			<th>First Name</th>
			<th>Last Name</th>
			<th>Maximum Credits</th> 
			<th>Minimum Credits</th>
			<th>Program</th>
			<th>Action</th>
		</tr>
	
		<?php 
			include_once("./backend/db_connector.php");

			$sql = "SELECT * FROM `faculty`";
			$result = mysqli_query($dbconn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
				$fid = $row['FID'];
				$femail = $row['email'];
				$ffname = $row['fname'];
				$flname = $row['lname'];
				$fmaxcred = $row['max_credits'];
				$fmincred = $row['min_credits'];
				$fprogram = $row['program'];
		?>
		<tr>
			<td><?php echo $fid; ?></td>
			<td><?php echo $femail; ?></td>
			<td><?php echo $ffname; ?></td>
			<td><?php echo $flname; ?></td>
			<td><?php echo $fmaxcred; ?></td>
			<td><?php echo $fmincred; ?></td>
			<td><?php echo $fprogram; ?></td>
			<td>Edit</td>
		</tr>
		<?php } ?>
	</table>
</div>