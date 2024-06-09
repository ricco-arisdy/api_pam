<?php
// Sambungkan ke database
$connect = new mysqli("localhost", "root", "", "dbkuliner", 3307);

// Periksa koneksi
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Ambil informasi dari permintaan register
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password']; // Disarankan untuk melakukan hashing pada kata sandi

// Periksa apakah email sudah digunakan
$query = "SELECT * FROM users WHERE email = '$email'";
$result = $connect->query($query);

if ($result->num_rows > 0) {
    // Jika email sudah digunakan, kirimkan respons gagal
    echo json_encode(array("status" => "error", "message" => "Email sudah terdaftar"));
} else {
    // Jika email belum digunakan, tambahkan pengguna ke database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash kata sandi
    $insertQuery = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
    if ($connect->query($insertQuery) === TRUE) {
        // Jika registrasi berhasil, kirimkan respons berhasil
        echo json_encode(array("status" => "success", "message" => "Registrasi berhasil"));
    } else {
        // Jika terjadi kesalahan saat registrasi, kirimkan respons gagal
        echo json_encode(array("status" => "error", "message" => "Registrasi gagal"));
    }
}

// Tutup koneksi
$connect->close();
