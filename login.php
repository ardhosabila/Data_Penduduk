<?php
// Mulai session untuk menyimpan informasi login
session_start();
include('koneksi.php');

// Cek apakah pengguna sudah login, jika sudah login, arahkan ke halaman utama
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Proses login ketika form disubmit
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa apakah username dan password cocok
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Simpan data pengguna ke dalam session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Arahkan ke halaman utama setelah login berhasil
        header('Location: index.php');
        exit();
    } else {
        // Jika login gagal, tampilkan pesan error
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container small-container">
        <h1>Log in</h1>

        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="login">Login</button>
        </form>

        <div class="links">
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a>.</p>
        </div>
    </div>
</body>
</html>
