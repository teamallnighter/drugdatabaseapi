<?php
header('Content-Type: application/json');
require_once 'connection.php';

$response = array();

//get id
//what can be updated? box_office, stars, storyline

if( isset($_POST['id']) && isset($_POST['description']) && isset($_POST['aka'])
    && isset($_POST['class_id'])  ){


        //move on and update movie

        $id = $_POST['id'];
        $description = $_POST['description'];
        $aka = $_POST['aka'];
        $class_id = $_POST['class_id'];

        $stmt = $con->prepare("UPDATE substances SET description='$description', aka='$aka',
                               class_id='$class_id' WHERE id='$id'");

                  if($stmt->execute()){

                        //success
                        $response['error'] = false;
                        $response['message']= "substance has been updated successfully";
                      


                  } else{

                    //failure
                    $response['error'] = true;
                    $response['message']= "faild to update Substance";
                

                  }            



}else{


    //we don't have info to update the movie
    $response['error'] = true;
    $response['message']= "Please provide us with the proper information";
  

}

// 200 201 400 401

echo json_encode($response);










/*

1. end point -> /update_substance.php
2. request type : $_POST


*/
