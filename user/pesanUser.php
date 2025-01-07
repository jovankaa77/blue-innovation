<?php
session_start();
if (!isset($_SESSION['member'])) {
    header("Location: /web_kuliah_test/index.php");
}
include '../conn.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kirim Pesan</title>
    <link rel="stylesheet" type="text/css" href="bs/css/bootstrap.min.css">
    <style>
        .container {
            margin: 100px auto;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
        <form action="" method="POST" autocomplete="off">
            <input type="hidden" name="id" value="<?php echo $_SESSION['data-user'] ?>">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Kirim Pesan Ke Admin</h3></div>
                            <div class="card-body">
                                <div class="small mb-3 text-muted">Pesan anda akan dikirim ke admin dan akan dibalas secepatnya oleh admin</div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="pesan" name="pesan" type="text" placeholder="Kirim pesan ke admin"></textarea>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <a class="small" href="test_halaman_utama.php">Kembali</a>
                                    <button type="submit" name="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php include "footer.php"; ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $pesan = trim(htmlspecialchars($_POST['pesan']));
    $queryPesan = $conn->query("INSERT INTO pesan (id_user, pesan_user) VALUES ('$id', '$pesan')");
    if (!$queryPesan) {
        die(mysqli_error($conn));
    } else {
        echo '<script type="text/javascript">
            swal({
                title: "Berhasil!",
                text: "Pesan Anda berhasil dikirim",
                icon: "success",
                button: "Oke!",
            }).then((value) => {
                window.location.href = "test_halaman_utama.php";
            });
            </script>';
    }
}
?>
