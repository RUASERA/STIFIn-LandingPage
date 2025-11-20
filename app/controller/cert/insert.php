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
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$jenis = mysqli_real_escape_string($conn, $_POST['jenis']);
$file = $_FILES['file'];
$foto = $_FILES['foto'];
$passcode = isset($_POST['password']) ? $_POST['password'] : 'password';

// Validasi input utama
if (empty($nama) || empty($jenis) || empty($file)) {
    echo json_encode(['success' => false, 'message' => 'Semua field harus diisi.']);
    exit();
}

// ================== VALIDASI & SIMPAN FILE UTAMA ==================
$allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];
$fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

if (!in_array($fileExtension, $allowedExtensions)) {
    echo json_encode(['success' => false, 'message' => 'Tipe file tidak valid. Hanya PDF, JPG, JPEG, dan PNG diperbolehkan.']);
    exit();
}

$uploadDir = __DIR__ . '/../../uploads/certificates/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Ganti nama file utama dengan timestamp
$newFileName = time() . "_" . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', basename($file['name']));
$filePath = $uploadDir . $newFileName;

if (!move_uploaded_file($file['tmp_name'], $filePath)) {
    echo json_encode(['success' => false, 'message' => 'Gagal mengunggah file sertifikat.']);
    return;
}

// ================== VALIDASI & SIMPAN FOTO CLIENT ==================
$profileFileName = null; // default

if (!empty($foto) && $foto['error'] === UPLOAD_ERR_OK) {
    $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];

    if (!in_array($foto['type'], $allowedImageTypes)) {
        echo json_encode(['success' => false, 'message' => 'Tipe foto tidak valid. Hanya JPG atau PNG diperbolehkan.']);
        return;
    }

    $photoDir = __DIR__ . '/../../uploads/photos/clients/';
    if (!is_dir($photoDir)) {
        mkdir($photoDir, 0755, true);
    }

    // Gunakan datetime untuk nama file foto (YYYYmmdd_His.jpg)
    $profileFileName = date('Ymd_His') . '.jpg';
    $photoPath = $photoDir . $profileFileName;

    if (!move_uploaded_file($foto['tmp_name'], $photoPath)) {
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan foto pemilik.']);
        return;
    }
}

// ================== SIMPAN DATA KE DATABASE ==================
$hash = password_hash($passcode, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO user (name, type_id, file, profile, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nama, $jenis, $newFileName, $profileFileName, $hash);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Sertifikat dan foto berhasil ditambahkan.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data ke database.']);
}

$stmt->close();
$conn->close();