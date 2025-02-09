<?php
include 'koneksi.php';

$query = "SELECT * FROM log_perubahan_email";
$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Email</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head><body>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-8">Data Email</h1>
        <a href="index.php" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">⬅️ Kembali</a>
        
        <table class="min-w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">tgl perubahan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Email Lama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Email Baru</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td class="px-6 py-4"><?= $row['id_log'] ?></td>
                    <td class="px-6 py-4"><?= $row['waktu_perubahan'] ?></td>
                    <td class="px-6 py-4"><?= $row['email_lama'] ?></td>
                    <td class="px-6 py-4"><?= $row['email_baru'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>

            </table>
    </body>
    </html>