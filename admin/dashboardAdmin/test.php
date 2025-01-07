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
                        <h1>Test</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Welcome <?php echo ($_SESSION ['admin']); ?> disini kamu dapat melihat soal ujian tambah, edit, dan hapus soal ujian yang ada</li>
                        </ol>
                        <div class="btn-add">
                            <a class="btn btn-success btn-sm" href="addTest.php">Tambah Soal Ujian</a>
                        </div>
                        <br>
                        <div class="card mb-4" >
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Soal Ujian
                            </div>
                                <div class="card-body" >
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Soal</th>
                                                <th scope="col">Settings</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $row = mysqli_query($conn, "SELECT * FROM ujian");
                                            $no = 1;
                                            while ($data = mysqli_fetch_array($row)):
                                            ?>
                                            <tr>
                                                <th scope="row"><?= $no++ ?></th>
                                                <td><?= $data ['question'] ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-primary btn-sm" href="../dashboardAdmin/editTest.php?no=<?= $data['id_ujian'] ?>" onclick="return confirm ('Yakin ingin edit?')">Edit</a> 
                                                        <a class="btn btn-danger btn-sm" href="../queryTBD/query.php?action=deleteTest&number=<?= $data['id_ujian'] ?>" onclick="return confirm ('Yakin ingin delete?')">Delete</a>
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
