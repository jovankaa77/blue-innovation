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
            width: 100%;
        }

        .btn-add {
            display: flex;
        }
        </style> 
    </head>

    <body class="sb-nav-fixed">
        <?php include "headerAdmin.php"?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">  
                        <h1>Test Selesai</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Welcome <?php echo ($_SESSION ['admin']); ?> disini kamu dapat melihat dan mengakses siapa saja yang sudah mengerjakan soal</li>
                        </ol>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
							<a class="btn btn-primary btn-sm" href="dashboard.php">Kembali ke dashboard</a>
						</div> 
                        <br>
                        <div class="card mb-4" >
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Ujian Calon Karyawan
                            </div>
                                <div class="card-body" >
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">View Test</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $row = mysqli_query($conn, 
                                                                        "SELECT us.id_user, u.nama_lengkap, us.statuss, l.nama_lowongan,us.id_ujian_selesai
                                                                        FROM ujian_selesai us
                                                                        JOIN user u ON us.id_user = u.id_user
                                                                        JOIN lowongan l ON us.kategori = l.id_lowongan");
                                            $no = 1;
                                            while ($data = mysqli_fetch_array($row)):
                                            ?>
                                            <tr>
                                                <th scope="row"><?= $no++ ?></th>
                                                <td><?= $data ['nama_lengkap'] ?></td>
                                                <td><?= $data ['statuss'] ?></td>
                                                <td><?= $data ['nama_lowongan'] ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-primary btn-sm" href="../dashboardAdmin/editFinishTest.php?no=<?= $data['id_ujian_selesai'] ?>">View</a>
                                                        <a class="btn btn-success btn-sm" href="../queryTBD/query.php?action=accTest&no=<?= $data['id_ujian_selesai'] ?>" onclick="return confirm ('Yakin ingin terima hasil ujian?')" >Accepted</a>
                                                        <a class="btn btn-danger btn-sm" href="../queryTBD/query.php?action=rejTest&no=<?= $data['id_ujian_selesai'] ?>" onclick="return confirm ('Yakin ingin tolak hasil ujian?')" >Reject</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </main>
                <?php include "footerAdmin.php"; ?>
            </div>
        </div>
    </body>
</html>

