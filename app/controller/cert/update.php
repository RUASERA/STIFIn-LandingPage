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
    echo json_encode(['success' => false, 'message' => 'Metode tidak diizinkan.']);
    exit;
}

$id     = isset($_POST['id']) ? intval($_POST['id']) : 0;
$nama   = mysqli_real_escape_string($conn, $_POST['nama']);
$jenis  = mysqli_real_escape_string($conn, $_POST['jenis']);
$file   = $_FILES['file'] ?? null;

// Pastikan ID valid
if ($id <= 0) {
    echo json_encode(['success' => false, 'message' => 'ID sertifikat tidak valid.']);
    exit;
}

// Ambil data lama untuk mendapatkan nama file lama
$stmtOld = $conn->prepare("SELECT file FROM user WHERE id = ?");
$stmtOld->bind_param("i", $id);
$stmtOld->execute();
$resultOld = $stmtOld->get_result();

if ($resultOld->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan.']);
    exit;
}

$oldData = $resultOld->fetch_assoc();
$oldFile = $oldData['file'];
$stmtOld->close();

// Direktori upload
$uploadDir = __DIR__ . '/../../uploads/certificates/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Jika ada file baru, lakukan validasi & hapus file lama
if ($file && $file['error'] === 0) {
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];

    if (!in_array($file['type'], $allowedTypes)) {
        echo json_encode(['success' => false, 'message' => 'Tipe file tidak valid. Hanya PDF, JPEG, dan PNG diperbolehkan.']);
        exit;
    }

    $newFileName = time() . "_" . basename($file['name']);
    $targetPath = $uploadDir . $newFileName;

    // Upload file baru
    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        echo json_encode(['success' => false, 'message' => 'Gagal mengunggah file baru.']);
        exit;
    }

    // Hapus file lama
    $oldFilePath = $uploadDir . $oldFile;
    if (file_exists($oldFilePath)) {
        unlink($oldFilePath);
    }

    $fileToSave = $newFileName;
} else {
    // Jika tidak upload file baru, gunakan file lama
    $fileToSave = $oldFile;
}

// Update data di database
$stmt = $conn->prepare("UPDATE user SET name = ?, type_id = ?, file = ? WHERE id = ?");
$stmt->bind_param("sssi", $nama, $jenis, $fileToSave, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Data sertifikat berhasil diperbarui.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal memperbarui data di database.']);
}

$stmt->close();
$conn->close();
