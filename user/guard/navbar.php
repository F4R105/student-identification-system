<?php 
    require_once('../../env/db.php');
    date_default_timezone_set('Africa/Dar_es_Salaam');

    $today_date = date('d/m/Y');
    $guard_id = $_SESSION['guard_id'];
    $query = "SELECT log_id, `date`, checkin, checkout FROM logs WHERE `date`='$today_date' AND `guard_id`='$guard_id'";
    $queryLog = mysqli_query($db,$query);
    $log = mysqli_fetch_assoc($queryLog);
    $checkedIn = mysqli_num_rows($queryLog);

    $query = "SELECT * FROM guards WHERE `guard_id`='$guard_id'";
    $fetchGuard = mysqli_query($db,$query);
    $guard = mysqli_fetch_assoc($fetchGuard);
?>
<nav>
    <div>
        <div class="container">
            <h3>Student Identification System</h3>
        </div>
    </div>
    <div>
        <div class="container">
            <span id="profile_picture">
                <img src="../../store/guards_photos/<?php echo $guard['profile_picture']; ?>" alt="guard profile picture">
            </span>
            <ul>
                <li><a href="./dashboard.php">Dashboard</a></li>
                <li>
                    <?php if($checkedIn == 0){ ?>
                        <form action="../../process/logs.php" method="POST">
                            <button type="submit" name="checkinBtn">Check-in</button>
                        </form>
                    <?php } else { ?>
                        <form action="../../process/logs.php" method="POST">
                            <button type="submit" name="checkoutBtn">Check-out</button>
                        </form>
                    <?php } ?>
                </li>
                <li><a href="../../process/logout.php?guard">Logout</a></li>
                <li><a href="./settings.php">Settings</a></li>
            </ul>
        </div>
    </div>
</nav>