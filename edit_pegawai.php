<?php
// Koneksi ke database
include 'koneksi.php';

// Cek apakah id_pegawai dikirim melalui GET
if (isset($_GET['id'])) {
    $id_pegawai = $_GET['id'];

    // Ambil data pegawai berdasarkan id
    $query = "SELECT * FROM pegawai WHERE id_pegawai = $id_pegawai";
    $result = mysqli_query($koneksi, $query);
    $pegawai = mysqli_fetch_assoc($result);

    // Ambil daftar jabatan
    $query_jabatan = "SELECT * FROM jabatan";
    $result_jabatan = mysqli_query($koneksi, $query_jabatan);

    // Ambil daftar depertemen
    $query_depertemen = "SELECT * FROM depertemen";
    $result_depertemen = mysqli_query($koneksi, $query_depertemen);
}

// Proses form edit data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pegawai = $_POST['id_pegawai'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $email = $_POST['email'];
    $jk = $_POST['jk'];
    $id_jabatan = $_POST['id_jabatan'];
    $id_depertemen = $_POST['id_depertemen'];

    // Query untuk update data pegawai
    $query = "UPDATE pegawai SET 
                nama = '$nama',
                alamat = '$alamat',
                tanggal_lahir = '$tanggal_lahir',
                email = '$email',
                jk = '$jk',
                id_jabatan = '$id_jabatan',
                id_depertemen = '$id_depertemen'
              WHERE id_pegawai = '$id_pegawai'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data pegawai berhasil diperbarui'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data'); window.location='edit_pegawai.php?id=$id_pegawai';</script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-8">Edit Pegawai</h1>

        <form action="edit_pegawai.php" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <input type="hidden" name="id_pegawai" value="<?= $pegawai['id_pegawai'] ?>">

            <label class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" value="<?= $pegawai['nama'] ?>" required class="w-full px-4 py-2 border rounded-lg mb-4">

            <label class="block text-sm font-medium text-gray-700">Alamat</label>
            <textarea name="alamat" required class="w-full px-4 py-2 border rounded-lg mb-4"><?= $pegawai['alamat'] ?></textarea>

            <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="<?= $pegawai['tanggal_lahir'] ?>" required class="w-full px-4 py-2 border rounded-lg mb-4">

            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
            <select name="jk" required class="w-full px-4 py-2 border rounded-lg mb-4">
                <option value="L" <?= ($pegawai['jk'] == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= ($pegawai['jk'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
            </select>
           
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <textarea name="email" required class="w-full px-4 py-2 border rounded-lg mb-4"><?= $pegawai['email'] ?></textarea>

            <label class="block text-sm font-medium text-gray-700">No_telpon</label>
            <textarea name="no_telpon" required class="w-full px-4 py-2 border rounded-lg mb-4"><?= $pegawai['no_telpon'] ?></textarea>

            <label class="block text-sm font-medium text-gray-700">Jabatan</label>
            <select name="id_jabatan" required class="w-full px-4 py-2 border rounded-lg mb-4">
                <?php while ($row = mysqli_fetch_assoc($result_jabatan)) : ?>
                    <option value="<?= $row['id_jabatan'] ?>" <?= ($pegawai['id_jabatan'] == $row['id_jabatan']) ? 'selected' : '' ?>>
                        <?= $row['nama_jabatan'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <label class="block text-sm font-medium text-gray-700">Depertemen</label>
            <select name="id_depertemen" required class="w-full px-4 py-2 border rounded-lg mb-4">
                <?php while ($row = mysqli_fetch_assoc($result_depertemen)) : ?>
                    <option value="<?= $row['id_depertemen'] ?>" <?= ($pegawai['id_depertemen'] == $row['id_depertemen']) ? 'selected' : '' ?>>
                        <?= $row['nama_depertemen'] ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Perubahan</button>
            <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Batal</a>
        </form>
    </div>
</body>
</html>
