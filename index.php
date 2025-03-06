<?php
session_start();

if (isset($_SESSION["login"])) {
    if ($_SESSION["role"] === "admin") {
        // Jika peran adalah admin, arahkan ke halaman admin
        header("Location: admin/beranda_admin.php");
        exit;
    } elseif ($_SESSION["role"] === "user") {
        // Jika peran adalah user, arahkan ke halaman user
        header("Location: user/beranda_user.php");
        exit;
    } else {
        // Jika role tidak valid, redirect ke halaman login dengan pesan error
        header("Location: index.php?error=invalid_role");
        exit;
    }
}

require 'koneksi.php';
// Syntax untuk mengambil semua data dari table berita
$result = mysqli_query($con, "select * from berita");
$is_logged_in = isset($_SESSION['login']); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>KompasJogja.com</title>
    <link rel="stylesheet" href="style.css"> <!-- Menyertakan file CSS untuk styling -->
    <script src="script.js" defer></script> <!-- Menyertakan file JavaScript untuk interaktivitas -->

    <!-- Fitur Tambahan Mode gelap -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleThemeButton = document.createElement('button');
        toggleThemeButton.innerText = 'Mode Gelap';
        toggleThemeButton.style.position = 'fixed';
        toggleThemeButton.style.top = '10px';
        toggleThemeButton.style.right = '10px';
        toggleThemeButton.style.zIndex = '1000';
        toggleThemeButton.style.background = '#6a11cb';
        toggleThemeButton.style.color = 'white';
        toggleThemeButton.style.padding = '10px';
        toggleThemeButton.style.border = 'none';
        toggleThemeButton.style.borderRadius = '5px';
        toggleThemeButton.style.cursor = 'pointer';
        document.body.appendChild(toggleThemeButton);
        toggleThemeButton.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            if (document.body.classList.contains('dark-mode')) {
                toggleThemeButton.innerText = 'Mode Terang';
            } else {
                toggleThemeButton.innerText = 'Mode Gelap';
            }
        });
    });
    // CSS untuk Mode Gelap
    const darkModeStyles = `
        .dark-mode {
            background: #121212;
            color: #e0e0e0;
        }
        .dark-mode form,
        .dark-mode table,
        .dark-mode #result,
        .dark-mode footer {
            background: #1e1e1e;
            color: #e0e0e0;
        }
        .dark-mode table th {
            background: #333;
            color: #fff;
        }
        .dark-mode input[type="submit"],
        .dark-mode button {
            background: #333;
            color: white;
        }
        .dark-mode a {
            color: #90caf9;
        }
        .dark-mode a:hover {
            color: #bbdefb;
        }`;
    const styleSheet = document.createElement('style');
    styleSheet.type = 'text/css';
    styleSheet.innerText = darkModeStyles;
    document.head.appendChild(styleSheet);
    </script>

    <!-- CSS untuk tampilan UI -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #333;
            text-align: center;
        }

        h1 {
            color: white;
            margin-bottom: 20px;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: inline-block;
            margin-top: 20px;
        }

        table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background: #6a11cb;
            color: white;
        }

        input[type="text"], input[type="submit"] {
            padding: 10px;
            width: 90%;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"] {
            background: #6a11cb;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #2575fc;
        }

        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background: #6a11cb;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #2575fc;
        }

        #result {
            margin-top: 20px;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: inline-block;
        }

        a {
            text-decoration: none;
            color: #6a11cb;
        }

        a:hover {
            color: #2575fc;
        }

        hr{
            border: 1px solid black;
        }

        table.mycss {
            width: 100%;
        }
        
        .mycss-footer p {
            color:rgb(255, 255, 255);

        }
        
        .mycss-footer p:hover{
            color:rgb(251, 255, 4);
        }
    </style>
</head>
<body>
    <h1>Halaman Login</h1>

    <form method=post action=cek_login.php>
        <table class="mycss">
            <tr>
                <td>Username</td>
                <td> : <input name='id_user' type='text'></td>
            </tr>

            <tr>
                <td>Password</td>
                <td> : <input name='password' type='text'></td>
            </tr>

            <tr>
                <td>Captcha<br><img src='captcha.php' /></td>
                <td> : <input name='captcha_code' type='text'></td>
            </tr>
            
            <tr>
                <td colspan=><input type='submit' value='LOGIN'></td>
                <td><a href="registrasi.php">Registrasi</a></td>
            </tr>
        </table>
    </form><br><br>

    <h1>Pencarian Berita</h1>
    <form id="searchForm">
        <!-- Form untuk mencari berita -->
        <input type="text" id="searchInput" placeholder="Cari berita..." />
        <button type="submit">Cari</button>
    </form>
    <div id="result"></div> <!-- Tempat untuk menampilkan hasil pencarian -->
    <hr>

    <table width='100%' border=1>
        <tr>
            <th>ID Berita</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Lokasi</th>
            <th>Penulis</th>
            <th>Waktu</th>
            <th>-</th>
        </tr>

        <?php
        while ($user_data = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $user_data['id_berita'] . "</td>";
            echo "<td>" . $user_data['judul'] . "</td>";
            echo "<td>" . $user_data['deskripsi'] . "</td>";
            echo "<td>" . "</td>";
            echo "<td>" . "</td>";
            echo "<td>" . "</td>";
            if ($is_logged_in) {
                echo "<td><a href='index.php?id={$user_data['id_berita']}'>Baca Berita</a></td>";
            } else {
                echo "<td><a href='#' onclick='alertLogin()'>Baca Selengkapnya</a></td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <!-- Fitur Tambahan jam digital -->
    <div id="clock" style="font-size: 20px; color: white; margin: 10px;"></div>
    <script>
    setInterval(() => {
        const now = new Date();
        const timeString = now.toLocaleTimeString();
        document.getElementById('clock').innerText = `Waktu Saat Ini: ${timeString}`;
    }, 1000);
    </script><br>

    <footer class="mycss-footer">
        <p>copyright &copy; Yudha Wira Dharma || 2200018073</a>
    </footer>

    <script>
    // Fungsi untuk menampilkan pesan alert
    function alertLogin() {
        alert('Anda harus login terlebih dahulu untuk membaca berita.');
    }
    </script>

    <!-- Fitur Tambahan Notifikasi KompasJogja -->
    <div id="toast" style="visibility: hidden; position: fixed; bottom: 10%; right: 5%; background: #6a11cb; color: white; padding: 10px 20px; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        Notifikasi!
    </div>
    <script>
    function showToast(message) {
        const toast = document.getElementById('toast');
        toast.innerText = message;
        toast.style.visibility = 'visible';
        setTimeout(() => {
            toast.style.visibility = 'hidden';
        }, 3000);
    }
    // pemanggilan:
    showToast('Selamat datang di KompasJogja.com!');
    </script>

</body>
</html>