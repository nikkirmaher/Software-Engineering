<?php
    if(!isset($_SESSION))
    {
        session_start();
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
        <?php include_once('./html/header.html') ?>
        
        <!-- Navigation bar -->
        <?php include_once('./components/sidebar.php') ?>
        
        <!-- Page Content -->
        <div class="content">
            <p>
                <h1>Course Scheduler</h1>
                Please fill out the following information before generating schedules:
            </p>
            <form method="get" action="...">	
                <label for="semester">Semester:</label>
                <br>
                <select>
                    <option value="fall">Fall</option>
                    <option value="spring">Spring</option>
                    <option value="summer">Summer</option>
                    <option value="winter">Winter</option>
                </select>
                <br><br>
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
                <br><br>

                <label for="schedule-preference">Schedule-Start Preference:</label><br>		
                <input type="radio" id="schedule-preference" name="time-preference" value="morning">
                <label for="morning">Morning</label><br>
                <input type="radio" id="schedule-preference" name="time-preference" value="afternoon">
                <label for="afternoon">Afternoon</label><br>
                <input type="radio" id="schedule-preference" name="time-preference" value="evening">
                <label for="evening">Evening</label><br><br>

                <label for="times">Course Padding (in minutes):</label>
                <br>
                <input type="number" id="padding" name="padding" step="5">
                <br><br>
                
                <input type="submit" value="Submit">	
            </form>
        </div>
    </body>
</html>