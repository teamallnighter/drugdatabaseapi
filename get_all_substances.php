<?php
header('Content-Type: application/json');
require_once 'connection.php';

$response = array();

$stmt = $con->prepare("SELECT * FROM substances");

if ($stmt->execute()) {
    //Statement was executed!
    //This array stores all results
    $substances = array();
    //Get all results from DB
    $result = $stmt->get_result();
    //loog and get eachsingle row
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $substances[] = $row;
    }

    $response['error'] = false;
    $response['substances'] = $substances;
    $response['message'] = 'Substance returned';
    $stmt->close();

    /*
    [
        "error => false,
        substances =>[{},{},{}],
        message =>"string
    ]
    */
} else {
    //We have an error
    $response['error'] = true;
    $response['message'] = "Could not execute query";
}

//display results 
echo json_encode($response);
