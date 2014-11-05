<?php
include '../config.php';
include '../classes/site.php';
$siteconfig = getsiteconfig();
$single_business = Site::getBusinessFromPermalink($_GET['permalink']);
?>
<!DOCTYPE HTML>
<!--

	Parallelism 1.1 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)

-->
<html>
	<head>
		<title><?php echo $single_business['name'];?></title>
		<meta name="viewport" content="width=1120,user-scalable=no" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script>-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.poptrox.min.js"></script>
		<script src="js/config.js"></script>
		<script src="js/skel.min.js"></script>
<link rel="stylesheet" href="<?php echo ROOT_WWW;?>js/font-awesome/css/font-awesome.css">
		<noscript>
			<link rel="stylesheet" href="web/css/skel-noscript.css" />
			<link rel="stylesheet" href="web/css/style.css" />
			<link rel="stylesheet" href="web/css/style-desktop.css" />
			<link rel="stylesheet" href="web/css/style-noscript.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
	</head>
	<body>

		<div id="wrapper">
<a href="<?php echo ROOT_WWW.$single_business['permalink'];?>/"><i class="fa fa-home fa-3x"></i></a>
			<div id="main">
			
			
				<div id="reel">
				<!-- ******************************************************************************************** -->
				<!-- ******************************************************************************************** -->
				

					<!-- Header Item -->
					
						<div id="header" class="item" data-width="400">
							<h1><?php echo $single_business['name'];?></h1>
							<p><i class="fa fa-map-marker"></i> <?php echo $single_business['address'];?>, <?php echo $single_business['city'];?>, <?php echo $single_business['full_state'];?>, <?php echo $single_business['zip'];?>, USA<br>
							<?php if(empty($single_business['photo_number'])){}else{?><span ><i class="fa fa-phone"></i> <?php echo $single_business['photo_number'];?></span><br><?php } ?>
							<span ><i class="fa fa-at"></i> <?php echo $single_business['email'];?></span>
							</p>
						</div>
					
					<!-- Thumb Items -->
	<?php
 $business_images_list = $db->query("SELECT * FROM business_image where id_business = '".$single_business['id_business']."'");
while ($row = $business_images_list->fetch()){
?>
						<article class="item thumb" data-width="282">
						<a href="<?php echo ROOT_WWW;?>/uploads/images/<?php echo $single_business['id_business'];?>/business/<?php echo $row['name'];?>"><img src="<?php echo ROOT_WWW;?>/uploads/images/<?php echo $single_business['id_business'];?>/business/medium/<?php echo $row['name'];?>" alt=""></a>
						</article>
						<?php
	  }?>

						
				<!-- ******************************************************************************************** -->
				<!-- ******************************************************************************************** -->
				</div>
			</div>
		

		</div>

	</body>
</html>