<?php include_once('../_header.php'); ?>

<?php $user_level = $_SESSION['user']['level']; ?>

<div class="container-fluid mt-4">
    <!-- Greeting Card -->
<div class="row mb-4">
    <div class="col-12">

        <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
            <div>
                <h2 class="card-title fw-bold" style="color: #1E3A8A;font-weight: 700;">
                    Selamat Datang, 
                    <span style="background: linear-gradient(90deg, #FBBF24, #F59E0B); -webkit-background-clip: text; color: transparent; font-weight: 700;">
                        <?= $_SESSION['user']['nama_user']; ?>
                    </span>
                </h2>

                <p class="card-text fs-5 d-flex align-items-center" style="color: #374151; font-weight: 700;">
                    <img src="<?= base_url('_assets/image/v987-18a.jpg'); ?>"alt="Logo Yeyen" style="height:30px; margin-right:10px;">
                    Di Sistem Rekam Medis Yeyen
                </p>

                <a href="#menu-toggle" class="btn btn-primary" id="menu-toggle" style="background: linear-gradient(90deg, #4A70A9, #1E3A8A); border: none; color: #fff;">
                    Toggle Menu
                </a>
            </div>
        </div>
            
    </div>
</div>

        <div class="row g-4" style="margin-top: 30px;">

        <div class="col-md-3 col-sm-6">
            <a href="<?= base_url('dashboard'); ?>" style="text-decoration:none;">
                <div class="card shadow-sm border-0 rounded-4 text-center p-3 hover-scale" style="background-color: #4A70A9; color: #fff; cursor:pointer;">
                    <div class="card-body" style="padding: 5px;">
                        <span class="material-icons" style="font-size: 50px;">dashboard</span>
                        <h5 class="card-title mt-3">Dashboard</h5>
                        <p class="card-text">Ringkasan sistem dan statistik</p>
                    </div>
                </div>
            </a>
        </div>

        <?php if($user_level == 2): ?>
            <div class="col-md-3 col-sm-6">
                <a href="<?= base_url('bidan/data.php'); ?>" style="text-decoration:none;">
                    <div class="card shadow-sm border-0 rounded-4 text-center p-3 hover-scale" style="background-color: #28A745; color: #fff; cursor:pointer;">
                        <div class="card-body" style="padding: 5px;">
                            <span class="material-icons" style="font-size: 50px;">person</span>
                            <h5 class="card-title mt-3">Data Bidan</h5>
                            <p class="card-text">Kelola data bidan</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="<?= base_url('poliklinik/data.php'); ?>" style="text-decoration:none;">
                    <div class="card shadow-sm border-0 rounded-4 text-center p-3 hover-scale" style="background-color: #17A2B8; color: #fff; cursor:pointer;">
                        <div class="card-body" style="padding: 5px;">
                            <span class="material-icons" style="font-size: 50px;">apartment</span>
                            <h5 class="card-title mt-3">Data Poliklinik</h5>
                            <p class="card-text">Kelola data poliklinik</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="<?= base_url('obat/data.php'); ?>" style="text-decoration:none;">
                    <div class="card shadow-sm border-0 rounded-4 text-center p-3 hover-scale" style="background-color: #FFC107; color: #fff; cursor:pointer;">
                        <div class="card-body" style="padding: 5px;">
                            <span class="material-icons" style="font-size: 50px;">medication</span>
                            <h5 class="card-title mt-3">Data Obat</h5>
                            <p class="card-text">Kelola data obat</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6" style="margin-top: 20px;">
                <a href="<?= base_url('rekammedis/data.php'); ?>" style="text-decoration:none;">
                    <div class="card shadow-sm border-0 rounded-4 text-center p-3 hover-scale" style="background-color: #6C757D; color: #fff; cursor:pointer;">
                        <div class="card-body" style="padding: 5px;">
                            <span class="material-icons" style="font-size: 50px;">medical_services</span>
                            <h5 class="card-title mt-3">Rekam Medis</h5>
                            <p class="card-text">Lihat rekam medis pasien</p>
                        </div>
                    </div>
                </a>
            </div>

        <?php elseif($user_level == 1): ?>
            <div class="col-md-3 col-sm-6">
                <a href="<?= base_url('pasien/data.php'); ?>" style="text-decoration:none;">
                    <div class="card shadow-sm border-0 rounded-4 text-center p-3 hover-scale" style="background-color: #28A745; color: #fff; cursor:pointer;">
                         <div class="card-body" style="padding: 5px;">
                            <span class="material-icons" style="font-size: 50px;">person</span>
                            <h5 class="card-title mt-3">Data Pasien</h5>
                            <p class="card-text">Kelola data pasien</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="<?= base_url('rekammedis/data.php'); ?>" style="text-decoration:none;">
                    <div class="card shadow-sm border-0 rounded-4 text-center p-3 hover-scale" style="background-color: #FFC107; color: #fff; cursor:pointer;">
                         <div class="card-body" style="padding: 5px;">
                            <span class="material-icons" style="font-size: 50px;">medical_services</span>
                            <h5 class="card-title mt-3">Input Rekam Medis</h5>
                            <p class="card-text">Input & cek rekam medis pasien</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endif; ?>

    </div>
</div>

<style>
.hover-scale {
    transition: transform 0.3s, box-shadow 0.3s;
}
.hover-scale:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

/* Responsive text */
@media (max-width: 768px){
    .card-title {
        font-size: 1.1rem;
    }
    .card-text {
        font-size: 0.9rem;
    }
}
.card {
    border-radius: 15px;
}
</style>

<?php include_once('../_footer.php'); ?>
