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
                        <h1>Data Karyawan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Welcome <?php echo ($_SESSION ['admin']); ?> disini kamu dapat melihat siapa saja yang telah selesai bekerja</li>
                        </ol>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
							<a class="btn btn-primary btn-sm" href="dashboard.php">Kembali ke dashboard</a>
						</div> 
                        <br>
                        <div class="card mb-4" >
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Sedang Bekerja
                            </div>
                                <div class="card-body" >
                                <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama lengkap</th>
                                    <th scope="col">Nama lowongan</th>
                                    <th scope="col">Kategori lowongan</th>
                                    <th scope="col">Dari Tanggal</th>
                                    <th scope="col">Sampai Tanggal</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Sertifikat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $query = $conn->query("SELECT * FROM pengajuan a, lowongan b, user c 
                                                           WHERE a.id_lowongan=b.id_lowongan 
                                                           AND a.id_user=c.id_user 
                                                           AND status_role='sukses' ");
                                    $no = 1;
                                    while($data= $query->fetch_array()){
                                        ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $data['nama_lengkap']; ?></td>
                                            <td><?php echo $data['nama_lowongan']; ?></td>
                                            <td><?php echo $data['kategori_lowongan']; ?></td>
                                            <td><?php echo $data['dari_tanggal']; ?></td>
                                            <td><?php echo $data['sampai_tanggal']; ?></td>
                                            <td><p class="btn btn-success btn-sm"><?php echo $data['status_role']; ?></p></td>
                                            <td><a href="mpdf/sertifikat.php?id=<?php echo $data['id_user']; ?>" target="_blank" class="btn btn-info btn-custom">Print</a></td>
                                        </tr>
                                        <?php } ?>
                                </tbody>
                                </table>
                                <a href="mpdf/print.php " class="btn btn-info" target="blank" style="float: right; margin: 0 0 15px 0; width: 18%;">Print Sertifikat</a>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include "footerAdmin.php" ?>
            </div>
        </div>
    </body>
</html>
