<?php
    require_once("../env/error_reporting.php");
    require_once("../env/db.php");

    SESSION_START();

    if(isset($_POST['new_username'])){
        if(!isset($_SESSION['admin_id'])){ header('location: ../user/admin/'); }

        $admin_id = $_SESSION['admin_id'];
        $current_password = mysqli_real_escape_string($db,$_POST['current_password']);
        $new_username = mysqli_real_escape_string($db,$_POST['new_username']);
        $new_password = mysqli_real_escape_string($db,$_POST['new_password']);
        $confirm_password = mysqli_real_escape_string($db,$_POST['confirm_password']);

        // VALIDATE EMPTY FIELDS
        if(empty($current_password) || empty($new_username) || empty($new_password) || empty($confirm_password)){ 
            $msg = base64_encode('all fields are required');
            header("location: ../user/admin/settings.php?msg=$msg&f"); 
            die();
        };

        // VALIDATE PASSWORD
        // Password length
        if(strlen($confirm_password) < 6){ 
            $msg = base64_encode('password should contain 6 or more characters');
            header("location: ../user/admin/settings.php?msg=$msg&f"); 
            die();
        };

        // Password strength
        if(
            !preg_match('/[a-z]/', $confirm_password) ||
            !preg_match('/[A-Z]/', $confirm_password) ||
            !preg_match('/[0-9]/', $confirm_password)
        ){ 
            $msg = base64_encode('use strong password');
            header("location: ../user/admin/settings.php?msg=$msg&f"); 
            die();
        };


        // VERIFY CURRENT PASSWORD
        $query = "SELECT `username`,`password` FROM admins WHERE admin_id = '$admin_id'";
        $data = mysqli_query($db, $query);
        $admin = mysqli_fetch_assoc($data);
        $password_verified = password_verify($current_password, $admin['password']);

        if(!$password_verified){ 
            $msg = base64_encode('wrong current password');
            header("location: ../user/admin/settings.php?msg=$msg&f"); 
            die();
        };

        // CONFIRM NEW PASSWORD
        if($new_password !== $confirm_password){ 
            $msg = base64_encode('new passwords did not match');
            header("location: ../user/admin/settings.php?msg=$msg&f"); 
            die();
        };

        // UPDATE CREDENTIALS
        $password = password_hash($new_password, PASSWORD_DEFAULT);
        $query = "UPDATE admins SET `username`='$new_username', `password`='$password' WHERE admin_id='$admin_id'";
        $update_credentials = mysqli_query($db, $query);

        if(!$update_credentials){ 
            $msg = base64_encode('failed to update credentials');
            header("location: ../user/admin/settings.php?msg=$msg&f"); 
            die();
        };

        $msg = base64_encode('credentials successfully updated');
        header("location: ../user/admin/settings.php?msg=$msg&s"); 


    }else{

        if(!isset($_SESSION['guard_id'])){ header('location: ../user/guard/'); }

        $guard_id = $_SESSION['guard_id'];
        $current_password = mysqli_real_escape_string($db,$_POST['current_password']);
        $new_password = mysqli_real_escape_string($db,$_POST['new_password']);
        $confirm_password = mysqli_real_escape_string($db,$_POST['confirm_password']);

        // VALIDATE EMPTY FIELDS
        if(empty($current_password) || empty($new_password) || empty($confirm_password)){ 
            $msg = base64_encode('all fields are required');
            header("location: ../user/guard/settings.php?msg=$msg&f"); 
            die();
        };

        // VALIDATE PASSWORD
        // Password length
        if(strlen($confirm_password) < 6){ 
            $msg = base64_encode('password should contain 6 or more characters');
            header("location: ../user/admin/settings.php?msg=$msg&f"); 
            die();
        };

        // Password strength
        if(
            !preg_match('/[a-z]/', $confirm_password) ||
            !preg_match('/[A-Z]/', $confirm_password) ||
            !preg_match('/[0-9]/', $confirm_password)
        ){ 
            $msg = base64_encode('use strong password');
            header("location: ../user/admin/settings.php?msg=$msg&f"); 
            die();
        };

        // VERIFY CURRENT PASSWORD
        $query = "SELECT `password` FROM guards WHERE guard_id = '$guard_id'";
        $data = mysqli_query($db, $query);
        $guard = mysqli_fetch_assoc($data);
        $password_verified = password_verify($current_password, $guard['password']);

        if(!$password_verified){ 
            $msg = base64_encode('wrong current password');
            header("location: ../user/guard/settings.php?msg=$msg&f"); 
            die();
        };

        // CONFIRM NEW PASSWORD
        if($new_password !== $confirm_password){ 
            $msg = base64_encode('new passwords did not match');
            header("location: ../user/guard/settings.php?msg=$msg&f"); 
            die();
        };

        // UPDATE CREDENTIALS
        $password = password_hash($new_password, PASSWORD_DEFAULT);
        $query = "UPDATE guards SET `password`='$password', `otp`=FALSE WHERE guard_id='$guard_id'";
        $update_credentials = mysqli_query($db, $query);

        if(!$update_credentials){ 
            $msg = base64_encode('failed to update credentials');
            header("location: ../user/guard/settings.php?msg=$msg&f"); 
            die();
        };

        $msg = base64_encode('credentials successfully updated');
        header("location: ../user/guard/settings.php?msg=$msg&s"); 

    }

