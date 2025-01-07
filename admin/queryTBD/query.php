<?php
include "../koneksi.php";

// Tentukan operasi berdasarkan parameter 'action'
// Untuk post tambahkan input type=hidden name=action value="nama function"
// Untuk get tambahkan di linknya setelah ? action=namaFunction
$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    case 'accTest':
        // Query untuk acc test user lanjut ke tahap wawancara
        // Dipanggil dari halaman: dashboardAdmin/finishTest.php
        if (isset($_GET['no'])) {
            $id_ujian_selesai = mysqli_real_escape_string($conn, $_GET['no']);
            $queryAccTest = "DELETE FROM ujian_selesai WHERE id_ujian_selesai = '$id_ujian_selesai'";
            $accTest = mysqli_query($conn, $queryAccTest);
            if ($accTest) {
                header("location: ../dashboardAdmin/finishTest.php");
                exit();
            } 
            else {
                echo mysqli_error($conn);
                exit();
            }
        } 
        else {
            echo "Parameter 'no' tidak ditemukan.";
        }
        break;

    case 'rejTest':
        // Query untuk reject test user GAGALL
        // Dipanggil dari halaman: dashboardAdmin/finishTest.php
        $idUjianSelesai = $_GET['no'];

        if (isset($idUjianSelesai)) {
            $idUjianSelesai = mysqli_real_escape_string($conn, $idUjianSelesai);
            $query = "CALL DeleteAndUpdateStatus($idUjianSelesai)";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_affected_rows($conn) > 0) {
                header("location: ../dashboardAdmin/finishTest.php");
                exit();
            } 
            else {
                echo "Tidak ada perubahan yang dilakukan.";
                exit();
            }
        } 
        else {
            echo "Parameter 'no' tidak ditemukan.";
        }
        break;

    case 'addTest':
        // Query untuk menambahkan test baru
        // Dipanggil dari halaman: dashboardAdmin/addTest.php
        if (isset($_POST['question'], $_POST['optionA'], $_POST['optionB'], $_POST['optionC'], $_POST['optionD'], $_POST['correct'], $_POST['category'])) {
            $question = mysqli_real_escape_string($conn, $_POST['question']);
            $optionA = mysqli_real_escape_string($conn, $_POST['optionA']);
            $optionB = mysqli_real_escape_string($conn, $_POST['optionB']);
            $optionC = mysqli_real_escape_string($conn, $_POST['optionC']);
            $optionD = mysqli_real_escape_string($conn, $_POST['optionD']);
            $correct = mysqli_real_escape_string($conn, $_POST['correct']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);

            $queryAddTest = "INSERT INTO ujian (question, option_a, option_b, option_c, option_d, correct_answer, category) 
                             VALUES ('$question', '$optionA', '$optionB', '$optionC', '$optionD', '$correct', '$category')";
            $addTest = mysqli_query($conn, $queryAddTest);

            if ($addTest) {
                header("Location: ../dashboardAdmin/test.php");
                exit();
            } 
            else {
                echo mysqli_error($conn);
            }
        } 
        else {
            echo "Data formulir tidak lengkap.";
        }
        break;

    case 'editTest':
        // Query untuk mengedit test yang ada
        // Dipanggil dari halaman: dashboardAdmin/editTest.php
        if (isset($_POST['id_ujian'], $_POST['question'], $_POST['optionA'], $_POST['optionB'], $_POST['optionC'], $_POST['optionD'], $_POST['correct'], $_POST['category'])) {
            $id_ujian = mysqli_real_escape_string($conn, $_POST['id_ujian']);
            $question = mysqli_real_escape_string($conn, $_POST['question']);
            $optionA = mysqli_real_escape_string($conn, $_POST['optionA']);
            $optionB = mysqli_real_escape_string($conn, $_POST['optionB']);
            $optionC = mysqli_real_escape_string($conn, $_POST['optionC']);
            $optionD = mysqli_real_escape_string($conn, $_POST['optionD']);
            $correct = mysqli_real_escape_string($conn, $_POST['correct']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);

            $queryEditTest = "UPDATE ujian 
                              SET question = '$question', option_a = '$optionA', option_b = '$optionB', option_c = '$optionC', option_d = '$optionD', correct_answer = '$correct', category = '$category'
                              WHERE id_ujian = '$id_ujian'";
            $editTest = mysqli_query($conn, $queryEditTest);

            if ($editTest) {
                header("Location: ../dashboardAdmin/test.php");
                exit();
            } else {
                echo mysqli_error($conn);
            }
        } else {
            echo "Data formulir tidak lengkap.";
        }
        break;

    case 'deleteTest':
        // Query untuk menghapus test
        // Dipanggil dari halaman: dashboardAdmin/test.php
        if (isset($_GET['number'])) {
            $id_ujian = mysqli_real_escape_string($conn, $_GET['number']);
            $queryDeleteTest = "DELETE FROM ujian WHERE id_ujian = '$id_ujian'";
            $deleteTest = mysqli_query($conn, $queryDeleteTest);
            if ($deleteTest) {
                header("Location: ../dashboardAdmin/test.php"); // Redirect kembali ke halaman test
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
                exit();
            }
        } else {
            echo "Parameter 'number' tidak ditemukan.";
        }
        break;

    case 'finishTest':
        // Query untuk menyelesaikan atau mengupdate status test
        // Dipanggil dari halaman: dashboardAdmin/finishTest.php
        if (isset($_POST['id_ujian_selesai'], $_POST['statuss'])) {
            $id_ujian_selesai = mysqli_real_escape_string($conn, $_POST['id_ujian_selesai']);
            $status = mysqli_real_escape_string($conn, $_POST['statuss']);

            $queryFinishTest = "UPDATE ujian_selesai 
                                SET statuss = '$status'
                                WHERE id_ujian_selesai = '$id_ujian_selesai'";
            $finishTest = mysqli_query($conn, $queryFinishTest);

            if ($finishTest) {
                header("Location: ../dashboardAdmin/finishTest.php");
                exit();
            } else {
                echo mysqli_error($conn);
            }
        } else {
            echo "Data formulir tidak lengkap.";
        }
        break;

    case 'acceptBerkas':
        // Query untuk menerima (acc) berkas user
        // Dipanggil dari halaman: dashboardAdmin/seleksiBerkas.php
        if (isset($_GET['number'])) {
            $id_biodata = mysqli_real_escape_string($conn, $_GET['number']);
            
            // Query untuk mendapatkan id_user dari id_biodata
            $queryGetUserId = "SELECT id_user FROM biodata WHERE id = '$id_biodata'";
            $result = mysqli_query($conn, $queryGetUserId);
            
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $id_user = $row['id_user'];
                
                // Query untuk mengupdate status_role di tabel user
                $queryAcceptBerkas = "UPDATE user SET status_role = 'ikut_tes' WHERE id_user = '$id_user'";
                $acceptBerkas = mysqli_query($conn, $queryAcceptBerkas);
                
                if ($acceptBerkas) {
                    header("Location: ../dashboardAdmin/seleksiBerkas.php");
                    exit();
                } 
                else {
                    echo "Error updating record: " . mysqli_error($conn);
                    exit();
                }
            } 
            else {
                echo "Tidak ada user yang terkait dengan biodata ini.";
            }
        }
        break;

    case 'rejectBerkas':
        // Query untuk menolak (reject) berkas user
        // Dipanggil dari halaman: dashboardAdmin/seleksiBerkas.php
        if (isset($_GET['number'])) {
            $id_biodata = mysqli_real_escape_string($conn, $_GET['number']);
            
            $queryGetUserId = "SELECT id_user FROM biodata WHERE id = '$id_biodata'";
            $result = mysqli_query($conn, $queryGetUserId);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $id_user = $row['id_user'];

                $queryRejectBerkas = "UPDATE user SET status_role = 'gagal_seleksi' WHERE id_user = '$id_user'";
                $rejectBerkas = mysqli_query($conn, $queryRejectBerkas);
                if ($rejectBerkas) {
                    header("Location: ../dashboardAdmin/seleksiBerkas.php");
                    exit();
                } 
                else {
                    echo "Error updating record: " . mysqli_error($conn);
                    exit();
                }
            } 
            else {
                echo "Tidak ada user yang terkait dengan biodata ini.";
            }
        }
        break;

    case 'addPerforma':
        // Query untuk menambahkan performa karyawan
        // Dipanggil dari halaman: dashboardAdmin/tambah_performa_karyawan.php
        if (isset($_POST['nama_karyawan'], $_POST['kualitas_kerja'], $_POST['kuantitas_kerja'], $_POST['kompetensi_teknis'], $_POST['sikap_perilaku'], $_POST['komunikasi'], $_POST['tahun'], $_POST['pesan'])) {
            $id_user = mysqli_real_escape_string($conn, $_POST['nama_karyawan']);
            $kualitas_kerja = mysqli_real_escape_string($conn, $_POST['kualitas_kerja']);
            $kuantitas_kerja = mysqli_real_escape_string($conn, $_POST['kuantitas_kerja']);
            $kompetensi_teknis = mysqli_real_escape_string($conn, $_POST['kompetensi_teknis']);
            $sikap_perilaku = mysqli_real_escape_string($conn, $_POST['sikap_perilaku']);
            $komunikasi = mysqli_real_escape_string($conn, $_POST['komunikasi']);
            $tahun = mysqli_real_escape_string($conn, $_POST['tahun']);
            $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

            $queryAddPerforma = "UPDATE performa 
                                 SET kualitas_kerja = '$kualitas_kerja', 
                                     kuantitas_kerja = '$kuantitas_kerja', 
                                     kompetensi_teknis = '$kompetensi_teknis', 
                                     sikap_perilaku = '$sikap_perilaku', 
                                     komunikasi = '$komunikasi', 
                                     tahun = '$tahun', 
                                     pesan = '$pesan'
                                 WHERE id_user = '$id_user'";
            $addPerforma = mysqli_query($conn, $queryAddPerforma);

            if ($addPerforma) {
                header("Location: ../dashboardAdmin/performa.php");
                exit();
            } 
            else {
                echo mysqli_error($conn);
            }
        }
        break;

    case 'aturTanggalWawancara':
        // Query untuk mengatur atur tanggal wawancara
        // Dipanggil dari halaman: dashboardAdmin/wawancara.php
        if (isset($_POST['id_user'], $_POST['tanggal_wawancara'], $_POST['link_wawancara'])) {
            $id_user = mysqli_real_escape_string($conn, $_POST['id_user']);
            $tanggal_wawancara = mysqli_real_escape_string($conn, $_POST['tanggal_wawancara']);
            $link_wawancara = mysqli_real_escape_string($conn, $_POST['link_wawancara']);

            $queryTanggalWawancara = "UPDATE user
                                      SET tanggal_wawancara = '$tanggal_wawancara', link_wawancara = '$link_wawancara'
                                      WHERE id_user = '$id_user'";
            $aturTanggal = mysqli_query($conn, $queryTanggalWawancara);

            if ($aturTanggal) {
                header("Location: ../dashboardAdmin/wawancara.php");
                exit();
            } 
            else {
                echo mysqli_error($conn);
            }
        }
        break;

    case 'accWawancara':
        // Query untuk mengatur acc dan ubah status role jadi proses
        // Dipanggil dari halaman: dashboardAdmin/wawancara.php
        if (isset($_GET['id'])) {
            $id_pengajuan = mysqli_real_escape_string($conn, $_GET['id']);
            
            $queryGetUserId = "SELECT id_user FROM pengajuan WHERE id_pengajuan = '$id_pengajuan'";
            $result = mysqli_query($conn, $queryGetUserId);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $id_user = $row['id_user'];

                $queryAccWawancara = "UPDATE user SET status_role = 'proses' WHERE id_user = '$id_user'";
                $accWawancara = mysqli_query($conn, $queryAccWawancara);
                if ($accWawancara) {
                    header("Location: ../dashboardAdmin/wawancara.php");
                    exit();
                } 
                else {
                    echo "Error updating record: " . mysqli_error($conn);
                    exit();
                }
            } 
            else {
                echo "Tidak ada user yang terkait dengan pengajuan ini.";
            }
        }
        break;

    case 'selesaiKerja':
        // Query untuk ubah status role jadi selesai_kerja
        // Dipanggil dari halaman: dashboardAdmin/ongoing.php
        if (isset($_GET['number'])) {
            $id_pengajuan = mysqli_real_escape_string($conn, $_GET['number']);
            
            $queryGetUserId = "SELECT id_user FROM pengajuan WHERE id_pengajuan = '$id_pengajuan'";
            $result = mysqli_query($conn, $queryGetUserId);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $id_user = $row['id_user'];

                $querySelesaiKerja = "UPDATE user SET status_role = 'sukses' WHERE id_user = '$id_user'";
                $selesaiKerja = mysqli_query($conn, $querySelesaiKerja);
                if ($selesaiKerja) {
                    header("Location: ../dashboardAdmin/ongoing.php");
                    exit();
                } 
                else {
                    echo "Error updating record: " . mysqli_error($conn);
                    exit();
                }
            } 
            else {
                echo "Tidak ada user yang terkait dengan data ini.";
            }
        }
        break;

    case 'dikeluarkan':
        // Query untuk ubah status role jadi dikeluarkan
        // Dipanggil dari halaman: dashboardAdmin/ongoing.php
        if (isset($_GET['number'])) {
            $id_pengajuan = mysqli_real_escape_string($conn, $_GET['number']);
            
            $queryGetUserId = "SELECT id_user FROM pengajuan WHERE id_pengajuan = '$id_pengajuan'";
            $result = mysqli_query($conn, $queryGetUserId);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $id_user = $row['id_user'];

                $queryDikeluarkan = "UPDATE user SET status_role = 'dikeluarkan' WHERE id_user = '$id_user'";
                $dikeluarkan = mysqli_query($conn, $queryDikeluarkan);
                if ($dikeluarkan) {
                    header("Location: ../dashboardAdmin/ongoing.php");
                    exit();
                } 
                else {
                    echo "Error updating record: " . mysqli_error($conn);
                    exit();
                }
            } 
            else {
                echo "Tidak ada user yang terkait dengan data ini.";
            }
        }
        break;

    case 'editTanggalKerja':
        // Query untuk mengatur atur tanggal wawancara
        // Dipanggil dari halaman: dashboardAdmin/wawancara.php
        if (isset($_POST['id_user'], $_POST['dari_tanggal'], $_POST['sampai_tanggal'])) {
            $id_user = mysqli_real_escape_string($conn, $_POST['id_user']);
            $dari_tanggal = mysqli_real_escape_string($conn, $_POST['dari_tanggal']);
            $sampai_tanggal = mysqli_real_escape_string($conn, $_POST['sampai_tanggal']);

            $queryTanggalKerja = "UPDATE user
                                  SET dari_tanggal = '$dari_tanggal', sampai_tanggal = '$sampai_tanggal'
                                  WHERE id_user = '$id_user'";
            $tanggalKerja = mysqli_query($conn, $queryTanggalKerja);

            if ($tanggalKerja) {
                header("Location: ../dashboardAdmin/ongoing.php");
                exit();
            } 
            else {
                echo mysqli_error($conn);
            }
        }
        break;
    
        case 'hapusPesan':
            // Query untuk ubah status role jadi dikeluarkan
            // Dipanggil dari halaman: dashboardAdmin/pesan.php
            if (isset($_GET['id_pesan'])) {
                $id_pesan = mysqli_real_escape_string($conn, $_GET['id_pesan']);
                
                $queryGetUserId = "SELECT id_user FROM pesan WHERE id_pesan = '$id_pesan'";
                $result = mysqli_query($conn, $queryGetUserId);
    
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $id_user = $row['id_user'];
    
                    $queryHapusPesan = "DELETE FROM pesan WHERE id_pesan = '$id_pesan'";
                    $hapusPesan = mysqli_query($conn, $queryHapusPesan);
                    if ($hapusPesan) {
                        header("Location: ../dashboardAdmin/pesan.php");
                        exit();
                    } 
                    else {
                        echo "Error updating record: " . mysqli_error($conn);
                        exit();
                    }
                } 
                else {
                    echo "Tidak ada user yang terkait dengan data ini.";
                }
            }
            break;

    default:
        // Jika operasi tidak valid atau tidak dikenali
        echo "Operasi tidak valid.";
        break;
}

mysqli_close($conn);
?>
