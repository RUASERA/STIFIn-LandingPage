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

$data = json_decode(file_get_contents("php://input"), true);
$id = mysqli_real_escape_string($conn, $_POST['id']); // ID user yang ingin diupdate
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$jenis = mysqli_real_escape_string($conn, $_POST['jenis']);
$file = $_FILES['file'] ?? null;
$foto = $_FILES['foto'] ?? null;

// Validasi ID utama
if (empty($id)) {
    echo json_encode(['success' => false, 'message' => 'ID user tidak ditemukan.']);
    return;
}

// Validasi input utama
if (empty($nama) || empty($jenis)) {
    echo json_encode(['success' => false, 'message' => 'Nama dan jenis tidak boleh kosong.']);
    return;
}

// Ambil data lama dari database untuk menghapus file lama jika diganti
$oldData = $conn->query("SELECT file, profile FROM user WHERE id = '$id'")->fetch_assoc();
if (!$oldData) {
    echo json_encode(['success' => false, 'message' => 'Data user tidak ditemukan.']);
    return;
}

$newFileName = $oldData['file'];
$profileFileName = $oldData['profile'];

// ================== UPDATE FILE UTAMA (sertifikat) ==================
if (!empty($file) && $file['error'] === UPLOAD_ERR_OK) {
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
    if (!in_array($file['type'], $allowedTypes)) {
        echo json_encode(['success' => false, 'message' => 'Tipe file tidak valid.']);
        return;
    }

    $uploadDir = __DIR__ . '/../../uploads/certificates/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $newFileName = time() . "_" . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', basename($file['name']));
    $filePath = $uploadDir . $newFileName;

    if (!move_uploaded_file($file['tmp_name'], $filePath)) {
        echo json_encode(['success' => false, 'message' => 'Gagal mengunggah file sertifikat.']);
        return;
    }

    // Hapus file lama jika berbeda
    if (!empty($oldData['file']) && file_exists($uploadDir . $oldData['file'])) {
        unlink($uploadDir . $oldData['file']);
    }
}

// ================== UPDATE FOTO CLIENT ==================
if (!empty($foto) && $foto['error'] === UPLOAD_ERR_OK) {
    $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];

    if (!in_array($foto['type'], $allowedImageTypes)) {
        echo json_encode(['success' => false, 'message' => 'Tipe foto tidak valid.']);
        return;
    }

    $photoDir = __DIR__ . '/../../uploads/photos/clients/';
    if (!is_dir($photoDir)) {
        mkdir($photoDir, 0755, true);
    }

    $profileFileName = date('Ymd_His') . '.jpg';
    $photoPath = $photoDir . $profileFileName;

    if (!move_uploaded_file($foto['tmp_name'], $photoPath)) {
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan foto pemilik.']);
        return;
    }

    // Hapus foto lama jika ada
    if (!empty($oldData['profile']) && file_exists($photoDir . $oldData['profile'])) {
        unlink($photoDir . $oldData['profile']);
    }
}

// ================== UPDATE DATA KE DATABASE ==================
$stmt = $conn->prepare("UPDATE user SET name = ?, type_id = ?, file = ?, profile = ? WHERE id = ?");
$stmt->bind_param("sssss", $nama, $jenis, $newFileName, $profileFileName, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Data berhasil diperbarui.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal memperbarui data di database.']);
}

$stmt->close();
$conn->close();