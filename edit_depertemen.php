<?php
include 'koneksi.php';

$depertemen = null; // Inisialisasi variabel untuk mencegah error

if (isset($_GET['id'])) {
    $id_depertemen = $_GET['id'];

    $query = "SELECT * FROM depertemen WHERE id_depertemen = $id_depertemen";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $depertemen = mysqli_fetch_assoc($result);
    } else {
        echo "<p class='text-red-500 text-center'>Data tidak ditemukan!</p>";
    }
}
if (isset($_POST['id_depertemen'])) {
    $id_depertemen = $_POST['id_depertemen'];
    $nama_depertemen = $_POST['nama_depertemen'];

    $query = "UPDATE depertemen SET nama_depertemen = '$nama_depertemen' WHERE id_depertemen = $id_depertemen";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data depertemen berhasil diperbarui'); window.location='depertemen.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data'); window.location='edit_depertemen.php?id=$id_depertemen';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Cabang</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-8">Edit Cabang</h1>

        <?php if ($depertemen): ?>
            <form action="edit_depertemen.php" method="POST">
                <input type="hidden" name="id_depertemen" value="<?= $depertemen['id_depertemen'] ?>">
                <div class="mb-4">
                    <label for="nama_depertemen" class="block text-gray-700">Nama departemen</label>
                    <input type="text" name="nama_depertemen" id="nama_depertemen" class="w-full px-4 py-2 border rounded-lg" value="<?= htmlspecialchars($depertemen['nama_depertemen']) ?>" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        <?php else: ?>
            <p class="text-red-500 text-center">Cabang tidak ditemukan atau terjadi kesalahan.</p>
        <?php endif; ?>
    </div>
</body>
</html>


