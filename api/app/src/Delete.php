<?php

namespace App\Acme;

include_once 'LostObject.php';
include_once 'functions.php';

class Delete {

    private $conn;
    private $data;
    public $response;

    private function areParametersOk() {
        $this->data = json_decode(\file_get_contents("php://input"));
        return  !empty($this->data->id); /* TODO: &&!empty(TOKEN) */
    }

    private function deleteLostObject() {
        $lost_object = new LostObject($this->conn);

        //set object id:
        $lost_object->id = $this->data->id;

        //delete the object:
        if($lost_object->delete()) {
            // 200: OK
            $this->response = setResponse(200, "Object deleted succesfully.");
        }
        else{
            // 503: service unavailable
            $this->response = setResponse(503, "Unable to delete object.");
        }
    }

    function __construct($conn) {
        $this->conn=$conn;
        if($this->areParametersOk()) {
            // data is ok
            $this->deleteLostObject();
        } else {
            // data not ok
            $this->response = setResponse(400, "Unable to delete product. Data is incomplete.");
        }
    }
}