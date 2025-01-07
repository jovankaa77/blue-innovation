<?php

include '../conn.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'];
    $url_linkedin = $_POST['url_linkedin'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jk'];
    $cv = $_FILES['cv']['name'];

    // Handle file upload
    if ($cv) {
        $cv_path = 'uploads/' . $cv;
        move_uploaded_file($_FILES['cv']['tmp_name'], $cv_path);
        $sql = $conn->query("UPDATE biodata SET url_linkedin='$url_linkedin', alamat='$alamat', jk='$jk', cv='$cv' WHERE id_user='$id_user'");
    } else {
        $sql = $conn->query("UPDATE biodata SET url_linkedin='$url_linkedin', alamat='$alamat', jk='$jk' WHERE id_user='$id_user'");
    }

    if ($sql) {
        header("Location:biodata.php");
    } else {
        echo "Error updating biodata: " . $conn->error;
    }
}
?>
