<?php
// Replace with your actual database connection details
$servername = "localhost";
$username = "root";
$password = ""; // Assuming no password for localhost
$dbname = "minutemen";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch device list from the 'Device' table
$sql = "SELECT * FROM employee"; // Modify query based on your table structure
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $deviceList = array();

    // Fetch and store each row in an array
    while ($row = $result->fetch_assoc()) {
        $deviceList[] = $row;
    }

    // Output the device list data in JSON format
    header('Content-Type: application/json');
    echo json_encode($deviceList);
} else {
    echo "0 results";
}

$conn->close();
?>
