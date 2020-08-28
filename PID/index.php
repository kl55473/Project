<?php
  session_start();

header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

$c_id=$_GET["c_id"];
if(isset($c_id)){
	$sql = <<<qlc
    select p_name,p_quantity,p_price,c.c_name,c.c_id from product p inner join category c on c.c_id=p.c_id where c.c_id=$c_id
    qlc;
	$result = mysqli_query ( $link, $sql) or die("查詢失敗");
}
else{
$sql = <<<qlc
    select p_name,p_quantity,p_price,c.c_name from product p inner join category c on c.c_id=p.c_id
    qlc;
	$result = mysqli_query ( $link, $sql) or die("查詢失敗");
}


  if(isset($_SESSION["userName"])){
  $user=$_SESSION["userName"];
}
  else{
  $user="Guest";
}
if (isset($_GET["logout"]))
{
	unset($_SESSION["userName"]);
	header("Location: index.php");
	exit();
}
	$p_id=$_GET["p_id"];
	$dquantity = $_POST["dquantity"];
	// echo $p_id;
	// echo $dquantity;

	$sql2 = <<<qlcw
		select * from product where p_id = "$p_id" 
		qlcw;
		$result2 = mysqli_query ( $link, $sql2) or die("查詢失敗");
		$row = mysqli_fetch_assoc( $result2 );
		if(isset($dquantity)){
			if($dquantity>$row["p_quantity"])
				echo "<script>alert('超過庫存量，請重新輸入'); </script>";
		else{
			$sql3 = <<<qlcw
				select m_id from member where m_username='$user'
			qlcw;
			$result3 = mysqli_query ( $link, $sql3) or die("查詢失敗");
			$row3 = mysqli_fetch_assoc( $result3 );
			$fin=$row3['m_id'];
			//echo $fin;
			$sql4 = <<<qlcw
				insert into dreamlist(d_quantity,p_id,m_id,buy) values($dquantity,$p_id,$fin,false) 
			qlcw;
			$result4 = mysqli_query ( $link, $sql4) or die("存取失敗");
			echo "<script>alert('加入購物車'); </script>";
		}
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ink &mdash; Free Website Template, Free HTML5 Template by freehtml5.co</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="freehtml5.co" />

	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,700,800" rel="stylesheet">	 -->
	<link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="top-menu">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="index.php">Beauty<span>.</span></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<!-- <li class="active"><a href="index.php">Home</a></li> -->
							<!-- <li><a href="index.php">產品</a></li> -->
							<li class="has-dropdown">
								<a href="index.php">產品</a>
								<ul class="dropdown">
									<li><a href="index.php?c_id=1">上衣</a></li>
									<li><a href="index.php?c_id=2">裙子</a></li>
									<li><a href="index.php?c_id=3">褲子</a></li>
									<!-- <li><a href="#">API</a></li> -->
								</ul>
							</li>
							<!-- <li><a href="about.php">About</a></li> -->
							<?php if($user=="Guest" || $_SESSION[$a]==1){ ?>
							<li class="btn-cta"><a href="Login.php"><span>Login</span></a></li>
							<?php } else{ ?>
							<li class="has-dropdown"><a href="#"><span><?= $user ?></span></a>
							<ul class="dropdown">
									<li><a href="shopcar.php">購物車</a></li>
									<li><a href=" finbuy.php">購買歷史紀錄</a></li>
									<!-- <li><a href="#">會員資料</a></li> -->
									<li><a href="index.php?logout=1">Logout</a></li>
								</ul></li>
							<?php }?>
						</ul>
					</div>
				</div>
				
				
			</div>
		</div>
	</nav>

	<!-- <aside id="fh5co-hero" class="js-fullheight">
		<div class="flexslider js-fullheight">
			<ul class="slides">
		   	<li class="holder" style="background-image: url(images/img_bg_1.jpg);">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
		   				<div class="slider-text-inner desc">
		   					<h2 class="heading-section">Product</h2>
		   					<p class="fh5co-lead">Designed with <i class="icon-heart3"></i> by the fine folks at <a href="http://freehtml5.co" target="_blank">FreeHTML5.co</a></p>
		   				</div>
		   			</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside> -->
	
	<div id="fh5co-product">
		<div class="container">
			<div class="row">
				
				<?php while($row = mysqli_fetch_assoc( $result )):?>
				<form method="POST" action="index.php?p_id=<?=$row['p_id']?>">
				<div class="col-md-4 prod text-center animate-box">
					<div class="product" style="background-image: url(images/prod-1.jpg);">
						<img src="<?= $row['p_img']?>">
					</div>
					<h3><a href="#"><?= $row['p_name']?></a></h3>
					<span ><?= $row["p_price"]?>元</span><br>
					<span >庫存量：<?= $row["p_quantity"]?></span><br>
					<span > 種類：<?= $row["c_name"]?></span><br>
					<?php if($user!="Guest" || ){ ?>
					<span >數量：<input type="text" name="dquantity" id="dquantity" required="required" style="width: 75px;"></span>
					<span ><input type="submit" name="submit" id="submit" value="加入購物車" style="width: 100px;"></span>
					<?php } ?>
					<!-- <span ><input type="button" value="結帳" onclick="location.href='buy.php'"></span> -->
				</div>
				</form>
				<?php endwhile ?>
			</div>
		</div>
	</div>
	<!-- <div id="fh5co-started" style="background-image:url(images/img_bg_2.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>Want To Write About Us!</h2>
					<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
					<p><a href="#" class="btn btn-default btn-lg">Contact Us</a></p>
				</div>
			</div>
		</div>
	</div> -->

	<!-- <footer id="fh5co-footer" role="contentinfo">
		<div class="container">
			<div class="row row-pb-md">
				<div class="col-md-4 fh5co-widget">
					<h4>Ink's</h4>
					<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
				</div>
				<div class="col-md-4 col-md-push-1">
					<h4>Links</h4>
					<ul class="fh5co-footer-links">
						<li><a href="#">Home</a></li>
						<li><a href="#">Practice Areas</a></li>
						<li><a href="#">Won Cases</a></li>
						<li><a href="#">Blog</a></li>
						<li><a href="#">About us</a></li>
					</ul>
				</div>

				<div class="col-md-4 col-md-push-1">
					<h4>Contact Information</h4>
					<ul class="fh5co-footer-links">
						<li>198 West 21th Street, <br> Suite 721 New York NY 10016</li>
						<li><a href="tel://1234567920">+ 1235 2355 98</a></li>
						<li><a href="mailto:info@yoursite.com">info@yoursite.com</a></li>
						<li><a href="http://gettemplates.co">gettemplates.co</a></li>
					</ul>
				</div>

			</div>

			<div class="row copyright">
				<div class="col-md-12 text-center">
					<p>
						<small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small> 
						<small class="block">Designed by <a href="http://freehtml5.co/" target="_blank">FreeHTML5.co</a> Demo Images: <a href="http://unsplash.co/" target="_blank">Unsplash</a></small>
					</p>
					<p>
						<ul class="fh5co-social-icons">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					</p>
				</div>
			</div>

		</div>
	</footer> -->
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>

