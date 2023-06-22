<?php
$data = array(
    'name' => 'John Doe',
    'age' => 30,
    'email' => 'johndoe@example.com'
);

// Check if it's a GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve any query parameters
    $param1 = $_GET['param1'] ?? null;
    $param2 = $_GET['param2'] ?? null;
    
    // Perform any necessary processing based on the parameters
    // For example, filter the data based on the parameters
    if ($param1 === 'age') {
        $filteredData = array('age' => $data['age']);
    } else {
        $filteredData = $data;
    }
    
    // Set the response content type to JSON
    header('Content-Type: application/json');
    
    // Send the JSON response
    echo json_encode($filteredData);
} else {
    // Send a response indicating an invalid request
    $response = array('error' => 'Invalid request');
    echo json_encode($response);
}
?>
