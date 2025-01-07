<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/styleReg.css">
        <title>Register</title>
    </head>

    <body>
        <div class="container">
            <div class="form-wrapper">
                <div class="register-container">
                    <img class="logo" src="assets/logo.png" alt="Logo">
                    <h1>Create your account</h1>
                </div>
                <form class="my-form" method="POST" action="">
                    <div class="text-field">
                        <input type="hidden" name="status_role" class="form-control" value="belum_mengajukan">
                        <input type="hidden" name="domisili" class="form-control" value="">
                        <input type="hidden" name="usia" class="form-control" value="">
                        <input type="hidden" name="negara" class="form-control" value="">
                        <input type="hidden" name="kontak" class="form-control" value="">
                        <input type="hidden" name="email" class="form-control" value="">
                        <input type="hidden" name="dari_tanggal" value="belum di tentukan">
                        <input type="hidden" name="sampai_tanggal" value="belum di tentukan">
                        <input type="hidden" name="link" value="kosong">
                    </div>
                    <div class="text-field">
                        <label for="email">Username:
                            <input type="text" id="username" name="nama" autocomplete="off" placeholder="Your Username" required>
                        </label>
                    </div>
                    <div class="text-field">
                        <label for="email">Fullname:
                            <input type="text" id="fullname" name="nama_lengkap" autocomplete="off" placeholder="Your Fullname" required>
                        </label>
                    </div>
                    <div class="text-field">
                        <label for="password">Password:
                            <input id="password" type="password" name="password" placeholder="Your Password" 
                                title="Minimum 6 characters at least 1 Alphabet and 1 Number"
                                pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$" required>
                        </label>
                    </div>
                    <input type="hidden" name="level" value="member" id="">
                    <input class="my-form-button" type="submit" name="submit" value="Sign Up">
                    <div class="my-form-actions">
                        <div class="my-form-row">
                            <p>Sudah punya akun?<p>
                        </div>
                        <div class="my-form-login">
                            <a href="login.php">
                                Login
                            </a>
                        </div>
                    </div>
                </form>
                <p class="my-form-footer">Create by - Blue inovation 2024</p>
            </div>
        </div>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </body>

    </html>

    <?php
    session_start();
        // Cek jika tombol submit telah ditekan
        if (isset($_POST["submit"])) {
            // Sertakan file koneksi database
            include "../conn.php";

            // Ambil data dari form
            $status_role = htmlspecialchars($_POST["status_role"]);
            $nama = htmlspecialchars($_POST["nama"]);
            $pass = htmlspecialchars($_POST["password"]);
            $nama_lengkap = htmlspecialchars($_POST["nama_lengkap"]);
            $level = htmlspecialchars($_POST["level"]);
            $domisili = htmlspecialchars($_POST["domisili"]);
            $usia = htmlspecialchars($_POST["usia"]);
            $negara = htmlspecialchars($_POST["negara"]);
            $kontak = htmlspecialchars($_POST["kontak"]);
            $email = htmlspecialchars($_POST["email"]);
            $dari_tanggal = htmlspecialchars($_POST['dari_tanggal']);
            $sampai_tanggal = htmlspecialchars($_POST['sampai_tanggal']);
            $link = htmlspecialchars($_POST['link']);

            // Cek apakah username sudah ada di database
            $query = $conn->query("SELECT id_user, nama FROM user WHERE nama ='$nama'");
            $data = $query->fetch_array();

            if (!$query) {
                die(mysqli_error($conn));
            } else if ($data && $nama === $data["nama"]) { // Pastikan $data tidak null sebelum mengakses $data["nama"]
                echo "<script>
                    alert('Username Sudah Tersedia');
                    document.location.href = 'register.php';
                </script>";
                return false;
            } else {
                // Jika username belum ada, lakukan insert data
                $insertQuery = $conn->query("INSERT INTO user (nama, password, nama_lengkap, level, status_role, domisili, usia, negara, kontak, email, dari_tanggal, sampai_tanggal, link) VALUES ('$nama', '$pass', '$nama_lengkap', '$level', '$status_role', '$domisili', '$usia', '$negara', '$kontak', '$email', '$dari_tanggal', '$sampai_tanggal', '$link')");

                if ($insertQuery) {
                    // Set session for the user
                    $_SESSION['member'] = $nama;
                    $last_id = $conn->insert_id; // Mengambil ID terakhir yang dimasukkan
                    $_SESSION['data-user'] = $last_id;

                    echo '<script type="text/javascript">
                        swal({
                            title: "Register Berhasil!",
                            text: "Selamat datang di Blue Innovation!",
                            icon: "success",
                            button: "Oke!"
                        }).then((value) => {
                            window.location.href = "../user/test_halaman_utama.php";
                        });
                    </script>';
                } else {
                    die(mysqli_error($conn));
                }
            }
        }
    ?>
