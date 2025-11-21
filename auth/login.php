<?php
require_once "../_config/config.php";

if (isset($_SESSION['user'])) {
    echo "<script>window.location='" . base_url() . "'</script>";
    exit;
}

$popup = ''; 

if (isset($_POST['login'])) {
    $user = trim(mysqli_real_escape_string($con, $_POST['user']));
    $pass = sha1(trim(mysqli_real_escape_string($con, $_POST['pass'])));

    $sql_login = mysqli_query($con, "SELECT * FROM tb_user WHERE username = '$user' AND password = '$pass'") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_login) > 0) {
        $row = mysqli_fetch_assoc($sql_login); 
        $_SESSION['user'] = [
            'id_user'   => $row['id_user'],
            'nama_user' => $row['nama_user'],
            'username'  => $row['username'],
            'level'     => $row['level'] 
        ];
        $popup = 'success';
    } else {
        $popup = 'failed';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Rekam Medis</title>
    <link rel="stylesheet" href="../_assets/css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="header-left">
                    <img src="../_assets/image/v987-18a.jpg" alt="Logo" class="login-logo" style="width:40px; height:35px; object-fit:contain;">
                    <h2>Sistem Rekam Medis</h2>
                </div>
                <p>Masukkan kredensial Anda untuk melanjutkan</p>
            </div>

            <form class="login-form" action="" method="post" novalidate>
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" id="user" name="user" required autocomplete="username" autofocus>
                        <label for="user">Username</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="password" id="pass" name="pass" required autocomplete="current-password">
                        <label for="pass">Password</label>
                        <button type="button" class="password-toggle" id="passwordToggle" aria-label="Toggle password visibility">
                            <span class="toggle-icon"></span>
                        </button>
                    </div>
                </div>

                <button type="submit" name="login" class="login-btn">
                    <span class="btn-text">Login</span>
                </button>
            </form>

            <div class="signup-link">
                <p>Belum punya akun? <a href="validate_admin.php">Buat Akun</a></p>
            </div>
        </div>
    </div>

    <?php if ($popup === 'success'): ?>
        <div class="popup-success active" id="successPopup">
            <div class="popup-box">
                <img src="../_assets/image/v987-18a.jpg" alt="Success">
                <h3>Login Berhasil!</h3>
                <p>Selamat datang di Sistem Rekam Medis.</p>
                <button onclick="window.location='<?php echo base_url(); ?>'">OK</button>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($popup === 'failed'): ?>
        <div class="popup-failed active" id="failedPopup">
            <div class="popup-box">
                <img src="../_assets/image/v987-18a.jpg" alt="Failed">
                <h3>Login Gagal!</h3>
                <p>Username atau password salah. Silakan coba lagi.</p>
                <button onclick="window.location='login.php'">Coba Lagi</button>
            </div>
        </div>
    <?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('pass');
            const toggleButton = document.getElementById('passwordToggle');
            const toggleIcon = toggleButton.querySelector('.toggle-icon');

            toggleButton.addEventListener('click', function() {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                toggleIcon.classList.toggle('active');
            });
        });
    </script>
</body>
</html>
