<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/utils.php';

// Pastikan pengguna telah login
if (!isset($_SESSION['loggedIn'])) {
    echo json_encode(['error' => 'Unauthorized']);
    http_response_code(403);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $action = $_POST['action'] ?? $data['action'] ?? '';

    switch ($action) {
        case 'login':
            login($conn);
            break;
    }
}

function login($conn)
{
    session_start();
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Gunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifikasi password dengan password_verify()
        if (password_verify($password, $row['password'])) {
            $_SESSION['name'] = $row['username'];
            $_SESSION['profile'] = base_url() . "/" . $row['image'];
            $_SESSION['loggedIn'] = true;
            $_SESSION['role'] = $row['role'];

            json_encode(['status'=>'success', 'message' => 'Login berhasil']);
            exit();
        } else {
            echo json_encode(['status'=>'error', 'message' => 'Passowrd salah']);
            exit();
        }
    } else {
        echo json_encode(['status'=>'error', 'message' => 'Pengguna tidak ditemukan']);
        exit();
    }
}

