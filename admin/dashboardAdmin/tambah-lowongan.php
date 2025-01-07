<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin</title>
        <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styleDashboard.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>

    <body class="sb-nav-fixed">
        <?php include "headerAdmin.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                <div class="container-fluid px-4">  
                    <h1>View Lowongan</h1>
                    <ol class="breadcrumb mb-4">
                    </ol>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <a class="btn btn-primary btn-sm" href="dashboard.php">Kembali ke dashboard</a>
                    </div> 
                    <br>
                        <div class="card mb-4" >
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                View Lowongan
                            </div>
							<div class="card-body">
	                       <form action="" method="post" autocomplete="" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama lowongan</label>
		<input type="text" name="nama" class="form-control" placeholder="Input Nama...">
	</div>

	<div class="form-group">
		<label>Kategori lowongan</label>
		<input type="text" name="kategori" class="form-control" placeholder="Input kategori...">
	</div>

	<div class="form-group">
		<label>Waktu lowongan</label>
		<input type="text" name="waktu" class="form-control" placeholder="Input waktu...">
	</div>

	<div class="form-group">
		<label>Alamat lowongan</label>
		<input type="text" name="alamat" class="form-control" placeholder="Input alamat...">
	</div>

	<div class="form-group">
		<label>Quota lowongan</label>
		<input type="number" name="quota" class="form-control" placeholder="Input quota...">
	</div>

	<div class="form-group">
		<label>Gaji</label>
		<input type="text" name="gaji" class="form-control" placeholder="Input gaji...">
	</div>


	<div class="form-group">
		<label>Gambar</label>
		<input type="file" name="gambar" class="form-control" placeholder="Masukan Gambar..." required="">
	</div>

	<div class="form-group">
		<textarea name="deskripsi" placeholder="deskripsi lowongan..." class="form-control"></textarea>
	</div>

	<div class="form-group">
		<button class="btn btn-primary" name="submit">Submit</button>
	</div>
                        </div>
                        </div>
                    </div>
                </main>
                <?php include "footerAdmin.php"; ?>
            </div>
        </div>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </body>
</html>








<?php 
if(isset($_POST['submit'])){
	//koneksi
    
    include '../koneksi.php';
	include "upload.php";
	//Ambil data
	$nama = htmlspecialchars($_POST['nama']);
	$kategori = htmlspecialchars($_POST['kategori']);
	$waktu = htmlspecialchars($_POST['waktu']);
	$alamat = htmlspecialchars($_POST['alamat']);
	$deskripsi = htmlspecialchars($_POST['deskripsi']);
	$quota = htmlspecialchars($_POST['quota']);
	$gaji = htmlspecialchars($_POST['gaji']);
	$gambar = upload();
	

	
	
	//query data
	$queryn = $conn->query("INSERT INTO lowongan VALUES('', '$nama', '$kategori','$waktu', '$alamat', '$quota', '$deskripsi', '$gambar', '$gaji') ");
	//header
	if(!$query){
 		die(mysqli_error($conn));
 	}else{
 		echo ' . ?>
        <script type="text/javascript">
          swal({
              title: "Berhasil!",
              text: "lowongan Berhasil Di tambahkan",
              icon: "success",
              button: "Oke!",
            });

        </script>
      <?php '  ;
 	}
}

 ?>