<?php

require_once __DIR__ . '/vendor/autoload.php';
include 'koneksi.php';
session_start();

$id = $_SESSION['data-user'];
$id_user = $_GET['id'];
$query = $conn->query("SELECT * FROM pengajuan a, lowongan b, user c 
                       WHERE a.id_lowongan=b.id_lowongan 
                       AND a.id_user=c.id_user 
                       AND a.id_user = '$id_user' ");
$data = $query->fetch_array();
$nama_siswa = $data['nama_lengkap'];
$tanggal = $data['sampai_tanggal'];
$lowongan =$data['nama_lowongan'];
$mpdf = new \Mpdf\Mpdf(['orientation' => 'l', 'format' => [148, 208]]);
// $mpdf->SetAlpha(0.5);
// $html = "<div style='background:url(a.png);width:1000px;height:600px;background-size: cover;'></div> <pagebreak /> <img src='a.png'> <pagebreak /> <img src='a.png'>";
// $mpdf->WriteHTML($html);
// // $mpdf->AddPage();
// // $mpdf->WriteHTML($html);
// $mpdf->Output();
// $name = ["$nama_siswa", 'doe doe doe', 'doe john', 'john doe'];

// foreach ($name as $n) {
    // Add First page
    $mpdf->AddPage();

    $pagecount = $mpdf->setSourceFile('f.pdf');
    $tplId = $mpdf->importPage($pagecount);

    $actualsize = $mpdf->useTemplate($tplId);

    // The height of the template as it was printed is returned as $actualsize['h']
    // The width of the template as it was printed is returned as $actualsize['w']

    $mpdf->WriteHTML('
 <div style="position:absolute;top:290px;left:0px;width:100%"><h2 align="center" style="font-family:Times New Roman, Times, serif;color: #414143;font-weight:bold;"> ' . $nama_siswa . ' </h2></div>
 <div style="position:absolute;top:410px;left:0px;width:55%"><h2 align="center" style="font-family:Times New Roman, Times, serif;color: #414143;font-weight:bold;"> ' . $tanggal . ' </h2></div>
 <div style="position:absolute;top:410px;left:300px;width:75%"><h2 align="center" style="font-family:Times New Roman, Times, serif;color: #414143;font-weight:bold;"> ' . $lowongan . ' </h2></div>


');
// }
$mpdf->Output();