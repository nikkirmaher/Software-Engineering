<!-- Navigation bar -->
<div class="leftnav">
    <?php if(isset($_SESSION['user_fname'])) echo "<p>Welcome," . $_SESSION['user_fname'] . "</p>";?>
    <a class="navlink" href="./home.php">Home</a>
    <a class="navlink" href="./create.php">Create</a>
    <a class="navlink" href="./search.php">Search</a>
    <a class="navlink" href="./schedule.php">Schedule</a>
    <br>
    <form class="logout-form" method="get">
        <input name="button" type="submit" class="logout-button" value="Logout">
    </form>
</div>