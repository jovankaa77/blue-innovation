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

    <body class="sb-nav-fixed">
        <?php include "headerAdmin.php"; ?>
            <div id="layoutSidenav_content">
                <main>  
                    <div class="container-fluid px-4"> 
                        <h1>Add Test</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Welcome <?php echo ($_SESSION ['admin']); ?> silakan tambah soal baru</li>
                        </ol>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <a class="btn btn-primary btn-sm" href="test.php">Kembali</a>
                        </div> 
                        <br>
                        <div class="card mb-4" >
                            <div class="card-header">
                                <i class="fa-brands fa-wpforms"></i>
                                Tambah Ujian
                            </div>
                            <div class="card-body">
                                <form method="POST" action="../queryTBD/query.php">
                                    <input type="hidden" name="action" value="addTest">
                                    <div class="form-group row">
                                        <label for="inputQuestion" class="col-sm-2 col-form-label">Question:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Input Soal" name="question" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="inputOptions" class="col-sm-2 col-form-label">A</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Input Option A" name="optionA" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="inputOptions" class="col-sm-2 col-form-label">B</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Input Option B" name="optionB" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="inputOptions" class="col-sm-2 col-form-label">C</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Input Option C" name="optionC" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="inputOptions" class="col-sm-2 col-form-label">D</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Input Option D" name="optionD" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="inputCategory" class="col-sm-2 col-form-label">Correct Answer:</label>
                                        <div class="col-sm-1">
                                            <select class="form-control" name="correct">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="inputCategory" class="col-sm-2 col-form-label">Category:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Input Category" name="category" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row" style="float: right;">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm ('Yakin ingin kirim soal?')">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include "footerAdmin.php" ?>
            </div>
        </div>
    </body>
</html>
