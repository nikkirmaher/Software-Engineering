<html>
	<head>
		<meta charset="UTF-8">
		<title>Course Scheduler - Create</title>
		<!-- Link for our main style sheet -->
		<link href="./css/scheduler.css" rel="stylesheet" type="text/css">
		<!-- Link for font awesome icons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></link>
	</head>

	<body>
		<!-- Header -->
		<?php include_once('./html/header.html') ?>
		<!-- Navigation bar -->
		<?php include_once('./components/sidebar.php') ?>

	<div class="content">
    <h2> Schedule of Classes </h2>

    <table style="width:100%">
      <tr>
        <th>Course</th>
        <th>Section</th> 
        <th>Title</th>
        <th>Credits</th>
        <th>Semester</th> 
        <th>Days</th>
      <th>Time</th>
      <th>Location</th>
      <th>Instructor</th>
      </tr>
      <?php 
      $sql = "SELECT * FROM schedule 
                JOIN `courses`
                  ON schedule.CID = `courses`.CID, 

                JOIN `week_day`
                  ON schedule.SEID = `week_day`.SEID,
                
                JOIN `user_data`
                  ON schedule.UID = `user_data`.UID"; 
			$result = mysqli_query($dbconn, $sql);
			$numResults = mysqli_num_rows($result);

			if($numResults < 1) {
                echo("<tr>
                    <td colspan='10'>No Schedule found found</td>
                    </tr>");
            }
            else {
				$rowNum = 0;
				while ($row = mysqli_fetch_assoc($result)) {
					$title = $row['title'];
					$section = $row['section_num'];
          $numcredits = $row['num_credits'];
					$semsteroffered = $row['semester_offered'];
          $dayofweek = $row['day_of_week'];
          $starttime = $row['start_time'];
					$shortname = $row['short_name'];
					$firstlastname = $row['first_name'] . " " . $row['last_name'];
		?>
		<tr>
			<td><?php echo $title; ?></td>
			<td><?php echo $section; ?></td>
			<td><?php echo $numcredits; ?></td>
      <td><?php echo $semsteroffered; ?></td>
			<td><?php echo $daysofweek; ?></td>
			<td><?php echo $starttime; ?></td>
      <td><?php echo $shortname; ?></td>
			<td><?php echo $firstlastname; ?></td>
			<td><button type="button" onclick="displayModal(<?php echo ++$rowNum ?>, 'buildingTable')">View</button></td>
		</tr>
		<?php 
				}
			}
		?>
    </table>
  </div>
	</body>
</html>