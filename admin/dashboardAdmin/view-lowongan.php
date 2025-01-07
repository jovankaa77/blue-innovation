

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
    </head>

    <body class="sb-nav-fixed">
        <?php include "headerAdmin.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                <div class="container-fluid px-4">  
                    <h1>Tambah Admin</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Welcome <?php echo ($_SESSION ['admin']); ?> disini kamu dapat menambah akun admin yang baru</li>
                    </ol>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <a class="btn btn-primary btn-sm" href="dashboard.php">Kembali ke dashboard</a>
                    </div> 
                    <br>
                        <div class="card mb-4" >
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tambah admin
                            </div>
							<div class="card-body">
	                        <table class="table table-striped table-responsive table-hover" id="table_id" class="display">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama lowongan</th>
      <th scope="col">Kategori lowongan</th>
      <th scope="col">Waktu lowongan</th>
      <th scope="col">Alamat lowongan</th>
      <th scope="col">Descripsi</th>
      <th scope="col">Quota</th>
      <th scope="col">Gaji</th>
      <th scope="col">Detail</th>
      <th scope="col">Hapus</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      //Koneksi
      //Query Data
      $sql = $conn->query("SELECT * FROM lowongan");
      $i = 1;
      while($data = $sql->fetch_array()){
        ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data["nama_lowongan"]; ?></td>
            <td><?php echo $data["kategori_lowongan"]; ?></td>
            <td><?php echo $data["waktu_lowongan"]; ?></td>
            <td><?php echo $data["alamat"]; ?></td>
            <td><?php echo $data["deskripsi"]; ?></td>
            <td><?php echo $data["quota"]; ?></td>
            <td><?php echo $data["gaji"]; ?></td>
            <td><a href="view-user.php?id=<?php echo $data['id_lowongan']; ?> " class="btn btn-info btn-sm">Lihat user</a></td>
            <td><a href="hapus-lowongan.php?id=<?php echo $data['id_lowongan']; ?> " class="btn btn-danger btn-sm" onclick="return confirm('Yakin?');">Hapus</a></td>
          </tr>
        <?php
        $i++;
      }

     ?>
  </tbody>
</table>
                        </div>
                    </div>
                </main>
                <?php include "footerAdmin.php"; ?>
            </div>
        </div>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </body>
</html>
