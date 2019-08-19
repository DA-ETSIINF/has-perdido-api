<?php

namespace App\Acme;

class User {

    //database connection and table name:
    private $conn;
    private $table_name = "users";

    public $alreadyExists = true;

    // object properties:
    public $id, $name, $username, $email, $password, $activation_code;

    private function sanitize($str) {
        return htmlspecialchars(strip_tags(trim($str)));
    }

    function create() {
        // check email is valid and exists:
        $checkQuery = "SELECT id FROM $this->table_name WHERE email=:email AND activation_code=:activation_code";

        $stmt = $this->conn->prepare($checkQuery);

        // sanitize email:
        $this->email=$this->sanitize($this->email);
        $this->activation_code=$this->sanitize($this->activation_code);

        // bind email value:
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":activation_code", $this->activation_code);

        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows = 0) {
            $alreadyExists = false;
            return false;
        }
        else {
            //query to insert new user:
            $insertQuery = "UPDATE $this->table_name
                            SET name=:name, username=:username, password=:password
                            WHERE email=$this->email AND activation_code=$this->activation_code";
        
            // prepare query:
            $stmt = $this->conn->prepare($insertQuery);
            
            // sanitize:
            $this->name=$this->sanitize($this->name);
            $this->username=$this->sanitize($this->username);
            $this->password=$this->sanitize($this->password);

            //hash password:
            $password = password_hash($this->password,PASSWORD_DEFAULT);

            //bind values:
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":username", $this->username);       
            $stmt->bindParam(":password", $password);

            //execute query:
            if($stmt->execute()) {
                return true;
            }
        
            return false;
        }
    }
    
    function update() {
    	//query to insert new user:
            $insertQuery = "UPDATE $this->table_name
                            SET name=:name, username=:username, password=:password
                            WHERE email=$this->email AND activation_code=$this->activation_code";
        
            // prepare query:
            $stmt = $this->conn->prepare($insertQuery);
            
            // sanitize:
            $this->name=$this->sanitize($this->name);
            $this->username=$this->sanitize($this->username);
            $this->password=$this->sanitize($this->password);

            //hash password:
            $password = password_hash($this->password,PASSWORD_DEFAULT);

            //bind values:
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":username", $this->username);       
            $stmt->bindParam(":password", $password);

            //execute query:
            if($stmt->execute()) {
                return true;
            }
        
            return false;
        }
    }
}