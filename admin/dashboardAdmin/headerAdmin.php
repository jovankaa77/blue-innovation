<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styleDashboard.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <?php 
    session_start();
    include '../koneksi.php';

    //cek apakah pengguna sudah login
    if (!isset($_SESSION['admin'])) {
        header("Location:/web_kuliah_test/logReg/login.php");
        exit();
    }

    $id_user = $_SESSION['data-user'];
    $query = $conn->query("SELECT * FROM user WHERE id_user ='$id_user' ");
    $data = $query->fetch_array();
    ?>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">\
            <img class="logo" src="assets/img/logo.png" alt="logo">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="dashboard.php">Blue Innovation</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fa-solid fa-bars"></i></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <!-- <div class="navbar-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div> -->
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!-- <li><a class="dropdown-item" href="#!">Settings</a></li> -->
                        <li><a class="dropdown-item" href="pesan.php">Pesan</a></li>
                        <li><a class="dropdown-item" href="tambahAdmin.php">Tambah Admin</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="../logout.php" onclick="return confirm ('Yakin ingin Logout?')">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"><?php echo ($_SESSION ['admin']); ?></div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-gauge-high"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCalon" aria-expanded="false" aria-controls="collapseCalon">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-folder"></i></div>
                                Data Calon Karyawan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCalon" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="seleksiBerkas.php">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-check-to-slot"></i></div>
                                        Seleksi Berkas
                                    </a>
                                    <a class="nav-link collapsed" href="mengikutiTest.php">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                        Mengikuti Test
                                    </a>
                                    <a class="nav-link" href="finishTest.php">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-file-circle-check"></i></div>
                                        Ujian Selesai
                                    </a>
                                    <a class="nav-link collapsed" href="wawancara.php">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-clipboard-question"></i></div>
                                        Wawancara
                                    </a>
                                </nav>
                            </div>

                            
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-folder-closed"></i></div>
                                Data Karyawan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="performa.php">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-bolt"></i></div>
                                        Performa
                                    </a>
                                    <a class="nav-link collapsed" href="ongoing.php">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-laptop-code"></i></div>
                                        Sedang Bekerja
                                    </a>
                                    <a class="nav-link collapsed" href="finish.php">
                                        <div class="sb-nav-link-icon"><i class="fa-regular fa-circle-check"></i></div>
                                        Selesai Bekerja
                                    </a>
                                    <a class="nav-link collapsed" href="dikeluarkan.php">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-xmark"></i></div>
                                        Dikeluarkan
                                    </a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTest" aria-expanded="false" aria-controls="collapseTest">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-award"></i></div>
                                Test
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseTest" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="test.php">
                                            <div class="sb-nav-link-icon"><i class="fa-solid fa-file"></i></div>
                                            View Soal Ujian
                                        </a>
                                        <a class="nav-link" href="addTest.php">
                                            <div class="sb-nav-link-icon"><i class="fa-solid fa-file-circle-plus"></i></div>
                                            Tambah Soal Ujian
                                        </a>

                                        
                                    </nav>
                                </div>
                            </a>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTest" aria-expanded="false" aria-controls="collapseTest">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-award"></i></div>
                                Lowongan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseTest" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        

                                        <a class="nav-link" href="tambah-lowongan.php">
                                            <div class="sb-nav-link-icon"><i class="fa-solid fa-file-circle-plus"></i></div>
                                            Tambah Lowongan
                                        </a>

                                        <a class="nav-link" href="view-lowongan.php">
                                            <div class="sb-nav-link-icon"><i class="fa-solid fa-file-circle-plus"></i></div>
                                            Lihat Lowongan
                                        </a>

                                        <a class="nav-link" href="kegiatan.php">
                                            <div class="sb-nav-link-icon"><i class="fa-solid fa-file-circle-plus"></i></div>
                                            Lihat Kegiatan
                                        </a>
                                    </nav>
                                </div>
                            </a>


                            
                            <!-- <a class="nav-link" href="password.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-microchip"></i></div>
                                Authentication
                            </a>     -->
                            <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                                Error
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div> -->
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: <?php echo ($_SESSION ['level']); ?></div>
                    </div>
                </nav>
            </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>