<?php
session_start();
require_once '../../app/config/utils.php';
if(isset($_SESSION['loggedIn']) == false){
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
<title>Daftar Operator</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="container mx-auto pt-20">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">Daftar Operator</h1>
    <button onclick="openModal()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
      + Tambah Operator
    </button>
  </div>

  <div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
      <thead class="bg-gray-50 border-b">
        <tr>
          <th class="p-3 text-left text-gray-700">No</th>
          <th class="p-3 text-left text-gray-700">Foto</th>
          <th class="p-3 text-left text-gray-700">Username</th>
          <th class="p-3 text-left text-gray-700">Role</th>
          <th class="p-3 text-center text-gray-700">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; while($row=$result->fetch_assoc()): ?>
        <tr class="border-b hover:bg-gray-50 transition">
          <td class="p-3 text-center"><?= $no++ ?></td>
          <td class="p-3 text-center">
            <img src="../../app/uploads/<?= htmlspecialchars($row['img'] ?: 'default.jpg') ?>" 
                 class="w-10 h-10 rounded-full mx-auto object-cover">
          </td>
          <td class="p-3"><?= htmlspecialchars($row['username']) ?></td>
          <td class="p-3 capitalize"><?= htmlspecialchars($row['role']) ?></td>
          <td class="p-3 text-center">
            <a href="../../app/controller/operators/delete.php?id=<?= $row['id'] ?>"
               class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
               onclick="return confirm('Yakin ingin menghapus operator ini?')">
               Hapus
            </a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- MODAL TAMBAH OPERATOR -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg p-6 w-96 relative">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Operator</h2>
    <form action="../../app/controller/operators/insert.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="block mb-1 text-sm font-medium text-gray-700">Username</label>
        <input type="text" name="username" class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-200" required>
      </div>
      <div class="mb-3">
        <label class="block mb-1 text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-200" required>
      </div>
      <div class="mb-3">
        <label class="block mb-1 text-sm font-medium text-gray-700">Role</label>
        <select name="role" class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-200">
          <option value="admin">Admin</option>
          <option value="operator">Operator</option>
        </select>
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-700">Foto (img)</label>
        <input type="file" name="img" accept="image/*" class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-200">
      </div>
      <div class="flex justify-end gap-2">
        <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">Batal</button>
        <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
const modal = document.getElementById('addModal');
function openModal(){ modal.classList.remove('hidden'); modal.classList.add('flex'); }
function closeModal(){ modal.classList.add('hidden'); }
</script>
</body>
</html>
