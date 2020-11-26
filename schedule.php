<?php
    //Resuming the session
    if(!isset($_SESSION))
    {
        session_start();
    }
    //Checking if the user is signed in.
    if(!isset($_SESSION['user'])) {
        header("Location: index.php");
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Course Scheduler - Scheduler</title>
        <link href="./css/scheduler.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <!-- Header -->
        <?php include_once('./components/header.php') ?>
        
        <!-- Navigation bar -->
        <?php include_once('./components/sidebar.php') ?>
        
        <!-- Page Content -->
        <div class="content">
            <h2>Course Scheduler</h2>
            <p>Please fill out the following information before generating schedules:</p>
            <form method="get" action="...">	
                <label for="semester">Semester:</label>
                <select name="semester" id="semester">
                    <option value="">Please select the semester</option>
                    <?php
                        include_once("./backend/db_connector.php");
                        $sql = "SELECT * FROM `semester`";
                        $query = mysqli_query($dbconn, $sql);
                        while($row = mysqli_fetch_assoc($query)) {
                            $date = $row['start_date'];
                            $year = explode('-', $date);

                            echo("<option value='" . $row['SEID'] . "'>" . $row['season'] . " " . $year[0] . "</option>");
                        }
                    ?>
                </select>

                <p>Please enter the times that courses can run on each day:</p>
                <table>
                    <tr>
                        <th>Days</th>
                        <th>Start</th>
                        <th>End<th>
                    </tr>
                    <tr>
                        <td>Monday</td>
                        <td><input type="time" id="monday-start" name="monday-start"></td>
                        <td><input type="time" id="monday-end" name="monday-end"></td>
                    </tr>
                    <tr>
                        <td>Tuesday</td>
                        <td><input type="time" id="tuesday-start" name="tuesday-start"></td>
                        <td><input type="time" id="tuesday-end" name="tuesday-end"></td>
                    </tr>
                    <tr>
                        <td>Wednesday</td>
                        <td><input type="time" id="wednesday-start" name="wednesday-start"></td>
                        <td><input type="time" id="wednesday-end" name="wednesday-end"></td>
                    </tr>
                    <tr>
                        <td>Thursday</td>
                        <td><input type="time" id="thursday-start" name="thursday-start"></td>
                        <td><input type="time" id="thursday-end" name="thursday-end"></td>
                    </tr>
                    <tr>
                        <td>Friday</td>
                        <td><input type="time" id="friday-start" name="friday-start"></td>
                        <td><input type="time" id="friday-end" name="friday-end"></td>
                    </tr>
                </table>

                <p>Please choose from the list of all courses, which courses will run this semester.</p>
                <!-- Course Search -->
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for courses..">
                <table id="courseTable" style="display:block; max-width:fit-content; overflow-y:auto; max-height:200px;">
                    <tr>
                        <th>Title</th> 
                        <th>Course Short Name</th>
                        <th>Number of Credits</th>
                        <th>Contact Hours</th>
                        <th>Running?</th>
                    </tr>
                    <?php 
                        $sql = "SELECT * FROM `courses` WHERE is_active = '1'";
                        $result = mysqli_query($dbconn, $sql);
                        $numResults = mysqli_num_rows($result);

                        if($numResults < 1) {
                            echo("<tr>
                                <td colspan='10'>No Courses found</td>
                                </tr>");
                        }
                        else {
                            $rowNum = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $courseID = $row['CID'];
                                $courseName = $row['title'];
                                $shortName = $row['short_name'];
                                $isActive = $row['is_active'];
                                $credits = $row['num_credits'];
                                $contactHours = $row['contact_hours'];
                                $semesterOffered = $row['semester_offered'];
                        ?>
                        <tr>
                            <td><?php echo $courseName; ?></td>
                            <td><?php echo $shortName; ?></td>
                            <td><?php echo $credits; ?></td>
                            <td><?php echo $contactHours; ?></td>
                            <td><input type="checkbox" id="running" name="<?php echo $courseID; ?>" value="running"></td>
                        </tr>
                        
                    <?php 
                            }
                        }
                    ?>
                </table>
                <br>
                <label for="times">Time between classes (in minutes):</label>
                <input type="number" id="padding" name="padding" step="5">
                <br><br>
                
                <input type="submit" value="Submit">	
            </form>
        </div>
    </body>
</html>

<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("courseTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>