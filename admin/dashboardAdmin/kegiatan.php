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
    <style type="text/css">
        .container {
            width: auto;
            margin: 50px auto;
            border: 1px solid grey;
            background-color: #fff;
            padding: 15px;
            box-sizing: border-box;
            box-shadow: 3px 3px 5px grey;
            border-top-right-radius: 50px;
            border-bottom-left-radius: 50px;
            overflow: auto;
        }
        .btn-group {
            display: flex;
            gap: 10px;
            width: 100%;
        }
        td a {
            width: 100%;
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <?php include "headerAdmin.php"; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1>Kegiatan</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Welcome <?php echo ($_SESSION ['admin']); ?> disini kamu dapat melihat kegiatan pengembangan setiap karyawan</li>
                </ol>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <a class="btn btn-primary btn-sm" href="dashboard.php">Kembali ke dashboard</a>
                </div> 
                <br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Performa Karyawan
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Tanggal</th>
                                    <th>Deskripsi</th>
                                    <th>Bukti kegiatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $query = $conn->query("SELECT kegiatan.id_user, kegiatan.tanggal,kegiatan.deskripsi, kegiatan.bukti_kegiatan , user.nama_lengkap
                                                        FROM kegiatan
                                                        JOIN user ON kegiatan.id_user = user.id_user;
                                                        ");
                                $i = 1;
                                while ($data = $query->fetch_array()) {
                                   
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $data['nama_lengkap']; ?></td>
                                        <td><?php echo $data['tanggal']; ?></td>
                                        <td><?php echo $data['deskripsi']; ?></td>
                                        <td><a href="/web_kuliah_test/uploads/<?php echo $data['bukti_kegiatan']; ?>" target="_blank">Lihat Bukti Kegiatan</a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- <br>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <a class="btn btn-success btn-sm" href="tambah_performa_karyawan.php">Tambah Performa Karyawan</a>
                        </div> 
                        <br> -->
                    </div>
                </div>
            </div>
        </main>
        <?php include "footerAdmin.php"; ?>
    </div>
</body>
</html>
