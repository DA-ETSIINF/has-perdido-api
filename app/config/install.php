<?php
include_once './database.php';
try
{
    $dbclass = new Database();
    echo "dfs";
    $connection = $dbclass.getConecction();
    $sql = file_get_contents("./create-tables.sql");
    $connection->exec($sql);
    echo "Database and tables created successfully!";
}
catch(PDOException $e)
{
    echo $e->getMessage();
}