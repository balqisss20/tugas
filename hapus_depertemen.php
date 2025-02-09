<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_depertemen = $_GET['id'];

    $query = "DELETE FROM depertemen WHERE id_depertemen = '$id_depertemen'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: depertemen.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
}
?>
