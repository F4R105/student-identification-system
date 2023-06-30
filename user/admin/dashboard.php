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
    <title>SIS | Admin Dashboard</title>
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
    <main id="admin">
        <div class="container">
            <div id="guards">
                <div id="pagetitle">
                    <h1>Dashboard</h1>
                    <p><?php echo $noOfGuards; ?> Guards registered</p>
                </div>
                <p id="guardslist">Guards</p>
                <div id="guards_list" class="hide-scrollbar">
                    <?php if($noOfGuards === 0){ ?>
                        <div class="empty">
                            <span>No guard is registered to the system</span>
                        </div>
                    <?php } else { ?>
                        <?php while($guards = mysqli_fetch_assoc($fetchGuards)){ ?>
                            <a class="guard" href="./guard.php?id=<?php echo $guards['guard_id']; ?>">
                                <span class="guard_name"><?php echo $guards['name']; ?></span>
                                <span class="guard_id">GUARD ID: <?php echo $guards['guard_id']; ?></span>
                            </a>
                        <?php } ?>
                    <?php }  ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>