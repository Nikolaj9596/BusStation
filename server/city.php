<?php
$data = array(
  array(
    'id' => 1,
    'name' => 'Murom',
    'schedule' => array(
      array(
        'id' => 1,
        'departure_time' => '06:05',
        'arrival_time' => '08:05',
        'waypoints' => 'г. Калининград — пос. Космодемьянское через г. Гурьевск',
        'departure_time_destination' => '08:25',
        'arrival_time_destination' => '10:25',
        'city_id' => 1
      ),

      array(
        'id' => 2,
        'departure_time' => '06:05',
        'arrival_time' => '08:05',
        'waypoints' => 'г. Калининград — пос. Космодемьянское через г. Гурьевск',
        'departure_time_destination' => '08:25',
        'arrival_time_destination' => '10:25',
        'city_id' => 1
      ),

      array(
        'id' => 3,
        'departure_time' => '06:05',
        'arrival_time' => '08:05',
        'waypoints' => 'г. Калининград — пос. Космодемьянское через г. Гурьевск',
        'departure_time_destination' => '08:25',
        'arrival_time_destination' => '10:25',
        'city_id' => 1
      ),
    )
  ),
  array(
    'id' => 2,
    'name' => 'Navashino',
    'schedule' => array(
      array(
        'id' => 4,
        'departure_time' => '06:05',
        'arrival_time' => '08:05',
        'waypoints' => 'г. Калининград — пос. Космодемьянское через г. Гурьевск',
        'departure_time_destination' => '08:25',
        'arrival_time_destination' => '10:25',
        'city_id' => 2
      ),

      array(
        'id' => 5,
        'departure_time' => '06:05',
        'arrival_time' => '08:05',
        'waypoints' => 'г. Калининград — пос. Космодемьянское через г. Гурьевск',
        'departure_time_destination' => '08:25',
        'arrival_time_destination' => '10:25',
        'city_id' => 2
      ),

      array(
        'id' => 6,
        'departure_time' => '06:05',
        'arrival_time' => '08:05',
        'waypoints' => 'г. Калининград — пос. Космодемьянское через г. Гурьевск',
        'departure_time_destination' => '08:25',
        'arrival_time_destination' => '10:25',
        'city_id' => 2
      ),
    )
  ),
  array(
    'id' => 3,
    'name' => 'Moscow',
    'schedule' => array(
      array(
        'id' => 7,
        'departure_time' => '06:05',
        'arrival_time' => '08:05',
        'waypoints' => 'г. Калининград — пос. Космодемьянское через г. Гурьевск',
        'departure_time_destination' => '08:25',
        'arrival_time_destination' => '10:25',
        'city_id' => 3
      ),
      array(
        'id' => 8,
        'departure_time' => '06:05',
        'arrival_time' => '08:05',
        'waypoints' => 'г. Калининград — пос. Космодемьянское через г. Гурьевск',
        'departure_time_destination' => '08:25',
        'arrival_time_destination' => '10:25',
        'city_id' => 3
      ),
      array(
        'id' => 9,
        'departure_time' => '06:05',
        'arrival_time' => '08:05',
        'waypoints' => 'г. Калининград — пос. Космодемьянское через г. Гурьевск',
        'departure_time_destination' => '08:25',
        'arrival_time_destination' => '10:25',
        'city_id' => 3
      ),
    )
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
