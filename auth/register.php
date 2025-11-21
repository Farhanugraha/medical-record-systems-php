

<?php
require_once "../_config/config.php";

if (!isset($_SESSION['validated_admin']) || $_SESSION['validated_admin'] !== true) {
    echo "<script>
            alert('Anda tidak memiliki hak akses! Silakan validasi admin terlebih dahulu.');
            window.location='validate_admin.php';
          </script>";
    exit;
} {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Rekam Medis</title>
    <link rel="stylesheet" href="../_assets/css/styleRegister.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="header-left">
                    <img src="../_assets/image/v987-18a.jpg" alt="Logo" class="login-logo" style="width:40px; height:35px; object-fit:contain;">
                    <h2>Registrasi Pengguna</h2>
                </div>
                <p>Buat akun untuk mengakses sistem</p>
            </div>

            <?php
            if (isset($_POST['register'])) {
                $nama_user = trim(mysqli_real_escape_string($con, $_POST['nama_user']));
                $username = trim(mysqli_real_escape_string($con, $_POST['username']));
                $password = sha1(trim(mysqli_real_escape_string($con, $_POST['password'])));
                $confirm = sha1(trim(mysqli_real_escape_string($con, $_POST['confirm'])));
                $level = trim(mysqli_real_escape_string($con, $_POST['level']));

                $cek_user = mysqli_query($con, "SELECT * FROM tb_user WHERE username = '$username'") or die(mysqli_error($con));
                if (mysqli_num_rows($cek_user) > 0) {
                    echo '<div class="alert alert-danger" style="text-align:center; margin-bottom:15px; color:#fff; background-color:#e74c3c; padding:10px; border-radius:5px;">
                            <strong>Username sudah digunakan!</strong> Silakan pilih username lain.
                          </div>';
                } elseif ($password !== $confirm) {
                    echo '<div class="alert alert-danger" style="text-align:center; margin-bottom:15px; color:#fff; background-color:#e74c3c; padding:10px; border-radius:5px;">
                            <strong>Password tidak cocok!</strong> Silakan periksa kembali.
                          </div>';
                } else {
                    $insert = mysqli_query($con, "INSERT INTO tb_user (nama_user, username, password, level) VALUES ('$nama_user', '$username', '$password', '$level')") or die(mysqli_error($con));
                    if ($insert) {
                        echo "
                        <div class='popup-success active' id='successPopup'>
                            <div class='popup-box'>
                                <img src='../_assets/image/v987-18a.jpg' alt='Success'>
                                <h3>Registrasi Berhasil!</h3>
                                <p>Akun Anda telah dibuat. Silakan login untuk melanjutkan.</p>
                                <button onclick=\"window.location='login.php'\">OK</button>
                            </div>
                        </div>";
                    }
                }
            }
            ?>

            <form class="login-form" action="" method="post" novalidate>
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" id="nama_user" name="nama_user" required>
                        <label for="nama_user">Nama Lengkap</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" id="username" name="username" required>
                        <label for="username">Username</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" required>
                        <label for="password">Password</label>
                        <button type="button" class="password-toggle" id="passwordToggle1" aria-label="Toggle password visibility">
                            <span class="toggle-icon"></span>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="password" id="confirm" name="confirm" required>
                        <label for="confirm">Konfirmasi Password</label>
                        <button type="button" class="password-toggle" id="passwordToggle2" aria-label="Toggle password visibility">
                            <span class="toggle-icon"></span>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                <div class="input-wrapper">
                    <label for="level" style="position: static; display: block; margin-bottom: 5px; font-weight: 500;">
                        Level Pengguna
                    </label>
                    <select name="level" id="level" required>
                        <option value="" disabled selected>Pilih Level</option>
                        <option value="1">Bidan</option>
                        <option value="2">Admin</option>
                    </select>
                </div>
            </div>


                <button type="submit" name="register" class="login-btn">
                    <span class="btn-text">Register</span>
                    <span class="btn-loader"></span>
                </button>
            </form>

            <div class="signup-link">
                <p>Sudah punya akun? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = (inputId, toggleId) => {
            const input = document.getElementById(inputId);
            const toggle = document.getElementById(toggleId);
            const icon = toggle.querySelector('.toggle-icon');
            toggle.addEventListener('click', function() {
                const isPassword = input.getAttribute('type') === 'password';
                input.setAttribute('type', isPassword ? 'text' : 'password');
                icon.classList.toggle('active');
            });
        };
        togglePassword('password', 'passwordToggle1');
        togglePassword('confirm', 'passwordToggle2');
    });
    </script>
</body>
</html>

<?php } ?>
