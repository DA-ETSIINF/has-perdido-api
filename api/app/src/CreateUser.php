<?php

namespace App\Acme;

include_once 'User.php';
include_once 'functions.php';

class CreateUser {
    private $conn;
    private $data;
    public $response;


    private function areParametersOk() {
        if (!isset($this->data->username, $this->data->password, $this->data->email)) {
            // Could not get the data that should have been sent.
            die ('Please complete the registration form!');
        }
        // Make sure the submitted registration values are not empty.
        if (empty($this->data->username) || empty($this->data->password) || empty($this->data->email)) {
            // One or more values are empty.
            die ('Please complete the registration form');
        }

        //Email format:
        if (!filter_var($this->data->email, FILTER_VALIDATE_EMAIL)) {
            die ('Email is not valid!');
        }

        //Password format:
            if (strlen($this->data->password) > 20 || strlen($this->data->password) < 8) {
                die ('Password must be between 8 and 20 characters long!');
            }
    }

    private function createUser() {
        $user = new User($this->conn);

        // set user values:
        $user->name = $this->data->name;
        $user->username = $this->data->username;
        $user->email = $this->data->email;
        $user->password = $this->data->password;
        $user->activation_code = $this->data->activation_code;

        // create user:
        if($user->create()) {
            $this->response = setResponse(201, "User created succesfully");
        }
        else {
            if(!$user->alreadyExists){
                $this->response = setResponse(403, "Forbidden.");
            }
            else {
                $this->response = setResponse(503, "Unable to create user.");
            }
        }
    }

    function __construct($conn) {
        $this->conn=$conn;
        if($this->areParametersOk()) {
            // data is ok
            $this->createUser();
        } else {
            // data not ok
            $this->response = setResponse(400, "Unable to create user. Data is incomplete.");
        }
    }
}

