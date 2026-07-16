<?php
mysqli_report(MYSQLI_REPORT_OFF);

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db = getenv('DB_NAME');
$port = getenv('DB_PORT') ?: 3306;

if (empty($host) || empty($user) || empty($db)) {
    http_response_code(500);
    echo "Database configuration is incomplete. Please set DB_HOST, DB_USER, DB_PASS, DB_NAME, and DB_PORT in Render.";
    exit;
}

try {
    $conn = new mysqli($host, $user, $pass, $db, (int) $port);
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    error_log("Database connection failed: " . $e->getMessage());
    echo "Database connection failed. Please verify your Render database host, username, password, and database name.";
    exit;
}
?>