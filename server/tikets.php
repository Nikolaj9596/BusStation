<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve any query parameters
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    $departure_city_id = $_GET['departure_city_id'] ?? null;
    $arrival_city_id = $_GET['arrival_city_id'] ?? null;
    $filteredData = array();
    $host = "postgres";
    $port = "5432";
    $dbname = "auto_bus";
    $user = "nik";
    $password = "238924";


    try {
        // Create a new PDO instance for the PostgreSQL connection
        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");

        // Set PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch city data
        $flights = [];
        $query = $pdo->query("SELECT f.id, f.flight_number, f.departure_city_id, f.arrival_city_id, f.departure_time, f.arrival_time, f.count_of_seats, f.company_name, d.name AS departure_city_name, a.name AS arrival_city_name FROM flights f INNER JOIN city d ON f.departure_city_id = d.id INNER JOIN city a ON f.arrival_city_id = a.id WHERE f.departure_city_id = {$departure_city_id} AND f.arrival_city_id = {$arrival_city_id}");
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $flight = array (
              'id' => $row['id'],
              'flight_num' => $row['flight_number'],
              'departure_city' => array(
                'id' => $row['departure_city_id'],
                'name' => $row['departure_city_name']
              ),
              'arrival_city' => array(
                'id' => $row['arrival_city_id'],
                'name' => $row['arrival_city_name']
              ),
              'departure_time' => $row['departure_time'],
              'arrival_time' => $row['arrival_time'],
              'count_of_seats' => $row['count_of_seats'],
              'company_name' => $row['company_name'],
              'tikets' => [],
            );

            // Fetch schedule data for the city
            $tikensQuery = $pdo->query("SELECT * FROM tikets WHERE flight_id = {$row['id']}");
            while ($tiketRow = $tikensQuery->fetch(PDO::FETCH_ASSOC)) {
                $tiket = [
                  'id' => $tiketRow['id'],
                  'price' => $tiketRow['price'],
                  'booked' => $tiketRow['booked']
                ];
                $flight['tikets'][] = $tiket;
            }
            $flights[] = $flight;
        }

        // Convert the data to JSON
        $jsonData = json_encode($flights, JSON_UNESCAPED_UNICODE);
        $pdo = null;
        echo $jsonData;
    } catch (PDOException $e) {
        // Handle connection errors
        echo "Connection failed: " . $e->getMessage();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Set the response headers for CORS
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');

    // Get the request body as JSON
    $requestBody = json_decode(file_get_contents('php://input'), true);

    // Extract ticket ID and blocked status from the request body
    $ticketId = $requestBody['tiket_id'] ?? null;
    $blocked = $requestBody['blocked'] ?? null;
    if ($ticketId !== null && $blocked !== null) {
        // Find the ticket in the flight data and update its 'booked' status
        foreach ($data as &$flight) {
            foreach ($flight['tikets'] as &$ticket) {
                if ($ticket['id'] == $ticketId) {
                    $ticket['booked'] = $blocked;
                    break 2; // Break both loops
                }
            }
        }

        // Set the response content type to JSON
        header('Content-Type: application/json');

        // Send a success response
        $response = array('message' => 'Ticket updated successfully');
        echo json_encode($response);
    } else {
        // Send a response indicating invalid request data
        $response = array('error' => 'Invalid request data');
        echo json_encode($response);
    }
} else {
    // Set the response headers for CORS
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');

    // Send a response indicating an invalid request method
    $response = array('error' => 'Invalid request method');
    echo json_encode($response);
}

