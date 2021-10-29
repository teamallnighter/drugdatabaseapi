<?php
header('Content-Type: application/json');
require_once 'connection.php';

$response = array();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $con->prepare("SELECT id, name, description, class_id, aka FROM substances WHERE id = ? ");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $stmt->bind_result($id, $name, $description, $class_id, $aka);
        $stmt->fetch();

        $substance = array(
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'class_id' => $class_id,
            'aka' => $aka
        );

        $response['error'] = false;
        $response['substance'] = $substance;
        $response['message'] = "substance has been returned";
    } else {
        $response['error'] = true;
        $response['message'] = "Could not retrieve substance";
    }
} else {
    $response['error'] = true;
    $response['message'] = "Please provide a substance name ";
}

echo json_encode($response);
