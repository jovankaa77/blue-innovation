<!DOCTYPE html>
<html>
<head>
    <title>Landing Pag</title>
    
    <link rel="stylesheet" type="text/css" href="bs/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="font/css/all.min.css">
    <link rel="stylesheet" href="./css1/index.css">
    <link rel="stylesheet" href="./css1/responsive.css">
    <!-- <link rel="icon" type="image/png" href="img/favicon-32x32.png" sizes="32x32" /> -->
    <style>
        body {
            font-family: 'lexend', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .hero {
            background: url('img/work.avif') no-repeat center center/cover;
            height: 600px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 0 15px;
        }
        .hero .cta-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            border: none;
            color: white;
            text-transform: uppercase;
            cursor: pointer;
        }
        .hero .cta-button:hover {
            background-color: #0056b3;
        }
        .card-img {
            margin: auto;
            width: 90%;
            height: 250px;
            background-image: url('img/freepik.png');
            background-size: cover;
        }
        span .arrow {
            font-size: 1.5rem; /* Ukuran font untuk panah */
            color: #333;       /* Warna panah */
            margin-left: 0.5rem; /* Margin kiri */
        }
        section {
            padding: 60px 20px;
        }
        .mitra {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .mitra img {
            width: 100%;
            max-width: 250px;
            height: auto;
            padding: 20px;
        }
        section h2 {
            text-align: center;
            margin-bottom: 40px;
        }
        p .brand{
            margin-right: 50%;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr)); /* Equivalent to grid-cols-1 */
            gap: 2rem; /* Equivalent to gap-x-8 */
            row-gap: 1.5rem; /* Equivalent to gap-y-6 */
            font-size: 1rem; /* Equivalent to text-base */
            font-weight: 600; /* Equivalent to font-semibold */
            line-height: 1.75rem; /* Equivalent to leading-7 */
            color: white; /* Equivalent to text-white */
        }
        .grid-container a{
            color: white;

        }
        .list {
            margin-left: auto;
            margin-right: auto;
            margin-top: 2.5rem;  /* Equivalent to mt-10 */
            max-width: 42rem;    /* Equivalent to max-w-2xl */
        }
        h2 .judul{
            font-family: Garamond;
        }
        .judul {
            font-size: 2.25rem;  /* Equivalent to text-4xl */
            font-weight: 700;    /* Equivalent to font-bold */
            letter-spacing: -0.025em; /* Equivalent to tracking-tight */
            color: white;        /* Equivalent to text-white */
        }
        .branding {
            margin-top: 1.5rem;  /* Equivalent to mt-6 */
            font-size: 1.125rem; /* Equivalent to text-lg */
            line-height: 2rem;   /* Equivalent to leading-8 */
            color: #D1D5DB;      /* Equivalent to text-gray-300 */
        }
.mitra-section {
    padding: 60px 0;
}

.section-title {
    text-align: center;
    margin-bottom: 40px;
}

.mitra-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.mitra-item {
    text-align: center;
}

.mitra-item img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 20px;
}

.mitra-description {
    font-size: 1rem;
    color: #666;
}

        @media (min-width: 640px) {
            .grid-container{
                grid-template-columns: repeat(2, minmax(0, 1fr)); /* Equivalent to sm:grid-cols-2 */
            }
            .judul {
                font-size: 3.75rem;  /* Equivalent to sm:text-6xl */
            }
        }
        @media (min-width: 768px) {
            .grid-container {
                display: flex; /* Equivalent to md:flex */
            }
        }
        @media (min-width: 1024px) {
            .grid-container {
                column-gap: 2.5rem; /* Equivalent to lg:gap-x-10 */
            }
            .list {
                margin-left: 0;   /* Equivalent to lg:mx-0 */
                margin-right: 0;  /* Equivalent to lg:mx-0 */
                max-width: none;  /* Equivalent to lg:max-w-none */
            }
        }
        @media(max-width: 800px) {
            .ponsel {
                display: none;
            }
            .hero {
                height: auto;
                padding: 40px 20px;
            }
            .flex {
                position: static;
                margin: 0;
            }
            .hero h2, .hero p {
                margin: 20px 0;
            }
            p .brand{
            margin-right: 10%;
            text-align: justify;
        }
        }
        </style>
</head>
<body>
    <!-- menambahakan nav -->
    <?php include "test_nav.php";?>
    <?php include "test_carousel.php"; ?>
    <!-- Mitra -->
    <section class="mitra-section">
    <div class="container">
        <h2 class="section-title">MITRA</h2>
        <div class="mitra-grid">
            <div class="mitra-item">
                <img src="img/blueArc.png" alt="Mitra Blue Arc">
                <p class="mitra-description">Blue Arc adalah salah satu mitra terkemuka kami yang telah berkolaborasi dengan kami dalam berbagai proyek teknologi.</p>
            </div>
            <div class="mitra-item">
                <img src="img/blueBird.jpg" alt="Mitra Blue Bird">
                <p class="mitra-description">Blue Bird adalah mitra terpercaya kami yang telah memberikan solusi teknologi inovatif bagi perusahaan kami.</p>
            </div>
            <div class="mitra-item">
                <img src="img/blueLock.png" alt="Mitra Blue Lock">
                <p class="mitra-description">Blue Lock adalah mitra keamanan kami yang membantu melindungi data dan infrastruktur kami.</p>
            </div>
            <!-- Tambahkan mitra lainnya sesuai kebutuhan -->
        </div>
    </div>
</section>


    
    <!-- Poster -->
    <section class="hero">
        <div class="container text-left" >
            <h2 class="text-left">Jadilah Bagian dari Kami</h2>
            <p class="brand">Setelah sukses menjadi pelopor dalam pengembangan teknologi di Indonesia, Blue Innovation memutuskan untuk memperluas jangkauan ke seluruh dunia. Saat ini, solusi dan produk teknologi Blue Innovation telah menjadi pemimpin di lebih dari 60 negara di seluruh dunia.</p>
            <a href="logReg/register.php" class="btn btn-secondary">Daftar Sekarang</a>
            <div class="list">
                <div class="grid-container">
                    <a href="#">Open roles <span aria-hidden="true" class="arrow">&rarr;</span></a>
                    <a href="#">Internship program <span aria-hidden="true" class="arrow">&rarr;</span></a>
                    <a href="#">Our values <span aria-hidden="true" class="arrow">&rarr;</span></a>
                    <a href="#">Meet our leadership <span aria-hidden="true" class="arrow">&rarr;</span></a>
                </div>
            </div>
        </div>
    </section>
    <?php include "user/footer.php"; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>

