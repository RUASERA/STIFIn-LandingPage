<?php
session_start();
require_once('../app/config/utils.php');
require_once('../app/config/database.php');

rememberMe($conn);

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    header('location: ./index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login - STIFIn</title>
  <link rel="icon" href="../src/images/logo_stifin.webp" type="image/x-icon" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-[Ubuntu] flex items-center justify-center min-h-screen">
  <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-8 border border-gray-200">
    <div class="text-center mb-6">
      <img src="../src/images/logo_stifin1.png" alt="Logo" class="w-20 mx-auto mb-3" />
      <h1 class="text-2xl font-semibold text-gray-800">Login Admin</h1>
      <p class="text-sm text-gray-500">Masuk untuk mengelola dashboard</p>
    </div>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="mb-4 text-center text-sm text-red-500">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url() ?>/app/controller/DashboardLoginController.php" method="POST" class="space-y-5">
      <div>
        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
        <input type="text" name="username" id="username" placeholder="Masukkan username"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" required />
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" id="password" placeholder="Masukkan password"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" required />
      </div>

      <div class="flex items-center justify-between">
        <label class="flex items-center text-sm text-gray-600">
          <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
          <span class="ml-2">Ingat saya</span>
        </label>
      </div>

      <button type="submit" name="action" value="login"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg py-2.5 transition duration-200">
        Masuk
      </button>
    </form>

    <p class="mt-6 text-center text-gray-500 text-sm">© 2025 STIFIn Dashboard</p>
  </div>
</body>
</html>
