<?php

function bersihkan($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

function validasiNama($nama) {
    if (empty($nama)) return "Nama tidak boleh kosong.";
    if (!preg_match("/^[a-zA-Z\s]+$/", $nama)) return "Nama hanya boleh mengandung huruf dan spasi.";
    return true;
}

function validasiUmur($umur) {
    if (empty($umur)) return "Umur tidak boleh kosong.";
    if (!is_numeric($umur)) return "Umur harus berupa angka.";
    return true;
}

$nim = bersihkan($_POST['nim'] ?? '-');
$nama = bersihkan($_POST['nama'] ?? '-');
$umur = bersihkan($_POST['umur'] ?? '-');
$tempat_lahir = bersihkan($_POST['tempat_lahir'] ?? '-');
$tanggal_lahir = bersihkan($_POST['tanggal_lahir'] ?? '-');
$no_hp = bersihkan($_POST['no_hp'] ?? '-');
$alamat = bersihkan($_POST['alamat'] ?? '-');
$email = bersihkan($_POST['email'] ?? '-');
$kota = bersihkan($_POST['kota'] ?? '-');
$jk = isset($_POST['jk']) ? bersihkan($_POST['jk']) : "-";
$status = isset($_POST['status']) ? bersihkan($_POST['status']) : "-";

$hobi_list = [];
if (!empty($_POST['hobi'])) {
    foreach ($_POST['hobi'] as $h) {
        $hobi_list[] = bersihkan($h);
    }
    $hobi_output = implode(", ", $hobi_list);
} else {
    $hobi_output = "Tidak ada hobi";
}

$cek_nama = validasiNama($nama);
$cek_umur = validasiUmur($umur);

if ($cek_nama !== true) {
    die("<div style='color:red; text-align:center; padding:50px; font-family:sans-serif;'>
            <h3>Gagal: $cek_nama</h3>
            <a href='F_POST.php'>Kembali ke Form</a>
         </div>");
}

if ($cek_umur !== true) {
    die("<div style='color:red; text-align:center; padding:50px; font-family:sans-serif;'>
            <h3>Gagal: $cek_umur</h3>
            <a href='F_POST.php'>Kembali ke Form</a>
         </div>");
}

include 'koneksi.php';

$sql = "INSERT INTO table_mhs (nim, nama, tempatLahir, tanggaLahir, alamat, kota, jenisKelamin, email, noHP, umur, status, hobi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssss", $nim, $nama, $tempat_lahir, $tanggal_lahir, $alamat, $kota, $jk, $email, $no_hp, $umur, $status, $hobi_output);

if ($stmt->execute()) {
} else {
    die("<div style='color:red; text-align:center; padding:50px; font-family:sans-serif;'>
            <h3>Gagal menyimpan data: " . $stmt->error . "</h3>
            <a href='F_POST.php'>Kembali ke Form</a>
         </div>");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Data Mahasiswa</title>
    <style>
        /* --- MODERN PROGRAMMER THEME STYLE --- */
        @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500;600;700&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'JetBrains Mono', 'Courier New', monospace;
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 25%, #16213e 50%, #0f0f23 75%, #1a1a2e 100%);
            background-attachment: fixed;
            color: #e2e8f0;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 177, 153, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(80, 250, 123, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        .container {
            background: linear-gradient(145deg, #1e1e2e, #2a2a3e);
            padding: 40px;
            border-radius: 20px;
            box-shadow:
                0 20px 40px rgba(0,0,0,0.3),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            width: 100%;
            max-width: 700px;
            border: 1px solid rgba(99, 102, 241, 0.2);
            backdrop-filter: blur(10px);
            position: relative;
            animation: slideIn 0.6s ease-out;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #50fa7b, #ffb86c, #bd93f9, #ff79c6);
            border-radius: 20px 20px 0 0;
        }

        h2 {
            text-align: center;
            background: linear-gradient(135deg, #50fa7b, #ffb86c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 700;
            text-shadow: 0 0 20px rgba(80, 250, 123, 0.3);
            letter-spacing: 1px;
        }

        .code-snippet {
            background: linear-gradient(145deg, #0f0f23, #1a1a2e);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            font-size: 14px;
            color: #50fa7b;
            border-left: 4px solid #50fa7b;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }

        .code-snippet::before {
            content: '⚡';
            position: absolute;
            top: 20px;
            right: 20px;
            color: #ffb86c;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background: linear-gradient(145deg, #1e1e2e, #2a2a3e);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid rgba(99, 102, 241, 0.1);
            border-right: 1px solid rgba(68, 71, 90, 0.3);
        }

        th {
            background: linear-gradient(135deg, #2d2d42, #3a3a52);
            color: #50fa7b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85em;
            position: sticky;
            top: 0;
            z-index: 10;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        tr:nth-child(even) {
            background: linear-gradient(145deg, #1a1a2e, #2a2a3e);
        }

        tr:hover {
            background: linear-gradient(145deg, #2d2d42, #3a3a52);
            transform: scale(1.01);
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(80, 250, 123, 0.1);
        }

        td {
            color: #e2e8f0;
            font-size: 0.9em;
            transition: color 0.2s ease;
        }

        tr:hover td {
            color: #f8f8f2;
        }

        /* Styling Kolom Label (Kiri) */
        td:first-child {
            font-weight: 600;
            color: #ffb86c;
            width: 35%;
        }

        /* Styling Kolom Isi (Kanan) */
        td:last-child {
            color: #e2e8f0;
            text-align: left;
        }

        /* Highlight Nama agar menonjol */
        .highlight {
            color: #50fa7b;
            font-weight: 700;
        }

        /* Tombol Kembali */
        .btn-back {
            display: inline-block;
            width: auto;
            text-align: center;
            background: linear-gradient(135deg, #50fa7b, #40e66b);
            color: #0f0f23;
            padding: 16px 32px;
            margin-top: 30px;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-family: 'JetBrains Mono', monospace;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(80, 250, 123, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-back::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-back:hover {
            background: linear-gradient(135deg, #40e66b, #50fa7b);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(80, 250, 123, 0.4);
        }

        .btn-back:hover::before {
            left: 100%;
        }

        .btn-back:active {
            transform: translateY(0);
        }

        /* Animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .container {
                margin: 10px;
                padding: 25px;
                border-radius: 15px;
            }

            h2 {
                font-size: 24px;
                margin-bottom: 20px;
            }

            table {
                font-size: 0.75em;
            }

            th, td {
                padding: 12px 15px;
            }

            .btn-back {
                padding: 14px 28px;
                font-size: 13px;
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #1e1e2e;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #50fa7b, #ffb86c);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #40e66b, #ff9f43);
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Data Terverifikasi ✅</h2>
    
    <table>
        <tr><td>NIM             :</td><td><?= $nim ?></td></tr>
        <tr><td>Nama Lengkap    :</td><td class="highlight"><?= $nama ?></td></tr>
        <tr><td>Umur            :</td><td><?= $umur ?> Tahun</td></tr>
        <tr><td>Tempat Lahir    :</td><td><?= $tempat_lahir ?></td></tr>
        <tr><td>Tanggal Lahir   :</td><td><?= $tanggal_lahir ?></td></tr>
        <tr><td>No. Handphone   :</td><td><?= $no_hp ?></td></tr>
        <tr><td>Alamat          :</td><td><?= $alamat ?></td></tr>
        <tr><td>Kota Domisili   :</td><td><?= $kota ?></td></tr>
        <tr><td>Jenis Kelamin   :</td><td><?= $jk ?></td></tr>
        <tr><td>Status          :</td><td><?= $status ?></td></tr>
        <tr><td>Hobi            :</td><td><?= $hobi_output ?></td></tr>
        <tr><td>Email           :</td><td><?= $email ?></td></tr>
    </table>

    <div style="text-align: center;">
        <a href="F_POST.php" class="btn-back">Input Data Baru</a>
    </div>
</div>

</body>
</html>