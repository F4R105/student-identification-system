<?php
    SESSION_START();
    date_default_timezone_set('Africa/Dar_es_Salaam');
    require('../env/db.php');
    require('../env/error_reporting.php');

    $date = date('d/m/Y');
    $time = date('H:i');
    $guard_id = $_SESSION['guard_id'];

    
    if(isset($_POST['checkinBtn'])){ 

        $query = "INSERT INTO logs(`date`,`checkin`,`checkout`,`guard_id`) VALUES('$date','$time','on duty','$guard_id')";
        $setLog = mysqli_query($db,$query);

        if(!$setLog){ 
            $msg = base64_encode('failed to check-in');
            header("location: ../user/guard/dashboard.php?msg=$msg&f");
            die();
        }

        header("location: ../user/guard/dashboard.php");
    }else{

        $query = "UPDATE logs SET checkout = '$time' WHERE date='$date' AND guard_id='$guard_id'";
        $setLog = mysqli_query($db,$query);

        if(!$setLog){ 
            $msg = base64_encode('failed to check-out');
            header("location: ../user/guard/dashboard.php?msg=$msg&f");
            die();
        }

        header("location: ../process/logout.php?guard");
    }
?>