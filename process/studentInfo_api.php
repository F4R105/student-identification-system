<?php

    require('../env/db.php');
    require('../env/error_reporting.php');

    SESSION_START();
    if(!isset($_SESSION['guard_id'])){header('location: ./index.php'); die();} 

    $postData = file_get_contents('php://input');
    $jsonData = json_decode($postData, true);
    $admission_number = $jsonData['admission_number'];

    $query = "SELECT * FROM students WHERE admission_number='$admission_number'";
    $fetchStudentInfo = mysqli_query($db, $query);
    $studentInfo = mysqli_fetch_assoc($fetchStudentInfo);

    if(!$studentInfo){
        
        // Set the HTTP response code
        http_response_code(400); // For example, using 400 Bad Request

        // Error message
        $error_message = array(
            'error' => 'Bad Request',
            'message' => 'Student not registered or invalid barcode20051013032'
        );

        // Set the response content type to JSON
        header('Content-Type: application/json');

        // Send the error response as JSON
        echo json_encode($error_message);

        // Terminate the script
        exit();

    }

    header("Content-Type: application/json");
    echo json_encode($studentInfo);

?>