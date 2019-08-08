<?php

namespace App\Acme;

include_once 'LostObject.php';
include_once 'functions.php';

class Put {

    private $conn;
    private $data;
    public $response;

    private function areParametersOk() {
        $this->data = json_decode(file_get_contents("php://input"));
        // Put it with OR sentences to send error if no changes are to be made
        // (except for the object id, which should exist):
        return  !empty($this->data->id) && (
                !empty($this->data->name) ||
                !empty($this->data->description) ||
                !empty($this->data->category) ||
                !empty($this->data->color) ||
                !empty($this->data->place)
        ); 
    }

    private function updateObject() {
        $lost_object = new LostObject($this->conn);

        //set object id:
        $lost_object->id = $this->data->id;

        //update object:
        if($lost_object->put()) {
            // 201: Created
            $this->response = setResponse(201, "Object updated succesfully.");
        }
        else{
            // 503: service unavailable
            $this->response = setResponse(503, "Unable to update object.");
        }
    }
    
    function __construct($conn) {
        $this->conn=$conn;
        if($this->areParametersOk()) {
            // data is ok
            $this->deleteLostObject();
        } else {
            // data not ok
            $this->response = setResponse(400, "Unable to update product. Data is incomplete.");
        }
    }
}