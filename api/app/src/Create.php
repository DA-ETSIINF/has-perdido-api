<?php

namespace App\Acme;

include_once 'LostObject.php';
include_once 'functions.php';

class Create
{
    private $conn;
    private $data;
    public $response;


    private function areParametersOk() {
        $this->data = json_decode(file_get_contents("php://input"));
        return  !empty($this->data->name) &&
                !empty($this->data->category) &&
                !empty($this->data->color);
    }

    private function saveLostObject() {
        $lost_object = new LostObject($this->conn);

        // set object property values
        $lost_object->name = $this->data->name;
        $lost_object->category = $this->data->category;
        $lost_object->description = $this->data->description;
        $lost_object->color = $this->data->color;
        $lost_object->place = $this->data->place;
        $lost_object->createdAt = date('Y-m-d H:i:s');

        // create the object
        if($lost_object->create()){
            $this->response = setResponse(201, "Object created succesfully.");
        }
        else{
            // 503: service unavailable
            $this->response = setResponse(503, "Unable to create product.");
        }
    }

    function __construct($conn) {
        $this->conn=$conn;
        if($this->areParametersOk()) {
            // data is ok
            $this->saveLostObject();
        } else {
            // data not ok
            $this->response = setResponse(400, "Unable to create product. Data is incomplete.");
        }
    }
}