<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Sertifikat</title>
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
        <a href="#" class="text-gray-600 hover:text-blue-600 font-semibold">Sertifikat</a>
        <a href="#" class="text-gray-600 hover:text-blue-600">Pengaturan</a>
      </div>

      <div class="flex items-center gap-4">
        <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
          <span class="text-sm font-medium">OR</span>
        </div>
      </div>
    </div>
  </nav>

  <!-- MAIN CONTENT -->
  <main class="pt-24 container mx-auto px-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-semibold">Data Sertifikat</h1>
      <button
        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition"
        onclick="alert('Form tambah sertifikat akan ditampilkan')"
      >
        + Tambah Sertifikat
      </button>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
      <table class="w-full border-collapse">
        <thead class="bg-gray-50 border-b">
          <tr>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">No</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Nama Pemilik</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Tipe STIFIn</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Tanggal Diterbitkan</th>
            <th class="py-3 px-4 text-center text-sm font-semibold text-gray-600">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <!-- Row 1 -->
          <tr class="border-b hover:bg-gray-50">
            <td class="py-3 px-4">1</td>
            <td class="py-3 px-4">John Doe</td>
            <td class="py-3 px-4">Sertifikat Web Developer</td>
            <td class="py-3 px-4">12 Jan 2024</td>
            <td class="py-3 px-4 text-center">
              <button
                class="bg-sky-400 text-white px-3 py-1 rounded-lg hover:bg-yellow-500 transition"
                onclick="alert('Edit sertifikat ini')"
              >
                Download
              </button>
              <button
                class="bg-yellow-400 text-white px-3 py-1 rounded-lg hover:bg-yellow-500 transition"
                onclick="alert('Edit sertifikat ini')"
              >
                Edit
              </button>
              <button
                class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition ml-2"
                onclick="confirm('Hapus sertifikat ini?')"
              >
                Hapus
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>

</body>
</html>
