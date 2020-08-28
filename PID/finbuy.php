<?php
  session_start();



header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

	
if(isset($_POST['qBox']))
$_SESSION['qBox'] = $_POST['qBox'];

  if(isset($_SESSION["userName"])){
  $user=$_SESSION["userName"];
}
  else{
  $user="Guest";
}

$sql3 = <<<qlcw
				select m_id from member where m_username='$user'
			qlcw;
			$result3 = mysqli_query ( $link, $sql3) or die("查詢失敗");
			$row3 = mysqli_fetch_assoc( $result3 );
			$fin=$row3['m_id'];

$sql = <<<qlcq
	select p.p_name,d_quantity,p.p_price,d_id,(d_quantity*p.p_price) as total_price from dreamlist d inner join product p on d.p_id=p.p_id  where (buy=true && m_id=$fin);
	qlcq;
$result = mysqli_query ( $link, $sql) or die("查詢失敗");


if (isset($_GET["logout"]))
{
	unset($_SESSION["userName"]);
	header("Location: index.php");
	exit();
}
?>
<!DOCTYPE HTML>
<html>
	<head>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ink &mdash; Free Website Template, Free HTML5 Template by freehtml5.co</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="jquery.min.js"></script>
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
						<div id="fh5co-logo"><a href="index.php">Ink<span>.</span></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<!-- <li class="active"><a href="index.php">Home</a></li> -->
							<li><a href="index.php">Product</a></li>
							<!-- <li class="has-dropdown">
								<a href="blog.php">Blog</a>
								<ul class="dropdown">
									<li><a href="#">Web Design</a></li>
									<li><a href="#">eCommerce</a></li>
									<li><a href="#">Branding</a></li>
									<li><a href="#">API</a></li>
								</ul>
							</li>
							<li><a href="about.php">About</a></li> -->
							<?php if($user=="Guest"){ ?>
							<li class="btn-cta"><a href="Login.php"><span>Login</span></a></li>
							<?php } else{ ?>
							<li class="has-dropdown"><a href="#"><span><?= $user ?></span></a>
							<ul class="dropdown">
									<li><a href="shopcar.php">購物車</a></li>
									<li><a href="finbuy.php">購買歷史紀錄</a></li>
									<li><a href="#">會員資料</a></li>
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
		   	<li style="background-image: url(images/img_bg_1.jpg);">
		   		<div class="overlay-gradient"></div>
		   		<div class="container-fluid">
		   			<div class="row">
			   			<div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text slider-text-bg">
			   				<div class="slider-text-inner">
			   					<h1>Not Every Project Needs To Be Perfect</h1>
									<h2>Free html5 templates Made by <a href="http://freehtml5.co/" target="_blank">freehtml5.co</a></h2>
									<p class="ct"><a href="#">Learn More <i class="icon-arrow-right"></i></a></p>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		   	<li style="background-image: url(images/img_bg_2.jpg);">
		   		<div class="overlay-gradient"></div>
		   		<div class="container-fluid">
		   			<div class="row">
			   			<div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text slider-text-bg">
			   				<div class="slider-text-inner">
			   					<h1>Minimal &amp; Clean Blog WordPress Theme For People Who Tell Stories</h1>
									<h2>Free html5 templates Made by <a href="http://freehtml5.co/" target="_blank">freehtml5.co</a></h2>
									<p class="ct"><a href="#">Learn More <i class="icon-arrow-right"></i></a></p>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		   	<li style="background-image: url(images/img_bg_3.jpg);">
		   		<div class="overlay-gradient"></div>
		   		<div class="container-fluids">
		   			<div class="row">
			   			<div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text slider-text-bg">
			   				<div class="slider-text-inner">
			   					<h1>What Would You Like To Learn?</h1>
									<h2>Free html5 templates Made by <a href="http://freehtml5.co/" target="_blank">freehtml5.co</a></h2>
									<p class="ct"><a href="#">Learn More <i class="icon-arrow-right"></i></a></p>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>		   	
		  	</ul>
	  	</div>
	</aside> -->

	<!-- <div id="fh5co-content">
		<div class="video fh5co-video" style="background-image: url(images/video.jpg);">
			<a href="https://vimeo.com/channels/staffpicks/93951774" class="popup-vimeo"><i class="icon-video2"></i></a>
			<div class="overlay"></div>
		</div>
		<div class="choose animate-box">
			<div class="fh5co-heading">
				<h2>Why Choose Us?</h2>
				<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts far from the countries Vokalia and Consonantia, there live the blind texts. </p>
			</div>
			<ul class="list-nav">
				<li><i class="icon-check2"></i>Far far away, behind the word mountains, far from the countries Vokalia</li>
				<li><i class="icon-check2"></i>There live the blind texts far from the countries Vokalia and Consonantia, there live the blind texts.</li>
				<li><i class="icon-check2"></i>Separated they live in bookmarksgrove there live the blind texts far from the countries</li>
			</ul>
		</div>
	</div>

	<div id="fh5co-mission">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center animate-box">
					<h2>Mission</h2>
					<blockquote>
						<p>Quos quia provident consequuntur culpa facere ratione maxime commodi voluptates id repellat velit eaque aspernatur expedita. Possimus itaque adipisci rem dolorem nesciunt perferendis quae amet deserunt eum labore quidem minima.</p>
					</blockquote>
				</div>
			</div>
		</div>
	</div>

	<div id="fh5co-services">
		<div class="container">
			<div class="row">
				<div class="col-md-4 text-center animate-box">
					<div class="services">
						<span class="icon">
							<i class="icon-command"></i>
						</span>
						<div class="desc">
							<h3><a href="#">Brand Identity</a></h3>
							<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 text-center animate-box">
					<div class="services">
						<span class="icon">
							<i class="icon-drop2"></i>
						</span>
						<div class="desc">
							<h3><a href="#">Web Design &amp; UI</a></h3>
							<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 text-center animate-box">
					<div class="services">
						<span class="icon">
							<i class="icon-anchor"></i>
						</span>
						<div class="desc">
							<h3><a href="#">Web Development</a></h3>
							<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->

	<div id="fh5co-about">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>購買紀錄</h2>
					<!-- <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p> -->
				</div>
			</div>
			<div class="row">
			<?php while($row = mysqli_fetch_assoc( $result )):?>
				<div class="member">
					<div class="col-md-6 nopadding animate-box">
						<div class="author" style="background-image: url(images/user-1.jpg);"></div>
					</div>
					<div class="col-md-6 nopadding animate-box">
						<div class="desc">
							<h3><?=$row['p_name']?></h3>
							<hr/>
							<p>單價：<?=$row['p_price']?>元</p>
							<p>數量：<?=$row['d_quantity']?>件</p>
							<p>總價：<?=$row['total_price']?>元</p>
						</div>
					</div>
				</div>
				<?php endwhile ?>
				<!-- <div class="member">
					<div class="col-md-6 nopadding col-md-push-6 animate-box">
						<div class="author" style="background-image: url(images/user-2.jpg);"></div>
					</div>
					<div class="col-md-6 nopadding col-md-pull-6 animate-box">
						<div class="desc">
							<h3>John Doe</h3>
							<span>CEO, Founder</span>
							<p>Quos quia provident consequuntur culpa facere ratione maxime commodi voluptates id repellat velit eaque aspernatur expedita. Possimus itaque adipisci.</p>
							<p>
								<ul class="fh5co-social-icons">
									<li><a href="#"><i class="icon-twitter-with-circle"></i></a></li>
									<li><a href="#"><i class="icon-facebook-with-circle"></i></a></li>
									<li><a href="#"><i class="icon-linkedin-with-circle"></i></a></li>
									<li><a href="#"><i class="icon-dribbble-with-circle"></i></a></li>
								</ul>
							</p>
						</div>
					</div>
				</div> -->
				<!-- <div class="member">
					<div class="col-md-6 nopadding animate-box">
						<div class="author" style="background-image: url(images/user-3.jpg);"></div>
					</div>
					<div class="col-md-6 nopadding animate-box">
						<div class="desc">
							<h3>John Doe</h3>
							<span>CEO, Founder</span>
							<p>Quos quia provident consequuntur culpa facere ratione maxime commodi voluptates id repellat velit eaque aspernatur expedita. Possimus itaque adipisci.</p>
							<p>
								<ul class="fh5co-social-icons">
									<li><a href="#"><i class="icon-twitter-with-circle"></i></a></li>
									<li><a href="#"><i class="icon-facebook-with-circle"></i></a></li>
									<li><a href="#"><i class="icon-linkedin-with-circle"></i></a></li>
									<li><a href="#"><i class="icon-dribbble-with-circle"></i></a></li>
								</ul>
							</p>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</div>


	<!-- <div id="fh5co-blog">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>Recent Post</h2>
					<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="fh5co-blog animate-box">
						<a href="#"><img class="img-responsive" src="images/blog-1.jpg" alt=""></a>
						<div class="blog-text">
							<span class="posted_on">Nov. 15th</span>
							<span class="comment"><a href="">21<i class="icon-speech-bubble"></i></a></span>
							<h3><a href="#">We've grown from a regional</a></h3>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							<a href="#" class="btn btn-primary">Read More</a>
						</div> 
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="fh5co-blog animate-box">
						<a href="#"><img class="img-responsive" src="images/blog-2.jpg" alt=""></a>
						<div class="blog-text">
							<span class="posted_on">Nov. 15th</span>
							<span class="comment"><a href="">21<i class="icon-speech-bubble"></i></a></span>
							<h3><a href="#">We've grown from a regional</a></h3>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							<a href="#" class="btn btn-primary">Read More</a>
						</div> 
					</div>
				</div>
			</div>
		</div>
	</div> -->

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

	<footer id="fh5co-footer" role="contentinfo">
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
	</footer>
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
	
	<script>
	
	$("#edit").click(function () {
		alert("OK");
		// var iIndex = $(this).closest("p").index();
		// alert(iIndex);
		// header("location:edit.php")
        // currentIndex = -1;
        // $("#titleTextBox").val("");
        // $("#ymdTextBox").val("");
        $("#newsModal").modal( { backdrop: "static" } );
	})
	
	// $("#okButton").click(function){

	// }


	</script>



	</body>
</html>

