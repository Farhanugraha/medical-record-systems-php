<?php
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'rumahsakit',
    'host' => 'localhost'
);

$con = mysqli_connect(
    $sql_details['host'],
    $sql_details['user'],
    $sql_details['pass'],
    $sql_details['db']
);

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit;
}
?>
