<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'koneksi.php';

    $nama_depertemen = $_POST['nama_depertemen'];

    $query = "INSERT INTO depertemen (nama_depertemen) 
    VALUES ('$nama_depertemen')";
    mysqli_query($koneksi, $query);
    header('Location: depertemen.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Depertemen</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto p-4"></div>

    <h1 class="text-3xl font-bold text-center mb-8">Tambah Depertemen</h1>
    <form method="POST" action="tambah_depertemen.php" class="bg-white shadow-md rounded-lg p-6 max-w-lg mx-auto">
        <div class="mb-4"></div>
            <label for="nama_depertemen" class="block text-gray-700">Nama Depertemen</label>
            <input type="text" name="nama_depertemen" id="nama_depertemen" class="w-full px-4 py-2 border rounded-lg" required>
        </div>
        <div class="text-center">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
        </div>
    </form>
    </body>
</html>