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
        td p {
            width: 100%;
        }
        </style>  
    </head>

    <body class="sb-nav-fixed">
        <?php include "headerAdmin.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">  
                        <h1>Data Calon Karyawan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Welcome <?php echo ($_SESSION ['admin']); ?> disini kamu dapat melihat siapa saja yang sedang mengajukan berkas</li>
                        </ol>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
							<a class="btn btn-primary btn-sm" href="dashboard.php">Kembali ke dashboard</a>
						</div> 
                        <br>
                        <div class="card mb-4" >
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Seleksi Berkas Calon Karyawan
                            </div>
                                <div class="card-body" >
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Lowongan</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Linkedin</th>
                                            <th scope="col">Domisili</th>
                                            <th scope="col">CV</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = $conn->query("SELECT b.id, b.url_linkedin, b.alamat, b.cv, b.jk, u.nama_lengkap, u.status_role, l.nama_lowongan, l.kategori_lowongan
                                                                   FROM biodata b
                                                                   JOIN user u ON b.id_user = u.id_user 
                                                                   JOIN lowongan l ON b.id_lowongan = l.id_lowongan 
                                                                   WHERE u.status_role = 'seleksi_berkas'");
                                            $no = 1;
                                            while ($data = $query->fetch_array()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $data['nama_lengkap']; ?></td>
                                                    <td><?php echo $data['nama_lowongan']; ?></td>
                                                    <td><?php echo $data['kategori_lowongan']; ?></td>
                                                    <td><a href="<?php echo $data['url_linkedin']; ?>" target="">Profil LinkedIn</a></td>
                                                    <td><?php echo $data['alamat']; ?></td>
                                                    <td><a href="/web_kuliah_test/uploads/<?php echo $data['cv']; ?>" target="_blank">Lihat CV</a></td>
                                                    <td><?php echo $data['jk']; ?></td>
                                                    <td><p class="btn btn-warning btn-sm"><?php echo $data['status_role']; ?></p></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a class="btn btn-success btn-sm" href="../queryTBD/query.php?action=acceptBerkas&number=<?= $data['id'] ?>" onclick="return confirm ('Yakin ingin konfirmasi?')">Lulus</a> 
                                                            <a class="btn btn-danger btn-sm" href="../queryTBD/query.php?action=rejectBerkas&number=<?= $data['id'] ?>" onclick="return confirm ('Yakin ingin gagalkan?')">Gagal</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </main>
                <?php include "footerAdmin.php" ?>
            </div>
        </div>
    </body>
</html>
