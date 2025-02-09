<?php
// Proses form tambah data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'koneksi.php';
    $nama = $_POST['nama'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $no_telpon = $_POST['no_telpon'];
    $email = $_POST['email'];
    $jk = $_POST['jk'];
    $id_jabatan = $_POST['id_jabatan'];
    $id_depertemen = $_POST['id_depertemen'];

    $query = "INSERT INTO pegawai (nama, tanggal_lahir, alamat,no_telpon,email, jk, id_jabatan, id_depertemen) 
              VALUES ('$nama', '$tanggal_lahir','$alamat','$no_telpon','$email', '$jk', '$id_jabatan', '$id_depertemen')";
    mysqli_query($koneksi, $query);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-8">Tambah Pegawai</h1>

        <!-- Form Tambah Data -->
        <form action="tambah_pegawai.php" method="POST" class="bg-white shadow-md rounded-lg p-6 max-w-lg mx-auto">
            <div class="mb-4">
                <label for="nama" class="block text-gray-700">Nama</label>
                <input type="text" name="nama" id="nama" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="tanggal_lahir" class="block text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="jk" class="block text-gray-700">Jenis Kelamin</label>
                <select name="jk" id="jk" class="w-full px-4 py-2 border rounded-lg" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="alamat" class="block text-gray-700">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="no_telpon" class="block text-gray-700">No Telpon</label>
                <input type="text" name="no_telpon" id="no_telpon" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="text" name="email" id="email" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="id_jabatan" class="block text-gray-700">Jabatan</label>
                <select name="id_jabatan" id="id_jabatan" class="w-full px-4 py-2 border rounded-lg" required>
                    <!-- Ambil data jabatan dari database -->
                    <?php
                    include 'koneksi.php';
                    $query = "SELECT * FROM Jabatan";
                    $result = mysqli_query($koneksi, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id_jabatan']}'>{$row['nama_jabatan']}</option>";
                    }
                    ?>
                </select>
                </div>
            <div class="mb-4">
                <label for="id_depertemen" class="block text-gray-700">Depertemen</label>
                <select name="id_depertemen" id="id_depertemen" class="w-full px-4 py-2 border rounded-lg" required>
                    <!-- Ambil data depertemen dari database -->
                    <?php
                    $query = "SELECT * FROM depertemen";
                    $result = mysqli_query($koneksi, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id_depertemen']}'>{$row['nama_depertemen']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
                <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-700 ml-2">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>

         