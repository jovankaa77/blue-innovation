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
    <?php include "headerAdmin.php"; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">  
                <h1>Pesan Karyawan</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Welcome <?php echo ($_SESSION['admin']); ?> disini kamu dapat melihat pesan setiap karyawan</li>
                </ol>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <a class="btn btn-primary btn-sm" href="dashboard.php">Kembali ke dashboard</a>
                </div> 
                <br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Sedang Bekerja
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Pesan</th>
                                    <th scope="col">Status account</th>
                                    <th scope="col">Balas Pesan</th>
                                    <th scope="col">Hapus Pesan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $query = $conn->query("SELECT p.*, u.nama_lengkap, u.status_role
                                                       FROM pesan p
                                                       JOIN user u ON p.id_user = u.id_user");
                                $no = 1;
                                while($data = $query->fetch_array()){
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $data['nama_lengkap']; ?></td>
                                    <td><?php echo $data['pesan_user']; ?></td>
                                    <td><?php echo $data['status_role']; ?></td>
                                    <td>
                                        <a href="ubah-pesan.php?id_pesan=<?php echo urlencode($data['id_pesan']); ?>" onclick="return confirm('Konfirmasi Pesan?');" class="btn btn-primary btn-sm">
                                            Reply
                                        </a>
                                    </td>
                                    <td>
                                        <a href="../queryTBD/query.php?action=hapusPesan&id_pesan=<?php echo urlencode($data['id_pesan']); ?>" onclick="return confirm('Yakin ingin menghapus pesan?');" class="btn btn-danger btn-sm">
                                            Hapus
                                        </a>
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
