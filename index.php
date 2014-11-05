<?php
include 'config.php';
$siteconfig = getsiteconfig();
$error = '0';
if($_POST['email']){
	$password = md5($_POST['pass']);
	$user_sql = $db->query("SELECT * FROM business where email = '".$_POST['email']."' and pw='".$password."'");
	$user = $user_sql->fetch();
	if(!empty($user)){
		if($user['status']=='1'){
			$_SESSION["logged_in"] = $user;
			$_SESSION["logged_in"]['type'] = 'user';
			$_SESSION["logged_in"]['date'] = date('Y-m-d');
			$_SESSION["logged_in"]['is_logged'] = true;
			header("location:".ROOT_WWW."admin/");
		}else{
			$error = '2';
		}
	}else{
		$admin_sql = $db->query("SELECT * FROM site_config where site_admin_username = '".$_POST['email']."' and site_admin_password='".$password."'");
		$admin_check = $admin_sql->fetch();
		if(!empty($admin_check)){
			$_SESSION["logged_in"] = $admin_check;
			$_SESSION["logged_in"]['type'] = 'admin';
			$_SESSION["logged_in"]['date'] = date('Y-m-d');
			$_SESSION["logged_in"]['is_logged'] = true;
			header("location:".ROOT_WWW."admin/");
		}else{
			$error = '1';
		}
	}
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<title><?php echo $siteconfig['site_name'];?></title>
<?php
include 'includes/main/head_main.php';
?>
<link rel="stylesheet" href="<?php echo ROOT_WWW;?>js/slider/responsiveslides.css">
<script src="<?php echo ROOT_WWW;?>js/slider/responsiveslides.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="<?php echo ROOT_WWW;?>js/validate/css/screen.css">
<script src="<?php echo ROOT_WWW;?>js/md5/jquery.md5.js"></script>
<script src="<?php echo ROOT_WWW;?>js/validate/dist/jquery.validate.js"></script>
<link href='http://fonts.googleapis.com/css?family=Kranky' rel='stylesheet' type='text/css'>

<script>
    // You can also use "$(window).load(function() {"
    $(function () {

      // Slideshow 1
      $("#slider1").responsiveSlides({
        maxwidth: 800,
        speed: 800
      });


    });
  </script>
</head>
<body>
<div class="container">
<?php
include 'includes/main/header_main.php';
?>
<div class="home-page main">
<section class="grid-wrap">
<header class="grid col-full">
<hr>
</header>
<div class="grid col-two-thirds mq2-col-full">
<!-- Slideshow 1 -->
<ul class="rslides" id="slider1">
<li><img src="<?php echo ROOT_WWW;?>img/template/one.jpg" alt="">
<p class="caption">CMS - Content Management System.</p></li>
<li><img src="<?php echo ROOT_WWW;?>img/template/two.jpg" alt="">
<p class="caption">Add unlimited amount of rich content information page.</p></li>
<li><img src="<?php echo ROOT_WWW;?>img/template/three.jpg" alt="">
<p class="caption">Post jobs available within your organization online.</p>
</li>
<li><img src="<?php echo ROOT_WWW;?>img/template/four.jpg" alt="">
<p class="caption">Create photo album and upload photos.</p></li>
<li><img src="<?php echo ROOT_WWW;?>img/template/five.jpg" alt="">
<p class="caption">Manage your very own online product catalogue.</p>
</li>
<li><img src="<?php echo ROOT_WWW;?>img/template/six.jpg" alt="">
<p class="caption">Upload photos and view them as online galleries</p></li>
<li><img src="<?php echo ROOT_WWW;?>img/template/seven.jpg" alt="">
<p class="caption">Google map pointing exactly where your business in located</p></li>
<li><img src="<?php echo ROOT_WWW;?>img/template/eight.jpg" alt="">
<p class="caption">Rich content pages with videos, audios and downloadable files.</p>
</li>
</ul>
<a href="<?php echo ROOT_WWW;?>register" class="buttonbig">
<span><i class="fa fa-magic"></i> Sign Up Free</span>
</a>
<div class="clear"></div>
Instantly have a modern website for you businesses accessible onto your mobile devices. NO CREDIT CARD REQUIRED.
</div>
<div class="grid col-one-third mq2-col-full">
<?php
include 'includes/main/login.php';
?>
</div>
</section>
<div class="grid-wrap">
<div class="grid col-one-third mq2-col-full">
<?php echo $siteconfig['box_one'];?></div>
<div class="grid col-one-third mq2-col-full">
<?php echo $siteconfig['box_two'];?></div>
<div class="grid col-one-third mq2-col-full">
<?php echo $siteconfig['box_three'];?>
</div>
</div>
</div>
<!--main-->
<div class="divide-top">
<?php
include 'includes/main/footer_main.php';
?>
</div>
</div>
</body>
</html>