<?php
session_start();
require '../config/database.php';

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
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Gunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("SELECT * FROM operators WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifikasi password dengan password_verify()
        if (password_verify($password, $row['password'])) {
            $_SESSION['name'] = $row['username'];
            $_SESSION['profile'] = $row['img'];
            $_SESSION['loggedIn'] = true;
            $_SESSION['role'] = $row['role'];

            header('location: ../../dashboard');
            exit();
        } else {
            $_SESSION['error'] = "Password salah!";
            header('location: ../../dashboard');
            exit();
        }
    } else {
        $_SESSION['error'] = "Akun tidak ditemukan!";
            header('location: ../../dashboard');
            exit();
    }
}


