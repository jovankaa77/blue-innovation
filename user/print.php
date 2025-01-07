<?php

require_once __DIR__ . '/vendor/autoload.php';
include '../conn.php';
session_start();
$id = $_SESSION['data-user'];

$query = $conn->query("SELECT * FROM pengajuan a, perusahaan b, user c WHERE a.id_perusahaan=b.id_perusahaan AND a.id_user=c.id_user AND status_role='sukses' ");
$data = $query->fetch_array();
$nama_siswa = $data['nama_lengkap'];
$tanggal = $data['dari_tanggal'];
$perusahaan =$data['nama_perusahaan'];
$mpdf = new \Mpdf\Mpdf(['orientation' => 'l', 'format' => [148, 208]]);
// $mpdf->SetAlpha(0.5);
// $html = "<div style='background:url(a.png);width:1000px;height:600px;background-size: cover;'></div> <pagebreak /> <img src='a.png'> <pagebreak /> <img src='a.png'>";
// $mpdf->WriteHTML($html);
// // $mpdf->AddPage();
// // $mpdf->WriteHTML($html);
// $mpdf->Output();
// $name = ["$nama_siswa", 'doe doe doe', 'doe john', 'john doe'];

 foreach ($data as $n) {
    // Add First page
    $mpdf->AddPage();

    $pagecount = $mpdf->setSourceFile('f.pdf');
    $tplId = $mpdf->importPage($pagecount);

    $actualsize = $mpdf->useTemplate($tplId);

    // The height of the template as it was printed is returned as $actualsize['h']
    // The width of the template as it was printed is returned as $actualsize['w']

    $mpdf->WriteHTML('
 <div style="position:absolute;top:290px;left:0px;width:100%"><h2 align="center" style="font-family:Times New Roman, Times, serif;color: #414143;font-weight:bold;"> ' . $n['nama_lengkap'] . ' </h2></div>

 <div style="position:absolute;top:410px;left:0px;width:55%"><h2 align="center" style="font-family:Times New Roman, Times, serif;color: #414143;font-weight:bold;"> ' . $n['dari_tanggal'] . ' </h2></div>
 <div style="  position:absolute;top:410px;left:300px;width:75% " ><h2 align="center" style="font-family:Times New Roman, Times, serif;color: #414143;font-weight:bold;"> ' . $n['nama_perusahaan'] . ' </h2></div>


');
 }
$mpdf->Output();
