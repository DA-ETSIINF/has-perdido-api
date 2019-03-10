<?php

include '../app/vendor/autoload.php';

$db = new App\Acme\Database();
$conn = $db->getConnection();


// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $create = new App\Acme\Create($conn);
    echo $create->response;
} else {
    echo "LOL";
}