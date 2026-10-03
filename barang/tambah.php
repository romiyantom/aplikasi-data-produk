<?php

session_start();

if (!isset($_SESSION['username'])) {

    header("Location: ../login/login.php");
    exit;

}

include "../config/koneksi.php";


if (isset($_POST['simpan'])) {


    $nama_barang = trim($_POST['nama_barang']);
    $kategori = trim($_POST['kategori']);
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $tanggal_masuk = date('Y-m-d');


    $query = "
        INSERT INTO barang
        (
            nama_barang,
            kategori,
            harga,
            stok,
            tanggal_masuk
        )
        VALUES
        (
            :nama_barang,
            :kategori,
            :harga,
            :stok,
            :tanggal_masuk
        )
    ";


    $stmt = $koneksi->prepare($query);


    $stmt->execute([

        ':nama_barang' => $nama_barang,

        ':kategori' => $kategori,

        ':harga' => $harga,

        ':stok' => $stok,

        ':tanggal_masuk' => $tanggal_masuk

    ]);


    header("Location: index.php");
    exit;

}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Tambah Produk</title>

    <link rel="stylesheet" href="../css/style.css">

</head>

<body>


    <div class="navbar">

        <h2>Aplikasi Data Produk</h2>

    </div>


    <div class="container">

        <div class="form-box">

            <h2>Tambah Produk</h2>


            <form method="POST">


                <div class="form-group">

                    <label>Nama Produk</label>

                    <input
                        type="text"
                        name="nama_barang"
                        placeholder="Masukkan nama produk"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Kategori</label>

                    <input
                        type="text"
                        name="kategori"
                        placeholder="Masukkan kategori"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Harga</label>

                    <input
                        type="number"
                        name="harga"
                        placeholder="Masukkan harga"
                        min="0"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Stok</label>

                    <input
                        type="number"
                        name="stok"
                        placeholder="Masukkan stok"
                        min="0"
                        required
                    >

                </div>


                <button
                    type="submit"
                    name="simpan"
                    class="btn btn-simpan">

                    Simpan

                </button>


                <a
                    href="index.php"
                    class="btn btn-kembali">

                    Kembali

                </a>


            </form>

        </div>

    </div>

</body>

</html>