<?php

namespace App\Acme;

include_once 'LostObject.php';
include_once 'functions.php';

class Post {

    private $conn;
    private $data;
    public $response;

    private function areParametersOk() {
        $this->data = json_decode(\file_get_contents("php://input"));
        
    }
}