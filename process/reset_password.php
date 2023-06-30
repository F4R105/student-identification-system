<?php
    require_once("../env/error_reporting.php");
    require_once("../env/db.php");

    SESSION_START();
    if(!isset($_SESSION['admin_id'])){ header('location: ../user/admin/'); }
    date_default_timezone_set('Africa/Dar_es_Salaam');

    $guard_id = mysqli_real_escape_string($db,$_POST['guard_id']);
    $temp_password = mysqli_real_escape_string($db,$_POST['password']);
    
    // VALIDATE EMPTY FIELDS
    if(empty($temp_password)){ 
        $msg = base64_encode('You did not generate password');
        header("location: ../user/admin/guard.php?id=$guard_id&msg=$msg&f"); 
        die();
    };

    // GENERATE EXPIRY TIMESTAMP
    $expiry_minutes = 30;
    $expiry_minute = date('i') + $expiry_minutes;
    if($expiry_minute > 59){
        $expiry_minute = $expiry_minute - 60;
        $expiry_hour = date('H') + 1;
        $expiry_timestamp = date("Y-m-d $expiry_hour:$expiry_minute:s");
    }else{
        $expiry_timestamp = date("Y-m-d H:$expiry_minute:s");
    }
    
    // UPDATE CREDENTIALS
    $temp_password_hashed = password_hash($temp_password, PASSWORD_DEFAULT);
    $query = "UPDATE guards SET `password`='$temp_password_hashed', `otp`=TRUE, `time`='$expiry_timestamp' WHERE guard_id='$guard_id'";
    $reset_password = mysqli_query($db, $query);

    if(!$reset_password){ 
        $msg = base64_encode('failed to reset password');
        header("location: ../user/admin/guard.php?id=$guard_id&msg=$msg&f"); 
        die();
    };

    $msg = base64_encode('password was reset successfully');
    header("location: ../user/admin/guard.php?id=$guard_id&msg=$msg&s"); 

