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
                    <h1>Tambah Admin</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Welcome <?php echo ($_SESSION ['admin']); ?> disini kamu dapat menambah akun admin yang baru</li>
                    </ol>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <a class="btn btn-primary btn-sm" href="dashboard.php">Kembali ke dashboard</a>
                    </div> 
                    <br>
                        <div class="card mb-4" >
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tambah admin
                            </div>
							<div class="card-body">
	                        <h3 class="text-center">Tambah Account Admin</h3>
                            <form action="" method="post" autocomplete="off">
                                <input type="hidden" name="status_role" class="form-control" value="Admin">
                                <input type="hidden" name="domisili" class="form-control" value="">
                                <input type="hidden" name="usia" class="form-control" value="">
                                <input type="hidden" name="negara" class="form-control" value="">
                                <input type="hidden" name="kontak" class="form-control" value="">
                                <input type="hidden" name="email" class="form-control" value="">
                                <input type="hidden" name="dari_tanggal" value="Admin">
                                <input type="hidden" name="sampai_tanggal" value="Admin">
                                <input type="hidden" name="link" value="Admin">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Input Nama Lengkap...">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="Input Username...">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Input Password...">
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="hidden" name="level" value="Admin">
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button><br>
                            </form>
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
    // Cek apakah tombol submit sudah ditekan atau belum
    if(isset($_POST['submit'])){
        $status_role = htmlspecialchars($_POST["status_role"]);
        $nama = htmlspecialchars($_POST["username"]);
        $pass = htmlspecialchars($_POST["password"]);
        $nama_lengkap = htmlspecialchars($_POST["nama_lengkap"]);
        $level = htmlspecialchars($_POST["level"]);
        $domisili = htmlspecialchars($_POST["domisili"]);
        $usia = htmlspecialchars($_POST["usia"]);
        $negara = htmlspecialchars($_POST["negara"]);
        $kontak = htmlspecialchars($_POST["kontak"]);
        $email = htmlspecialchars($_POST["email"]);
        $dari_tanggal = htmlspecialchars($_POST['dari_tanggal']);
        $sampai_tanggal = htmlspecialchars($_POST['sampai_tanggal']);
        $link = htmlspecialchars($_POST['link']);

        // Membuat query dengan nilai yang sudah di-sanitize
        $query = $conn->query("INSERT INTO user (nama, password, nama_lengkap, level, status_role, domisili, usia, negara, kontak, email, tanggal_wawancara, link_wawancara, dari_tanggal, sampai_tanggal, link) 
                               VALUES ('$nama', '$pass', '$nama_lengkap', '$level', '$status_role', '$domisili', '$usia', '$negara', '$kontak', '$email', 'Belum Ditentukan', 'Belum Ditentukan', '$dari_tanggal', '$sampai_tanggal', '$link')");

        // Jika query data gagal, tampilkan kesalahan
        if(!$query){
            die(mysqli_error($conn));
        } else {
            echo '<script type="text/javascript">
                    swal({
                        title: "Berhasil!",
                        text: "Admin berhasil ditambahkan!",
                        icon: "success",
                        button: "Oke!",
                    }).then((value) => {
                        window.location.href = "dashboard.php";
                    });
                </script>';
        }
    }
?>
