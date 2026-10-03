<?php

session_start();

if (!isset($_SESSION['username'])) {

    header("Location: ../login/login.php");
    exit;

}

include "../config/koneksi.php";


$id = $_GET['id'] ?? "";


$query = "
    DELETE FROM barang
    WHERE id = :id
";


$stmt = $koneksi->prepare($query);


$stmt->execute([
    ':id' => $id
]);


header("Location: index.php");
exit;

?>