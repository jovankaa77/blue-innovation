<?php
    session_start();
    include "../conn.php";
        
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_user = $_POST['id_user'];
        $kategori = $_POST['id_lowongan'];
        $jawaban = $_POST['jawaban']; // Ini adalah array dengan key sebagai id_ujian dan value sebagai array yang berisi jawaban

        foreach ($jawaban as $id_ujian => $dataJawaban) {
            if (isset($dataJawaban['jawaban'])) {
                $jawab = mysqli_real_escape_string($conn, $dataJawaban['jawaban']);
                $query = "INSERT INTO jawaban (id_user, id_ujian, jawaban, kategori) VALUES ($id_user, $id_ujian, '$jawab', '$kategori')";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    echo "Error executing query: " . mysqli_error($conn);
                    exit();
                }
            } 
            else {
                echo "Jawaban untuk ujian $id_ujian tidak ada.<br>"; // Log jika tidak ada jawaban
            }
        }

        // Redirect ke halaman konfirmasi atau tampilkan pesan sukses
        echo "<script>alert('Jawaban telah disimpan!'); window.location.href='test_halaman_utama.php';</script>";
    } 
    else {
        // Redirect kembali ke form jika metode bukan POST
        header("Location: test_halaman_utama.php");
        exit();
    }
    ?>