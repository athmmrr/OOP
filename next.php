<?php
session_start(); // Pastikan Anda telah memulai sesi

// Periksa apakah pengguna telah login
if (!isset($_SESSION['username'])) {
    // Jika pengguna belum login, arahkan kembali ke halaman login
    header('Location: login.php');
    exit();
}

require_once 'database.php';

$db = new Database();

// Ambil informasi pengguna dari database
$username = $_SESSION['username'];
$query = "SELECT id, username, password FROM tb_login WHERE username = ?";
$stmt = $db->connection->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $id = $row['id'];
    $username = $row['username'];
    $password = $row['password'];
} else {
    // Handle kesalahan jika data pengguna tidak ditemukan
    // Misalnya, tampilkan pesan kesalahan atau arahkan ke halaman lain
    echo "Data pengguna tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Selamat Datang</title>
    <style>
        body {
            background-color: black;
            color: white;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #007bff;
            padding: 20px;
            border-bottom: 3px solid #0056b3;
        }

        header h1 {
            margin: 0;
            color: white;
        }

        .container {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 400px;
            background-color: #f0f0f0;
        }

        p {
            font-size: 18px;
            margin: 10px 0;
            color: grey;
        }

        div {
            margin: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1><b>Selamat Datang!</b></h1>
    </header>
    <div class="container">
        <p>ID: <?php echo $id; ?></p>
        <p>Username: <?php echo $username; ?></p>
        <p>Password: <?php echo $password; ?></p>
    </div>
</body>
</html>
