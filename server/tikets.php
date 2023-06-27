<?php
$data = array(
  array(
    'id' => 1,
    'flight_num' => 1,
    'departure_city_id' => array(
      'id' => 1,
      'name' => 'Муром'
    ),
    'arrival_city_id' => array(
      'id' => 2,
      'name' => 'Навашино'    
    ),
    'departure_time' => '06:05',
    'arrival_time' => '08:05',
    'count_of_seats' => 3,
    'company_name' => 'Аэрофлот',
    'tikets' => array(
      array(
        'id' => 1,
        'price' => 100
      ),
      array(
        'id' => 2,
        'price' => 100
      ),
      array(
        'id' => 3,
        'price' => 100
      ),
    )
  ),

  array(
    'id' => 2,
    'flight_num' => 2,
    'departure_city_id' => array(
      'id' => 2,
      'name' => 'Навашино'
    ),
    'arrival_city_id' => array(
      'id' => 3,
      'name' => 'Москва'      
    ),
    'departure_time' => '06:05',
    'arrival_time' => '08:05',
    'count_of_seats' => 3,
    'company_name' => 'Аэрофлот',
    'tikets' => array(
      array(
        'id' => 4,
        'price' => 100
      ),
      array(
        'id' => 5,
        'price' => 100
      ),
      array(
        'id' => 6,
        'price' => 100
      ),
    )
  ),


  array(
    'id' => 3,
    'flight_num' => 3,
    'departure_city_id' => array(
      'id' => 3,
      'name' => 'Москва'
    ),
    'arrival_city_id' => array(
      'id' => 1,
      'name' => 'Муром'
    ),
    'departure_time' => '06:05',
    'arrival_time' => '08:05',
    'count_of_seats' => 3,
    'company_name' => 'Аэрофлот',
    'tikets' => array(
      array(
        'id' => 7,
        'price' => 100
      ),
      array(
        'id' => 8,
        'price' => 100
      ),
      array(
        'id' => 9,
        'price' => 100
      ),
    )
  ),

  array(
    'id' => 4,
    'flight_num' => 4,
    'departure_city_id' => array(
      'id' => 3,
      'name' => 'Москва'
    ),
    'arrival_city_id' => array(
      'id' => 1,
      'name' => 'Муром'
    ),
    'departure_time' => '06:05',
    'arrival_time' => '08:05',
    'count_of_seats' => 3,
    'company_name' => 'Аэрофлот',
    'tikets' => array(
      array(
        'id' => 1,
        'price' => 100
      ),
      array(
        'id' => 2,
        'price' => 100
      ),
      array(
        'id' => 3,
        'price' => 100
      ),
    )
  ),
);

// Check if it's a GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve any query parameters
    $departure_city_id = $_GET['departure_city_id'] ?? null;
    $arrival_city_id = $_GET['arrival_city_id'] ?? null;
    $filteredData = array();

    foreach ($data as $flight) {
      if ($flight['departure_city_id'] == $departure_city_id && $flight['arrival_city_id'] == $arrival_city_id) {
        $filteredData[] = $flight;
      }
    };
    // Set the response content type to JSON
    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *"); // Replace * with the appropriate origin or set it dynamically based on the request origin.
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Add any additional HTTP methods your server supports.
    header("Access-Control-Allow-Headers: Content-Type"); // Add any additional headers your server accepts.

    // Send the JSON response
    echo json_encode($filteredData);
} else {
    // Send a response indicating an invalid request
    $response = array('error' => 'Invalid request');
    echo json_encode($response);
}
