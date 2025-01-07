<?php
include('koneksi.php');
include('session.php');

// Cek apakah pengguna sudah login
if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

// Query untuk mengambil penduduk yang sudah menikah
$pendudukMenikahQuery = "SELECT * FROM penduduk WHERE status_pernikahan = 'Menikah'";
$pendudukMenikahResult = $conn->query($pendudukMenikahQuery);

// Query untuk mengambil penduduk yang belum menikah
$pendudukBelumMenikahQuery = "SELECT * FROM penduduk WHERE status_pernikahan = 'Belum Menikah'";
$pendudukBelumMenikahResult = $conn->query($pendudukBelumMenikahQuery);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penduduk Desa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Data Penduduk Desa</h1>

        <!-- Tabel Penduduk yang Menikah -->
        <h3>Penduduk yang Menikah</h3>
        <table id="tabelMenikah">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Status Pernikahan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $pendudukMenikahResult->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['nama']}</td>
                            <td>{$row['umur']}</td>
                            <td>{$row['jenis_kelamin']}</td>
                            <td>{$row['alamat']}</td>
                            <td>{$row['status_pernikahan']}</td>
                            <td>
                                <a href='edit_penduduk.php?id={$row['id']}'>Edit</a> | 
                                <a href='delete.php?id={$row['id']}'>Hapus</a>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Tabel Penduduk yang Belum Menikah -->
        <h3>Penduduk yang Belum Menikah</h3>
        <table id="tabelBelumMenikah">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Status Pernikahan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $pendudukBelumMenikahResult->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['nama']}</td>
                            <td>{$row['umur']}</td>
                            <td>{$row['jenis_kelamin']}</td>
                            <td>{$row['alamat']}</td>
                            <td>{$row['status_pernikahan']}</td>
                            <td>
                                <a href='edit_penduduk.php?id={$row['id']}'>Edit</a> | 
                                <a href='delete.php?id={$row['id']}'>Hapus</a>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="links">
            <a href="index.php">Kembali ke Halaman Utama</a>
        </div>
    </div>
</body>
</html>
