<?php
class Object{
    // database connection and table name
    private $conn;
    private $table_name = "objects";

    // object properties
    public $id;
    public $name;
    public $description;
    public $category;
    public $color;
    public $createdAt;
    public $place;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}