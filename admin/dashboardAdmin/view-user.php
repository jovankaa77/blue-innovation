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
                    <h1>View Lowongan</h1>
                    <ol class="breadcrumb mb-4">
                    </ol>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <a class="btn btn-primary btn-sm" href="dashboard.php">Kembali ke dashboard</a>
                    </div> 
                    <br>
                        <div class="card mb-4" >
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                View Lowongan
                            </div>
							<div class="card-body">
	                        <table class="table table-striped table-hover " id="table_id" class="display">
  <thead>
    <tr>
      <th scope="col">Username</th>
      <th scope="col">Nama Lengkap</th>
      <th scope="col">Status</th>
      <th scope="col" class="text-center">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $id = $_GET['id'];
    	include "../koneksi.php";
      //Jadi url id_lowongan harus sama dengan database contoh : id lowongan 4 di id_pengajuan harus id_lowongan nya 4
      //NOTE JIKA lowongan YANG DI PAKAI YA ID_lowongan
    	$query = $conn->query("SELECT * FROM pengajuan a, lowongan b, user c
    							WHERE a.id_lowongan=b.id_lowongan AND a.id_user=c.id_user
    							AND a.id_lowongan = '$id'
    		");
    	while($data= $query->fetch_array()){
    		?>
    			<tr>
    				<td><?php echo $data['nama']; ?></td>
    				<td><?php echo $data['nama_lengkap']; ?></td>
            <td><p class="btn btn-info btn-sm"><?php echo $data['status_role']; ?></p></td>

            <td class="text-center"><a class="btn btn-danger btn-sm" 
                  href="hapus-pengajuan-admin.php?id=<?php echo $data['id_pengajuan'] ?> "
                  onclick="return confirm('Hapus Siswa') " >Hapus</a>
                    |
                <a class="btn btn-primary btn-sm"
                 href="ubah-pengajuan.php?id=<?php echo $data['id_user']; ?> "
                 onclick="return confirm('Update Data Siswa?') " >Update Data Siswa</a>
                </td>

              
    			</tr>
    		<?php
    	}
     ?>
      
  </tbody>
</table>
                        </div>
                        </div>
                    </div>
                </main>
                <?php include "footerAdmin.php"; ?>
            </div>
        </div>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </body>
</html>

