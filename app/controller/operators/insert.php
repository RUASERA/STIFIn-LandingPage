<?php
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $img = 'default.jpg';

    // Upload file gambar
    if (!empty($_FILES['img']['name'])) {
        $targetDir = '../../uploads/';
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $imgName = time() . '_' . basename($_FILES['img']['name']);
        $targetFile = $targetDir . $imgName;

        if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFile)) {
            $img = $imgName;
        }
    }

    // Masukkan ke database sesuai kolom yang ada
    $stmt = $conn->prepare("INSERT INTO operators (username, password, role, img) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $password, $role, $img);

    if ($stmt->execute()) {
        header("Location: ../../../dashboard/operators/index.php?success=1");
exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}


?>
