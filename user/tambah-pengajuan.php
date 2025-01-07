<?php 
include "../conn.php" ;
session_start();
//Semua data id_lowongan
$id = $_GET["id"];
$lowongan = $conn->query("SELECT a.id_pengajuan, a.id_lowongan,a.id_user, b.quota ,c.nama,c.status_role FROM pengajuan a,lowongan b, user c WHERE a.id_lowongan=b.id_lowongan AND a.id_user=c.id_user AND a.id_lowongan = '$id' and c.status_role = 'proses'");
$data = $lowongan->fetch_array();
$quota = $data['quota'];
$jml_proses =  mysqli_num_rows($lowongan);
// else if($jml_proses >= $quota){
// 	echo "<script>
// 		alert('Maap, Kuota Sudah Penuh');
// 		document.location.href='halaman-utama.php';
// 	</script>";
// 	return false;
// }
// while($data = $lowongan->fetch_array()){
// 	echo $data['id_pengajuan']."<br>";
// }
//hard
//id_user
$id_user = $_SESSION['data-user'];

//Jika user sudah mengklik lowongan return false
//NOTE JIKA USER YANG DI PAKAI YA ID_USER
$query = $conn->query("SELECT * FROM pengajuan where id_user= '$id_user'");
$data = $query->fetch_array();
$biodata = $conn->query("SELECT * FROM biodata where id_user = '$id_user'");
$biodata_query = $biodata->fetch_array();
$status = $conn->query("SELECT * FROM user where id_user = '$id_user'");
$status_query = $status->fetch_array();

if(!$query){
	die(mysqli_error($conn));
//Jika di table biodata coloumn id_user ga ada session id user / belum mengisi biodata maka ga bisa tambah pengajuan
}else if(!$biodata_query){
	echo "<script>
		alert('Maap, Anda belum mengisi biodata');
		document.location.href= 'test_halaman_utama.php';
	</script>";

	return false;
//Jika jumblah Proses sudah melebihi quota return false
} else if($status_query ['status_role'] === 'seleksi_berkas'){
	echo "<script>
		alert('Maap, Anda Sudah Mengajukan Data!');
		document.location.href= 'test_halaman_utama.php';
	</script>";

	return false;
//Jika jumblah Proses sudah melebihi quota return false
} else{
	echo "<script>
		alert('Pengajuan Mu Berhasil');
		document.location.href= 'test_halaman_utama.php';
	</script>";
}
//INSERT Relasi $id = id lowongan, $id_user = id user
$query = mysqli_query($conn, "INSERT INTO pengajuan (id_lowongan, id_user) VALUES ('$id', '$id_user')");
?>
