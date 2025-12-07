<!DOCTYPE html>
<html>
<head>
    <title>Hasil Input GET</title>
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
        <h2>Data yang Dikirim dengan Metode GET</h2>
        <div class="code-block">
            <div class="code-line"><span class="comment">// GET Request Data</span></div>
            <div class="code-line"><span class="keyword">const</span> data = {</div>
            <?php
                $nim = $_GET['nim'] ?? '-';
                $nama = $_GET['nama'] ?? '-';
                $umur = $_GET['umur'] ?? '-';
                $tempat_lahir = $_GET['tempat_lahir'] ?? '-';
                $tanggal_lahir = $_GET['tanggal_lahir'] ?? '-';
                $no_hp = $_GET['no_hp'] ?? '-';
                $alamat = $_GET['alamat'] ?? '-';
                $kota = $_GET['kota'] ?? '-';
                $jk = isset($_GET['jk']) ? $_GET['jk'] : "Belum dipilih";
                $status = isset($_GET['status']) ? $_GET['status'] : "Belum dipilih";

                $hobi_list = [];
                if (!empty($_GET['hobi'])) {
                    foreach ($_GET['hobi'] as $h) {
                        $hobi_list[] = $h;
                    }
                    $hobi_output = implode(", ", $hobi_list);
                } else {
                    $hobi_output = "Tidak ada hobi";
                }

                $email = $_GET['email'] ?? '-';

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
        <a href="F_GET.php" class="btn">Kembali ke Form</a>
    </div>
</body>
</html>
