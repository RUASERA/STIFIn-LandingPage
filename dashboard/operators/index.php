<?php
session_start();
require_once '../../app/config/utils.php';
if (isset($_SESSION['loggedIn']) == false) {
  header('location: ./index.php');
  exit();
}
include '../../app/config/database.php';
$result = $conn->query("SELECT * FROM operators ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Operator</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans text-gray-800">

  <!-- NAVBAR -->
  <nav class="bg-white shadow-md fixed top-0 left-0 right-0 z-50">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
      <div class="flex items-center gap-2">
        <div class="w-8 h-8 bg-blue-500 rounded-lg"></div>
        <span class="text-lg font-semibold">Dashboard</span>
      </div>

      <div class="hidden md:flex items-center gap-6">
        <a href="../index.php" class="text-gray-600 hover:text-blue-600">Home</a>
        <a href="../sert/index.php" class="text-gray-600 hover:text-blue-600">Sertifikat</a>
        <a href="#" class="text-gray-600 hover:text-blue-600 font-semibold">Operator</a>
      </div>

      <div class="flex items-center gap-4">
        <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
          <span class="text-sm font-medium">AD</span>
        </div>
      </div>
    </div>
  </nav>

  <!-- MAIN CONTENT -->
  <main class="pt-24 container mx-auto px-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-semibold">Data Operator</h1>
      <button onclick="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
        + Tambah Operator
      </button>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
      <table class="w-full border-collapse">
        <thead class="bg-gray-50 border-b">
          <tr>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">No</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Foto</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Username</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Role</th>
            <th class="py-3 px-4 text-center text-sm font-semibold text-gray-600">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          while ($row = $result->fetch_assoc()): ?>
            <tr class="border-b hover:bg-gray-50 transition">
              <td class="py-3 px-4"><?= $no++ ?></td>
              <td class="py-3 px-4">
                <img src="../../app/uploads/<?= htmlspecialchars($row['img'] ?: 'default.jpg') ?>" class="w-10 h-10 rounded-full object-cover">
              </td>
              <td class="py-3 px-4"><?= htmlspecialchars($row['username']) ?></td>
              <td class="py-3 px-4 capitalize"><?= htmlspecialchars($row['role']) ?></td>
              <td class="py-3 px-4 text-center">
                <a href="../../app/controller/operators/delete.php?id=<?= $row['id'] ?>"
                  class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition"
                  onclick="return confirm('Yakin ingin menghapus operator ini?')">
                  Hapus
                </a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </main>

  <!-- MODAL TAMBAH OPERATOR -->
  <div id="addModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-6 relative">
      <h2 class="text-xl font-semibold mb-4">Tambah Operator</h2>
      <form action="../../app/controller/operators/insert.php" method="POST" enctype="multipart/form-data" class="space-y-4">
        <div>
          <label class="block text-sm font-medium mb-1">Username</label>
          <input type="text" name="username"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            required>
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Password</label>
          <input type="password" name="password"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            required>
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Role</label>
          <select name="role"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="admin">Admin</option>
            <option value="operator">Operator</option>
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Foto</label>
          <input type="file" name="img" accept="image/*"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="flex justify-end gap-3 pt-4">
          <button type="button" onclick="closeModal()"
            class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition">
            Batal
          </button>
          <button type="submit" class="px-4 py-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition">
            Simpan
          </button>
        </div>

        <button type="button" onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
          ✕
        </button>
      </form>
    </div>
  </div>

  <script>
    const modal = document.getElementById('addModal');
    function openModal() {
      modal.classList.remove('hidden');
    }
    function closeModal() {
      modal.classList.add('hidden');
    }
  </script>
</body>
</html>
