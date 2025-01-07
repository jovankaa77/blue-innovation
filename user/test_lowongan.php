<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="bs/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="font/css/all.min.css">
    <link rel="stylesheet" href="./css1/index.css">
    <link rel="stylesheet" href="./css1/responsive.css">
	<link rel="icon" type="image/png" href="img/favicon-32x32.png" sizes="32x32" />
    <title>Document</title>
	<Style>
		*{
			padding:0;
			margin:0;
			font-family: 'lexend';
		}
		.img{
	      width: 100%;
    	  height: 300px;
		}
		.img-o{
	      	width: 100%;
    	 	height: 250px;
			border-radius: 15px;

    	}
		.conten{
            flex-wrap: wrap;
            margin: 20px auto;
            width: 100%;
            height: auto;
            display: flex;
            justify-content: space-around;
            box-sizing: border-box;
            padding: 0;
        }
        .judul{
            padding: 10px;
            box-sizing: border-box;
        }
        .kotak{
          	border-radius: 15px;
          	box-shadow: 1px 1px 2px #8585ad;
            margin: 20px 0 30px 0 ;
            box-sizing: border-box;
            width: 30%;
            box-sizing: border-box;
            border:1px solid #8585ad;
		}
		.content{
            padding: 10px;
            box-sizing: border-box;
        }
        .gambar{
            margin: auto;
            width: 90%;
            height: 250px;
            background-image: url(img/freepik.png);
            background-size: 100% 100%;
        }
        .samping{
          margin: au
		}
		@media(max-width: 890px){
            .kotak{
                width: 45%;
                margin: 20px 0 0 10px;
            }
            .container-flued{
                padding: 20px;
                box-sizing: border-box;
            }
        }
        @media(max-width: 750px){
            .kotak{
                width: 90%;
            }
        }
	</Style>
</head>
<body>
	<?php include "../test_nav.php";?>
<!-- daftar lowogan -->
<div class="container">
	<div class="conten">
		<?php include "../conn.php" ;
      //hard
        $query = $conn->query("SELECT * FROM pengajuan a, lowongan b, user c WHERE a.id_lowongan=b.id_lowongan AND a.id_user=c.id_user");
      	$sql = $conn->query("SELECT * FROM lowongan");
    	?>
    
      	<?php while($data = $sql->fetch_array()) : ?>
       	<div class="kotak">
           	<div class="judul">
               <h4 style="font-size: 18px;font-weight: bold; color: #336699;  text-align: center"><?php echo $data['nama_lowongan']; ?></h4>
               <p style="font-size: 14px; color: #407bbf; text-align: center;"><?php echo $data['kategori_lowongan']; ?></p>
           	</div>
           	<div class="gambar"><img class="img-o" src="../uploads/<?php echo $data['img']; ?> "></div>
           	<div class="content">
               <h5 style="margin: 10px 0 0 0 ; font-size: 16px;"><i class="fas fa-clock" style="color:#8585ad; "></i> Waktu : <?php echo $data['waktu_lowongan']; ?></h5>
               <p><i class="fas fa-users" style="color:#8585ad;"></i> Quota : <?php echo $data['quota']; ?></p>
			   <a href="../logReg/login.php" class="btn btn-primary w-100">View Info</a>
			</div>
		</div>
		<?php endwhile;?>
	</div>
</div>

<br>
<?php include "footer.php"; ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>