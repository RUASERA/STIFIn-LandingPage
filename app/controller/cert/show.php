<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/utils.php';

// Pastikan pengguna telah login
if (!isset($_SESSION['loggedIn'])) {
    echo json_encode(['error' => 'Unauthorized']);
    http_response_code(403);
    exit();
}

$query = "SELECT u.id, u.name, t.type AS tipe_stifin, u.created_at AS tanggal_terbit
          FROM user u
          LEFT JOIN types t ON u.type_id = t.id
          ORDER BY u.created_at DESC";

$result = mysqli_query($conn, $query);

$data = [];
if ($result && mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
      "id" => $row["id"],
      "name" => htmlspecialchars($row["name"]),
      "tipe_stifin" => htmlspecialchars($row["tipe_stifin"]),
      "tanggal_terbit" => date("d M Y", strtotime($row["tanggal_terbit"]))
    ];
  }
}

echo json_encode([
  "success" => true,
  "data" => $data
]);