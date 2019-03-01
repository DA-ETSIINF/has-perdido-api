<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate object
include_once '../queries/lost-object.php';

$database = new Database();
$db = $database->getConnection();

$object_id = $_POST["id"];

if($object_id!=null){
    $db->prepare("DELETE FROM 'objects' WHERE 'id'=$object_id");
    $db->execute();
    echo set_response(201, "Object deleted succesfully.");
}else{
    echo set_response(503, "Unable to delete object. No id specified.");
}

