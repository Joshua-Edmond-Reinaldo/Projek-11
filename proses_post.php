<?php
function bersihkan($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

function validasiNama($nama) {
    if (empty($nama)) return "Nama tidak boleh kosong.";
    if (!preg_match("/^[a-zA-Z\s]+$/", $nama)) return "Nama hanya boleh huruf.";
    return true;
}

function validasiUmur($umur) {
    if (empty($umur)) return "Umur tidak boleh kosong.";
    if (!is_numeric($umur)) return "Umur harus angka.";
    return true;
}

function validasiNim($nim) {
    if (empty($nim)) return "NIM tidak boleh kosong.";
    if (!preg_match("/^[0-9]{14}$/", $nim)) return "NIM harus berupa angka dan panjang 14 digit.";
    return true;
}

function validasiTempatLahir($tempat_lahir) {
    if (empty($tempat_lahir)) return "Tempat Lahir tidak boleh kosong.";
    if (!preg_match("/^[a-zA-Z\s]+$/", $tempat_lahir)) return "Tempat Lahir hanya boleh huruf.";
    return true;
}

function validasiTanggalLahir($tanggal_lahir) {
    if (empty($tanggal_lahir)) return "Tanggal Lahir tidak boleh kosong.";
    $date = DateTime::createFromFormat('Y-m-d', $tanggal_lahir);
    if (!$date || $date->format('Y-m-d') !== $tanggal_lahir) return "Tanggal Lahir tidak valid.";
    $today = new DateTime();
    if ($date > $today) return "Tanggal Lahir tidak boleh di masa depan.";
    return true;
}

function validasiNoHp($no_hp) {
    if (empty($no_hp)) return "No HP tidak boleh kosong.";
    if (!preg_match("/^08[0-9]{8,11}$/", $no_hp)) return "No HP harus dimulai dengan 08 dan berupa angka dengan panjang 10-13 digit.";
    return true;
}

function validasiEmail($email) {
    if (empty($email)) return "Email tidak boleh kosong.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return "Email tidak valid.";
    if (!preg_match("/\.com$/", $email)) return "Email harus berakhiran .com";
    return true;
}

function validasiKota($kota) {
    $allowed_kota = ['Semarang', 'Solo', 'Brebes', 'Kudus', 'Demak', 'Salatiga'];
    if (empty($kota) || !in_array($kota, $allowed_kota)) return "Kota tidak valid.";
    return true;
}

function validasiJk($jk) {
    $allowed_jk = ['Laki - Laki', 'Perempuan'];
    if (empty($jk) || !in_array($jk, $allowed_jk)) return "Jenis Kelamin tidak valid.";
    return true;
}

function validasiStatus($status) {
    $allowed_status = ['Kawin', 'Belum Kawin'];
    if (empty($status) || !in_array($status, $allowed_status)) return "Status tidak valid.";
    return true;
}

function validasiHobi($hobi) {
    if (empty($hobi)) return "Hobi tidak boleh kosong.";
    $allowed_hobi = ['Membaca', 'Olahraga', 'Musik', 'Traveling'];
    foreach ($hobi as $h) {
        if (!in_array($h, $allowed_hobi)) return "Hobi tidak valid.";
    }
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
$jk = isset($_POST['jk']) ? bersihkan($_POST['jk']) : "Belum dipilih";
$status = isset($_POST['status']) ? bersihkan($_POST['status']) : "Belum dipilih";

$hobi_list = [];
if (!empty($_POST['hobi'])) {
    foreach ($_POST['hobi'] as $h) {
        $hobi_list[] = bersihkan($h);
    }
    $hobi_output = implode(", ", $hobi_list);
} else {
    $hobi_output = "Tidak ada hobi";
}

$cek_nim = validasiNim($nim);
$cek_nama = validasiNama($nama);
$cek_umur = validasiUmur($umur);
$cek_tempat_lahir = validasiTempatLahir($tempat_lahir);
$cek_tanggal_lahir = validasiTanggalLahir($tanggal_lahir);
$cek_no_hp = validasiNoHp($no_hp);
$cek_email = validasiEmail($email);
$cek_kota = validasiKota($kota);
$cek_jk = validasiJk($jk);
$cek_status = validasiStatus($status);
$cek_hobi = validasiHobi($_POST['hobi'] ?? []);

if ($cek_nim !== true) die("<h3 style='color:red; text-align:center;'>Error: $cek_nim <br><a href='F_POST.php'>Kembali</a></h3>");
if ($cek_nama !== true) die("<h3 style='color:red; text-align:center;'>Error: $cek_nama <br><a href='F_POST.php'>Kembali</a></h3>");
if ($cek_umur !== true) die("<h3 style='color:red; text-align:center;'>Error: $cek_umur <br><a href='F_POST.php'>Kembali</a></h3>");
if ($cek_tempat_lahir !== true) die("<h3 style='color:red; text-align:center;'>Error: $cek_tempat_lahir <br><a href='F_POST.php'>Kembali</a></h3>");
if ($cek_tanggal_lahir !== true) die("<h3 style='color:red; text-align:center;'>Error: $cek_tanggal_lahir <br><a href='F_POST.php'>Kembali</a></h3>");
if ($cek_no_hp !== true) die("<h3 style='color:red; text-align:center;'>Error: $cek_no_hp <br><a href='F_POST.php'>Kembali</a></h3>");
if ($cek_email !== true) die("<h3 style='color:red; text-align:center;'>Error: $cek_email <br><a href='F_POST.php'>Kembali</a></h3>");
if ($cek_kota !== true) die("<h3 style='color:red; text-align:center;'>Error: $cek_kota <br><a href='F_POST.php'>Kembali</a></h3>");
if ($cek_jk !== true) die("<h3 style='color:red; text-align:center;'>Error: $cek_jk <br><a href='F_POST.php'>Kembali</a></h3>");
if ($cek_status !== true) die("<h3 style='color:red; text-align:center;'>Error: $cek_status <br><a href='F_POST.php'>Kembali</a></h3>");
if ($cek_hobi !== true) die("<h3 style='color:red; text-align:center;'>Error: $cek_hobi <br><a href='F_POST.php'>Kembali</a></h3>");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Data POST</title>
    <style>
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
            max-width: 900px;
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

        .code-block {
            background: linear-gradient(145deg, #0f0f23, #1a1a2e);
            padding: 25px;
            border-radius: 12px;
            border-left: 4px solid #50fa7b;
            font-size: 14px;
            line-height: 1.7;
            overflow-x: auto;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .code-block::before {
            content: '⚡';
            position: absolute;
            top: 20px;
            right: 20px;
            color: #ffb86c;
            font-size: 16px;
        }

        .code-line {
            margin: 8px 0;
        }

        .keyword {
            color: #ff79c6;
            font-weight: 600;
        }

        .string {
            color: #f1fa8c;
        }

        .comment {
            color: #6272a4;
            font-style: italic;
        }

        .btn {
            display: inline-block;
            margin-top: 30px;
            padding: 16px 32px;
            background: linear-gradient(135deg, #50fa7b, #40e66b);
            color: #0f0f23;
            text-decoration: none;
            border-radius: 12px;
            font-family: 'JetBrains Mono', monospace;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(80, 250, 123, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover {
            background: linear-gradient(135deg, #40e66b, #50fa7b);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(80, 250, 123, 0.4);
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:active {
            transform: translateY(0);
        }

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

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 25px;
                margin: 10px;
                border-radius: 15px;
            }

            h2 {
                font-size: 24px;
                margin-bottom: 20px;
            }

            .code-block {
                padding: 20px;
                font-size: 13px;
            }
        }

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
    <h2>Data yang Dikirim (POST)</h2>
        <div class="code-block">
            <div class="code-line"><span class="keyword">const</span> data = {</div>
        <?php
            echo "<div class=\"code-line\">    nim: <span class=\"string\">\"$nim\"</span>,</div>";
            echo "<div class=\"code-line\">    nama: <span class=\"string\">\"$nama\"</span>,</div>";
            echo "<div class=\"code-line\">    umur: <span class=\"string\">\"$umur\"</span>,</div>";
            echo "<div class=\"code-line\">    tempat_lahir: <span class=\"string\">\"$tempat_lahir\"</span>,</div>";
            echo "<div class=\"code-line\">    tanggal_lahir: <span class=\"string\">\"$tanggal_lahir\"</span>,</div>";
            echo "<div class=\"code-line\">    no_hp: <span class=\"string\">\"$no_hp\"</span>,</div>";
            echo "<div class=\"code-line\">    alamat: <span class=\"string\">\"$alamat\"</span>,</div>";
            echo "<div class=\"code-line\">    kota: <span class=\"string\">\"$kota\"</span>,</div>";
            echo "<div class=\"code-line\">    jenis_kelamin: <span class=\"string\">\"$jk\"</span>,</div>";
            echo "<div class=\"code-line\">    status: <span class=\"string\">\"$status\"</span>,</div>";
            echo "<div class=\"code-line\">    hobi: <span class=\"string\">\"$hobi_output\"</span>,</div>";
            echo "<div class=\"code-line\">    email: <span class=\"string\">\"$email\"</span></div>";
        ?>
        <div class="code-line">};</div>
    </div>
    <a href="F_POST.php" class="btn">Kembali ke Form</a>
</div>

</body>
</html>