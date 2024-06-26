<?php
// Sambungkan ke database
$connect = new mysqli("localhost", "root", "", "dbkuliner", 3307);

// Periksa koneksi
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Ambil informasi dari permintaan login
$email = $_POST['email'];
$password = $_POST['password'];

// Cari pengguna dengan email yang cocok di database
$query = "SELECT * FROM users WHERE email = '$email'";
$result = $connect->query($query);

if ($result->num_rows > 0) {
    // Jika pengguna ditemukan, periksa kata sandi
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        // Jika kata sandi cocok, kirimkan respons berhasil
        echo json_encode(array("status" => "success", "message" => "Login berhasil"));
    } else {
        // Jika kata sandi tidak cocok, kirimkan respons gagal
        echo json_encode(array("status" => "error", "message" => "Kata sandi salah"));
    }
} else {
    // Jika pengguna tidak ditemukan, kirimkan respons gagal
    echo json_encode(array("status" => "error", "message" => "Email tidak ditemukan"));
}

// Tutup koneksi
$connect->close();
?>
