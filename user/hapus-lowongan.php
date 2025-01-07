<?php 
//koneksi
include "../conn.php" ;
//ambil id url
$id_lowongan = $_GET['id'];
//query data
$query = $conn->query("DELETE FROM lowongan WHERE id_lowongan ='$id_lowongan' ");
//header
header("Location:halaman-admin.php");
 ?>