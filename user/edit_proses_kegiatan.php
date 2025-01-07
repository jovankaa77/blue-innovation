<?php

include '../conn.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'];
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $tanggal = $_POST['tanggal'];
    $deskripsi = $_POST['deskripsi'];
    $cv = $_FILES['bukti_kegiatan']['name'];

    // Handle file upload
    if ($cv) {

        
        $cv_path = 'uploads/' . $cv;
        move_uploaded_file($_FILES['bukti_kegiatan']['tmp_name'], $cv_path);
        $sql = $conn->query("UPDATE kegiatan SET nama_kegiatan='$nama_kegiatan', tanggal='$tanggal', deskripsi='$deskripsi', bukti_kegiatan='$cv' WHERE id_user='$id_user'");
    } else {
        $sql = $conn->query("UPDATE kegiatan SET nama_kegiatan='$nama_kegiatan', tanggal='$tanggal', deskripsi='$deskripsi' WHERE id_user='$id_user'");
    }

    if ($sql) {
        header("Location:kegiatan.php");
    } else {
        echo "Error updating kegiatan: " . $conn->error;
    }
}
?>
