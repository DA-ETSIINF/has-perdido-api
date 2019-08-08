<?php
/**
 * Created by PhpStorm.
 * User: onmax
 * Date: 10/03/19
 * Time: 14:08
 */

namespace App\Acme;


class LostObject
{
    // database connection and table name:
    private $conn;
    private $table_name = "lost-objects";

    // object properties:
    public $id, $name, $description, $category, $color, $createdAt, $place;


    private function sanitize($str) {
        return htmlspecialchars(strip_tags(trim($str)));
    }

    /**
     * @return bool
     */
    function create() {
        // query to insert record:
        $query = "INSERT INTO $this->table_name SET
                name=:name, description=:description, category=:category, color=:color, createdAt=:createdAt, place=:place";

        // prepare query:
        $stmt = $this->conn->prepare($query);

        // sanitize:
        $this->name=$this->sanitize($this->name);
        $this->category=$this->sanitize($this->category);
        $this->color=$this->sanitize($this->color);

        $this->description=$this->sanitize($this->description);
        $this->place=$this->sanitize($this->place);

        // bind values:
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":createdAt", $this->createdAt);
        $stmt->bindParam(":place", $this->place);

        // execute query:
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function delete() {

        //query to delete object:
        $query = "DELETE FROM $this->table_name WHERE
                id=:id";

        //prepare query:
        $stmt = $this->conn->prepare($query);

        //sanitize:
        $this->id=$this->sanitize($this->id);

        //bind value:
        $stmt->bindParam(":id",$this->id);

        //execute query:
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function put() {

        //query to update object:
        $query = "UPDATE $this->table_name 
                SET name=:name, description=:description, category=:category, color=:color, place=:place
                WHERE id=:id";

        //prepare query:
        $stmt = $this->conn->prepare($query);

        //sanitize:
        $this->id=$this->sanitize($this->id);

        //bind values:
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":place", $this->place);

        //execute query:
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    // constructor with $db as database connection:
    public function __construct($db){
        $this->conn = $db;
    }

}
