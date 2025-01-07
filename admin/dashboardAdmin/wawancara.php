<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styleDashboard.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .center-text {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
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
                    <li class="breadcrumb-item active">Welcome <?php echo ($_SESSION ['admin']); ?> disini kamu dapat melihat siapa saja yang lolos ke tahap wawancara dan anda dapat mengatur tanggal wawancaranya</li>
                </ol>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <a class="btn btn-primary btn-sm" href="dashboard.php">Kembali ke dashboard</a>
                </div> 
                <br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Wawancara
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="display">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama lengkap</th>
                                    <th scope="col">Nama lowongan</th>
                                    <th scope="col">Kategori lowongan</th>
                                    <th scope="col">Tanggal Wawancara</th>
                                    <th scope="col">Link Wawancara</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Acc</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $query = $conn->query("SELECT * FROM pengajuan a, lowongan b, user c 
                                                       WHERE a.id_lowongan=b.id_lowongan 
                                                       AND a.id_user=c.id_user 
                                                       AND status_role='wawancara'");
                                $no = 1;
                                while($data = $query->fetch_array()){
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $data['nama_lengkap']; ?></td>
                                        <td><?php echo $data['nama_lowongan']; ?></td>
                                        <td><?php echo $data['kategori_lowongan']; ?></td>
                                        <td><?php echo $data['tanggal_wawancara']; ?></td>
                                        <td><?php echo $data['link_wawancara']; ?></td>
                                        <td class="center-text"><p class="btn btn-warning btn-sm"><?php echo $data['status_role']; ?></p></td>
                                        <td class="text-center">
                                            <a href="tanggalWawancara.php?id=<?php echo $data['id_pengajuan']; ?>" class="btn btn-primary btn-sm">Atur</a>
                                        </td>
                                        <td class="text-center">
                                            <a href="../queryTBD/query.php?action=accWawancara&id=<?php echo $data['id_pengajuan']; ?>" class="btn btn-success btn-sm" onclick="return confirm ('Yakin ingin terima calon karyawan?')" >Terima</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <?php include "footerAdmin.php"; ?>
    </div>
</body>
</html>