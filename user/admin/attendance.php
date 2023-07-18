<?php 
    SESSION_START(); 
    require_once('../../env/error_reporting.php');
    if(!isset($_SESSION['admin_id'])){header('location: ./index.php'); die();} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS | Attendance</title>
    <link rel="stylesheet" href="../../styles/styles.min.css">
    <script src="../../scripts/addguard.js" defer></script>
    <script src="../../scripts/image_preview.js" defer></script>
    <script src="../../scripts/feedback_overlay.js" defer></script>
    <script src="../../scripts/password_generator.js" defer></script>
</head>
<body>
    <?php require('./navbar.php'); ?>
    <?php require('./addGuardFormOverlay.php'); ?>
    <?php require('./feedbackOverlay.php'); ?>
    <?php
        $date = date('d/m/Y');
        $query = "SELECT * FROM `attendance` JOIN `students` ON attendance.student_id = students.admission_number ORDER BY first_name ASC";
        $fetchAttendance = mysqli_query($db,$query);
        $noOfAttendees = mysqli_num_rows($fetchAttendance);
    ?>
    <main id="admin">
        <div class="container">
            <div id="guards">
                <div id="pagetitle">
                    <h1>Attendance</h1>
                    <p><?php echo $noOfAttendees; ?> Students ID's scanned today</p>
                </div>
                <p id="guardslist">Students</p>
                <div id="guards_list" class="hide-scrollbar">
                    <?php if($noOfAttendees === 0){ ?>
                        <div class="empty">
                            <span>No student is attended</span>
                        </div>
                    <?php } else { ?>
                        <?php while($attendee = mysqli_fetch_assoc($fetchAttendance)){ ?>
                            <a class="guard" href="#?id=<?php echo $attendee['student_id']; ?>">
                                <span class="guard_name"><?php echo $attendee['first_name'] . ' ' . $attendee['last_name']; ?></span>
                                <span class="guard_id">TIME: <?php echo $attendee['time']; ?></span>
                            </a>
                        <?php } ?>
                    <?php }  ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>