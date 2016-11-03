<?php

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

$car_entries = $db->fetchCarEntries();

if ($car_entries) {
        $response["error"] = FALSE;
		$response["car_entries"] = $car_entries["value"];
		$response["time_stamp"] = $car_entries["time"];
        echo json_encode($response); 
}	
	else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Canot Fetsh car entries data form the Database";
    echo json_encode($response);
	}

?>