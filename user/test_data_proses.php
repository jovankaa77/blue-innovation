<?php
session_start();
if(!isset($_SESSION['member'])){
  header("Location: /web_kuliah_test/index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Pengguna</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Arial', sans-serif;
    }
    .main-container {
      margin: 50px auto;
      padding: 20px;
      max-width: 80%;
      background-color: #ffffff;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      border-radius: 15px;
    }
    .card {
      margin-bottom: 30px;
      border: none;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 15px;
    }
    .card-body {
      padding: 25px;
    }
    .form-group label {
      font-weight: bold;
      color: #343a40;
    }
    .form-control[readonly] {
      background-color: #f8f9fa;
      border: none;
      padding-left: 10px;
      padding-right: 10px;
    }
    .status-btn {
      padding: 10px 20px;
      font-size: 0.875rem;
      text-transform: uppercase;
      border-radius: 50px;
      margin-right: 10px;
      transition: transform 0.2s;
    }
    .status-btn:hover {
      transform: scale(1.05);
    }
    .icon {
      font-size: 1.2rem;
      color: #343a40;
      margin-right: 10px;
    }
    .info-container {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }
    .info-container .icon {
      min-width: 30px;
    }
    .info-container label {
      margin: 0;
      flex: 1;
    }
    .info-container input {
      flex: 2;
      padding-left: 10px;
      padding-right: 10px;
    }
    .message-card {
      margin-top: 30px;
      border-radius: 15px;
      background-color: #e9f7ef;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .message-card .card-header {
      background-color: #2ecc71;
      color: white;
      font-weight: bold;
    }
    .message-card .card-body {
      background-color: #e9f7ef;
      color: #2c3e50;
    }
    .message-card .blockquote-footer {
      color: #16a085;
    }
    .btn-custom {
      padding: 10px 20px;
      font-size: 1rem;
      border-radius: 50px;
      text-transform: uppercase;
    }
    .btn-pending {
      background-color: #f39c12;
      color: white;
    }
    .btn-wawancara, .btn-tes, .btn-proses {
      background-color: #3498db;
      color: white;
    }
    .btn-sukses {
      background-color: #2ecc71;
      color: white;
    }
    .btn-danger {
      background-color: #e74c3c;
      color: white;
      min-width: 139px;
      margin-right: 120px;
      margin-top: -80px;
    }
    .btn-info {
      background-color: #3498db;
      color: white;
    }
    .text-center {
      text-align: center;
      margin-top: 10px;
    }
    .text-left {
      text-align: left;
    }
    .progress-container {
      margin: 20px auto;
      width: 80%;
    }
    .status-btn {
      width: 140px;
       margin-left: auto;
       margin-right: 590px;
    }
  </style>
</head>
<body>
  <?php include "header.php"; ?>
  <br><br><br>
  <div class="main-container">
    <?php 
      include '../conn.php';
      $id_user = $_SESSION['data-user'];
      $query = $conn->query("SELECT * FROM pengajuan a, lowongan b, user c WHERE a.id_lowongan=b.id_lowongan AND a.id_user=c.id_user AND c.id_user='$id_user'");
      $sql = $conn->query("SELECT * FROM user WHERE id_user='$id_user'");
      $tampil = $sql->fetch_array();
      while($data = $query->fetch_array()) {
    ?>

    <?php
      $data['status_role'] = $data['status_role']; // Contoh status, bisa diganti sesuai kebutuhan

      $status = [
          'seleksi_berkas' => ['text' => 'Seleksi Berkas', 'percentage' => 20, 'class' => 'warning'],
          'tunggu_test' => ['text' => 'Tunggu Hasil Test', 'percentage' => 40, 'class' => 'warning'],
          'ikut_tes' => ['text' => 'Mengikuti Tes', 'percentage' => 60, 'class' => 'primary'],
          'wawancara' => ['text' => 'Wawancara', 'percentage' => 80, 'class' => 'primary'],
          'proses' => ['text' => 'Proses', 'percentage' => 90, 'class' => 'primary'],
          'dikeluarkan' => ['text' => 'Dikeluarkan', 'percentage' => 0, 'class' => 'danger'],
          'gagal_seleksi' => ['text' => 'Gagal Seleksi', 'percentage' => 0, 'class' => 'danger'],
          'sukses' => ['text' => 'Sukses', 'percentage' => 100, 'class' => 'success'],
      ];

      $current_status = $status[$data['status_role']] ?? $status['sukses'];
      ?>

    <div class="progress-container">
        <div class="progress">
            <div class="progress-bar bg-<?= $current_status['class'] ?>" role="progressbar" style="width: <?= $current_status['percentage'] ?>%;" aria-valuenow="<?= $current_status['percentage'] ?>" aria-valuemin="0" aria-valuemax="100">
                <?= $current_status['percentage'] ?>%
            </div>
        </div>
        
    </div>
    <div class="card">
      <div class="card-body">
        <div class="info-container">
          <i class="fas fa-user icon"></i>
          <label>Nama Lengkap:</label>
          <input type="text" value="<?php echo $data["nama_lengkap"]; ?>" class="form-control" readonly>
        </div>
        <div class="info-container">
          <i class="fas fa-briefcase icon"></i>
          <label>Lowongan:</label>
          <input type="text" value="<?php echo $data["nama_lowongan"]; ?>" class="form-control" readonly>
        </div>
        <div class="info-container">
          <i class="fas fa-list icon"></i>
          <label>Kategori Lowongan:</label>
          <input type="text" value="<?php echo $data["kategori_lowongan"]; ?>" class="form-control" readonly>
        </div>
        <?php if($data['status_role'] == 'wawancara') { ?>
        <div class="info-container">
          <i class="fas fa-calendar-alt icon"></i>
          <label>Tanggal wawancara:</label>
          <input type="text" value="<?php echo $data["tanggal_wawancara"]; ?>" class="form-control" readonly>
        </div>
        <div class="info-container">
          <i class="fas fa-calendar-alt icon"></i>
          <label>Link wawancara:</label>
          <input type="text" value="<?php echo $data["link_wawancara"]; ?>" class="form-control" readonly>
        </div>
        <?php } ?>
        <?php if($data['status_role'] == 'proses') { ?>
        <div class="info-container">
          <i class="fas fa-calendar-alt icon"></i>
          <label>Dari Tanggal:</label>
          <input type="text" value="<?php echo $data["dari_tanggal"]; ?>" class="form-control" readonly>
        </div>
        <div class="info-container">
          <i class="fas fa-calendar-alt icon"></i>
          <label>Sampai Tanggal:</label>
          <input type="text" value="<?php echo $data["sampai_tanggal"]; ?>" class="form-control" readonly>
        </div>
        <div class="info-container">
          <i class="fas fa-dollar-sign icon"></i>
          <label>Gaji:</label>
          <input type="text" value="<?php echo $data["gaji"]; ?>" class="form-control" readonly>
        </div>
        <br><br>

        <a href="kegiatan.php">Isi kegiatan</a>
        <?php } ?>

        <?php if($data['status_role'] == 'sukses') { ?>
        <div class="info-container">
          <i class="fas fa-calendar-alt icon"></i>
          <label>Dari Tanggal:</label>
          <input type="text" value="<?php echo $data["dari_tanggal"]; ?>" class="form-control" readonly>
        </div>
        <div class="info-container">
          <i class="fas fa-calendar-alt icon"></i>
          <label>Sampai Tanggal:</label>
          <input type="text" value="<?php echo $data["sampai_tanggal"]; ?>" class="form-control" readonly>
        </div>
        <div class="info-container">
          <i class="fas fa-dollar-sign icon"></i>
          <label>Gaji:</label>
          <input type="text" value="<?php echo $data["gaji"]; ?>" class="form-control" readonly>
        </div>
        <?php } ?>
        <div class="info-container ">
          <i class="fas fa-info-circle icon"></i>
          <label>Status:</label>
          <div>
          <?php 
            switch ($data['status_role']) {
              case 'seleksi_berkas':
                echo '<div class="d-flex justify-content-center">
                        <a href="#" class="btn btn-wawancara btn-warning btn-custom status-btn" style="width: 140px; margin-left: auto; margin-right: 590px;">Seleksi Berkas</a>
                      </div>';
                break;
              case 'tunggu_test':
                echo '<div class="d-flex justify-content-center">
                        <a href="#" class="btn btn-wawancara btn-warning btn-custom status-btn" style="width: 140px; margin-left: auto; margin-right: 590px;">Tunggu Hasil Test</a>
                      </div>';
                break;
              case 'wawancara':
                echo '<div class="d-flex justify-content-center">
                        <a href="#" class="btn btn-wawancara btn-primary btn-custom status-btn" style="width: 140px; margin-left: auto; margin-right: 590px;">Wawancara</a>
                      </div>';
                break;
              case 'ikut_tes':
                echo '<div class="d-flex justify-content-center">
                        <a href="userUjian.php" class="btn btn-wawancara btn-primary btn-custom status-btn" style="width: 140px; margin-left: auto; margin-right: 590px;">Mengikuti tes</a>
                      </div>';
                break;
              case 'proses':
                 echo '<div class="d-flex justify-content-center">
                        <a href="#" class="btn btn-proses btn-primary btn-custom status-btn" style="width: 140px; margin-left: auto; margin-right: 590px;">Proses</a>
                      </div>';
                break;
              case 'dikeluarkan':
                echo '<div class="d-flex justify-content-center">
                        <a href="#" class="btn btn-wawancara btn-danger btn-custom status-btn" style="width: 140px; margin-top:20px; margin-left: auto; margin-right: 590px;">Dikeluarkan</a>
                      </div>';
                break;
              case 'gagal_seleksi':
                echo '<div class="d-flex justify-content-center">
                        <a href="#" class="btn btn-wawancara btn-danger btn-custom status-btn" style="width: 140px; margin-top:20px; margin-left: auto; margin-right: 590px;">Gagal Seleksi</a>
                      </div>';
                break;
              default:
              echo '<div class="d-flex justify-content-center">
              <a href="#" class=" btn btn-success btn-custom status-btn" style="width: 140px; margin-left: auto; margin-right: 590px;">Sukses</a>
            </div>';
            }
          ?>
          </div>
        </div>
        <?php if($data['status_role'] != 'sukses') { ?>
        <!-- <div class="info-container">
          <i class="fas fa-times-circle icon"></i>
          <label>Aksi:</label>
        </div>
        <div class="text-center">
          <a class="btn btn-danger btn-custom status-btn" style=""
             href="hapus-pengajuan.php?id=<?php echo $data['id_pengajuan']; ?>" 
             onclick="return confirm('Yakin ingin membatalkan?');">Batalkan</a>
        </div> -->
        <?php } ?>

        <footer class="blockquote-footer"><?php echo date('Y-m-d'); ?><cite title="Source Title"> , Timeline Anda</cite></footer>
      </div>
    <?php } ?>

    <div class="container my-4 p-4" style="overflow:auto;">
      <?php
        $lowongan = $conn->query("SELECT * FROM pengajuan a, lowongan b, user c WHERE a.id_lowongan=b.id_lowongan AND a.id_user=c.id_user AND c.id_user ='$id_user' ");
        $result = $lowongan->fetch_array(); 
        if ($tampil['status_role'] == 'proses') {
      ?>
      <div class="card message-card">
        <div class="card-header">
          Catatan
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <h5 style="font-size: 17px;">
              <strong style="font-size: 22px;">Halo, Selamat Anda telah di ACC oleh Admin <b>Smart Kerja</b>.</strong>
              <br><br> Selamat bekerja semoga hari mu selalu menyenangkan</b>
            </h5>
            <p>Jika ada pertanyaan atau ingin tahu info lebih lanjut mengenai lowongan, atau perubahan status pekerjaan ke <b style="color: blue;">sukses</b>, silahkan kirim pesan ke admin
              <a href="ubah-user.php?id=<?php echo $result['id_user']; ?>" class="btn btn-primary btn-sm">Kirim Pesan</a>
            </p>
            <footer class="blockquote-footer" style="margin-top: 15px;"><?php echo date('Y-m-d'); ?> <cite title="Source Title">Have a nice day!</cite></footer>
          </blockquote>
        </div>
      </div>
      <?php } else if ($tampil['status_role'] == 'seleksi_berkas') { ?>
      <div class="card message-card" style="overflow:auto;">
        <div class="card-header">
          Pesan
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <h5>Harap Sabar ya, <br><br> Admin <b>Blue Innovation</b> akan konfirmasi dalam waktu 2x24 jam</h5>
            <footer class="blockquote-footer" style="margin-top: 15px;"><?php echo date('Y-m-d'); ?> <cite title="Source Title">Have a nice day!</cite></footer>
          </blockquote>
        </div>
      </div>
      <?php } else if ($tampil['status_role'] == 'tunggu_test') { ?>
      <div class="card message-card" style="overflow:auto;">
        <div class="card-header">
          Pesan
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <h5>Harap Sabar ya, <br><br> Admin <b>Blue Innovation</b> akan konfirmasi dalam waktu 1x24 jam</h5>
            <footer class="blockquote-footer" style="margin-top: 15px;"><?php echo date('Y-m-d'); ?> <cite title="Source Title">Have a nice day!</cite></footer>
          </blockquote>
        </div>
      </div>
      <?php } else if ($tampil['status_role'] == 'ikut_tes') { ?>
      <div class="card message-card">
        <div class="card-header">
          Pesan
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <h5>Selamat mengerjakan soal, semoga mendapat hasil terbaik: <a href="userUjian.php">link</a></h5>
            <footer class="blockquote-footer" style="margin-top: 15px;"><?php echo date('Y-m-d'); ?> <cite title="Source Title">Have a nice day!</cite></footer>
          </blockquote>
        </div>
      </div>
      <?php } else if ($tampil['status_role'] == 'wawancara') { ?>
      <div class="card message-card">
        <div class="card-header">
          Pesan
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <h5>Selamat, kamu lolos tahap wawancara</h5>
            <h5>Tanggal wawancara: <?php echo $tampil['tanggal_wawancara']; ?> </h5>
            <h5>Link untuk mengaksesnya: <a href="<?php echo $tampil['link_wawancara']; ?>">link</a></h5>
            <footer class="blockquote-footer" style="margin-top: 15px;"><?php echo date('Y-m-d'); ?> <cite title="Source Title">Have a nice day!</cite></footer>
          </blockquote>
        </div>
      </div>
      <?php } else if ($tampil['status_role'] == 'dikeluarkan') { ?>
      <div class="card message-card" style="overflow:auto;">
        <div class="card-header">
          Pesan
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <h5>Maaf anda sudah dikeluarkan</h5>
            <footer class="blockquote-footer" style="margin-top: 15px;"><?php echo date('Y-m-d'); ?> <cite title="Source Title">Have a nice day!</cite></footer>
          </blockquote>
        </div>
      </div>
      <?php } else if ($tampil['status_role'] == 'gagal_seleksi') { ?>
      <div class="card message-card" style="overflow:auto;">
        <div class="card-header">
          Pesan
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <h5>Maaf anda gagal lolos</h5>
            <footer class="blockquote-footer" style="margin-top: 15px;"><?php echo date('Y-m-d'); ?> <cite title="Source Title">Have a nice day!</cite></footer>
          </blockquote>
        </div>
      </div>
      <?php } else if ($tampil['status_role'] == 'sukses') { ?>
      <div class="row">
        <div class="card col-md-4 text-center message-card">
          <img src="img_gambar/sertif.png" class="card-img-top" alt="Sertifikat">
          <div class="card-body">
            <p class="card-text">Silahkan download sertifikat Anda di sini:</p>
            <a href="mpdf/index.php?id=<?php echo $result['id_user']; ?>" target="_blank" class="btn btn-info btn-custom">Download</a>
          </div>
        </div>
        <div class="card col-md-7 ms-md-3 message-card">
          <div class="card-header">
            Pesan
          </div>
          <div class="card-body">
            <blockquote class="blockquote mb-0">
              <p>Selamat <b><?php echo $result['nama']; ?></b>, Kamu sudah menyelesaikan kerja.<br><br>
                <strong style="font-size: 17px; font-style: italic;">
                  Note: Jika sertifikat Anda belum ada, silahkan kirim pesan ke admin
                  <a href="ubah-user.php?id=<?php echo $result['id_user']; ?>" class="btn btn-primary btn-sm">Kirim Pesan</a>
                </strong>
              </p>
              <footer class="blockquote-footer" style="margin-top: 15px;"><?php echo date('Y-m-d'); ?> <cite title="Source Title">Have a nice day!</cite></footer>
            </blockquote>
          </div>
        </div>
      </div>
      <?php } else { ?>
      <div class="card message-card" style="overflow:auto;">
        <div class="card-header">
          Pesan
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <h5>Maaf anda belum mengajukan pengajuan</h5>
            <footer class="blockquote-footer" style="margin-top: 15px;"><?php echo date('Y-m-d'); ?> <cite title="Source Title">Have a nice day!</cite></footer>
          </blockquote>
        </div>
      </div>
      <?php } ?>
      <?php
      if ($tampil['status_role'] == 'proses') {
        ?>
          <h3>Performa</h3>
  <table id="table_id" class="display">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama lengkap </th>
            <th scope="col">Kualitas Kerja</th>
            <th scope="col">Kuantitas Kerja</th>
            <th scope="col">Kompetensi teknis</th>
            <th scope="col">Sikap perilaku</th>
            <th scope="col">Komunikasi</th>
            <th scope="col">Total</th>
            <th scope="col">Tahun</th>
            <th scope="col">Pesan</th>

        </tr>
    </thead>
    <tbody>
        <?php      
      $query = $conn->query("SELECT * FROM performa a, user b WHERE a.id_user=b.id_user AND a.id_user ='$id_user' " );
      //while
      $i = 1;
      while($data = $query->fetch_array()){
        ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data['nama_lengkap']; ?></td>
            <td><?php echo $data['kualitas_kerja'] ?></td>
            <td><?php echo $data['kuantitas_kerja'] ?></td>
            <td><?php echo $data['kompetensi_teknis']; ?></td>
            <td><?php echo $data['sikap_perilaku']; ?></td>
            <td><?php echo $data['komunikasi']; ?></td>
            <td><?php 
                    $kualitas_kerja =  $data['kualitas_kerja']; 
                    $kuantitas_kerja =  $data['kuantitas_kerja']; 
                    $kompetensi_teknis =  $data['kompetensi_teknis']; 
                    $sikap_perilaku =  $data['sikap_perilaku']; 
                    $komunikasi =  $data['komunikasi']; 

                    $hasil =  $kualitas_kerja + $kuantitas_kerja + $kompetensi_teknis + $sikap_perilaku + $komunikasi;
                    $hasil_akhir = $hasil * 2;
            
            ?><?php echo $hasil_akhir; ?></td>
            <td><?php echo $data['tahun']; ?></td>
            <td><?php echo $data['pesan']; ?></td>
            
          </tr>
        <?php
        $i++;
      }
    ?>
    </tbody>
</table>
        <?php
      }
      ?>
      
</div> 
</div>
          </div>
        </div>
    </div>
    </div>
  </div>
  <?php include "footer.php"; ?>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- datatables.net di cdn -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script type="text/javascript">
    $(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>