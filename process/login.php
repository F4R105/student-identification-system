<?php
    require_once("../env/error_reporting.php");
    require_once("../env/db.php");
    date_default_timezone_set('Africa/Dar_es_Salaam');

    // LOGIN FOR ADMIN
    // only admin posts username
    if(isset($_POST['username'])){
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $password = mysqli_real_escape_string($db,$_POST['password']);
        $query = "SELECT * FROM admins WHERE username = '$username'";
        $data = mysqli_query($db, $query);
        $rows = mysqli_num_rows($data);

        if($rows === 0){ 
            $msg = base64_encode('wrong username or password');
            header("location: ../user/admin/?msg=$msg&f"); 
            die();
        };

        $user = mysqli_fetch_array($data);
        $user_password = $user['password'];

        if(!password_verify($password, $user_password)){ 
            $msg = base64_encode('wrong username or password');
            header("location: ../user/admin/?msg=$msg&f"); 
            die();
        };
        
        SESSION_START();
        $admin_id = $user['admin_id'];
        $_SESSION["admin_id"] = $admin_id;
        header('location: ../user/admin/dashboard.php');

    }else{
        // LOGIN FOR GUARDS
        // only admin posts username
        $guard_id = mysqli_real_escape_string($db,$_POST['guard_id']);
        $password = mysqli_real_escape_string($db,$_POST['password']);
        $query = "SELECT `guard_id`,`password`,`time`,`otp` FROM guards WHERE guard_id = '$guard_id'";
        $data = mysqli_query($db, $query);
        $rows = mysqli_num_rows($data);

        // VERIFY GUARD ID
        if($rows === 0){ 
            $msg = base64_encode('wrong guard id or password');
            header("location: ../user/guard/?msg=$msg&f"); 
            die();
        };
        
        // VERIFY PASSWORD
        $user = mysqli_fetch_array($data);
        $user_password = $user['password'];

        if(!password_verify($password, $user_password)){ 
            $msg = base64_encode('wrong guard id or password');
            header("location: ../user/guard/?msg=$msg&f"); 
            die();
        };

        // VERIFY OTP EXPIRY
        if($user['otp'] == 1){
            $expiry_timestamp = strtotime($user['time']);
            $current_timestamp = time();
            $difference = $expiry_timestamp - $current_timestamp;
    
            if($difference < 0){
                $msg = base64_encode('OTP is expired!..');
                header("location: ../user/guard/?msg=$msg&f"); 
                die();
            }
        }
        
        // LOGIN USER
        SESSION_START();
        $guard_id = $user['guard_id'];
        $_SESSION["guard_id"] = $guard_id;
        header('location: ../user/guard/dashboard.php');
    }

