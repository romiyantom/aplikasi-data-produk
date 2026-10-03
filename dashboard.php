<?php

session_start();

if (!isset($_SESSION['username'])) {

    header("Location: login/login.php");
    exit;

}

include "config/koneksi.php";


/* Total produk */

$query_produk = "SELECT COUNT(*) AS total FROM barang";

$stmt_produk = $koneksi->query($query_produk);

$total_produk = $stmt_produk->fetch()['total'];


/* Total stok */

$query_stok = "SELECT SUM(stok) AS total FROM barang";

$stmt_stok = $koneksi->query($query_stok);

$total_stok = $stmt_stok->fetch()['total'];

if ($total_stok == null) {

    $total_stok = 0;

}


/* Jumlah kategori */

$query_kategori = "
    SELECT COUNT(DISTINCT kategori) AS total
    FROM barang
";

$stmt_kategori = $koneksi->query($query_kategori);

$total_kategori = $stmt_kategori->fetch()['total'];


/* Total nilai produk */

$query_nilai = "
    SELECT SUM(harga * stok) AS total
    FROM barang
";

$stmt_nilai = $koneksi->query($query_nilai);

$total_nilai = $stmt_nilai->fetch()['total'];

if ($total_nilai == null) {

    $total_nilai = 0;

}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Dashboard - Data Produk</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body class="dashboard-page">


    <!-- NAVBAR -->

    <div class="navbar">

        <h2>Aplikasi Data Produk</h2>

        <a
            href="logout.php"
            class="navbar-logout">

            Logout

        </a>

    </div>


    <!-- DASHBOARD -->

    <div class="dashboard-container">


        <!-- WELCOME -->

        <div class="dashboard-welcome">

            <div>

                <p class="welcome-small">
                    Selamat datang kembali 👋
                </p>

                <h1>

                    Halo,
                    <?php echo htmlspecialchars($_SESSION['username']); ?>!

                </h1>

                <p class="welcome-text">

                    Kelola data produk dengan mudah
                    melalui dashboard ini.

                </p>

            </div>

        </div>


        <!-- STATISTIK -->

        <div class="statistik">


            <div class="stat-card">

                <div class="stat-icon">
                    📦
                </div>

                <div>

                    <p>Total Produk</p>

                    <h2>
                        <?php echo $total_produk; ?>
                    </h2>

                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">
                    📊
                </div>

                <div>

                    <p>Total Stok</p>

                    <h2>
                        <?php echo $total_stok; ?>
                    </h2>

                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">
                    🗂️
                </div>

                <div>

                    <p>Kategori</p>

                    <h2>
                        <?php echo $total_kategori; ?>
                    </h2>

                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">
                    💰
                </div>

                <div>

                    <p>Nilai Produk</p>

                    <h2 class="nilai">

                        Rp
                        <?php

                        echo number_format(
                            $total_nilai,
                            0,
                            ',',
                            '.'
                        );

                        ?>

                    </h2>

                </div>

            </div>


        </div>


        <!-- MENU -->

        <div class="dashboard-menu">


            <div class="menu-card">

                <div class="menu-icon">
                    📦
                </div>

                <div class="menu-content">

                    <h3>Data Produk</h3>

                    <p>

                        Tambah, edit, hapus,
                        dan cari data produk.

                    </p>

                    <a
                        href="barang/index.php"
                        class="dashboard-button">

                        Kelola Data Produk

                    </a>

                </div>

            </div>


            <div class="menu-card">

                <div class="menu-icon">
                    ℹ️
                </div>

                <div class="menu-content">

                    <h3>Informasi Sistem</h3>

                    <p>

                        Aplikasi ini digunakan
                        untuk mengelola data produk
                        secara terkomputerisasi.

                    </p>

                    <span class="status-sistem">

                        ● Sistem Aktif

                    </span>

                </div>

            </div>


        </div>

    </div>

</body>

</html>