<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
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
            max-width: 1400px;
            margin: 0 auto;
            background: linear-gradient(145deg, #1e1e2e, #2a2a3e);
            border-radius: 20px;
            box-shadow:
                0 20px 40px rgba(0,0,0,0.3),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.2);
            backdrop-filter: blur(10px);
            overflow: hidden;
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

        h1 {
            background: linear-gradient(145deg, #0f0f23, #1a1a2e);
            color: transparent;
            background-clip: text;
            -webkit-background-clip: text;
            background-image: linear-gradient(135deg, #50fa7b, #ffb86c);
            margin: 0;
            padding: 40px;
            text-align: center;
            font-size: 2.8em;
            font-weight: 700;
            text-shadow: 0 0 20px rgba(80, 250, 123, 0.3);
            letter-spacing: 2px;
            border-bottom: 1px solid rgba(99, 102, 241, 0.2);
            position: relative;
        }

        h1::before {
            content: '📚';
            position: absolute;
            left: 40px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2em;
            color: #e2e8f0;
        }

        .table-container {
            padding: 30px;
            overflow: auto;
            max-height: 70vh;
        }

        .table-container::-webkit-scrollbar {
            width: 12px;
            height: 12px;
        }

        .table-container::-webkit-scrollbar-track {
            background: #1e1e2e;
            border-radius: 10px;
        }

        .table-container::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #50fa7b, #ffb86c);
            border-radius: 10px;
            border: 2px solid #1e1e2e;
        }

        .table-container::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #40e66b, #ff9f43);
        }

        .table-container::-webkit-scrollbar-corner {
            background: #1e1e2e;
        }

        table {
            width: 100%;
            min-width: 1200px;
            border-collapse: collapse;
            margin-top: 20px;
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

        .no-data {
            text-align: center;
            padding: 60px 40px;
            color: #ffb86c;
            font-size: 1.3em;
            background: linear-gradient(145deg, #1a1a2e, #2a2a3e);
            border-radius: 12px;
            margin: 20px 0;
            border: 1px solid rgba(255, 184, 108, 0.2);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .no-data::before {
            content: '📭';
            font-size: 2em;
            display: block;
            margin-bottom: 10px;
        }

        .actions {
            text-align: center;
            padding: 30px;
            background: linear-gradient(145deg, #0f0f23, #1a1a2e);
            border-top: 1px solid rgba(99, 102, 241, 0.2);
        }

        .btn {
            display: inline-block;
            padding: 16px 32px;
            background: linear-gradient(135deg, #50fa7b, #40e66b);
            color: #0f0f23;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-family: 'JetBrains Mono', monospace;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(80, 250, 123, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            font-size: 14px;
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
                margin: 10px;
                border-radius: 15px;
            }

            h1 {
                font-size: 2.2em;
                padding: 25px;
            }

            h1::before {
                left: 20px;
            }

            .table-container {
                padding: 15px;
                max-height: 60vh;
            }

            table {
                font-size: 0.75em;
                min-width: 1000px;
            }

            th, td {
                padding: 10px 12px;
            }

            .no-data {
                padding: 40px 20px;
                font-size: 1.1em;
            }

            .actions {
                padding: 20px;
            }

            .btn {
                padding: 14px 28px;
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
        <h1>Data Mahasiswa</h1>
        <div class="table-container">
            <?php
            include 'koneksi.php';

            $sql = "SELECT * FROM table_mhs";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>NIM</th>";
                echo "<th>Nama</th>";
                echo "<th>Tempat Lahir</th>";
                echo "<th>Tanggal Lahir</th>";
                echo "<th>Alamat</th>";
                echo "<th>Kota</th>";
                echo "<th>Jenis Kelamin</th>";
                echo "<th>Email</th>";
                echo "<th>No HP</th>";
                echo "<th>Umur</th>";
                echo "<th>Status</th>";
                echo "<th>Hobi</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nim"] . "</td>";
                    echo "<td>" . $row["nama"] . "</td>";
                    echo "<td>" . $row["tempatLahir"] . "</td>";
                    echo "<td>" . $row["tanggaLahir"] . "</td>";
                    echo "<td>" . $row["alamat"] . "</td>";
                    echo "<td>" . $row["kota"] . "</td>";
                    echo "<td>" . $row["jenisKelamin"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["noHP"] . "</td>";
                    echo "<td>" . $row["umur"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td>" . $row["hobi"] . "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<div class='no-data'>📭 Belum ada data mahasiswa yang tersimpan.</div>";
            }

            $conn->close();
            ?>
        </div>
        <div class="actions">
            <a href="F_POST.php" class="btn">➕ Tambah Data Mahasiswa</a>
        </div>
    </div>
</body>
</html>
