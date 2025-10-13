<?php
require_once '../../app/config/utils.php';
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
        <form id="formSertifikat" class="space-y-4">
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
        <tbody id="tableBody">
          <!-- Row 1 -->
          <tr>
            <td colspan="5" class="py-4 px-4 text-center text-gray-500">Memuat data...</td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>

  <script>
    document.addEventListener("DOMContentLoaded",function(){
      populateTypeDropdown();
      loadSertifikat();
    });

    async function loadSertifikat() {
    const tableBody = document.getElementById("tableBody");
    tableBody.innerHTML = `
      <tr>
        <td colspan="5" class="py-4 px-4 text-center text-gray-500">Memuat data...</td>
      </tr>`;

    try {
      const res = await fetch("<?= base_url() ?>/app/controller/Cert/show.php");
      const data = await res.json();

      if (!data.success || data.data.length === 0) {
        tableBody.innerHTML = `
          <tr><td colspan="5" class="py-4 px-4 text-center text-gray-500">Data sertifikat belum tersedia.</td></tr>`;
        return;
      }

      tableBody.innerHTML = "";

      data.data.forEach((row, i) => {
        const tr = document.createElement("tr");
        tr.className = "border-b hover:bg-gray-50";

        tr.innerHTML = `
          <td class="py-3 px-4">${i + 1}</td>
          <td class="py-3 px-4">${row.name}</td>
          <td class="py-3 px-4">${row.tipe_stifin}</td>
          <td class="py-3 px-4">${row.tanggal_terbit}</td>
          <td class="py-3 px-4 text-center">
            <button class="bg-sky-400 text-white px-3 py-1 rounded-lg hover:bg-sky-500 transition"
              onclick="window.location.href='download.php?id=${row.id}'">Download</button>
            <button class="bg-yellow-400 text-white px-3 py-1 rounded-lg hover:bg-yellow-500 transition"
              onclick="window.location.href='edit.php?id=${row.id}'">Edit</button>
            <button class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition ml-2"
              onclick="if(confirm('Hapus sertifikat ini?')) window.location.href='delete.php?id=${row.id}'">Hapus</button>
          </td>
        `;
        tableBody.appendChild(tr);
      });
    } catch (err) {
      console.error(err);
      tableBody.innerHTML = `
        <tr><td colspan="5" class="py-4 px-4 text-center text-red-500">Gagal memuat data.</td></tr>`;
    }
  }


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


    document.getElementById("formSertifikat").addEventListener("submit", async function(e) {
      e.preventDefault();

      const form = e.target;
      const formData = new FormData(form);

      try {
        // Tampilkan status loading (opsional)
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.textContent = "Menyimpan...";

        const response = await fetch("<?= base_url() ?>/app/controller/Cert/insert.php", {
          method: "POST",
          body: formData,
        });

        // Parsing hasil JSON dari API
        const result = await response.json();

        if (result.success) {
          alert("Sertifikat berhasil disimpan!");
          form.reset();
          // contoh: tutup modal jika ada fungsi toggleModal()
          if (typeof toggleModal === "function") toggleModal(false);
        } else {
          alert("Gagal menyimpan: " + (result.message || "Terjadi kesalahan."));
        }

      } catch (error) {
        console.error("Error:", error);
        alert("Gagal mengirim data ke server.");
      } finally {
        // Kembalikan tombol ke keadaan semula
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = false;
        submitBtn.textContent = "Simpan";
      }
    });
  </script>
</body>

</html>