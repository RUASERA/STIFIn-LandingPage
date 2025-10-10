<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sertifikat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans text-gray-800">

    <!-- NAVBAR SEDERHANA -->
    <nav class="bg-white shadow-sm fixed top-0 left-0 right-0 z-50">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <h1 class="text-lg font-semibold">Edit Sertifikat</h1>
            <a href="sertifikat.html" class="text-blue-500 hover:underline">Kembali</a>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="pt-24 container mx-auto px-6">
        <div class="bg-white shadow-md rounded-xl p-6 max-w-2xl mx-auto">
            <h2 class="text-xl font-semibold mb-4">Form Edit Sertifikat</h2>

            <form id="formEditSertifikat" class="space-y-5" onsubmit="submitEdit(event)">
                <input type="hidden" id="id" name="id" value="1" />
                <div class="flex gap-6">
                    <div>
                        <!-- Input Nama -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Nama Pemilik</label>
                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                required />
                        </div>

                        <!-- Input Jenis -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Jenis Sertifikat</label>
                            <select
                                id="jenis"
                                name="jenis"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                required>
                                <option value="">-- Pilih Jenis Sertifikat --</option>
                                <option value="Web Development">Web Development</option>
                                <option value="UI/UX Design">UI/UX Design</option>
                                <option value="Data Science">Data Science</option>
                            </select>
                        </div>

                        <!-- Input File -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Upload Sertifikat Baru (Opsional)</label>
                            <input
                                type="file"
                                id="file"
                                name="file"
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400"
                                onchange="previewFile(event)" />
                            <p class="text-xs text-gray-500 mt-1">Format yang didukung: PDF, JPG, PNG</p>
                        </div>
                    </div>
                    <!-- Preview Sertifikat -->
                    <div id="previewContainer" class="mt-4 hidden">
                        <p class="text-sm font-medium mb-2">Preview Sertifikat:</p>
                        <div id="previewBox" class="border rounded-lg overflow-hidden bg-gray-50 p-2"></div>
                    </div>
                </div>


                <!-- Tombol -->
                <div class="flex justify-end gap-3 pt-4">
                    <a
                        href="sertifikat.html"
                        class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition">
                        Batal
                    </a>
                    <button
                        type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Simulasi data awal (bisa diambil dari API)
        const sertifikatData = {
            id: 1,
            nama: "John Doe",
            jenis: "Web Development",
            fileUrl: "uploads/sertifikat_webdev.pdf",
        };

        // Isi form dengan data awal
        window.addEventListener("DOMContentLoaded", () => {
            document.getElementById("nama").value = sertifikatData.nama;
            document.getElementById("jenis").value = sertifikatData.jenis;
            tampilkanPreview(sertifikatData.fileUrl);
        });

        // Preview file (gambar atau PDF)
        function previewFile(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const url = e.target.result;
                tampilkanPreview(url, file.type);
            };
            reader.readAsDataURL(file);
        }

        // Tampilkan preview sesuai tipe file
        function tampilkanPreview(url, type = "") {
            const previewContainer = document.getElementById("previewContainer");
            const previewBox = document.getElementById("previewBox");
            previewContainer.classList.remove("hidden");

            if (type.includes("pdf") || url.endsWith(".pdf")) {
                previewBox.innerHTML = `<iframe src="${url}" class="w-full h-96 border rounded-lg"></iframe>`;
            } else {
                previewBox.innerHTML = `<img src="${url}" alt="Preview Sertifikat" class="w-full rounded-lg shadow-sm">`;
            }
        }

        // Kirim data ke server via AJAX
        async function submitEdit(e) {
            e.preventDefault();
            const formData = new FormData(e.target);

            try {
                const response = await fetch("api/sertifikat/edit.php", {
                    method: "POST",
                    body: formData,
                });

                const result = await response.json();

                if (result.success) {
                    alert("Data sertifikat berhasil diperbarui.");
                    window.location.href = "sertifikat.html";
                } else {
                    alert("Gagal memperbarui data sertifikat.");
                }
            } catch (err) {
                console.error(err);
                alert("Terjadi kesalahan saat mengirim data.");
            }
        }
    </script>
</body>

</html>