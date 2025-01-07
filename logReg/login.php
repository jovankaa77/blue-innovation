<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/styleLog.css">
        <title>Login</title>
    </head>

    <body>
        <div class="container">
            <div class="form-wrapper">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <a class="btn btn-primary btn-sm" href="../index.php">Kembali</a>
            </div> 
                <div class="login-container">
                    <img class="logo" src="assets/logo.png" alt="Logo">
                    <h1>BLUE INNOVATION</h1>
                </div>
                <form class="my-form" method="POST" action="">
                    <div class="text-field">
                        <label for="username">Username:</label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            placeholder="Your Username"
                            required
                        >
                        <img
                            alt="Email Icon"
                            title="Email Icon"
                            src="assets/email.png"
                        >
                    </div>
                    <div class="text-field">
                        <label for="password">Password:</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Your Password"
                            required
                        >
                        <img
                            alt="Password Icon"
                            title="Password Icon"
                            src="assets/password.png"
                        >
                    </div>
                    <input type="submit" name="submit" class="my-form-button" value="Login">
                </form>
                    <div class="my-form-actions">
                        <div class="my-form-row">
                            <p>Belum punya akun?</p>
                        </div>
                        <div class="my-form-signup">
                            <a href="register.php" title="Create Account">
                                Create Account
                            </a>
                        </div>
                    </div>
                <p class="my-form-footer">Create by - Blue Innovation 2024</p>
            </div>
        </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </body>

    <?php 
    session_start();
    include "../conn.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $query = "SELECT id_user, nama, password, level 
                FROM user 
                WHERE nama = '$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if ($password == $row['password']) { // Langsung membandingkan password teks biasa
                $_SESSION['data-user'] = $row['id_user']; // Simpan id_user ke dalam sesi
                $_SESSION['nama'] = $row['nama']; // Simpan nama user ke dalam sesi
                $_SESSION['level'] = $row['level']; // Simpan level user ke dalam sesi

                // Uji Level
                if ($row['level'] == 'Admin') {
                    $_SESSION['admin'] = $row['nama'];
                    header("Location:../admin/dashboardAdmin/dashboard.php");
                } 
                else if ($row['level'] == 'Member') {
                    $_SESSION['member'] = $row['nama'];
                    header("Location:../user/test_halaman_utama.php");
                }
                exit();
            } 
            else {
                echo ' . ?>
                    <script type="text/javascript">
                        swal({
                            title: "Login Gagal!",
                            text: "Password Tidak Sesuai!",
                            icon: "error",
                            button: "Oke!",
                            });

                    </script>
                <?php '  ;
            }
        } 
        else {
            echo ' . ?>
            <script type="text/javascript">
                swal({
                    title: "Login Gagal!",
                    text: "Username tidak tersedia!",
                    icon: "error",
                    button: "Oke!",
                    });

            </script>
        <?php '  ;
        }
    }
    ?>