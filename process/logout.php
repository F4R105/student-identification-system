<?php

    SESSION_START();
    
    if(!isset($_GET['admin']) && !isset($_GET['guard'])){ header("location: ../"); die(); }
    
    if(isset($_GET['admin'])){ 
        SESSION_DESTROY();
        UNSET($_SESSION['admin_id']);
        header("location: ../user/admin/");
    }
    
    if(isset($_GET['guard'])){ 
        SESSION_DESTROY();
        UNSET($_SESSION['guard_id']);
        header("location: ../user/guard/");
    }

?>