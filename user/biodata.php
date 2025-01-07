<?php
    //Harus Login Terlebih Dahulu
session_start();
if(!isset($_SESSION['member'])){
  header("Location: /web_kuliah_test/index.php");
}

include "../conn.php" ;

include "upload.php";

$id_user = $_SESSION['data-user'];
// Cek apakah form telah disubmit
if (isset($_POST["submit"])) {
    // Cek apakah pengguna telah login
    if (isset($_SESSION['data-user'])) { // Ambil id_user dari sesi

        // Periksa apakah sudah ada data biodata untuk id_user ini
        $stmt_check = $conn->prepare("SELECT id_user FROM biodata WHERE id_user = ?");
        $stmt_check->bind_param("i", $id_user);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            // Jika sudah ada data biodata untuk id_user ini, tampilkan pesan kesalahan
            $message = "Sudah Mengisi data!";
        } else {
            // Jika belum ada data biodata untuk id_user ini, lanjutkan proses insert
            $url_linkedin = $_POST['url_linkedin'];
            $alamat = $_POST['alamat'];
            $jk = $_POST['jk'];
            $gambar = upload(); // Fungsi upload untuk mengunggah file

            if(!$gambar){
                $message = "Gagal mengunggah CV.";
            } else {
                // Insert data biodata baru
                $stmt_insert = $conn->prepare("INSERT INTO biodata (url_linkedin, alamat, cv, jk, id_user) VALUES (?, ?, ?, ?, ?)");
                $stmt_insert->bind_param("ssssi", $url_linkedin, $alamat, $gambar, $jk, $id_user);

                if ($stmt_insert->execute()) {
                    $message = "berhasil dimasukkan ke dalam database.";
                } else {
                    $message = "Error: " . $stmt_insert->error;
                }
            }
        }

        $stmt_check->close();
    } else {
        $message = "Anda belum login. Silakan login terlebih dahulu.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <title>Form Biodata</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container-biodata{
            margin: 110px auto;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }
        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #f2f2f2;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        .btn-edit {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
        }
        .btn-edit:hover {
            background-color: #45a049;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"], input[type="file"], button, input[type="radio"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="radio"] {
            width: auto;
            margin-right: 10px;
        }

        .biodata {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 16px;
        }

        .biodata:hover {
            background-color: purple;
        }

        p {
            color: #333;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    
<?php include "header.php"; ?>
    
    <div class="container-biodata">
        
        <form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
            <?php
         if (isset($message)) {
                echo "<p>$message</p>";
            }
        ?>
        <label for="url_linkedin">URL linkedin:</label>
        <input type="text" id="url_linkedin" name="url_linkedin" required><br>

        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" required><br>

        <label for="cv">CV:</label>
        <input type="file" id="cv" name="gambar" required><br>
        
        <label for="jk">Jenis Kelamin:</label>
        <input type="radio" id="jk_l" name="jk" value="L" required> Laki-laki
        <input type="radio" id="jk_p" name="jk" value="P" required> Perempuan<br>

        <button name="submit" class="biodata">Submit</button>
        </form>

        <div class="table-biodata">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th scope="col">URL linkedin</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">CV</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = $conn->query("SELECT * FROM biodata WHERE id_user ='$id_user'");

                $tampil = $sql->fetch_array();

                if ($sql->num_rows === 0) {
                    echo '<tr><td colspan="5">Belum ada data biodata.</td></tr>';
                } 
                else {
                ?>
                <tr>
                    <td><?php echo $tampil['url_linkedin']; ?></td>
                    <td><?php echo $tampil['alamat']; ?></td>
                    <td>
                        <?php
                        $cv_path = '../uploads/' . $tampil['cv'];
                        ?>
                        <img src="<?php echo $cv_path ?>" alt="" width="100px">
                    </td>
                    <td><?php echo ($tampil['jk'] == 'L') ? 'Laki-laki' : 'Perempuan'; ?></td>
                    <td>
                        <form action="edit_biodata.php" method="post">
                            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                            <button type="submit">Edit</button>
                        </form>
                    </td>
                </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<?php include "footer.php"; ?>
</html>