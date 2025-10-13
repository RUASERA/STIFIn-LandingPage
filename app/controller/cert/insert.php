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
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    echo json_encode(['error'=>'invalid request method']);
    http_response_code(403);
}

$data = json_decode(file_get_contents("php://input"), true);

$nama = mysqli_real_escape_string($conn, $data['nama']);
$jenis = mysqli_real_escape_string($conn, $data['jenis']);
$file = $_FILES['file'];
$passcode = generateKodeUnik();

// Validasi input
if (empty($nama) || empty($jenis) || empty($file)) {
    echo json_encode(['success' => false, 'message' => 'Semua field harus diisi.']);
    return;
}

// Validasi file
$allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
if (!in_array($file['type'], $allowedTypes)) {
    echo json_encode(['success' => false, 'message' => 'Tipe file tidak valid. Hanya PDF, JPEG, dan PNG yang diperbolehkan.']);
    return;
}

// Pindahkan file ke direktori uploads
$uploadDir = __DIR__ . '/../../uploads/certificates/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}
$filePath = $uploadDir . basename($file['name']);
if (!move_uploaded_file($file['tmp_name'], $filePath)) {
    echo json_encode(['success' => false, 'message' => 'Gagal mengunggah file.']);
    return;
}

// Simpan data ke database
$stmt = $conn->prepare("INSERT INTO user (name, type_id, file, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nama, $jenis, $file['name'], $passcode);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Sertifikat berhasil ditambahkan.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data ke database.']);
}

$stmt->close();
