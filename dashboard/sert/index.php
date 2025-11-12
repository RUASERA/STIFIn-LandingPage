<?php
session_start();
require_once '../../app/config/utils.php';
if (isset($_SESSION['loggedIn']) == false) {
  header('location: ./index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Sertifikat</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/cropperjs@1.6.2/dist/cropper.min.css" rel="stylesheet" />
  <script src="https://unpkg.com/cropperjs@1.6.2/dist/cropper.min.js"></script>
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
        <a href="#" class="text-gray-600 hover:text-blue-600 font-semibold">Sertifikat</a>
        <a href="../operators/index.php" class="text-gray-600 hover:text-blue-600">Operators</a>
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
        onclick="toggleModal('add')">
        + Tambah Sertifikat
      </button>
    </div>
    <!-- Modal Overlay -->
    <div
      id="modal"
      class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
      <!-- Modal Content -->
      <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-6 relative">
        <h2 class="text-xl font-semibold mb-4" id="formTitle">Tambah Sertifikat</h2>

        <!-- Form -->
        <form id="formSertifikat" class="space-y-4">
          <!-- Input Text -->
          <input type="hidden" id="sertifikatId" name="id" />
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

          <div>
            <label class="block text-sm font-medium mb-1">Password</label>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Default: password"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"/>
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
            <label class="block text-sm font-medium mb-1">Foto pemilik</label>
            <input
              type="file"
              id="foto"
              name="foto"
              accept=".jpeg, .png, .jpg"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400" />
          </div>

          <div>
            <label class="block text-sm font-medium mb-1">Upload Sertifikat (PDF/JPG)</label>
            <input
              type="file"
              id="file"
              name="file"
              accept=".pdf,.jpg,.jpeg,.png"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400" />
          </div>

          <!-- Tombol Aksi -->
          <div class="flex justify-end gap-3 pt-4">
            <button
              type="button"
              onclick="toggleHideModal()"
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
          onclick="toggleHideModal()"
          class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
          ✕
        </button>
      </div>
    </div>

    <!-- Modal Crop Foto -->
    <div id="cropModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
      <div class="bg-white p-4 rounded-lg shadow-lg w-[90%] max-w-md">
        <h2 class="text-lg font-semibold mb-2">Crop Foto</h2>
        <div class="w-full">
          <img id="cropImage" class="max-w-full" />
        </div>
        <div class="mt-4 flex justify-end gap-3">
          <button onclick="closeCropModal()" class="px-3 py-1 border rounded hover:bg-gray-100">Batal</button>
          <button onclick="applyCrop()" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Terapkan</button>
        </div>
      </div>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
      <table class="w-full border-collapse">
        <div class="flex justify-between items-center mb-4">
          <input
            type="text"
            id="searchInput"
            placeholder="Cari nama atau tipe sertifikat..."
            class="border border-gray-300 rounded-lg px-3 py-2 w-1/3 focus:ring-2 focus:ring-blue-400" />
          <div id="pagination" class="flex items-center gap-2"></div>
        </div>
        <thead class="bg-gray-50 border-b">
          <tr>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">No</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Pemilik</th>
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
    document.addEventListener("DOMContentLoaded", function() {
      populateTypeDropdown();
      loadSertifikat();
    });

    const tableBody = document.getElementById("tableBody");
    const searchInput = document.getElementById("searchInput");
    const paginationDiv = document.getElementById("pagination");
    const fotoInput = document.getElementById('foto');
    const cropModal = document.getElementById('cropModal');
    const cropImage = document.getElementById('cropImage');

    let cropper;
    let croppedBlob; // hasil crop yang akan dikirim ke server
    let currentPage = 1;
    let currentSearch = "";
    let currentMode = "add";

    // Saat user memilih file
    fotoInput.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = function(event) {
        cropImage.src = event.target.result;
        openCropModal();
      };
      reader.readAsDataURL(file);
    });

    function openCropModal() {
      cropModal.classList.remove('hidden');
      setTimeout(() => {
        if (cropper) cropper.destroy();
        cropper = new Cropper(cropImage, {
          aspectRatio: 1, // ubah sesuai kebutuhan: 1 = square, 4/3 = landscape, 3/4 = portrait
          viewMode: 1,
          autoCropArea: 1,
        });
      }, 200);
    }

    function closeCropModal() {
      cropModal.classList.add('hidden');
      if (cropper) cropper.destroy();
    }

    function applyCrop() {
      cropper.getCroppedCanvas({
        width: 300, // ukuran final (statis)
        height: 300,
      }).toBlob((blob) => {
        croppedBlob = blob;

        // Buat file baru hasil crop
        const file = new File([blob], 'cropped.jpg', {
          type: 'image/jpeg'
        });

        // Ganti file input agar dikirim file hasil crop ke server
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        fotoInput.files = dataTransfer.files;

        closeCropModal();
      }, 'image/jpeg', 0.9);
    }

    async function loadSertifikat(page = 1, search = "") {
      tableBody.innerHTML = `<tr><td colspan="5" class="py-4 text-center text-gray-500">Memuat data...</td></tr>`;
      try {
        const res = await fetch(`<?= base_url() ?>/app/controller/cert/show.php?page=${page}&search=${encodeURIComponent(search)}`);
        const data = await res.json();

        if (!data.success || data.data.length === 0) {
          tableBody.innerHTML = `<tr><td colspan="5" class="py-4 text-center text-gray-500">Data tidak ditemukan.</td></tr>`;
          paginationDiv.innerHTML = "";
          return;
        }

        tableBody.innerHTML = "";
        data.data.forEach((row, i) => {
          const tr = document.createElement("tr");
          tr.className = "border-b hover:bg-gray-50";
          tr.innerHTML = `
          <td class="py-3 px-4">${(data.current_page - 1) * data.per_page + i + 1}</td>
          <td class="py-3 px-4 flex items-center gap-3">
          <img class="w-[40px] rounded" src="<?=base_url()?>/app/uploads/photos/clients/${row.profile}" alt="img">
          ${row.name}
          </td>
          <td class="py-3 px-4">${row.tipe_stifin}</td>
          <td class="py-3 px-4">${row.tanggal_terbit}</td>
          <td class="py-3 px-4 text-center">
            <button class="bg-sky-400 text-white px-3 py-1 rounded-lg hover:bg-sky-500 transition"
              onclick="window.location.href='<?= base_url() ?>/app/controller/cert/download.php?id=' + ${row.id}">Download</button>
            <button class="bg-yellow-400 text-white px-3 py-1 rounded-lg hover:bg-yellow-500 transition"
              onclick="toggleModal('edit', {
                id: '${row.id}',
                name: '${row.name}',
                type_id: '${row.typeId}'
              })">Edit</button>
            <button 
              class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition ml-2"
              onclick="deleteCert(${row.id})">
              Hapus
            </button>
          </td>
        `;
          tableBody.appendChild(tr);
        });

        // Generate pagination
        paginationDiv.innerHTML = "";
        for (let i = 1; i <= data.total_pages; i++) {
          const btn = document.createElement("button");
          btn.textContent = i;
          btn.className = `px-3 py-1 rounded ${i === data.current_page ? "bg-blue-500 text-white" : "bg-gray-200 hover:bg-gray-300"}`;
          btn.onclick = () => {
            currentPage = i;
            loadSertifikat(currentPage, currentSearch);
          };
          paginationDiv.appendChild(btn);
        }
      } catch (err) {
        console.error(err);
        tableBody.innerHTML = `<tr><td colspan="5" class="py-4 text-center text-red-500">Gagal memuat data.</td></tr>`;
      }
    }

    // Pencarian realtime (debounced)
    let searchTimer;
    searchInput.addEventListener("input", () => {
      clearTimeout(searchTimer);
      searchTimer = setTimeout(() => {
        currentSearch = searchInput.value;
        currentPage = 1;
        loadSertifikat(currentPage, currentSearch);
      }, 500);
    });

    async function deleteCert(id) {
      if (!confirm("Yakin ingin menghapus sertifikat ini?")) return;

      const formData = new FormData();
      formData.append("action", "deleteCert");
      formData.append("id", id);

      try {
        const res = await fetch("<?= base_url() ?>/app/controller/cert/delete.php", {
          method: "POST",
          body: formData
        });

        const result = await res.json();
        alert(result.message);

        if (result.success) {
          loadSertifikat(); // refresh tabel
        }
      } catch (error) {
        console.error("Error:", error);
        alert("Terjadi kesalahan saat menghapus data.");
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

    function toggleHideModal() {
      document.getElementById("modal").classList.toggle("hidden", true);
    }

    function toggleModal(action, data = null) {
      const modal = document.getElementById("modal");
      const title = document.getElementById("formTitle");
      const form = document.getElementById("formSertifikat");
      const fileInput = document.getElementById('file');

      modal.classList.remove("hidden");
      currentMode = action;

      if (action === "add") {
        title.textContent = "Tambah Sertifikat";
        form.reset();
        document.getElementById("sertifikatId").value = "";
        fileInput.required = true;
      } else if (action === "edit" && data) {
        title.textContent = "Edit Sertifikat";
        document.getElementById("sertifikatId").value = data.id;
        document.getElementById("nama").value = data.name;
        document.getElementById("jenis").value = data.type_id;
        fileInput.required = false;
      }
    }


    document.getElementById("formSertifikat").addEventListener("submit", async function(e) {
      e.preventDefault();

      const form = e.target;
      const formData = new FormData(form);
      const ENDPOINT = currentMode === "add" ?
        "<?= base_url() ?>/app/controller/cert/insert.php" :
        "<?= base_url() ?>/app/controller/cert/update.php";

      try {
        // Tampilkan status loading (opsional)
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.textContent = "Menyimpan...";

        const response = await fetch(ENDPOINT, {
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
          loadSertifikat();
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