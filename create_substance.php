<?php
header('Content-Type: application/json');
require_once 'connection.php';

$response = array();


//title, storyline, box_office, stars, lang, genre, release date,run_time

//id --> will be created by the db

if (
    isset($_POST['name']) && isset($_POST['description'])  && isset($_POST['aka'])
    && isset($_POST['class_id'])
) {

    //store paramerts in variables
    $name = $_POST['name'];
    $description = $_POST['description'];
    $class_id = $_POST['class_id'];
    $aka = $_POST['aka'];

    //we have all paramerts

    $stmt =   $con->prepare("INSERT INTO substances (name, description, class_id, aka)
                       VALUES (?,?,?,?)");

    $stmt->bind_param('ssis', $name, $description, $class_id, $aka);

    //execute query
    if ($stmt->execute()) {

        //success
        $response['error'] = false;
        $response['message'] = "substance inserted successfully";
        $response['response_code'] = 201; //created - success

        $stmt->close();
    } else {

        //failure
        $response['error'] = true;
        $response['message'] = "failed to insert substance to the database";
        $response['response_code'] = 400;
    }
} else {

    //we cannot insert a movies that doesn't have all of this info
    $response['error'] = true;
    $response['message'] = "please provide all parameters";
    $response['response_code'] = 400;
}



echo json_encode($response);
