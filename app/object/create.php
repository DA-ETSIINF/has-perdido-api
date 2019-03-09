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

$object = new LostObject($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->name)     &&
    !empty($data->category) &&
    !empty($data->color)
){
    // set object property values
    $object->name           =   trim($data->name);
    $object->category       =   trim($data->category);
    $object->description    =   trim($data->description);
    $object->color          =   trim($data->color);
    $object->place          =   trim($data->place);
    $object->createdAt      =   date('Y-m-d H:i:s');

    // create the object
    if($object->create()){
        echo set_response(201, "Object created succesfully.");
    }
    else{
        // 503: service unavailable
        echo set_response(503, "Unable to create product.");
    }
}
else{
    echo set_response(400, "Unable to create product. Data is incomplete.");
}

function set_response( $status, $message) {
    // set response code
    http_response_code($status);
    // send to the user
    return json_encode(array("message" => $message));
}