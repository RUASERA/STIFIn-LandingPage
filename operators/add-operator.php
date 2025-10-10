<?php
include '../config/database.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role = $_POST['role'];

  if ($username && $email && $role) {
    $stmt = $conn->prepare("INSERT INTO operator (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password, $role);
    if ($stmt->execute()) {
      $message = "User berhasil ditambahkan!";
    } else {
      $message = "Gagal menambahkan user: " . $conn->error;
    }
  } else {
    $message = "Semua field wajib diisi!";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Operator</title>
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
        <a href="#" class="text-gray-600 hover:text-blue-600">Home</a>
        <a href="#" class="text-gray-600 hover:text-blue-600 font-semibold">User</a>
        <a href="#" class="text-gray-600 hover:text-blue-600">Sertifikat</a>
      </div>

      <div class="flex items-center gap-4">
        <div id="roleDisplay" class="text-sm font-medium text-gray-600">Role: admin</div>
        <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
          <span class="text-sm font-medium">AD</span>
        </div>
      </div>
    </div>
  </nav>

  <!-- MAIN CONTENT -->
  <main class="pt-24 container mx-auto px-6">
    <?php if ($message): ?>
      <div class="mb-4 p-3 text-sm text-white bg-blue-500 rounded-lg text-center">
        <?= htmlspecialchars($message) ?>
      </div>
    <?php endif; ?>

    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-semibold">Daftar Operator</h1>
      <button id="addBtn" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
        + Tambah User
      </button>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
      <table class="w-full border-collapse">
        <thead class="bg-gray-50 border-b">
          <tr>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">No</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Nama</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Email</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Role</th>
            <th class="py-3 px-4 text-center text-sm font-semibold text-gray-600">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $result = $conn->query("SELECT * FROM operator ORDER BY id DESC");
          $no = 1;
          if ($result && $result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
          ?>
          <tr class="border-b hover:bg-gray-50">
            <td class="py-3 px-4"><?= $no++ ?></td>
            <td class="py-3 px-4"><?= htmlspecialchars($row['username']) ?></td>
            <td class="py-3 px-4"><?= htmlspecialchars($row['email']) ?></td>
            <td class="py-3 px-4"><?= htmlspecialchars($row['role']) ?></td>
            <td class="py-3 px-4 text-center">
              <button class="bg-yellow-400 text-white px-3 py-1 rounded-lg hover:bg-yellow-500 transition">Edit</button>
              <button class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition ml-2">Hapus</button>
            </td>
          </tr>
          <?php
            endwhile;
          else:
          ?>
          <tr><td colspan="5" class="text-center py-4 text-gray-500">Belum ada data operator</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>

  <!-- MODAL TAMBAH USER -->
  <div id="modal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md relative">
      <h2 class="text-xl font-semibold mb-4 text-center">Tambah User</h2>
      <button id="closeModal" class="absolute top-3 right-4 text-gray-500 hover:text-gray-800 text-xl">&times;</button>

      <form method="POST" class="space-y-4">
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Nama</label>
          <input type="text" name="username" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
          <input type="email" name="email" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Password</label>
          <input type="password" name="password" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Role</label>
          <select name="role" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
            <option value="">Pilih Role</option>
            <option value="admin">Admin</option>
            <option value="operator">Operator</option>
          </select>
        </div>
        <div class="flex justify-end gap-3 pt-2">
          <button type="button" id="cancelModal" class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition">Batal</button>
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const modal = document.getElementById("modal");
    const addBtn = document.getElementById("addBtn");
    const closeModal = document.getElementById("closeModal");
    const cancelModal = document.getElementById("cancelModal");

    addBtn.addEventListener("click", () => modal.classList.remove("hidden"));
    closeModal.addEventListener("click", () => modal.classList.add("hidden"));
    cancelModal.addEventListener("click", () => modal.classList.add("hidden"));
  </script>

</body>
</html>
