<?php 
session_start();
if(!isset($_SESSION['member'])){
  header("Location: /web_kuliah_test/index.php");
}
include '../conn.php';
$id = $_SESSION['data-user'];
$query = $conn->query("SELECT * FROM user WHERE id_user ='$id' ");
$data = $query->fetch_array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lowongan Pekerjaan</title>
  <link rel="stylesheet" href="bs/css/bootstrap.min.css">
  <link rel="stylesheet" href="font/css/all.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }
    .atasss {
      background-color: #007bff;
      color: white;
      padding: 20px 0;
      text-align: center;
    }
    .atasss h1 {
      margin: 0;
      font-size: 24px;
    }
    .container {
      margin-top: 20px;
    }
    .kotak {
      border-radius: 15px;
      box-shadow: 1px 1px 2px #8585ad;
      margin: 20px 0;
      padding: 10px;
      background-color: white;
      border: 1px solid #ddd;
      text-align: center;
    }
    .kotak img {
      max-width: 100%;
      height: auto;
      border-radius: 15px;
    }
    .modal-body textarea {
      width: 100%;
      resize: none;
    }
  </style>
</head>
<body>
  <!-- Hapus nanti -->
  <?php include "header.php"; ?>
  <br><br><br><br>
  <div class="container mt-5">
    <div class="atasss">
      <h1>Daftar Lowongan Pekerjaan</h1>
    </div>
    <div class="alert alert-info alert-dismissable text-center">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      Welcome to <b>Blue Innovation</b> Silahkan Pilih Lowongan Pekerjaan yang Anda Minati
      <p style="color: grey;">*Quota Akan Berkurang Jika Siswa telah di konfirmasi</p>
    </div>
    <div class="alert alert-info text-center">
      <a href="biodata.php" class="btn btn-info btn-block">Biodata</a>
    </div>
    <div class="row">
      <?php 
      $sql = $conn->query("SELECT * FROM lowongan");
      while($data = $sql->fetch_array()) : ?>
        <div class="col-md-4">
          <div class="kotak">
            <h4 style="font-size: 18px; font-weight: bold; color: #336699;"><?php echo $data['nama_lowongan']; ?></h4>
            <p style="font-size: 14px; color: #407bbf;"><?php echo $data['kategori_lowongan']; ?></p>
            <img src="../uploads/<?php echo $data['img']; ?>" alt="Gambar Lowongan">
            <h5 style="margin: 10px 0; font-size: 16px;"><i class="fas fa-clock" style="color:#8585ad;"></i> Waktu : <?php echo $data['waktu_lowongan']; ?></h5>
            <p><i class="fas fa-users" style="color:#8585ad;"></i> Quota : <?php echo $data['quota']; ?></p>
            <button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#h-<?php echo $data['id_lowongan']; ?>">View Info</button>

            <!-- Modal -->
            <div class="modal fade" id="h-<?php echo $data['id_lowongan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><p style="color:black;">Info Lengkap</p></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="form-group">
                        <label for="message-text" class="col-form-label"><p style="color:black;"><i class="fas fa-home" style="color:#8585ad;"></i> Alamat</p></label>
                        <textarea class="form-control" id="message-text" readonly><?php echo $data['alamat']; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="col-form-label"><p style="color:black;"><i class="fas fa-money-bill-alt" style="color:#8585ad;"></i> Gaji</p></label>
                        <textarea class="form-control" id="message-text" readonly><?php echo $data['gaji']; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="col-form-label"><p style="color:black;"><i class="fas fa-book-open" style="color:#8585ad;"></i> Deskripsi</p></label>
                        <textarea class="form-control" id="message-text" readonly><?php echo $data['deskripsi']; ?></textarea>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <?php if($data['quota'] != 0) : ?>
                      <a href="tambah-pengajuan.php?id=<?php echo $data["id_lowongan"]; ?>" class="btn btn-primary" onclick="return confirm('Yakin Ingin Mengajukan?');">Ajukan Data</a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
  <?php include "footer.php"; ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
