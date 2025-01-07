<?php
session_start();
if (!isset($_SESSION['member'])) {
    header("Location: /web_kuliah_test/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profil Pengguna</title>
    <link rel="stylesheet" type="text/css" href="bs/css/bootstrap.min.css">
    <style>
        .card-img {
            width: 100%;
            height: 100%;
            border-radius: 50px; 
            object-fit: cover; 
            object-position: center; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
            border: 2px solid #ddd;
            padding: 2%;
        }
        img .card-img {
            border-radius: 50px;
        }
        .container {
            margin: 105px auto;
        }
        .card-title {
            width: 150px; 
            display: inline-block;
            margin-right: 10px; 
        }
        .btn-primary {
            display: block; /* Mengubah tombol menjadi elemen blok */
            width: 100%; /* Membuat lebar tombol menyesuaikan kontainer */
            margin-top: 10px; /* Jarak antara elemen sebelumnya dan tombol */
        }
    </style>
</head>
<body>
    <?php include "header.php"; ?>
    <div class="container">
        <div class="oyo card mb-3" style="max-width: 80%; margin: 30px auto; box-shadow: 3px 3px 3px #dab3ff;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="img_gambar/user.png" class="card-img" alt="...">
                </div>
                <?php 
                include '../conn.php';
                $username = $_SESSION['member']; // Mengambil username dari sesi
                $sql = "SELECT id_user, nama, password, nama_lengkap, level, status_role, usia, negara, domisili, kontak, email FROM user WHERE nama = '$username'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $tampil = $result->fetch_assoc(); // Mengambil baris data pengguna
                ?>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $tampil['nama_lengkap']; ?></h3> 
                        <hr>
                        <p class="card-title">Username:</p> <?php echo $tampil['nama']; ?><br>
                        <p class="card-title">Password:</p> <input type="password" value="<?php echo $tampil['password']; ?>" style="border:none;" readonly><br>
                        <p class="card-title">Level:</p> <?php echo $tampil['level']; ?><br>
                        <p class="card-title">Status Role:</p> <?php echo $tampil['status_role']; ?><br>
                        <p class="card-title">Usia:</p> <?php echo $tampil['usia']; ?><br>
                        <p class="card-title">Negara:</p> <?php echo $tampil['negara']; ?><br>
                        <p class="card-title">Domisili:</p> <?php echo $tampil['domisili']; ?><br>
                        <p class="card-title">Kontak:</p> <?php echo $tampil['kontak']; ?><br>
                        <p class="card-title">Email:</p> <?php echo $tampil['email']; ?><br>
                        <a href="ubah-user.php?id=<?php echo $tampil['id_user']; ?>" class="btn btn-primary">Ubah</a>
                    </div>
                </div>
                <?php 
                } 
                else {
                    echo "<p>Data pengguna tidak ditemukan.</p>";
                }
                ?>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
