<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/utils.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(['error' => 'invalid request method']);
    http_response_code(403);
    exit;
}

$id = intval($_GET['id']);

// Ambil data file dari database
$stmt = $conn->prepare("SELECT file FROM user WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("File tidak ditemukan di database.");
}

$row = $result->fetch_assoc();
$filename = basename($row['file']);
$filePath = __DIR__ . "/../../uploads/certificates/" . $filename;

// Cek apakah file fisik tersedia
if (!file_exists($filePath)) {
    die("File tidak ditemukan di server.");
}

// Siapkan header untuk preview
header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename=\"" . $filename . "\"");
header("Content-Transfer-Encoding: binary");
header("Accept-Ranges: bytes");

// Bersihkan output buffer agar tidak ada karakter tambahan
ob_clean();
flush();

// Tampilkan file langsung di browser
readfile($filePath);
exit;
