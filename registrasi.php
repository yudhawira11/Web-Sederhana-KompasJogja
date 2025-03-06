<?php
  // pendefinisian variable
  $idUserErr = $passwordErr = $namaErr = $emailErr = $roleErr = "";
  $id_user = $password = $nama = $email = $role = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["id_user"])) {
      $idUserErr = "Username harus diisi";
    } else {
      $id_user = test_input($_POST["id_user"]);
    }

    if (empty($_POST["password"])) {
      $passwordErr = "Password harus diisi";
    } else {
      $password = test_input($_POST["password"]);
    }

    if (empty($_POST["nama"])) {
      $namaErr = "Nama Lengkap harus diisi";
    } else {
      $nama = test_input($_POST["nama"]);
    }

    if (empty($_POST["email"])) {
      $emailErr = "Email harus diisi";
    } else {
      $email = test_input($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Email tidak sesuai format";
      }
    }

    if (empty($_POST["role"])) {
      $roleErr = "Role harus dipilih";
    } else {
      $role = test_input($_POST["role"]);
    }

    if (empty($idUserErr) && empty($passwordErr) && empty($namaErr) && empty($emailErr) && empty($roleErr)) {
      include_once("koneksi.php");

      // Sanitasi data sebelum disimpan ke database
      $id_user = mysqli_real_escape_string($con, $id_user);
      $password = md5($_POST['password']); // Hashing password
      $nama = mysqli_real_escape_string($con, $nama);
      $email = mysqli_real_escape_string($con, $email);
      $role = mysqli_real_escape_string($con, $role);

      // Syntax untuk menambahkan data ke table user
      $result = mysqli_query($con, "INSERT INTO user(id_user, password, nama, email, role) 
                                    VALUES ('$id_user', '$password', '$nama', '$email', '$role')");

      if ($result) {
        echo "Data berhasil disimpan. <a href='index.php'>Kembali</a>";
      } else {
        echo "Gagal menyimpan data: " . mysqli_error($con);
      }
      exit();
    }
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi Akun</title>
  <style>
    .error { color: red; font-size: 12px; }
  </style>
</head>
<body>
  <a href='index.php'>Kembali</a>
  <h2>Registrasi Akun</h2>
  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <table>
      <tr>
        <td>Username</td>
        <td>: <input name="id_user" type="text" value="<?php echo htmlspecialchars($id_user); ?>"></td>
      </tr>
      <tr>
        <td></td>
        <td><span class="error"><?php echo $idUserErr; ?></span></td>
      </tr>

      <tr>
        <td>Password</td>
        <td>: <input name="password" type="password"></td>
      </tr>
      <tr>
        <td></td>
        <td><span class="error"><?php echo $passwordErr; ?></span></td>
      </tr>

      <tr>
        <td>Nama Lengkap</td>
        <td>: <input name="nama" type="text" value="<?php echo htmlspecialchars($nama); ?>"></td>
      </tr>
      <tr>
        <td></td>
        <td><span class="error"><?php echo $namaErr; ?></span></td>
      </tr>

      <tr>
        <td>Email</td>
        <td>: <input name="email" type="text" value="<?php echo htmlspecialchars($email); ?>"></td>
      </tr>
      <tr>
        <td></td>
        <td><span class="error"><?php echo $emailErr; ?></span></td>
      </tr>

      <tr>
        <td>Role</td>
        <td>: 
          <select id="role" name="role">
            <option value="">Pilih Role</option>
            <option value="admin" <?php echo ($role === 'admin') ? 'selected' : ''; ?>>admin</option>
            <option value="user" <?php echo ($role === 'user') ? 'selected' : ''; ?>>user</option>
          </select>
        </td>
      </tr>
      <tr>
        <td></td>
        <td><span class="error"><?php echo $roleErr; ?></span></td>
      </tr>

      <tr>
        <td colspan="2"><input type="submit" value="SIMPAN"></td>
      </tr>
    </table>
  </form>
</body>
</html>
