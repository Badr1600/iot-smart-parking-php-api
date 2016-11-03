<?php
// Prepare variables for database connection
$dbusername = "root";
$dbpassword = "root";
$server = "localhost";

$response = array("error" => FALSE);

// Connect to your database

$dbconnect = mysql_pconnect($server, $dbusername, $dbpassword);
$dbselect = mysql_select_db("Parking",$dbconnect);


if (isset($_GET['value'])) {
    $value = $_GET['value'];
    $sql = "INSERT INTO Parking.park (value) VALUES ('".$_GET["value"]."')";

    if(mysql_query($sql) === TRUE){
    	$response["error"] = FALSE;
    	$response["current_car_numbers"] = $value;
    	$response["time"] = date("h:i:sa");
    	echo json_encode($response);
    } else {
        $response["error"] = TRUE;
        $response["sql msg"] = "Error: " . $sql . "<br>" . $dbselect;
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["msg"] = "Check the entered Values!! || Check db Connection";
    echo json_encode($response);
}

?>
