<?php

namespace App\Acme;

include_once 'functions.php';
include_once 'User.php';

class updateUser {
	private $conn;
	private $data;
	public $response;
	
	private function areParametersOk() {
        //Email format:
        if (isset($this->data->email) && !empty($this->data->email) && !filter_var($this->data->email, FILTER_VALIDATE_EMAIL)) {
            die ('Email is not valid!');
        }

        //Password format:
        if (isset($this->data->password && !empty($this->data->password) && (strlen($this->data->password) > 20 || strlen($this->data->password) < 8)) {
            die ('Password must be between 8 and 20 characters long!');
        }
    }
    
    function updateUser() {
    	$user = new User();
    	
    	// set user values:
        $user->name = $this->data->name;
        $user->username = $this->data->username;
        $user->email = $this->data->email;
        $user->password = $this->data->password;

        // create user:
        if($user->update()) {
        	$this->response = setResponse(201, "User updated successfully.");
        }
        else {
            $this->response = setResponse(503, "Unable to update user.");
        }
    }
    
    function __construct($conn) {
        $this->conn=$conn;
        if($this->areParametersOk()) {
            // data is ok
            $this->updateUser();
        } else {
            // data not ok
            $this->response = setResponse(400, "Unable to update user. Data is incorrect.");
        }
    }
}