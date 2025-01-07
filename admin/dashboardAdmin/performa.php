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
                <h1>Performa</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Welcome <?php echo ($_SESSION ['admin']); ?> disini kamu dapat melihat performa setiap karyawan</li>
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
                                    <th>Kualitas Kerja</th>
                                    <th>Kuantitas Kerja</th>
                                    <th>Kompetensi teknis</th>
                                    <th>Sikap perilaku</th>
                                    <th>Komunikasi</th>
                                    <th>Total Skor</th>
                                    <th>Tahun</th>
                                    <th>Pesan</th>
                                    <th>Edit Performa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $query = $conn->query("SELECT p.*, u.nama_lengkap
                                                       FROM performa p 
                                                       JOIN user u ON p.id_user = u.id_user
                                                       WHERE u.status_role = 'proses'");
                                $i = 1;
                                while ($data = $query->fetch_array()) {
                                    $total = ($data['kualitas_kerja'] + $data['kuantitas_kerja'] + $data['kompetensi_teknis'] + $data['sikap_perilaku'] + $data['komunikasi']) * 2;
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $data['nama_lengkap']; ?></td>
                                        <td><?php echo $data['kualitas_kerja']; ?></td>
                                        <td><?php echo $data['kuantitas_kerja']; ?></td>
                                        <td><?php echo $data['kompetensi_teknis']; ?></td>
                                        <td><?php echo $data['sikap_perilaku']; ?></td>
                                        <td><?php echo $data['komunikasi']; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $data['tahun']; ?></td>
                                        <td><?php echo $data['pesan']; ?></td>
                                        <td><a class="btn btn-success btn-sm" href="tambah_performa_karyawan.php?number=<?php echo $data['id']; ?>" onclick="return confirm('Apakah anda yakin ingin edit performa?')">Edit</a></td>
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
