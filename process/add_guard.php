<?php

    SESSION_START();
    if(!isset($_SESSION['admin_id'])){ header('location: ../user/admin/'); }
    require('../env/error_reporting.php');
    require('../env/db.php');
    date_default_timezone_set('Africa/Dar_es_Salaam');

    $name = mysqli_real_escape_string($db,$_POST['name']);
    $guard_id = mysqli_real_escape_string($db,$_POST['guard_id']);
    $password = password_hash(mysqli_real_escape_string($db,$_POST['password']), PASSWORD_DEFAULT);
    $phone = mysqli_real_escape_string($db,$_POST['phone']);

    // VALIDATE EMPTY FIELDS
    if(empty($name) || empty($guard_id) || empty($password) || empty($phone)){ 
        $msg = base64_encode('All fields are required!..');
        header("location: ../user/admin/dashboard.php?msg=$msg&f"); 
        die();
    };

    // VALIDATE FILE TYPE
    // only jpg, jpeg and png are allowed
    $dp_filename = $_FILES['profile_picture']['name'];
    $extension = explode('.', $dp_filename);
    $dp_fileextension = strtolower(end($extension));

    if($dp_fileextension !== 'jpg' && $dp_fileextension !== 'jpeg' && $dp_fileextension !== 'png'){
        $msg = base64_encode('Invalid file type!..');
        header("location: ../user/admin/dashboard.php?msg=$msg&f"); 
        die();
    }

    // VALIDATE FILE SIZE
    // 10mb maximum image size
    $dp_filesize = $_FILES['profile_picture']['size'];

    if($dp_filesize > 10000000){
        $msg = base64_encode('Invalid file size!..');
        header("location: ../user/admin/dashboard.php?msg=$msg&f"); 
        die();
    }

    // VALIDATE DUPLICATE GUARD
    $query = "SELECT guard_id FROM guards WHERE guard_id='$guard_id'";
    $fetch_guard = mysqli_query($db,$query);
    $verify_guard_id = mysqli_num_rows($fetch_guard);

    if($verify_guard_id !== 0){ 
        $msg = base64_encode('Guard already exist!..');
        header("location: ../user/admin/dashboard.php?msg=$msg&f"); 
        die();
    }

    // UPLOAD IMAGE
    $temp = $_FILES['profile_picture']['tmp_name'];
    $image_dynamic_name = uniqid('',true).'.'.$dp_filename;
    $upload_image = move_uploaded_file($temp, "../store/guards_photos/".$image_dynamic_name);

    if(!$upload_image){ 
        $msg = base64_encode('Failed to upload image!..');
        header("location: ../user/admin/dashboard.php?msg=$msg&f"); 
        die();
    }

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

    // ADD GUARD
    $query = "INSERT INTO 
        guards(`guard_id`,`name`,`password`,`phone`,`profile_picture`,`time`) 
        VALUES('$guard_id','$name','$password','$phone','$image_dynamic_name', '$expiry_timestamp')";

    $add_guard = mysqli_query($db, $query);

    // CHECK IF GUARD ADDED
    if(!$add_guard){ 
        $msg = base64_encode('Failed to add guard!..');
        header("location: ../user/admin/dashboard.php?msg=$msg&f"); 
        die();
    }

    $msg = base64_encode('Guard added successful');
    header("location: ../user/admin/dashboard.php?msg=$msg&s");