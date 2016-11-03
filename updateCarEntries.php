<?php
 
require_once 'include/DB_Functions.php';

$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);


if (isset($_GET['value'])) {
    // receiving the post params
    $value = $_GET['value'];
    
    $car_entries = $db->updateCarEntries($value);
    
    if ($car_entries) {
    // user stored successfully
        $response["error"] = FALSE;
        $response["time"] = $car_entries;
        $response["car_entries"] = $value;
        echo json_encode($response);
    } else {
        $response["error"] = TRUE;
        $response["error_msg"] = "Unknown error occurred in updating car entries!";
        echo json_encode($response);
    }
} 
else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (value) is missing!";
    echo json_encode($response);
}

?>