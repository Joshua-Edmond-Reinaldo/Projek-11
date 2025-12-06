<?php
$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "universitas"; 

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error); 
}
// echo "Koneksi berhasil"; // Hapus atau komentari baris ini saat produksi [7, 10]
?>
