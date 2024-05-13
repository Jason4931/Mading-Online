<?php
session_start();
$nama = $_SESSION['Nama'];
session_destroy();
if(isset($_GET['admin'])) {
    session_start();
    $_SESSION['Nama'] = $nama;
    header('location: ./?menu=admin-dashboard');
} else {
    header('location: ./');
}
?>