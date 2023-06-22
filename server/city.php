<?php
$data = array(
  array(
    'id' => 1,
    'name' => 'Murom',
  ),
  array(
    'id' => 1,
    'name' => 'Navashino',
  ),
  array(
    'id' => 1,
    'name' => 'Moscow',
  ),
);

// Check if it's a GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve any query parameters
    // $param1 = $_GET['param1'] ?? null;
    // $param2 = $_GET['param2'] ?? null;
    // 
    // Perform any necessary processing based on the parameters
    // For example, filter the data based on the parameters
    // if ($param1 === 'age') {
    //     $filteredData = array('age' => $data['age']);
    // } else {
    //     $filteredData = $data;
    // }
    
    // Set the response content type to JSON
    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *"); // Replace * with the appropriate origin or set it dynamically based on the request origin.
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Add any additional HTTP methods your server supports.
    header("Access-Control-Allow-Headers: Content-Type"); // Add any additional headers your server accepts.

    // Send the JSON response
    echo json_encode($data);
} else {
    // Send a response indicating an invalid request
    $response = array('error' => 'Invalid request');
    echo json_encode($response);
}
?>
