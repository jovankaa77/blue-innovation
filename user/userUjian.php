<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>User Ujian</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
        .card-body {
            display: flex;
            flex-direction: column;
        }
        </style>
    </head>
    <?php 
    session_start(); // Pastikan session sudah dimulai
    include "../conn.php";

    if (!isset($_SESSION['member'])) {
        header("Location: /web_kuliah_test/index.php");
        exit();
    }
    ?>

    <body class="sb-nav-fixed">
        <?php include "header.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <br>
                    <br>
                    <br>
                    <div class="container-fluid px-4">
                    <h1 class="mt-4">General Test</h1>
                    <?php
                    $id_user = $_SESSION['data-user'];
                    $queryNama = mysqli_query($conn, "SELECT p.id_pengajuan, us.nama_lengkap, l.id_lowongan, l.nama_lowongan 
                                                         FROM pengajuan p JOIN user us ON p.id_user = us.id_user JOIN lowongan l ON p.id_lowongan = l.id_lowongan WHERE us.id_user = '$id_user'");
                    if (!$queryNama) {
                        echo "Error: " . mysqli_error($conn);
                    }
                    $row = mysqli_query($conn, "SELECT * FROM ujian");
                    $no = 1;
                    if ($data = mysqli_fetch_array($queryNama)) {
                        // Debugging untuk melihat output dari $data
                        // echo "<pre>"; print_r($data); echo "</pre>";
                    } 
                    else {
                        echo "Tidak ada data yang ditemukan.";
                    }
                    ?>
                    <form method="POST" action="querySubmitAnswers.php">
                        <!-- Input tersembunyi untuk id_user -->
                        <input type="hidden" name="id_user" value="<?= $id_user; ?>">
                        <!-- Input tersembunyi untuk id_lowongan -->
                        <input type="hidden" name="id_lowongan" value="<?= $data['id_lowongan']; ?>">
                        <div class="card mb-4" >
                            <div class="card-header">
                                <i class="fa-brands fa-wpforms"></i>
                                Kartu Karyawan
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="namaLabel" class="col-sm-2 col-form-label">ID Pengajuan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $data ['id_pengajuan'] ?>" name="id_pengajuan" readonly>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="namaLabel" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $data ['nama_lengkap'] ?>" name="nama_lengkap" readonly>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="namaLabel" class="col-sm-2 col-form-label">Pekerjaan yang diambil</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $data ['nama_lowongan'] ?>" name="nama_lowongan" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                        while ($data = mysqli_fetch_array($row)) : 
                        ?>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-question-circle"></i> Soal <?= $no++ ?>
                                </div>
                                <div class="card-body">
                                    <p><?= $data['question'] ?></p>
                                    <div>
                                        <input type="radio" name="jawaban[<?= $data['id_ujian'] ?>][jawaban]" value="A" required> <?= $data['option_a'] ?><br>
                                        <input type="radio" name="jawaban[<?= $data['id_ujian'] ?>][jawaban]" value="B" required> <?= $data['option_b'] ?><br>
                                        <input type="radio" name="jawaban[<?= $data['id_ujian'] ?>][jawaban]" value="C" required> <?= $data['option_c'] ?><br>
                                        <input type="radio" name="jawaban[<?= $data['id_ujian'] ?>][jawaban]" value="D" required> <?= $data['option_d'] ?><br>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            endwhile;
                            ?>
                        <button type="submit" class="btn btn-primary" onclick="return confirm ('Yakin ingin submit?')">Submit</button>
                    </form>
                </div>
                </main>
                
            </div>
        </div>
    </body>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Blue Innovation 2024</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</html>