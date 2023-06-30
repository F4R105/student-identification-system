<?php 
    require_once('../../env/db.php');
    date_default_timezone_set('Africa/Dar_es_Salaam');

    $query = "SELECT * FROM guards";
    $fetchGuards = mysqli_query($db,$query);
    $noOfGuards = mysqli_num_rows($fetchGuards);

    if(isset($_GET['id'])){
        $guard_id = $_GET['id'];
        $query = "SELECT * FROM guards WHERE guard_id='$guard_id'";
        $fetchGuard = mysqli_query($db,$query);
        $guard = mysqli_fetch_assoc($fetchGuard);

        $query = "SELECT `date`, checkin, checkout FROM logs WHERE guard_id='$guard_id' ORDER BY log_id DESC";
        $fetchLogs = mysqli_query($db, $query);
        $noOfLogs = mysqli_num_rows($fetchLogs);
    }
?>
<nav>
    <div>
        <div class="container">
            <h3>Student Identification System</h3>
        </div>
    </div>
    <div>
        <div class="container">
            <span></span>
            <ul>
                <li><a href="./dashboard.php">Dashboard</a></li>
                <li><a id="navAddGuardBtn">Add guard</a></li>
                <li><a href="../../process/logout.php?admin">Logout</a></li>
                <li><a href="./settings.php">Settings</a></li>
            </ul>
        </div>
    </div>
</nav>