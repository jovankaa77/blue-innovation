<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="bs/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="font/css/all.min.css">
    <link rel="stylesheet" href="./css1/index.css">
    <link rel="stylesheet" href="./css1/responsive.css">
    <link rel="icon" type="image/png" href="img/favicon-32x32.png" sizes="32x32" />
    <title>Visi & Misi - Blue Innovation</title>
    <style>
        body {
            font-family: 'lexend';
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .card-title {
            background-color: #908CB8;
            padding: 3px;
            animation: fadeIn 1s ease; /* Animasi fade-in */
        }
        .card-title h3 {
            text-align: center;
            color: #FAF8FF;
        }
        .conten {
            padding: 3px;
            font-family: 'lexend';
            animation: slideIn 1s ease; /* Animasi slide-in */
        }
        ol {
            padding: 2%;
            margin: 3px;
        }
        li {
            margin-bottom: 10px;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        @media(max-width: 800px) {
            .ponsel {
                display: none;
            }
            .flex {
                position: relative;
                margin: 20px auto;
                width: 90%;
            }
            h3 {
                text-align: center;
            }
            .card {
                margin: 2%;
            }
            @media(max-width: 745px) {
            .flex {
                width: 85%;
            }
        }
        @media(max-width: 640px) {
            .flex {
                width: 80%;
                padding:0;
                margin: 0;
            }
        }
    </style>
</head>
<body>
<?php include "../test_nav.php";?>
<br>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Visi</h3>
                </div>
                <div class="conten">
                    <p>Menjadi pemimpin dalam inovasi teknologi yang memajukan kehidupan manusia dan mempercepat kemajuan global.</p>
                </div>
            </div>
            <br>
            <div class="card-body">
                <div class="card-title">
                    <h3>Misi</h3>
                </div>
                <div class="conten">
                    <ol>
                        <li>berkomitmen untuk menghadirkan solusi teknologi inovatif yang memenuhi kebutuhan pasar dengan keunggulan dalam kualitas dan keandalan.</li>
                        <li>memperjuangkan kolaborasi lintas sektor untuk menciptakan ekosistem inovasi yang berkelanjutan, menghubungkan ide, orang, dan sumber daya.</li>
                        <li>menanamkan nilai-nilai pengembangan talenta lokal melalui program pelatihan dan pengembangan karyawan, membangun tim yang tangguh dan berdedikasi.</li>
                        <li>bertanggung jawab sosial dengan fokus pada pendidikan dan akses teknologi bagi masyarakat kurang mampu, membawa dampak positif bagi komunitas di sekitar kami.</li>
                        <li>berkomitmen pada keberlanjutan lingkungan dengan menerapkan praktik bisnis yang ramah lingkungan, mengurangi jejak karbon, dan memperjuangkan solusi yang berkelanjutan.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <br>
    <?php include "footer.php"; ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7Rswe
