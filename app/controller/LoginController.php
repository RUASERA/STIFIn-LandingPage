<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/utils.php';

// Jalankan fungsi loginclient jika diminta langsung via form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    loginclient($conn);
    exit;
}

// Jalankan fungsi login (admin)
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $action = $_POST['action'] ?? $data['action'] ?? '';

    switch ($action) {
        case 'login':
            login($conn);
            break;
    }
}

// Fungsi login untuk client    
function loginclient($conn) {
    $name = trim($_POST['name'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($name === '' || $password === '') {
        echo "<script>alert('Nama dan password wajib diisi!'); window.history.back();</script>";
        exit;
    }

    // Cek user di tabel user
    $stmt = $conn->prepare("SELECT * FROM user WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Bandingkan password polos
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['type_id'] = $user['type_id'];

            // ✅ Redirect ke report.php
            header("Location: ../../report.php");
            exit;
        } else {
            echo "<script>alert('Password salah!'); window.history.back();</script>";
            exit;
        }
    } else {
        echo "<script>alert('User tidak ditemukan!'); window.history.back();</script>";
        exit;
    }
}

// Fungsi login untuk admin
function login($conn)
{
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['name'] = $row['username'];
            $_SESSION['profile'] = base_url() . "/" . $row['image'];
            $_SESSION['loggedIn'] = true;
            $_SESSION['role'] = $row['role'];

            echo json_encode(['status' => 'success', 'message' => 'Login berhasil']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Password salah']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Pengguna tidak ditemukan']);
    }
    exit;
}
?>
