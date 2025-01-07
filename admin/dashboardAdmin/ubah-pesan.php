<!DOCTYPE html>
<html>
<head>
    <title>Ubah Pesan</title>
    <link rel="stylesheet" type="text/css" href="bs/css/bootstrap.css">
    <link rel="icon" type="image/png" href="img/favicon-32x32.png" sizes="32x32" />
</head>
<body>
    <?php include "headerAdmin.php"; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1>Kirim Pesan</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Welcome <?php echo ($_SESSION['admin']); ?> disini kamu dapat mengirim pesan balasan ke setiap karyawan</li>
                </ol>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <a class="btn btn-primary btn-sm" href="pesan.php">Kembali</a>
                </div> 
                <br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Kirim Pesan Ke Karyawan
                    </div>
                    <div class="card-body">
                        <?php
                        $id_pesan = $_GET['id_pesan'];
                        $query = $conn->query("SELECT p.*, u.nama_lengkap, u.status_role
                                               FROM pesan p
                                               JOIN user u ON p.id_user = u.id_user
                                               WHERE p.id_pesan = '$id_pesan'");
                        $data = $query->fetch_array();
                        ?>
                        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                            <input type="hidden" name="id_pesan" value="<?= $data['id_pesan'] ?>">
                            <div class="form-group">
                                <label>Pesan</label>
                                <input type="text" class="form-control" placeholder="pesan user" value="<?= $data['pesan_user'] ?>" name="pesan_user" readonly>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Pesan</label>
                                <textarea type="text" class="form-control" placeholder="Silakan masukkan pesan untuk dikirim ke user" value="<?= $data['pesan_admin'] ?>" name="pesan_admin"></textarea>
                            </div>
                            <br>
                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
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
    $id_pesan = trim($_POST['id_pesan']);
    $pesan_admin = trim($_POST['pesan_admin']);

    $query = $conn->query("UPDATE pesan SET pesan_admin = '$pesan_admin' WHERE id_pesan = '$id_pesan'");

    if (!$query) {
        die(mysqli_error($conn));
    } else {
        echo '<script type="text/javascript">
                swal({
                    title: "Berhasil!",
                    text: "Pesan Telah di kirim!",
                    icon: "success",
                    button: "Oke!",
                }).then((value) => {
                    window.location.href = "pesan.php";
                });
            </script>';
    }
}
?>
