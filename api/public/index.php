<?php

include '../app/vendor/autoload.php';
$foo = new App\Acme\Foo();
$foo->getName();

print_r($_SERVER['REQUEST_METHOD']);

$arr = array ('a'=>1,'b'=>2,'c'=>3,'d'=>4,'e'=>5);
header('Content-Type: application/json');
echo json_encode($arr);
?>