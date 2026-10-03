<?php

session_start();

if (isset($_SESSION['username'])) {

    header("Location: ../dashboard.php");
    exit;

}

$error = "";

if (isset($_GET['error'])) {

    $error = $_GET['error'];

}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Login - Data Produk</title>

    <link rel="stylesheet" href="../css/style.css">

</head>

<body class="login-page">

    <div class="login-box">

        <h2>Login</h2>

        <div class="judul">
            Aplikasi Data Produk
        </div>

        <?php if ($error != "") { ?>

            <div class="error">

                <?php echo htmlspecialchars($error); ?>

            </div>

        <?php } ?>


        <form action="proses_login.php" method="POST">

            <div class="form-group">

                <label>Username</label>

                <input
                    type="text"
                    name="username"
                    placeholder="Masukkan username"
                    required
                >

            </div>


            <div class="form-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >

            </div>


            <button
                type="submit"
                class="btn-login">

                Login

            </button>

        </form>

    </div>

</body>

</html>