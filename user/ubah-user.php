<?php
session_start();
if (!isset($_SESSION['member'])) {
    header("Location: /web_kuliah_test/index.php");
}
include '../conn.php';
$id = $_GET['id'];
$query = $conn->query("SELECT * FROM user WHERE id_user='$id'");
$data = $query->fetch_array();
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="bs/css/bootstrap.min.css">
    <style>
        .container {
            margin: 105px auto;
        }
        .card-img {
            width: 100%;
            height: 60%;
            object-fit: cover;
            height: 100%;
        }
        input:hover {
            border: inline;
            border: 2px solid lightgreen;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <div class="oyo card mb-3" style="max-width: 100%; margin: 30px auto; box-shadow: 3px 3px 3px #dab3ff;">
            <div class="row no-gutters">
                <div class="col-md-5">
                    <img src="img_gambar/user.png" class="card-img" alt="..." style="object-fit: cover; height: 100%;">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <form action="" method="post" autocomplete="off">
                            <div class="form-group">
                                <label>Nama Lengkap:</label>
                                <input type="text" name="nama_lengkap" value="<?php echo $data['nama_lengkap']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Username:</label>
                                <input type="text" name="nama" value="<?php echo $data['nama']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password:</label>
                                <input type="password" name="password" value="<?php echo $data['password']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Usia:</label>
                                <input type="text" name="usia" value="<?php echo $data['usia']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Domisili:</label>
                                <input type="text" name="domisili" value="<?php echo $data['domisili']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Negara:</label>
                                <input type="text" name="negara" value="<?php echo $data['negara']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Kontak:</label>
                                <input type="text" name="kontak" value="<?php echo $data['kontak']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" value="<?php echo $data['email']; ?>" class="form-control">
                            </div>
                            <!-- <div class="form-group">
                                <label>Kirim Pesan:</label>
                                <textarea name="pesan" autofocus="" placeholder="Silahkan Isi Pesan Mu" style="background-color: linen;"></textarea>\
                            </div> -->
                            <button name="submit" type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda Yakin Ingin Mengubah Data?')">Submit</button>
                            <a href="test_user_profile.php" class="btn btn-info">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $nama_lengkap = trim(htmlspecialchars($_POST['nama_lengkap']));
    $nama = trim(htmlspecialchars($_POST['nama']));
    $password = trim(htmlspecialchars($_POST['password']));
    $usia = trim(htmlspecialchars($_POST['usia']));
    $domisili = trim(htmlspecialchars($_POST['domisili']));
    $negara = trim(htmlspecialchars($_POST['negara']));
    $kontak = trim(htmlspecialchars($_POST['kontak']));
    $email = trim(htmlspecialchars($_POST['email']));

    $queryUpdate = $conn->query("UPDATE user 
                           SET nama='$nama', 
                               password='$password', 
                               nama_lengkap='$nama_lengkap',  
                               usia='$usia',
                               domisili='$domisili', 
                               negara='$negara', 
                               kontak='$kontak', 
                               email='$email' 
                           WHERE id_user='$id'");

    if (!$queryUpdate) {
        die(mysqli_error($conn));
    } else {
        echo '<script type="text/javascript">
            swal({
                title: "Berhasil!",
                text: "Profil berhasil diubah diubah",
                icon: "success",
                button: "Oke!",
            })
            .then((value) => {
                window.location.href = "test_user_profile.php";
            });
            </script>';
        }
    }
?>
