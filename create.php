<?php

$connect = new mysqli("localhost", "root", "", "dbkuliner", 3307);

// Periksa koneksi
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$nama_toko = $_POST['nama_toko'];
$alamat = $_POST['alamat'];
$notelp = $_POST['notelp'];
$kesan = $_POST['kesan'];

//menambahkan data ke tabel 'tbkuliner'
$sql = "INSERT INTO tbkuliner (nama_toko, alamat, notelp, kesan) VALUES ('$nama_toko', '$alamat', '$notelp', '$kesan')";

if ($connect->query($sql) === TRUE) {
    //kirimkan respons JSON dengan pesan berhasil
    echo json_encode(array("message" => "Data berhasil ditambahkan"));
} else {
    //kirimkan respons JSON dengan pesan error
    echo json_encode(array("message" => "Error: " . $sql . "<br>" . $connect->error));
}

$connect->close();
