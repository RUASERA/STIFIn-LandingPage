<?php
include '../../config/database.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ambil nama file gambar dulu agar bisa dihapus dari folder uploads
    $result = $conn->query("SELECT img FROM operators WHERE id = $id");
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imgPath = '../../../uploads/operators/' . $row['img'];

        // Hapus file gambar jika bukan default.jpg
        if ($row['img'] !== 'default.jpg' && file_exists($imgPath)) {
            unlink($imgPath);
        }

        // Hapus data dari database
        $stmt = $conn->prepare("DELETE FROM operators WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header("Location: ../../../dashboard/operators/index.php?delete_success=1");
            exit;
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Data tidak ditemukan.";
    }
    $conn->close();
} else {
    echo "ID tidak ditemukan.";
}
?>
