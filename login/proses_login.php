<?php

session_start();

include "../config/koneksi.php";

$username = trim($_POST['username'] ?? "");
$password = $_POST['password'] ?? "";


$query = "SELECT * FROM users
          WHERE username = :username
          AND password = :password";

$stmt = $koneksi->prepare($query);

$stmt->execute([
    ':username' => $username,
    ':password' => $password
]);


$data = $stmt->fetch();


if ($data) {

    $_SESSION['username'] = $data['username'];

    header("Location: ../dashboard.php");
    exit;

} else {

    header(
        "Location: login.php?error=Username atau password salah!"
    );

    exit;

}

?>