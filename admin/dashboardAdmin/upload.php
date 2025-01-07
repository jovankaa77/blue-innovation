<?php
function upload() {
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['gambar']['tmp_name'];
        $fileName = $_FILES['gambar']['name'];
        $fileSize = $_FILES['gambar']['size'];
        $fileType = $_FILES['gambar']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Sanitasi nama file
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        // Direktori tempat file akan disimpan
        $uploadFileDir = $_SERVER['DOCUMENT_ROOT'] . '/web_kuliah_test/uploads/';
        $dest_path = $uploadFileDir . $newFileName;

        // Membuat direktori jika belum ada
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        // Pindahkan file ke direktori yang ditentukan
        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            return $newFileName;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
?>
