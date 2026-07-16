<?php
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$db = getenv('DB_NAME') ?: 'library_db';
$port = getenv('DB_PORT') ?: 3306;

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    http_response_code(500);
    echo "Database connection failed. Please configure DB_HOST, DB_USER, DB_PASS, DB_NAME, and DB_PORT.";
    exit;
}
?>