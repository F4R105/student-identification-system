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
    <title>SIS | Account Settings</title>
    <link rel="stylesheet" href="../../styles/styles.min.css">
    <script src="../../scripts/addguard.js" defer></script>
    <script src="../../scripts/image_preview.js" defer></script>
    <script src="../../scripts/password_generator.js" defer></script>
</head>
<body>
    <?php require('./navbar.php'); ?>
    <?php require('./addGuardFormOverlay.php'); ?>
    <main id="settings">
        <div class="container">
            <form action="../../process/update_credentials.php" method="POST">
                <h1>Account Settings</h1>
                <div>
                    <label for="current_password">Current password</label>
                    <input type="password" name="current_password" />
                </div>
                <div>
                    <label for="new_username">New username</label>
                    <input type="text" name="new_username" />
                </div>
                <div>
                    <label for="new_password">New password</label>
                    <input type="password" name="new_password" />
                </div>
                <div>
                    <label for="confirm_password">Repeat new password</label>
                    <input type="password" name="confirm_password" />
                </div>
                <div>
                    <button type="submit">Update credentials</button>
                </div>
                <div>
                    <div class="feedback 
                        <?php 
                            if(isset($_GET['msg'])){
                                
                                if(isset($_GET['s'])){
                                    echo "success";
                                }else{
                                    echo "failure";
                                }
                            }
                        ?>"
                    >
                        <?php 
                            if(isset($_GET['msg'])){
                                echo base64_decode($_GET['msg']);
                            }else{
                                echo "feedback message";
                            }
                        ?>  
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
</html>