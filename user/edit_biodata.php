<?php
include('../conn.php');
session_start();
if(!isset($_SESSION['member'])){
  header("Location: /web_kuliah_test/index.php");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'];
    $sql = $conn->query("SELECT * FROM biodata WHERE id_user ='$id_user'");
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
        <form action="edit_proses_biodata.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($id_user); ?>">

            <label for="url_linkedin">URL Linkedin:</label>
            <input type="text" name="url_linkedin" id="url_linkedin" value="<?php echo htmlspecialchars($tampil['url_linkedin']); ?>">
            <br>

            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" id="alamat" value="<?php echo htmlspecialchars($tampil['alamat']); ?>">
            <br>

            <label for="cv">CV:</label>
            <input type="file" name="cv" id="cv">
            <br>

            <label for="jk">Jenis Kelamin:</label>
            <select name="jk" id="jk">
                <option value="L" <?php echo ($tampil['jk'] == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                <option value="P" <?php echo ($tampil['jk'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
            </select>
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
