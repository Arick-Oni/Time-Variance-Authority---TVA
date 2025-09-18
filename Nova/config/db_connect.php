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
    $mysqli = mysqli_connect("localhost", "root", "", "final");
} else {
    // Production environment (InfinityFree)
    // Updated with correct InfinityFree database settings
    $mysqli = mysqli_connect("sql205.infinityfree.com", "if0_39973795", "wETWvFXzRjMY4", "if0_39973795_final");
}

$conn = $mysqli; // For compatibility with files that use $conn

// Enhanced error handling
if(!$mysqli){
    $error_msg = "Database Connection Failed: " . mysqli_connect_error();
    // Log the error (in production, you might want to log to a file instead of displaying)
    error_log($error_msg);
    die($error_msg);
}
?>
