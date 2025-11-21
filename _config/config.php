<?php
// setting default timezone
date_default_timezone_set('Asia/Jakarta');
session_start();

include_once "conn.php";

// base_url
function base_url($url = null){
    $base_url = "http://localhost/sistemrekamedis";
    if($url != null){
        return $base_url . "/" . $url;
    } else {
        return $base_url;
    }
}

function tgl_indo($tgl){
    $tanggal = substr($tgl, 8, 2);
    $bulan = substr($tgl, 5, 2);
    $tahun = substr($tgl, 0, 4);
    return $tanggal . "/" . $bulan . "/" . $tahun;
}
?>
