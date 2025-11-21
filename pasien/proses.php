<?php
require_once"../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;

if(isset($_POST['add'])){
    $uuid = Uuid::uuid4()->toString();
    $identitas = trim(mysqli_real_escape_string($con, $_POST['identitas']));
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
    $jk = trim(mysqli_real_escape_string($con, $_POST['jk']));
    $umur = trim(mysqli_real_escape_string($con, $_POST['umur']));
    $alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
    $telp = trim(mysqli_real_escape_string($con, $_POST['telp']));
    $tgl_berobat = trim(mysqli_real_escape_string($con, $_POST['tanggal_berobat']));

    // cek duplikasi identitas
    $sql_cek_identitas = mysqli_query($con, 
        "SELECT * FROM tb_pasien WHERE nomor_identitas='$identitas'"
    ) or die(mysqli_error($con));

    if(mysqli_num_rows($sql_cek_identitas) > 0){
        echo "<script>alert('Nomor identitas sudah pernah diinput!');window.location='add.php';</script>";
    }
    else{
        mysqli_query($con, 
            "INSERT INTO tb_pasien 
            (id_pasien, nomor_identitas, nama_pasien, jenis_kelamin, umur, alamat, no_telp, tanggal_berobat)
            VALUES
            ('$uuid', '$identitas', '$nama', '$jk', '$umur', '$alamat', '$telp', '$tgl_berobat')"
        ) or die(mysqli_error($con));

        echo "<script>alert('Data berhasil ditambahkan');window.location='data.php';</script>";
    }
}

else if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $identitas = trim(mysqli_real_escape_string($con, $_POST['identitas']));
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
    $jk = trim(mysqli_real_escape_string($con, $_POST['jk']));
    $umur = trim(mysqli_real_escape_string($con, $_POST['umur']));
    $alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
    $telp = trim(mysqli_real_escape_string($con, $_POST['telp']));
    $tgl_berobat = trim(mysqli_real_escape_string($con, $_POST['tanggal_berobat']));

    // cek duplikasi identitas (selain dirinya sendiri)
    $sql_cek_identitas = mysqli_query($con, 
        "SELECT * FROM tb_pasien WHERE nomor_identitas='$identitas' AND id_pasien != '$id'"
    ) or die(mysqli_error($con));

    if(mysqli_num_rows($sql_cek_identitas) > 0){
        echo "<script>alert('Nomor identitas sudah pernah diinput!');window.location='edit.php?id=$id';</script>";
    }
    else{
        mysqli_query($con, 
            "UPDATE tb_pasien SET 
                nomor_identitas='$identitas',
                nama_pasien='$nama',
                jenis_kelamin='$jk',
                umur='$umur',
                alamat='$alamat',
                no_telp='$telp',
                tanggal_berobat='$tgl_berobat'
             WHERE id_pasien='$id'"
        ) or die(mysqli_error($con));

        echo "<script>alert('Data berhasil diedit');window.location='data.php';</script>";
    }
}

else if(isset($_POST['import'])){
    $file = $_FILES['file']['name'];
    $ekstensi = explode(".", $file);
    $file_name = "file-".round(microtime(true)).".".end($ekstensi);
    $sumber = $_FILES['file']['tmp_name'];
    $target_dir = "../_file/";
    $target_file = $target_dir.$file_name;
    $upload = move_uploaded_file($sumber, $target_file);

    // Membaca file
    $obj = PHPExcel_IOFactory::load($target_file);
    $all_data = $obj->getActiveSheet()->toArray(null, true, true, true);

    // Memasukkan data ke database
    $sql = "INSERT INTO tb_pasien 
            (id_pasien, nomor_identitas, nama_pasien, jenis_kelamin, umur, alamat, no_telp, tanggal_berobat) 
            VALUES ";

    for ($i=3; $i <=count($all_data); $i++){ 
        $uuid = Uuid::uuid4()->toString();
        $no_id = $all_data[$i]['A'];
        $nama = $all_data[$i]['B'];
        $jk = $all_data[$i]['C'];
        $umur = $all_data[$i]['D'];
        $alamat = $all_data[$i]['E'];
        $telp = $all_data[$i]['F'];
        $tgl_berobat = $all_data[$i]['G'];

        $sql .= "('$uuid', '$no_id', '$nama', '$jk', '$umur', '$alamat', '$telp', '$tgl_berobat'),";
    }

    $sql = substr($sql, 0, -1);

    mysqli_query($con, $sql) or die(mysqli_error($con));

    unlink($target_file);
    echo "<script>alert('Data berhasil diimport');window.location='data.php';</script>";
}
?>
