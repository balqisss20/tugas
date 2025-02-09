<?php
// Koneksi ke database
include 'koneksi.php';

// Query untuk mengambil data pegawai
$query = "SELECT p.id_pegawai, p.nama, p.alamat, p.tanggal_lahir, p.jk, j.GAJI_POKOK, p.no_telpon,p.email ,j.id_jabatan,j.nama_jabatan,d.nama_depertemen, d.id_depertemen
          FROM Pegawai p
          JOIN Jabatan j ON p.id_jabatan = j.id_jabatan
          JOIN depertemen d ON p.id_depertemen = d.id_depertemen";
$result = mysqli_query($koneksi, $query);
$query_Jabatan = "SELECT * FROM Jabatan LIMIT 3";
$result_Jabatan = mysqli_query($koneksi, $query_Jabatan);
$query_depertemen = "SELECT * FROM depertemen Limit 3";
$result_depertemen = mysqli_query($koneksi, $query_depertemen);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kepegawaian</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4 flex space-x-4">
        <!-- Tabel List 3 Depertemen Teratas -->
        <div class="w-1/4 bg-white shadow-md rounded-lg p-4">
            <div>
                <table class="min-w-full">
                <thead class="bg-gray-200">
                <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Depertemen</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <?php while ($depertemen = mysqli_fetch_assoc($result_depertemen)): ?>
                    <tr>
                        <td class="px-6 py-4"><?= $depertemen['nama_depertemen'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                    <tr>
                    <td class="px-6 py-4">...</td>
                    </tr>
                </tbody>
                </table>
                <a href="depertemen.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded w-full text-center">Details</a>
            </div>
            <br>
            <div>
                <table class="min-w-full">
                <thead class="bg-gray-200">
                <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status Pegawai</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <?php while ($Jabatan = mysqli_fetch_assoc($result_Jabatan)): ?>
                    <tr>
                        <td class="px-6 py-4"><?= $Jabatan['nama_jabatan'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                    <tr>
                    <td class="px-6 py-4">...</td>
                    </tr>
                </tbody>
                </table>
                <a href="jabatan.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded w-full text-center">Details</a>
            </div>
        </div>


        <!-- Table Karyawan -->
        <div class="w-full bg-white shadow-md rounded-lg p-4">
            <h1 class="text-3xl font-bold text-center mb-8">Data Kepegawaian </h1>
            <a href="tambah_pegawai.php" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Pegawai</a>
            <table class="min-w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Jabatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Depertemen</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Gaji_pokok</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td class="px-6 py-4"><?= $row['nama'] ?></td>
                        <td class="px-6 py-4"><?= $row['alamat'] ?></td>
                        <td class="px-6 py-4"><?= $row['email'] ?></td>
                        <td class="px-6 py-4"><?= $row['nama_jabatan'] ?></td>
                        <td class="px-6 py-4"><?= $row['nama_depertemen'] ?></td>
                        <td class="px-6 py-4"><?= "Rp " . number_format($row['GAJI_POKOK'], 0, ',', '.') ?></td>
                        <td class="px-6 py-4">
                            <a href="edit_pegawai.php?id=<?= $row['id_pegawai'] ?>" class="text-blue-500 hover:text-blue-700 border-solid">Edit</a>
                            <a href="hapus_pegawai.php?id=<?= $row['id_pegawai'] ?>" class="text-red-500 hover:text-red-700 ml-2 border-solid" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        

         

    </div>
</body>
