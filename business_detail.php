<?php
include 'config.php';
include 'classes/site.php';
$single_business = Site::getBusinessFromPermalink($_GET['permalink']);
$siteconfig = getsiteconfig();
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<title><?php echo $single_business['name'];?>, <?php echo $siteconfig['site_name'];?></title>
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
<p class="fleft"><i class="fa fa-home fa-lg"></i> Home</p> </header>
<div class="grid col-two-thirds mq2-col-full" style="margin-bottom:3em;">
<h2>Welcome</h2>
<?php echo $single_business['text'];?>
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