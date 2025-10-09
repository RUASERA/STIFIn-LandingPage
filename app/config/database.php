<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$dot = parse_ini_file(__DIR__ . '/.env');

$conn = new mysqli(
  $dot['DB_HOST'],
  $dot['DB_HOST'],
  $dot['DB_HOST'],
  $dot['DB_HOST'],
  $dot['DB_HOST'],
);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}
echo "Koneksi berhasil!";