<?php

    require('../env/db.php');
    require('../env/error_reporting.php');

    SESSION_START();
    if(!isset($_SESSION['admin_id'])){ header('location: ../user/admin/'); }

    if(!isset($_GET['id'])){ header('location: ../'); }

    $guard_id = $_GET['id'];
    $query = "SELECT `name` FROM guards WHERE guard_id='$guard_id'";
    $fetchGuard = mysqli_query($db, $query);
    $guard = mysqli_fetch_assoc($fetchGuard);
    $guardName = $guard['name'];

    $query = "DELETE FROM guards WHERE guard_id='$guard_id'";
    $deleteGuard = mysqli_query($db,$query);

    if(!$deleteGuard){
        $msg = base64_encode('Failed to delete guard');
        header("location: ../user/admin/guard.php?id=$guard_id&msg=$msg&f");
    }

    $msg = base64_encode("$guardName was deleted successfully");
    header("location: ../user/admin/dashboard.php?msg=$msg&s");

?>