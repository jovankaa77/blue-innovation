<?php
include('../conn.php');
session_start();
if(!isset($_SESSION['member'])){
  header("Location: /web_kuliah_test/index.php");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'];
    $sql = $conn->query("SELECT * FROM kegiatan WHERE id_user ='$id_user'");
    $tampil = $sql->fetch_array();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Biodata</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .container-biodata {
            margin: 200px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="file"], select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    
<?php include "header.php"; ?>
    <div class="container-biodata">
        <h2>Edit Biodata</h2>
        <form action="edit_proses_kegiatan.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($id_user); ?>">

            <label for="nama_kegiatan">Nama kegiatan:</label>
            <input type="text" name="nama_kegiatan" id="nama_kegiatan" value="<?php echo htmlspecialchars($tampil['nama_kegiatan']); ?>">
            <br>

            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" id="tanggal" value="<?php echo htmlspecialchars($tampil['tanggal']); ?>">
            <br>

            <label for="deskripsi">Deskripsi:</label>
            <input type="text" name="deskripsi" id="deskripsi" value="<?php echo htmlspecialchars($tampil['deskripsi']); ?>">
            <br>

            <label for="gambar">Bukti kegiatan:</label>
            <input type="file" name="bukti_kegiatan" id="gambar">
            <br>

            
            <br>
            <br>
            <button type="submit">Update</button>
        </form>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>
<?php
} else {
    echo "Invalid request.";
}
?>
