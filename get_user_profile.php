<?php
// Sambungkan ke database
$connect = new mysqli("localhost", "root", "", "dbkuliner", 3307);

// Periksa koneksi
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Ambil user_id dari parameter URL
$user_id = $_GET['user_id'];

// Ambil data pengguna dari database
$query = "SELECT username, email FROM users WHERE id = '$user_id'";
$result = $connect->query($query);

if ($result->num_rows > 0) {
    // Jika pengguna ditemukan, kirimkan data pengguna sebagai respons
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    // Jika pengguna tidak ditemukan, kirimkan respons gagal
    echo json_encode(array("status" => "error", "message" => "Pengguna tidak ditemukan"));
}

// Tutup koneksi
$connect->close();
