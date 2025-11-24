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

// Pagination setup
$per_page = 5;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $per_page;

// Search filter
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$search_condition = '';
if ($search !== '') {
    $search = mysqli_real_escape_string($conn, $search);
    $search_condition = "WHERE s.name LIKE '%$search%' OR t.type LIKE '%$search%'";
}

// Hitung total data
$total_query = "SELECT COUNT(*) as total FROM user s 
                LEFT JOIN types t ON s.type_id = t.id
                $search_condition";
$total_result = mysqli_query($conn, $total_query);
$total_data = $total_result ? mysqli_fetch_assoc($total_result)['total'] : 0;
$total_pages = ceil($total_data / $per_page);

// Ambil data sesuai halaman
$query = "SELECT s.id, s.name, t.type AS tipe_stifin, s.type_id, s.created_at AS tanggal_terbit, s.profile
          FROM user s
          LEFT JOIN types t ON s.type_id = t.id
          $search_condition
          ORDER BY s.created_at DESC
          LIMIT $per_page OFFSET $offset";

$result = mysqli_query($conn, $query);
$data = [];

if ($result && mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
      "id" => $row["id"],
      "typeId" => $row["type_id"],
      "name" => htmlspecialchars($row["name"]),
      "profile" => htmlspecialchars($row["profile"] ? $row["profile"] : 'default.jpg'),
      "tipe_stifin" => htmlspecialchars($row["tipe_stifin"]),
      "tanggal_terbit" => date("d M Y", strtotime($row["tanggal_terbit"]))
    ];
  }
}

echo json_encode([
  "success" => true,
  "data" => $data,
  "current_page" => $page,
  "per_page" => $per_page,
  "total_pages" => $total_pages,
  "total_data" => $total_data
]);