<?php
include 'config.php';
include 'classes/site.php';
$siteconfig = getsiteconfig();
$single_business = Site::getBusinessFromPermalink($_GET['permalink']);
$single_pages = $db->query("SELECT * FROM pages p
join pages_business bp on p.id_pages = bp.id_pages
where bp.id_business='".$single_business['id_business']."' and bp.id_pages = '".$_GET['id_pages']."'");
$single_pages = $single_pages->fetch();
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<title><?php echo $single_pages['name'];?>, <?php echo $single_business['name'];?>, <?php echo $siteconfig['site_name'];?></title>
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
<p class="fleft"><a href="<?php echo ROOT_WWW;?><?php echo $single_business['permalink'];?>/"><i class="fa fa-home fa-lg"></i> Home</a> > <?php echo $single_pages['name'];?></p>
</header>
<div class="grid col-two-thirds mq2-col-full"  style="margin-bottom:3em;" >
<h2><?php echo $single_pages['name'];?></h2>
<?php echo $single_pages['text'];?>
<?php
include 'includes/share_site.php';
?>
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