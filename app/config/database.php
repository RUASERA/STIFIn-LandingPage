<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require './utils.php';
$dot = parse_ini_file('../../.env');

$conn = new mysqli(
  $dot['DB_HOST'],
  $dot['DB_USERNAME'],
  $dot['DB_PASSWORD'],
  $dot['DB_DATABASE'],
  $dot['DB_PORT'],
);

if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'DELETE' ) {
    echo json_encode(['error' => 'Unauthorized']);
    http_response_code(403);
    exit();
}

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}
echo "Koneksi berhasil!";