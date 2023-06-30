<?php

    require('../env/error_reporting.php');
    require('../env/db.php');

    $fname = mysqli_real_escape_string($db,$_POST['fname']);
    $lname = mysqli_real_escape_string($db,$_POST['lname']);
    $adm_no = mysqli_real_escape_string($db,$_POST['adm_no']);
    $course = mysqli_real_escape_string($db,$_POST['course']);

    // VALIDATE EMPTY FIELDS
    if(empty($fname) || empty($lname) || empty($adm_no) || empty($course)){ 
        $msg = base64_encode('All fields are required!..');
        header("location: ../user/student/index.php?msg=$msg&f"); 
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
    $query = "SELECT admission_number FROM students WHERE admission_number='$adm_no'";
    $fetch_student = mysqli_query($db,$query);
    $verify_student_adm_no = mysqli_num_rows($fetch_student);

    if($verify_student_adm_no !== 0){ 
        $msg = base64_encode('Student already exist!..');
        header("location: ../user/student/index.php?msg=$msg&f");  
        die();
    }

    // UPLOAD IMAGE
    $temp = $_FILES['profile_picture']['tmp_name'];
    $image_dynamic_name = uniqid('',true).'.'.$dp_filename;
    $upload_image = move_uploaded_file($temp, "../store/students_photos/".$image_dynamic_name);

    // echo exec('whoami');
    // die();
    if(!$upload_image){ 
        $msg = base64_encode('Failed to upload image!..');
        header("location: ../user/student/index.php?msg=$msg&f"); 
        die();
    }


    // ADD STUDENT
    $query = "INSERT INTO 
        students(`first_name`,`last_name`,`admission_number`,`course`,`profile_picture`) 
        VALUES('$fname','$lname','$adm_no','$course','$image_dynamic_name')";

    $add_student = mysqli_query($db, $query);

    // CHECK IF GUARD ADDED
    if(!$add_student){ 
        $msg = base64_encode('Failed to register student!..');
        header("location: ../user/student/index.php?msg=$msg&f"); 
        die();
    }

    $msg = base64_encode('Student registered successful');
    header("location: ../user/student/index.php?msg=$msg&s"); 