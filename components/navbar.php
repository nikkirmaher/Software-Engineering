<!-- Navigation bar -->
<div class="leftnav">
    <p>Welcome, <?php if(isset($_SESSION['user_fname'])) echo $_SESSION['user_fname'] ?></p>
    <a href="./home.php">Home</a>
    <a href="./create.php">Create</a>
    <a href="./search.php">Search</a>
    <a href="./schedule.php">Schedule</a>
</div>