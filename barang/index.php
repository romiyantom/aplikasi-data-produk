<?php

session_start();

if (!isset($_SESSION['username'])) {

    header("Location: ../login/login.php");
    exit;

}

include "../config/koneksi.php";


$keyword = "";

if (isset($_GET['keyword'])) {

    $keyword = trim($_GET['keyword']);

}


$query = "
    SELECT *
    FROM barang
    WHERE nama_barang LIKE :keyword1
    OR kategori LIKE :keyword2
    ORDER BY id DESC
";


$stmt = $koneksi->prepare($query);

$search = "%" . $keyword . "%";

$stmt->execute([
    ':keyword1' => $search,
    ':keyword2' => $search
]);


$data_barang = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Data Produk</title>

    <link rel="stylesheet" href="../css/style.css">

</head>

<body>


    <!-- NAVBAR -->

    <div class="navbar">

        <h2>Aplikasi Data Produk</h2>

    </div>


    <div class="container">


        <!-- HEADER -->

        <div class="header">

            <h2>Data Produk</h2>

            <div>

                <a
                    href="tambah.php"
                    class="btn btn-tambah">

                    + Tambah Produk

                </a>


                <a
                    href="../dashboard.php"
                    class="btn btn-dashboard">

                    Dashboard

                </a>

            </div>

        </div>


        <!-- SEARCH -->

        <form
            method="GET"
            class="search-box">

            <input
                type="text"
                name="keyword"
                placeholder="Cari nama atau kategori produk..."
                value="<?php echo htmlspecialchars($keyword); ?>"
            >

            <button type="submit">
                Cari
            </button>

            <a href="index.php">
                Reset
            </a>

        </form>


        <!-- TABLE -->

        <div class="table-box">

            <table>

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Nama Produk</th>

                        <th>Kategori</th>

                        <th>Harga</th>

                        <th>Stok</th>

                        <th>Tanggal Masuk</th>

                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                <?php

                $no = 1;

                if (count($data_barang) > 0) {

                    foreach ($data_barang as $data) {

                ?>

                    <tr>

                        <td>
                            <?php echo $no++; ?>
                        </td>


                        <td>
                            <?php

                            echo htmlspecialchars(
                                $data['nama_barang']
                            );

                            ?>
                        </td>


                        <td>
                            <?php

                            echo htmlspecialchars(
                                $data['kategori']
                            );

                            ?>
                        </td>


                        <td>

                            Rp

                            <?php

                            echo number_format(
                                $data['harga'],
                                0,
                                ',',
                                '.'
                            );

                            ?>

                        </td>


                        <td>
                            <?php echo $data['stok']; ?>
                        </td>


                        <td>

                            <?php

                            if (
                                empty($data['tanggal_masuk']) ||
                                $data['tanggal_masuk'] == "0000-00-00"
                            ) {

                                echo "-";

                            } else {

                                echo date(
                                    'd-m-Y',
                                    strtotime(
                                        $data['tanggal_masuk']
                                    )
                                );

                            }

                            ?>

                        </td>


                        <td class="kolom-aksi">


                            <a
                                href="edit.php?id=<?php echo $data['id']; ?>"
                                class="edit">

                                Edit

                            </a>


                            <a
                                href="hapus.php?id=<?php echo $data['id']; ?>"
                                class="hapus"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">

                                Hapus

                            </a>


                        </td>

                    </tr>

                <?php

                    }

                } else {

                ?>

                    <tr>

                        <td
                            colspan="7"
                            class="tidak-ada">

                            Data produk tidak ditemukan.

                        </td>

                    </tr>

                <?php

                }

                ?>

                </tbody>

            </table>

        </div>


    </div>

</body>

</html>