<?php

session_start();

if (!isset($_SESSION['username'])) {

    header("Location: ../login/login.php");
    exit;

}

include "../config/koneksi.php";


$id = $_GET['id'] ?? "";


/* Ambil data berdasarkan ID */

$query = "
    SELECT *
    FROM barang
    WHERE id = :id
";


$stmt = $koneksi->prepare($query);

$stmt->execute([
    ':id' => $id
]);


$data = $stmt->fetch();


if (!$data) {

    die("Data produk tidak ditemukan.");

}


/* Proses update */

if (isset($_POST['update'])) {


    $nama_barang = trim($_POST['nama_barang']);
    $kategori = trim($_POST['kategori']);
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];


    $query_update = "
        UPDATE barang
        SET
            nama_barang = :nama_barang,
            kategori = :kategori,
            harga = :harga,
            stok = :stok
        WHERE id = :id
    ";


    $stmt_update = $koneksi->prepare(
        $query_update
    );


    $stmt_update->execute([

        ':nama_barang' => $nama_barang,

        ':kategori' => $kategori,

        ':harga' => $harga,

        ':stok' => $stok,

        ':id' => $id

    ]);


    header("Location: index.php");
    exit;

}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Edit Produk</title>

    <link rel="stylesheet" href="../css/style.css">

</head>

<body>


    <div class="navbar">

        <h2>Aplikasi Data Produk</h2>

    </div>


    <div class="container">

        <div class="form-box">

            <h2>Edit Produk</h2>


            <form method="POST">


                <div class="form-group">

                    <label>Nama Produk</label>

                    <input
                        type="text"
                        name="nama_barang"
                        value="<?php echo htmlspecialchars($data['nama_barang']); ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Kategori</label>

                    <input
                        type="text"
                        name="kategori"
                        value="<?php echo htmlspecialchars($data['kategori']); ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Harga</label>

                    <input
                        type="number"
                        name="harga"
                        value="<?php echo $data['harga']; ?>"
                        min="0"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Stok</label>

                    <input
                        type="number"
                        name="stok"
                        value="<?php echo $data['stok']; ?>"
                        min="0"
                        required
                    >

                </div>


                <button
                    type="submit"
                    name="update"
                    class="btn btn-update">

                    Update

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