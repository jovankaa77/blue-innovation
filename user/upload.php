<?php
function upload() {
    // Periksa apakah ada file yang diunggah
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['gambar']['name'];
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $file_size = $_FILES['gambar']['size'];
        $file_type = $_FILES['gambar']['type'];

        // Tentukan direktori tempat file akan disimpan
        $upload_dir = '../uploads/';

        // Pindahkan file ke direktori yang ditentukan
        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            return $file_name; // Mengembalikan nama file jika berhasil diunggah
        } else {
            return false; // Mengembalikan false jika gagal mengunggah
        }
    } else {
        return false; // Mengembalikan false jika tidak ada file yang diunggah atau terjadi kesalahan
    }
}
?>
