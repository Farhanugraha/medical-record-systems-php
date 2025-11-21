<?php
require_once "../_config/config.php";

if (isset($_POST['validate'])) {
    $username = trim(mysqli_real_escape_string($con, $_POST['username']));
    $password = sha1(trim(mysqli_real_escape_string($con, $_POST['password'])));

    $query = mysqli_query($con, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password' AND level = 2");
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['validated_admin'] = true;
        $popup = 'success';
    } else {
        $popup = 'failed';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Admin</title>
    <link rel="stylesheet" href="../_assets/css/styleRegister.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="header-left">
                    <img src="../_assets/image/v987-18a.jpg" alt="Logo" class="login-logo">
                    <h2>Validasi Admin</h2>
                </div>
                <p>Masukkan akun admin untuk membuat akun baru</p>
            </div>

            <form action="" method="post" class="login-form">
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" id="username" name="username" required>
                        <label for="username">Username Admin</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" required>
                        <label for="password">Password Admin</label>
                    </div>
                </div>

                <button type="submit" name="validate" class="login-btn">
                    <span class="btn-text">Validasi</span>
                </button>
            </form>

            <div class="signup-link">
                <p><a href="login.php">Kembali ke Login</a></p>
            </div>
        </div>
    </div>

    <!-- ===== POPUP SUCCESS ===== -->
    <?php if (isset($popup) && $popup === 'success'): ?>
        <div class="popup-success active" id="successPopup">
            <div class="popup-box">
                <img src="../_assets/image/v987-18a.jpg" alt="Success">
                <h3>Validasi Berhasil!</h3>
                <p>Anda adalah admin yang sah. Silakan lanjut ke halaman registrasi.</p>
                <button onclick="window.location='register.php'">Lanjutkan</button>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($popup) && $popup === 'failed'): ?>
        <div class="popup-failed active" id="failedPopup">
            <div class="popup-box">
                <img src="../_assets/image/v987-18a.jpg" alt="Failed">
                <h3>Validasi Gagal!</h3>
                <p>Username atau password admin tidak sesuai. Silakan coba lagi.</p>
                <button onclick="window.location='validate_admin.php'">Coba Lagi</button>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>
