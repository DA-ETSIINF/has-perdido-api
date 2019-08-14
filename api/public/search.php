<?php

namespace = App\Acme;

include_once = 'functions.php';

class search {
	private $conn;
	private $table_name = 'lost-objects';

	$query = "SELECT * FROM $table_name WHERE name= '".$_POST['string']."'";
	$result = $con->query($sql);
	$rows = array();
	while($r = mysqli_fetch_assoc($result)) {
		$rows[] = $r;
	}
	print json_encode($rows);

}