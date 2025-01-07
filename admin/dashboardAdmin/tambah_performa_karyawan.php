<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tambah Performa Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styleDashboard.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style type="text/css">
        .container {
            width: 80%;
            margin: 70px auto;
            background-color: #fff;
            border: 1px solid grey;
            padding: 20px;
            box-sizing: border-box;
            box-shadow: 3px 3px 6px grey;
            border-radius: 30px;
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <?php include "headerAdmin.php"; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1>Tambah Performa Karyawan</h1>
                <br>
				<div style="display: flex; justify-content: space-between; align-items: center;">
                    <a class="btn btn-primary btn-sm" href="performa.php">Kembali</a>
                </div>
				<br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa-brands fa-wpforms"></i>
                        Formulir Penilaian
                    </div>
                    <div class="card-body">
                        <form action="../queryTBD/query.php" method="post" autocomplete="off" enctype="multipart/form-data">
							<input type="hidden" name="action" value="addPerforma">
                            <?php
                            $id = $_GET['number'];
                            $query_user = $conn->query("SELECT * FROM user WHERE status_role='proses'");
                            ?>
                            <div class="form-group row">
                                <label for="nama_karyawan" class="col-sm-2 col-form-label">Nama Karyawan:</label>
                                <div class="col-sm-10">
                                    <select name="nama_karyawan" class="form-control" required>
                                        <?php
                                        while ($data_user = $query_user->fetch_array()) {
                                            echo '<option value="' . $data_user['id_user'] . '">' . $data_user['nama_lengkap'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="kualitas_kerja" class="col-sm-2 col-form-label">Kualitas Kerja:</label>
                                <div class="col-sm-10">
                                    <input type="number" name="kualitas_kerja" class="form-control" min="1" max="10" placeholder="Input kategori, min 1 max 10." required>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="kuantitas_kerja" class="col-sm-2 col-form-label">Kuantitas Kerja:</label>
                                <div class="col-sm-10">
                                    <input type="number" name="kuantitas_kerja" class="form-control" min="1" max="10" placeholder="Input kategori, min 1 max 10." required>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="kompetensi_teknis" class="col-sm-2 col-form-label">Kompetensi Teknis:</label>
                                <div class="col-sm-10">
                                    <input type="number" name="kompetensi_teknis" class="form-control" min="1" max="10" placeholder="Input kategori, min 1 max 10." required>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="sikap_perilaku" class="col-sm-2 col-form-label">Sikap Perilaku:</label>
                                <div class="col-sm-10">
                                    <input type="number" name="sikap_perilaku" class="form-control" min="1" max="10" placeholder="Input kategori, min 1 max 10." required>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="komunikasi" class="col-sm-2 col-form-label">Komunikasi:</label>
                                <div class="col-sm-10">
                                    <input type="number" name="komunikasi" class="form-control" min="1" max="10" placeholder="Input kategori, min 1 max 10." required>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="tahun" class="col-sm-2 col-form-label">Tahun:</label>
                                <div class="col-sm-10">
                                    <input type="number" name="tahun" class="form-control" min="2000" max="3000" placeholder="Input tahun" required>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="pesan" class="col-sm-2 col-form-label">Pesan:</label>
                                <div class="col-sm-10">
                                    <textarea name="pesan" class="form-control" placeholder="Pesan..." required></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row" style="float: right;">
                                <div class="col-sm-10">
                                    <button type="submit" name="submit" class="btn btn-success btn-sm">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <?php include "footerAdmin.php"; ?>
    </div>
</body>
</html>