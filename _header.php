<?php
require_once "_config/config.php";
require "_assets/libs/vendor/autoload.php";

if (!isset($_SESSION['user'])) {
    echo "<script>window.location='" . base_url('auth/login.php') . "'</script>";
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<!-- JSZip (untuk export Excel) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- pdfmake (untuk export PDF) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Rekam Medis</title>
    <!-- Bootstrap CSS -->
    <link href="<?= base_url(); ?>/_assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/_assets/css/simple-sidebar.css?v=1" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?= base_url(); ?>/_assets/libs/DataTables/datatables.min.css" rel="stylesheet">
    <!-- CKEditor -->
    <script src="<?= base_url(); ?>/_assets/libs/vendor/ckeditor/ckeditor/ckeditor.js"></script>

   <style>
    /* ===== POPUP LOGOUT ===== */
    .popup-overlay {
        position: fixed;
        top:0; left:0;
        width:100%; height:100%;
        background: rgba(0,0,0,0.6);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .popup-box {
        background: #fff;
        padding: 25px 30px;
        border-radius: 10px;
        text-align: center;
        width: 350px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.3);
    }

    .popup-box h3 { margin-bottom: 10px; }
    .popup-box p { margin-bottom: 20px; }

    .popup-box button {
        border: none;
        padding: 8px 20px;
        margin: 0 5px;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-confirm {
        background-color: #e74c3c;
        color: #fff;
    }

    .btn-cancel {
        background-color: #bdc3c7;
        color: #2c3e50;
    }

    .btn-confirm:hover { background-color: #c0392b; }
    .btn-cancel:hover { background-color: #95a5a6; }

    /* ===== SIDEBAR MODERN ===== */
    #sidebar-wrapper {
        background-color: #4A70A9; 
        box-shadow: 2px 0 10px rgba(0,0,0,0.1); 
    }

    #sidebar-wrapper .sidebar-nav {
        position: absolute;
        top: 0;
        width: 250px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    #sidebar-wrapper .sidebar-nav li {
        text-indent: 0;
        line-height: 45px; 
    }

    #sidebar-wrapper .sidebar-nav li a {
        display: block;
        text-decoration: none;
        color: #ffffff; 
        font-size: 16px;
        transition: all 0.3s ease;
        border-radius: 0 20px 20px 0; 
        padding-left: 25px;
    }
    

    #sidebar-wrapper .sidebar-nav li a:hover {
        background: rgba(255,255,255,0.2);
        color: #ffffff;
        text-shadow: 0 1px 2px rgba(0,0,0,0.3);
    }

#sidebar-wrapper .sidebar-nav > .sidebar-brand {
    height: 65px;
    font-size: 50px; 
    line-height: 65px; 
    background-color: rgba(255,255,255,0.1); 
    margin-bottom: 10px;
    border-bottom: 1px solid rgba(255,255,255,0.2);
    border-radius: 0 0 20px 20px;
    text-indent: 0;
    padding: 0;
}

#sidebar-wrapper .sidebar-nav > .sidebar-brand a {
    color: #ffffff;
    font-weight: bold;
    gap: 10px; 
    text-decoration: none;
}

#sidebar-wrapper .sidebar-nav > .sidebar-brand a:hover {
    color: #ffffff;
    background: none;
}

#sidebar-wrapper .sidebar-nav > .sidebar-brand a .sidebar-logo {
    width: 30px;
    height: auto;
}


#sidebar-wrapper .sidebar-nav li:nth-child(even) {
    background-color: rgba(255,255,255,0.05); 
}

#sidebar-wrapper .sidebar-nav li:nth-child(odd) {
    background-color: rgba(0,0,0,0.05); 
}


#sidebar-wrapper .sidebar-nav li a:hover {
    background: rgba(255,255,255,0.2);
    color: #ffffff;
    text-shadow: 0 1px 2px rgba(0,0,0,0.3);
}

/* Brand tetap terlihat */
#sidebar-wrapper .sidebar-nav > .sidebar-brand {
    background-color: rgba(255,255,255,0.1); /* sedikit kontras */
}

#sidebar-wrapper .sidebar-nav li#sidebarLogout a {
    background-color: #e74c3c; /* merah menonjol */
    color: #fff !important;
    font-weight: bold;
    border-radius: 0 30px 0 30px;
    padding-left: 25px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

#sidebar-wrapper .sidebar-nav li#sidebarLogout a:hover {
    background-color: #c0392b;
    text-shadow: 0 1px 2px rgba(0,0,0,0.3);
}

</style>
</head>
<body>
   <div id="wrapper">
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="#">
                    <img src="<?= base_url('_assets/image/v987-18a.jpg'); ?>" alt="Logo" class="sidebar-logo">
                    <span>Sistem Rekam Medis</span>
                </a>
            </li>

            <?php if($user['level'] == 2): // admin ?>
                <li><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li><a href="<?= base_url('pasien/data.php') ?>">Data Pasien</a></li>
                <li><a href="<?= base_url('bidan/data.php') ?>">Data Bidan</a></li>
                <li><a href="<?= base_url('poliklinik/data.php') ?>">Data Poliklinik</a></li>
                <li><a href="<?= base_url('obat/data.php') ?>">Data Obat</a></li>
                <li><a href="<?= base_url('rekammedis/data.php') ?>">Rekam Medis</a></li>
            <?php elseif($user['level'] == 1):?>
                <li><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li><a href="<?= base_url('pasien/data.php') ?>">Data Pasien</a></li>
                <li><a href="<?= base_url('rekammedis/data.php') ?>">Input Rekam Medis</a></li>
            <?php endif; ?>

            <li id="sidebarLogout">
                <a href="#">
                    <span class="material-icons">logout</span>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="popup-overlay" id="confirmLogoutPopup">
        <div class="popup-box">
            <h3>Konfirmasi Logout</h3>
            <p>Apakah Anda yakin ingin keluar dari akun?</p>
            <button class="btn-confirm" id="confirmLogout">Ya, Keluar</button>
            <button class="btn-cancel" id="cancelLogout">Batal</button>
        </div>
    </div>

    <div id="page-content-wrapper">
        <div class="container-fluid">
        <script>
            document.getElementById('sidebarLogout').addEventListener('click', function(e){
                e.preventDefault();
                document.getElementById('confirmLogoutPopup').style.display = 'flex';
            });

            document.getElementById('cancelLogout').addEventListener('click', function(){
                document.getElementById('confirmLogoutPopup').style.display = 'none';
            });

            document.getElementById('confirmLogout').addEventListener('click', function(){
                window.location.href = '<?= base_url("auth/logout.php"); ?>';
            });
        </script>
</body>
