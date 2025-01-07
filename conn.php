<?php 
	$host = "localhost";
	$username = "root";
	$password = "";
	$database = "blue_inovation2";
	
	$conn = mysqli_connect($host, $username, $password); // mysql -h localhost -u root
	
	mysqli_select_db($conn, $database) or die ("database tidak ditemukan"); //koneksi database USE db_training
	
	// echo "koneksi berhasil";
 ?>