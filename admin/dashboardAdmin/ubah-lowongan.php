<?php 
 
    include "../koneksi.php";
 $id = $_GET['id'];
 $query = $conn->query("SELECT * FROM lowongan WHERE id_lowongan ='$id' ");
 $data = $query->fetch_array();

 ?>

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
	                        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
		<div class="form-group">
			<label>Nama lowongan</label>
			<input type="hidden" name="GambarLama" value="<?php echo $data['img']; ?> ">
			<input type="text" name="nama" class="form-control"  value="<?php echo $data['nama_lowongan']; ?> ">
		</div>

		<div class="form-group">
			<label>Kategori lowongan</label>
			<input type="text" name="kategori" class="form-control" value="<?php echo $data['kategori_lowongan']; ?> ">
		</div>

		<div class="form-group">
			<label>Waktu lowongan</label>
			<input type="text" name="waktu" class="form-control" value="<?php echo $data['waktu_lowongan']; ?> ">
		</div>

		<div class="form-group">
			<label>Alamat</label>
			<input type="text" name="alamat" class="form-control" value="<?php echo $data['alamat']; ?> ">
		</div>
		<div class="form-group">
			<label>Deskripsi</label>
			<input type="text" name="deskripsi" class="form-control" value="<?php echo $data['deskripsi']; ?> ">
		</div>

		<div class="form-group">
			<label>Gambar</label>
			<input type="file" name="gambar" class="form-control" >
		</div>

		<div class="form-group">
			<label>Quota</label>
			<input type="text" name="quota" value="<?php echo $data['quota']; ?> " >
		</div>

		<div class="form-group">
			<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			<br> <br>
			<a href="halaman-admin.php" class="btn btn-info">Back</a>
		</div>
	</form>
                        </div>
                        </div>
                    </div>
                </main>
                <?php include "footerAdmin.php"; ?>
            </div>
        </div>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">
            console.log($data);
        </script>
    </body>
</html>

<?php 
//jika tombol submit di tekan

include "upload.php";
if(isset($_POST['submit'])){
	$nama = trim(htmlspecialchars($_POST['nama']));
	$kategori = trim(htmlspecialchars($_POST['kategori']));
	$waktu = trim(htmlspecialchars($_POST['waktu']));
	$alamat = trim(htmlspecialchars($_POST['alamat']));
	$quota = trim(htmlspecialchars($_POST['quota']));
	$deskripsi = trim(htmlspecialchars($_POST['deskripsi']));
	$GambarLama = $_POST['GambarLama'];
	if($_FILES['gambar']['error'] === 4){
		$gambar = $GambarLama;
	}else{
		$gambar = upload();
	}

	$queryn = $conn->query("UPDATE lowongan SET 
							nama_lowongan = '$nama',
							kategori_lowongan = '$kategori',
							waktu_lowongan = '$waktu',
							alamat = '$alamat',
							quota = '$quota',
							deskripsi = '$deskripsi',
							img = '$gambar'
							WHERE id_lowongan = '$id'
		");

	if(!$query){
 		die(mysqli_error($conn));
 	}else{
 		echo ' . ?>
        <script type="text/javascript">
          swal({
              title: "Berhasil di ubah!",
              text: "Data Telah di ubah!",
              icon: "success",
              button: "Oke!",
            });

        </script>
      <?php '  ;
 	}
}

 ?>