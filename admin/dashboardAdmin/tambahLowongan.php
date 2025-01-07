<!DOCTYPE html>
<html>
<head>
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styleDashboard.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
</head>
<body>
    <?php include "headerAdmin.php"; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
				<h1>Lowongan Kerja</h1>
				<ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Welcome <?php echo ($_SESSION ['admin']); ?> disini kamu dapat melihat menambah lowongan pekerjaan sesuai kebutuhan perusahaan</li>
                </ol>
				<div style="display: flex; justify-content: space-between; align-items: center;">
					<a class="btn btn-primary btn-sm" href="dashboard.php">Kembali</a>
				</div> 
				<br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa-brands fa-wpforms"></i>
                        Tambah Lowongan
                    </div>
                    <div class="card-body">
                        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Nama lowongan</label>
                                <input type="text" name="nama" class="form-control" placeholder="Input Nama...">
                            </div>
							<br>
                            <div class="form-group">
                                <label>Kategori lowongan</label>
                                <input type="text" name="kategori" class="form-control" placeholder="Input kategori...">
                            </div>
							<br>
                            <div class="form-group">
                                <label>Waktu lowongan</label>
                                <input type="text" name="waktu" class="form-control" placeholder="Input waktu...">
                            </div>
							<br>
                            <div class="form-group">
                                <label>Alamat lowongan</label>
                                <input type="text" name="alamat" class="form-control" placeholder="Input alamat...">
                            </div>
							<br>
                            <div class="form-group">
                                <label>Quota lowongan</label>
                                <input type="number" name="quota" class="form-control" placeholder="Input quota...">
                            </div>
							<br>
                            <div class="form-group">
                                <label>Gaji</label>
                                <input type="text" name="gaji" class="form-control" placeholder="Input gaji...">
                            </div>
							<br>
                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" name="gambar" class="form-control" required="">
                            </div>
							<br>
                            <div class="form-group">
                                <textarea name="deskripsi" class="form-control" placeholder="Deskripsi lowongan..."></textarea>
                            </div>
							<br>
                            <div class="form-group">
                                <button class="btn btn-success" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>

<?php 
if (isset($_POST['submit'])) {
    include "../koneksi.php";
    include "upload.php";

    $nama = htmlspecialchars($_POST['nama']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $waktu = htmlspecialchars($_POST['waktu']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $quota = htmlspecialchars($_POST['quota']);
    $gaji = htmlspecialchars($_POST['gaji']);
    $gambar = upload();

    $queryn = $conn->query("INSERT INTO lowongan (nama_lowongan, kategori_lowongan, waktu_lowongan, alamat, quota, deskripsi, img, gaji) VALUES ('$nama', '$kategori', '$waktu', '$alamat', '$quota', '$deskripsi', '$gambar', '$gaji')");

    if (!$queryn) {
        die(mysqli_error($conn));
    } else {
        echo '<script type="text/javascript">
            swal({
                title: "Berhasil!",
                text: "Lowongan Berhasil Ditambahkan",
                icon: "success",
                button: "Oke!",
            });
        </script>';
    }
}
?>