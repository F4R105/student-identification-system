<?php

    SESSION_START();
    if(!isset($_SESSION['admin_id'])){ header('location: ../user/admin/'); }

    if(!isset($_GET['id'])){ header('location: ../'); }
    require('../env/db.php');
    require('../env/error_reporting.php');

    $guard_id = $_GET['id'];
    $password = password_hash('admin', PASSWORD_DEFAULT);
    $query = "UPDATE guards SET password = '$password' WHERE guard_id='$guard_id'";
    $resetGuardPassword = mysqli_query($db,$query);

    if(!$resetGuardPassword){
        $msg = base64_encode('Failed to reset password');
        header("location: ../user/admin/guard.php?id=$guard_id&msg=$msg&f");
    }

    $msg = base64_encode('Password is reset successfully');
    header("location: ../user/admin/guard.php?id=$guard_id&msg=$msg&s");

?>