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
    </head>

    <body class="sb-nav-fixed">
        <?php include "headerAdmin.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4"> 
                        <h1>Wawancara</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Welcome <?php echo ($_SESSION ['admin']); ?> silakan atur tanggal wawancara calon karyawan</li>
                        </ol>
                        <div style="flex";>
                            <a class="btn btn-primary btn-sm" href="wawancara.php">Kembali</a>
                        </div> 
                        <br>
                        <div class="card mb-4" >
                            <div class="card-header">
                                <i class="fa-brands fa-wpforms"></i>
                                Atur Tanggal Wawancara
                            </div>
                            <div class="card-body">
                                <form method="POST" action="../queryTBD/query.php">
                                    <input type="hidden" name="action" value="aturTanggalWawancara">
                                    <?php
                                    $id_pengajuan = $_GET['id'];

                                    // Query untuk mendapatkan data dari tabel user berdasarkan id_user dari tabel pengajuan
                                    $query = mysqli_query($conn, "SELECT u.* 
                                                                  FROM pengajuan p 
                                                                  JOIN user u ON p.id_user = u.id_user 
                                                                  WHERE p.id_pengajuan = $id_pengajuan");

                                    if ($data = mysqli_fetch_array($query)) :
                                    ?>
                                    <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">
                                    <div class="form-group row">
                                        <label for="inputQuestion" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="nama" value="<?= $data['nama_lengkap'] ?>" name="nama_lengkap" readonly>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="inputOptions" class="col-sm-2 col-form-label">Atur Tanggal Wawancara</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Input Tanggal Wawancara" value="<?= $data['tanggal_wawancara'] ?>" name="tanggal_wawancara" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="inputOptions" class="col-sm-2 col-form-label">Atur Link Wawancara</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Input Link Wawancara" value="<?= $data['link_wawancara'] ?>" name="link_wawancara" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row" style="float: right;">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Yakin ingin atur tanggal?')">Send</button>
                                        </div>
                                    </div>
                                    <?php else : ?>
                                        <p>Data tidak ditemukan</p>
                                    <?php endif ; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include "footerAdmin.php"; ?>
            </div>
        </div>
    </body>
</html>