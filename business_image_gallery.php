<?php
include 'config.php';
include 'classes/site.php';
$permalink = $_GET['permalink'];
$siteconfig = getsiteconfig();
$single_business =  Site::getBusinessFromPermalink($_GET['permalink']);
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<title>Image Gallery, <?php echo $single_business['name'];?>, <?php echo $siteconfig['site_name'];?></title>
<?php
include 'includes/head_site.php';
?>
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
<p class="fleft"><a href="<?php echo ROOT_WWW;?><?php echo $single_business['permalink'];?>/"><i class="fa fa-home fa-lg"></i> Home</a> > <i class="fa fa-camera"></i> Image Gallery</p>
</header>
<div class="grid col-two-thirds mq2-col-full" style="margin-bottom:3em;">
<h2>Image Gallery</h2>
<div class="grid-wrap works" >	  		
<?php
$albums = $db->query("SELECT * FROM album a
join album_business ab on ab.id_album = a.id_album
where ab.id_business = '".$single_business['id_business']."'");
?>
<?php while ($row = $albums->fetch()){
	$first_image_sql = $db->query("SELECT * FROM album_image where id_album = '".$row['id_album']."' limit 1");
	$first_image =$first_image_sql->fetch();
	if(!empty($first_image['name'])){
		$theimage = ROOT_WWW."uploads/images/".$single_business['id_business']."/album/".$row['id_album']."/medium/".$first_image['name'];
	}else{
		$theimage = ROOT_WWW."img/noimage.png";
	}
	?><figure class="grid col-one-third mq2-col-one-half bottom_margin">
	<div class="drop-shadow lifted" >
	<a class="album-image" href="<?php echo ROOT_WWW;?><?php echo $permalink;?>/album/<?php echo $row['id_album'];?>/<?php echo generate_permalink($row['name']);?>"><img src="<?php echo $theimage;?>" alt=""><span class="zoom"></span></a>
	<figcaption> <a href="<?php echo ROOT_WWW;?><?php echo $permalink;?>/album/<?php echo $row['id_album'];?>/<?php echo generate_permalink($row['name']);?>" ><?php echo trim($row['name']);?> <i class="fa fa-angle-double-right fa-lg"></i></a>
	</figcaption>
	</div>
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
</body>
</html>