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
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(['error' => 'invalid request method']);
    http_response_code(403);
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

// Siapkan header untuk download
header("Content-Description: File Transfer");
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
header("Expires: 0");
header("Cache-Control: must-revalidate");
header("Pragma: public");
header("Content-Length: " . filesize($filePath));

// Bersihkan output buffer agar tidak ada karakter tambahan
ob_clean();
flush();

// Kirim file ke browser
readfile($filePath);
exit;