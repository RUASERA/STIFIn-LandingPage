<?php
$db = [
    'host'     => getenv('DB_HOST') ?: 'Localhost',
    'port'     => getenv('DB_PORT') ?: '3306',
    'database' => getenv('DB_DATABASE') ?: 'my_database',
    'username' => getenv('DB_USERNAME') ?: 'root',
    'password' => getenv('DB_PASSWORD') ?: '',
];

$conn = new mysqli($db['host'], $db['username'], $db['password'], $db['database'], $db['port']);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
