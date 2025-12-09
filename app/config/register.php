<?php
session_start();
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Cek apakah password dan confirm_password cocok
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Password dan Konfirmasi Password tidak cocok!";
        header("location: register_form.php");
        exit();
    }

    // Hash password sebelum disimpan
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Cek apakah email sudah terdaftar
    $stmt = $conn->prepare("SELECT id FROM operators WHERE username = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Email sudah terdaftar!";
        header("location: register_form.php");
        exit();
    }

    // Simpan data ke database
    $default_image = "default.jpg"; // Gambar default untuk user baru
    $stmt = $conn->prepare("INSERT INTO operators (username,  password, img) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $hashed_password, $default_image);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
        header("location: index.php"); // Arahkan ke halaman login
    } else {
        $_SESSION['error'] = "Gagal melakukan registrasi. Coba lagi!";
        header("location: register_form.php");
    }

    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Registrasi Akun</h2>

    <!-- Tampilkan pesan error jika ada -->
    <?php if (isset($_SESSION['error'])) : ?>
        <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <form  method="POST">

        <label for="email">Email:</label>
        <input type="text" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="confirm_password">Konfirmasi Password:</label>
        <input type="password" name="confirm_password" required><br>

        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="index.php">Login di sini</a></p>
</body>
</html>