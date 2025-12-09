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

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $action = isset($_GET['action']) ? $_GET['action'] : header('location: index.php');

    switch ($action) {
        case 'getTypes':
            show($conn);
            break;
    }
}

function show($conn)
{
    $stmt = $conn->prepare("SELECT * FROM types");
    $stmt->execute();
    $result = $stmt->get_result();

   if ($result && $result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode([
            'success' => true,
            'data' => $data
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'data' => [],
            'message' => 'Data type tidak ditemukan.'
        ]);
    }
}