<?php
require_once'../../app/config/utils.php';
?>

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
        onclick="toggleModal(true)">
        + Tambah Sertifikat
      </button>
    </div>
    <!-- Modal Overlay -->
    <div
      id="modal"
      class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
      <!-- Modal Content -->
      <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-6 relative">
        <h2 class="text-xl font-semibold mb-4">Tambah Sertifikat</h2>

        <!-- Form -->
        <form id="formSertifikat" class="space-y-4" onsubmit="submitForm(event)">
          <!-- Input Text -->
          <div>
            <label class="block text-sm font-medium mb-1">Nama Pemilik</label>
            <input
              type="text"
              id="nama"
              name="nama"
              placeholder="Masukkan nama pemilik"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
              required />
          </div>

          <!-- Input Option -->
          <div>
            <label class="block text-sm font-medium mb-1">Jenis Sertifikat</label>
            <select
              id="jenis"
              name="jenis"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
              required>
              <option value="">-- Pilih Jenis Sertifikat --</option>
            </select>
          </div>

          <!-- Input File -->
          <div>
            <label class="block text-sm font-medium mb-1">Upload Sertifikat (PDF/JPG)</label>
            <input
              type="file"
              id="file"
              name="file"
              accept=".pdf,.jpg,.jpeg,.png"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400"
              required />
          </div>

          <!-- Tombol Aksi -->
          <div class="flex justify-end gap-3 pt-4">
            <button
              type="button"
              onclick="toggleModal(false)"
              class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition">
              Batal
            </button>
            <button
              type="submit"
              class="px-4 py-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition">
              Simpan
            </button>
          </div>
        </form>

        <!-- Tombol Close (X) -->
        <button
          onclick="toggleModal(false)"
          class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
          ✕
        </button>
      </div>
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
            <td class="py-3 px-4">Feeling Introvert</td>
            <td class="py-3 px-4">12 Jan 2024</td>
            <td class="py-3 px-4 text-center">
              <button
                class="bg-sky-400 text-white px-3 py-1 rounded-lg hover:bg-yellow-500 transition"
                onclick="alert('Download sertifikat ini')">
                Download
              </button>
              <button
                class="bg-yellow-400 text-white px-3 py-1 rounded-lg hover:bg-yellow-500 transition"
                onclick="alert('Edit sertifikat ini')">
                Edit
              </button>
              <button
                class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition ml-2"
                onclick="confirm('Hapus sertifikat ini?')">
                Hapus
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>

  <script>
    document.addEventListener("DOMContentLoaded",
      populateTypeDropdown());

    function populateTypeDropdown() {
     const jenis = document.getElementById("jenis");
     fetch("<?= base_url() ?>/app/controller/TypeController.php?action=getTypes")
       .then(response => response.json())
       .then(json => {
         json.data.forEach(item => {
           const option = document.createElement("option");
           option.value = item.id;
           option.textContent = item.type;
           jenis.appendChild(option);
         });
       });
   }

    function toggleModal(show) {
      document.getElementById("modal").classList.toggle("hidden", !show);
    }

    
    async function kirimDataSertifikat(formElement, endpointUrl) {
      const formData = new FormData(formElement);

      try {
        const response = await fetch(endpointUrl, {
          method: "POST",
          body: formData,
        });

        if (!response.ok) {
          throw new Error("Gagal mengirim data ke server.");
        }

        const result = await response.json();

        if (result.success) {
          console.log("Sertifikat berhasil ditambahkan.");
          toggleModal(false);
          formElement.reset();
          // panggil fungsi refresh data jika diperlukan, contoh: refreshTabelSertifikat();
        } else {
          console.warn("Gagal menambahkan sertifikat:", result.message || "Terjadi kesalahan.");
        }
      } catch (error) {
        console.error("Error:", error);
      }
    }

    // contoh pemakaian:
    document.getElementById("formSertifikat").addEventListener("submit", function(e) {
      e.preventDefault();
      kirimDataSertifikat(e.target, "api/sertifikat/tambah.php");
    });

  </script>
</body>

</html>