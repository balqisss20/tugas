<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'koneksi.php';

    $nama_jabatan = $_POST['nama_jabatan'];
    $GAJI_POKOK = $_POST['GAJI_POKOK'];
    $tunjangan= $_POST['tunjangan'];

    $query = "INSERT INTO jabatan (nama_jabatan, GAJI_POKOK, tunjangan) 
    VALUES ('$nama_jabatan','$GAJI_POKOK','$tunjangan')";
    mysqli_query($koneksi, $query);
    header('Location: jabatan.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <title>Tambah Jabatan</title>
</head>
<body>
    <div class="container mx-auto p-4"></div>

    <h1 class="text-3xl font-bold text-center mb-8">Tambah Jabatan</h1>
    <form method="POST" action="tambah_jabatan.php" class="bg-white shadow-md rounded-lg p-6 max-w-lg mx-auto">
        <div class="mb-4"></div>
            <label for="nama_depertemen" class="block text-gray-700">Nama Jabatan</label>
            <input type="text" name="nama_jabatan" id="na ma_jabatan" class="w-full px-4 py-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label for="GAJI_POKOK" class="block text-gray-700">Gaji Pokok</label>
            <input type="Number" name="GAJI_POKOK" id="GAJI_POKOK" class="w-full px-4 py-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label for="tunjangan" class="block text-gray-700">Tunjangan</label>
            <input type="Number" name="tunjangan" id="GAJI_POKOK" class="w-full px-4 py-2 border rounded-lg" required>
        </div>
        <div class="text-center">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
        </div>
    </form>
    </body>
</html>