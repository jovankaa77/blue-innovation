<!DOCTYPE html>
<html lang="en">
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
        <style>
        .btn-group {
            display: flex;
            gap: 10px;
        }

        .btn-add {
            display: flex;
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }
        .card-body {
            display: flex;
            flex-direction: column;
        }
        .question {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .form-check-label {
            display: flex;
            align-items: center;
        }
        .form-check-input {
            margin-right: 10px;
        }
        .jawaban {
            font-weight: bold;
            color: grey;
            margin-left: 5px;
        }
        .correct_answer {
            font-weight: bold;
            color: green;
            margin-left: 5px;
        }
        .total_benar {
            color: green;
            font-weight: bold;
        }
        .total_salah {
            color: red;
            font-weight: bold;
        }
        </style>
    </head>

    <body class="sb-nav-fixed">
        <?php include "headerAdmin.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4"> 
                        <h1>Edit Finish Test</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Welcome <?php echo ($_SESSION ['admin']); ?> disini kamu dapat memeriksa hasil ujian calon karyawan</li>
                        </ol>
                        <br>
                        <div style="flex";>
                            <a class="btn btn-primary btn-sm" href="finishTest.php">Kembali</a>
                        </div> 
                        <br>
                            <div class="card mb-4" >
                                <div class="card-header">
                                    <i class="fa-brands fa-wpforms"></i>
                                    Edit Ujian Calon Karyawan
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="../queryTBD/query.php">
                                        <input type="hidden" name="action" value="finishTest">
                                        <?php
                                        $id_ujian_selesai = $_GET['no'];
                                        
                                        $query = mysqli_query($conn, 
                                                                    "SELECT us.id_ujian_selesai, u.id_user, u.nama_lengkap, us.statuss, l.nama_lowongan
                                                                    FROM ujian_selesai us
                                                                    JOIN user u ON us.id_user = u.id_user
                                                                    JOIN lowongan l ON us.kategori = l.id_lowongan
                                                                    WHERE us.id_ujian_selesai = $id_ujian_selesai");

                                        if ($data = mysqli_fetch_array($query)) :
                                        $idUser = $data ['id_user'];
                                        
                                        // Memanggil function untuk mendapatkan jumlah jawaban yang benar
                                        $queryBenar = "SELECT hitungJawabanBenar($idUser) AS total_benar";
                                        $resultBenar = mysqli_query($conn, $queryBenar);
                                        $dataBenar = mysqli_fetch_assoc($resultBenar);
                                        $totalBenar = $dataBenar['total_benar'];

                                        // Memanggil function untuk mendapatkan jumlah jawaban yang salah
                                        $querySalah = "SELECT hitungJawabanSalah($idUser) AS total_salah";
                                        $resultSalah = mysqli_query($conn, $querySalah);
                                        $dataSalah = mysqli_fetch_assoc($resultSalah);
                                        $totalSalah = $dataSalah['total_salah'];
                                        ?> 
                                        <input type="hidden" name="id_ujian_selesai" value="<?= $id_ujian_selesai ?>">
                                        <div class="form-group row">
                                            <label for="namaLabel" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" placeholder="Input Nama" value="<?= $data ['nama_lengkap'] ?>" name="nama_lengkap" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label for="statusLabel" class="col-sm-2 col-form-label">Status</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="statuss">
                                                        <option value="Belum Diperiksa" <?= $data['statuss'] == 'Belum Diperiksa' ? 'selected' : '' ?>>Belum Diperiksa</option>
                                                        <option value="Tidak Lulus" <?= $data['statuss'] == 'Tidak Lulus' ? 'selected' : '' ?>>Tidak Lulus</option>
                                                        <option value="Lulus" <?= $data['statuss'] == 'Lulus' ? 'selected' : '' ?>>Lulus</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label for="kategoriLabel" class="col-sm-2 col-form-label">Kategori</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Input Kategori" value="<?= $data ['nama_lowongan'] ?>" name="nama_lowongan" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row" style="float: right;">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm ('Yakin ingin edit hasil?')">Send</button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="total_benar">Total Jawaban Benar : <?php echo $totalBenar?></p> 
                                            <p class="total_salah">Total Jawaban Salah : <?php echo $totalSalah?></p>
                                        </div>
                                        <?php else : ?>
                                            <p>Soal tidak ditemukan</p>
                                        <?php endif ; ?>
                                    </form>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fa-brands fa-wpforms"></i>
                                    Hasil Ujian Calon Karyawan
                                </div>
                                <div class="card-body">
                                    <?php
                                    $nama_lengkap = mysqli_real_escape_string($conn, $data['nama_lengkap']);

                                    $query = "SELECT q.question, j.jawaban, q.correct_answer, j.id_ujian, u.nama_lengkap
                                              FROM jawaban j 
                                              JOIN user u ON j.id_user = u.id_user 
                                              JOIN ujian q ON j.id_ujian = q.id_ujian
                                              WHERE u.nama_lengkap = '$nama_lengkap'";

                                    $result = mysqli_query($conn, $query);
                                    ?>
                                    <?php 
                                    if (mysqli_num_rows($result) > 0):
                                    $index = 1;
                                    while ($row = mysqli_fetch_assoc($result)): 
                                    ?>
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <i class="fa fa-question-circle"></i> Soal <?= $index; ?>
                                        </div>
                                        <div class="card-body">
                                            <p class="question"><?= htmlspecialchars($row['question']); ?></p>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="jawaban_<?= $index; ?>" value="<?= htmlspecialchars($row['jawaban']); ?>" checked disabled>
                                                    <span class="jawaban"><?= htmlspecialchars($row['jawaban']); ?></span>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    Jawaban Benar: <span class="correct_answer"><?= htmlspecialchars($row['correct_answer']); ?></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    $index++;
                                    endwhile;
                                    ?>
                                    <?php else : ?>
                                        <p>Tidak ada jawaban yang ditemukan untuk <?= htmlspecialchars($nama_lengkap); ?></p>
                                    <?php
                                    endif;
                                    mysqli_free_result($result); 
                                    ?>
                                </div>
                            </div>
                    </div>
                </main>
                <?php include "footerAdmin.php" ?>
            </div>
        </div>
    </body>
</html>