<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <link rel="stylesheet" href="css/styles.css"> 	 -->
	<title>nav</title>
    <Style>
        *{
			padding: 0;
			margin: 0;
			font-family: "Open Sans", sans-serif;
		}
		body{
			background-color: white;
		}
		header {
    		background-color: #474555;
    		padding: 10px 0;
    		position: sticky;
    		top: 0;
    		width: 100%;
    		z-index: 1000;
			
		}
		
		nav a:hover {
    		text-decoration: underline;
		}

        nav{
            color: white;
    		text-decoration: none;
    		margin: 0 15px;
    		font-weight: bold;
		}
        nav .navbar-brand{
            color: white;
	        font-size: 30px;
	        margin: 0 0 0 10px;
        }

        nav.navbar-brand:hover{
	        color: white;
        }
		.nav-item{
			display:reverse;
		}

        ul{
	        margin: 0 0 0 10px;
	        text-align: center;
        }
        ul li .home{
	        border-bottom:2px solid white;
	        color: white;
	        background-color: none ;
        }

        ul li a{
	        margin: 0 0 0 30px;
	        color: white;
	        font-size: 18px;
        }

        ul li .home2:hover{
	        color: white;
	        border-bottom: 2px solid white;
        }
        .ponsel{
	        position: relative;
	        margin: -700px 0 0 120px;
	        width: 35%;
	        height: 700px;
	        background:url(img/pon.png);
	        background-size: 100% 100%;
}
@media (max-width: 900px){
	ul {
		margin: 0 0 0 0px;
	}
	ul li .home{
		background-color: white;
		color:rgb(26, 179, 148) ;
		border-bottom-left-radius: 20px;
		border-top-right-radius: 20px;
	}
	ul li a{
		margin: 0 0 0 0px;
	}
}
    </Style>
</head>
<body>
    <header >

		<nav class="navbar navbar-expand-lg " >
		  <a class="navbar-brand" href="/web_kuliah_test/index.php"><img src="img/logo.png" style="width: 100px; height: 100%; margin-bottom:2%;"> Blue Innovation</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="text-white fas fa-bars"></i>
		  </button>
	
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			  <li class="nav-item active">
					<a class="home2 nav-link"href="/web_kuliah_test/user/test_lowongan.php">Karir</a>
			  </li>
			  <li class="nav-item active">
				<a class="home2 nav-link"href="/web_kuliah_test/user/test_about.php">About Us</a>
			  </li>
			  <li class="nav-item active">
				<a class="home2 nav-link"href="/web_kuliah_test/logReg/login.php">Login</a>
			  </li>
			  <li class="nav-item active">
				<a class="home2 nav-link"href="/web_kuliah_test//logReg/register.php">Daftar</a>
			  </li>
			</ul>
			
		  </div>	
		</nav>
	</header>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>