<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Set the response content type to JSON
    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *"); // Replace * with the appropriate origin or set it dynamically based on the request origin.
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Add any additional HTTP methods your server supports.
    header("Access-Control-Allow-Headers: Content-Type"); // Add any additional headers your server accepts.
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
        $cities = [];
        $query = $pdo->query('SELECT * FROM city');
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $city = array (
                'id' => $row['id'],
                'name' => $row['name'],
                'schedule' => [],
            );

            // Fetch schedule data for the city
            $scheduleQuery = $pdo->query("SELECT * FROM schedule WHERE city_id = {$row['id']}");
            while ($scheduleRow = $scheduleQuery->fetch(PDO::FETCH_ASSOC)) {
                $schedule = [
                    'id' => $scheduleRow['id'],
                    'departure_time' => $scheduleRow['departure_time'],
                    'arrival_time' => $scheduleRow['arrival_time'],
                    'waypoints' => $scheduleRow['waypoints'],
                    'departure_time_destination' => $scheduleRow['departure_time_destination'],
                    'arrival_time_destination' => $scheduleRow['arrival_time_destination'],
                    'city_id' => $scheduleRow['city_id'],
                ];
                $city['schedule'][] = $schedule;
            }
            $cities[] = $city;
        }

        // Convert the data to JSON
        $jsonData = json_encode($cities, JSON_UNESCAPED_UNICODE);
        $pdo = null;
        echo $jsonData;
    } catch (PDOException $e) {
        // Handle connection errors
        echo "Connection failed: " . $e->getMessage();
    }
    // Send the JSON response
    // echo json_encode($data);
} else {
    // Send a response indicating an invalid request
    $response = array('error' => 'Invalid request');
    echo json_encode($response);
}
