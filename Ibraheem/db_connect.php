<?php

//connection to database
// More robust environment detection
$is_local = (
    $_SERVER['HTTP_HOST'] == 'localhost' || 
    strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false ||
    strpos($_SERVER['HTTP_HOST'], 'localhost:') !== false ||
    $_SERVER['HTTP_HOST'] == '::1'
);

if ($is_local) {
    // Local development environment (XAMPP)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "final";
} else {
    // Production environment (InfinityFree)
    $servername = "sql205.infinityfree.com";
    $username = "if0_39973795";
    $password = "wETWvFXzRjMY4";
    $dbname = "if0_39973795_final";
}

$conn = new mysqli($servername, $username, $password, $dbname);

// Enhanced error handling
if ($conn->connect_error) {
    $error_msg = "Database Connection Failed: " . $conn->connect_error;
    // Log the error (in production, you might want to log to a file instead of displaying)
    error_log($error_msg);
    die($error_msg);
}
?>