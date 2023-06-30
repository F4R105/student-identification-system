<?php 
    SESSION_START(); 
    require_once('../../env/error_reporting.php');
    if(!isset($_SESSION['admin_id'])){header('location: ./index.php'); die();} 
    if(!isset($_GET['id'])){header('location: ../../process/logout.php?admin'); die();} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS | Guard Info</title>
    <link rel="stylesheet" href="../../styles/styles.min.css">
    <script src="../../scripts/addguard.js" defer></script>
    <script src="../../scripts/deleteguard.js" defer></script>
    <script src="../../scripts/passwordreset.js" defer></script>
    <script src="../../scripts/image_preview.js" defer></script>
    <script src="../../scripts/feedback_overlay.js" defer></script>
    <script src="../../scripts/password_generator.js" defer></script>
</head>
<body>
    <?php require('./navbar.php'); ?>
    <?php require('./addGuardFormOverlay.php'); ?>
    <?php require('./feedbackOverlay.php'); ?>
    <div id="verifyGuardDeleteOverlay">
        <div id="dialog">
            <div id="question">Are you sure you want to delete <?php echo $guard['name']; ?>? </div>
            <div id="buttons">
                <button class="button cancelBtn">No</button>
                <a 
                    href="../../process/delete_guard.php?id=<?php echo $guard['guard_id']; ?>"
                    class="button actionBtn"
                >
                    Delete
                </a>
            </div>
        </div>
    </div>
    <div id="verifyPasswordResetOverlay">
        <form action="../../process/reset_password.php" method="POST">
            <h1>Reset Password</h1>
            <div>
                <label for="password">Temporary password *</label>
                <p class="info">Expires within 30 minutes</p>
                <div class="psd_gen">
                    <input type="text" name="password" readonly placeholder="####">
                    <input type="text" name="guard_id" value="<?php echo $_GET['id']; ?>" hidden>
                    <button>Generate</button>
                </div>
            </div>
            <div id="buttons">
                <button type="submit" class="button actionBtn">Reset password</button>
                <button type="reset" class="button cancelBtn">Cancel</button>
            </div>
        </form>
    </div>
    <main id="guard">
        <div class="container">
            <div id="guard_info_container">
                <div id="head">
                    <div class="image-container">
                        <img src="../../store/guards_photos/<?php echo $guard['profile_picture']; ?>" alt="guard profile picture">
                    </div>
                    <div class="guard-control">
                        <span class="name"><?php echo $guard['name']; ?></span>
                        <span class="id">ID: <?php echo $guard['guard_id']; ?></span>
                        <ul class="buttons">
                            <li><a id="deleteGuardBtn">Remove</a></li>
                            <li><a id="resetPasswordBtn">Reset password</a></li>
                            <li><a href="tel: <?php echo $guard['phone']; ?>">Call</a></li>
                        </ul>
                    </div>
                </div>
                <div id="body" class="hide-scrollbar">
                    <?php if($noOfLogs === 0 ){ ?>
                        <div class="empty">
                            <span>This guard does not have any logs yet</span>
                        </div>
                    <?php } else { ?>
                        <?php while($log = mysqli_fetch_assoc($fetchLogs)){ ?>
                            <div class="log">
                                <span class="log_date"><?php echo $log['date']; ?></span>
                                <span class="log_checkin">CHECKIN: <?php echo $log['checkin']; ?></span>
                                <span class="log_checkout">CHECKOUT: <?php echo $log['checkout']; ?></span>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>