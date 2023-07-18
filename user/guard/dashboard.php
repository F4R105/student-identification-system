<?php 
    SESSION_START(); 
    require_once('../../env/error_reporting.php');
    if(!isset($_SESSION['guard_id'])){header('location: ./index.php'); die();} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS | Guard Dashboard</title>
    <link rel="stylesheet" href="../../styles/styles.min.css">
    <script src="../../scripts/scanner.js" defer></script>
</head>
<body>
    <?php require('./navbar.php'); ?>
    <div id="scannerOverlay">
        <div id="scannerInfo">
            <div id="scannerProgress">hello</div>
            <div id="scannerResults"></div>
            <input type="text" id="scannerInput">
        </div>
    </div>
    <main id="guard_dashboard">
        <div class="container">
            <div>
                <h1>Hello, <?php echo $guard['name']; ?></h1>
                <p class="id">ID: <?php echo $guard['guard_id']; ?></p>
                    <?php if($guard['otp'] == 1){ ?>
                        <p class="reminder"><b>IMPORTANT:</b> You logged in using temporary password, go to settings to update your credentials.</p>
                    <?php } ?>
                    <?php if($checkedIn == 0){ ?>
                        <p class="reminder">Check-in to start scanning</p>
                    <?php } else { ?>
                        <p class="reminder">You checked in today, <?php echo $log['date']; ?> at <?php echo $log['checkin']; ?></p>
                        <p class="reminder">Don't forget to check-out</p>
                    <?php } ?>
                <div>
                    <button id="scanBtn" <?php if($checkedIn == 0){ echo "disabled style='background-color: gray;'"; } ?>>SCAN</button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>