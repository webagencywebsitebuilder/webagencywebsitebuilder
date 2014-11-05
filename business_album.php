<?php
include 'config.php';
include 'classes/site.php';
$single_business = Site::getBusinessFromPermalink($_GET['permalink']);
$siteconfig = getsiteconfig();
$album = $db->query("SELECT * FROM album where id_album='".$_GET['id_album']."'");
$album = $album->fetch();
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<title><?php echo $album['name'];?>, Image gallery, <?php echo $single_business['name'];?></title>
<?php
include 'includes/head_site.php';

$first_image_sql = $db->query("SELECT * FROM album_image where id_album = '".$album['id_album']."' limit 1");
	$first_image =$first_image_sql->fetch();
	if(!empty($first_image['name'])){
		$theimage = ROOT_WWW."uploads/images/".$single_business['id_business']."/album/".$album['id_album']."/medium/".$first_image['name'];
	}else{
		$theimage = ROOT_WWW."img/noimage.png";
	}

?>

<meta property="og:image" content="<?php echo $theimage;?>">


</head>
<body>
<div class="container">
<?php
include 'includes/header_site.php';
?>
<div class="home-page main">
<section class="grid-wrap">
<header class="grid col-full">
<hr>
<p class="fleft"><a href="<?php echo ROOT_WWW;?><?php echo $single_business['permalink'];?>/"><i class="fa fa-home fa-lg"></i> Home</a> > <a href="<?php echo ROOT_WWW;?><?php echo $single_business['permalink'];?>/image_gallery"><i class="fa fa-camera"></i> Image Gallery</a> > <?php echo $album['name'];?></p>
</header>
<div class="grid col-two-thirds mq2-col-full" style="margin-bottom:3em;">
<h2><?php echo $album['name'];?></h2>
<?php echo $album['text'];?>
<?php
include 'includes/share_site.php';
?>
<div class="grid-wrap works" >
<?php
$album_images = $db->query("SELECT * FROM album_image where id_album = '".$album['id_album']."'");
?>
<?php while ($row = $album_images->fetch()){?>		
	<figure class="grid col-one-third mq2-col-one-half mq3-col-full bottom_margin">
	<a class="album-image drop-shadow raised" title="<?php echo $album['name'];?>" rel="group" href="<?php echo ROOT_WWW;?>uploads/images/<?php echo $single_business['id_business'];?>/album/<?php echo $row['id_album'];?>/<?php echo $row['name'];?>"><img src="<?php echo ROOT_WWW;?>uploads/images/<?php echo $single_business['id_business'];?>/album/<?php echo $row['id_album'];?>/medium/<?php echo $row['name'];?>" alt=""><span class="zoom"></span></a>
	</figure>
	<?php 
}
?>  
</div>
</div>
<?php
include 'includes/sidebar_address.php';
?>
</section>
<?php
include 'includes/main_gallery.php';
?>
</div>
<!--main-->
<?php
include 'includes/footer_site.php';
?>
</div>
<script>
$(document).ready(function() {
	$(".album-image").fancybox();
});
</script>
</body>
</html>