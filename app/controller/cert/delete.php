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
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'invalid request method']);
    http_response_code(403);
}

// Validasi input
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    echo json_encode(["success" => false, "message" => "ID sertifikat tidak valid."]);
    return;
}

$id = intval($_POST['id']);

// Cek apakah sertifikat ada
$stmt = $conn->prepare("SELECT file FROM user WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["success" => false, "message" => "Data sertifikat tidak ditemukan."]);
    return;
}

$row = $result->fetch_assoc();
$filename = $row['file'];
$filePath = __DIR__ . "/../../uploads/certificates/" . basename($filename);

$photoname = $row['profile'];
$photoPath = __DIR__ . "/../../uploads/photos/client/" . basename($photoname);

// Gunakan transaksi agar aman
$conn->begin_transaction();

try {
    // Hapus data dari database
    $stmtDel = $conn->prepare("DELETE FROM user WHERE id = ?");
    $stmtDel->bind_param("i", $id);
    $stmtDel->execute();

    // Hapus file jika ada
    if (file_exists($filePath)) {
        if (!unlink($filePath)) {
            throw new Exception("Gagal menghapus file dari server.");
        }
    }

    if ($photoPath && file_exists($photoPath) && basename($photoPath) !== 'default.jpg') {
        if (!unlink($photoPath)) {
            throw new Exception("Gagal menghapus file dari server.");
        }
    }

    $conn->commit();

    echo json_encode([
        "success" => true,
        "message" => "Sertifikat dan file berhasil dihapus."
    ]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode([
        "success" => false,
        "message" => "Gagal menghapus sertifikat: " . $e->getMessage()
    ]);
}
