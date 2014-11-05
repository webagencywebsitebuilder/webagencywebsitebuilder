<?php
include 'config.php';
$siteconfig = getsiteconfig();
if(isset($_GET['id_categories'])){
	$getcategories = $db->query("SELECT * FROM categories where id_categories='".$_GET['id_categories']."' order by name ASC");
	$getcategories = $getcategories->fetch();
}else{
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
</head>
<body>
<div class="container">
<?php
include 'includes/main/header_main.php';
?>
<div class="about-page main grid-wrap">
<header class="grid col-full">
<hr>
<p class="fleft"><a href="<?php echo ROOT_WWW;?>"><i class="fa fa-home fa-lg"></i> Home</a> > <i class="fa fa-briefcase fa-lg"></i> Our Work</p>
</header>
<aside class="grid col-one-quarter mq2-col-full">
<menu>
<?php
$categories = $db->query("SELECT * FROM categories order by name ASC");
?>
<h3>Categories</h3>
<ul>
<?php while($row = $categories->fetch()){
	$count_business_sql = $db->query("SELECT count(*) as count from business_categories bc
join business b on b.id_business=bc.id_business
where id_categories='".$row['id_categories']."' and b.status='1'");
	$count_business = $count_business_sql->fetch();
	if($count_business['count']=='0'){
		echo "<li>".$row['name']."</li>";
	}else{
		?>
		<li><i class="fa fa-angle-double-right"></i> <a href="<?php echo ROOT_WWW;?>cat/<?php echo generate_permalink($row['id_categories']);?>/<?php echo generate_permalink($row['name']);?>"><?php echo $row['name'];?></a> (<?php echo $count_business['count'];?>)</li>
		<?php
		
	}
}
?>
</ul>
</menu></aside>
<section class="grid col-three-quarters mq2-col-full">
<article id="navteam" class="works">
<h2><?php
if(isset($_GET['id_categories'])){
	echo $getcategories['name'];
}else{?>Latest sites<?php }?></h2>
<?php	
if(isset($_GET['id_categories'])){
	$business_sql = $db->query("SELECT * FROM business b
		left join business_zip_codes bzc on bzc.id_business = b.id_business
		left join zip_codes zc on bzc.id_zip_codes = zc.id_zip_codes
		left join business_categories bc on bc.id_business = b.id_business
		where bc.id_categories = '".$_GET['id_categories']."' and b.status='1' order by b.name ");
}else{
	$business_sql = $db->query("SELECT * FROM business b
		left join business_zip_codes bzc on bzc.id_business = b.id_business
		left join zip_codes zc on bzc.id_zip_codes = zc.id_zip_codes
		where b.status = '1'
		order by b.id_business DESC limit 12");
}		
while ($row = $business_sql->fetch()){	
	$theimage = "";
	$first_image_sql = $db->query("SELECT * FROM business_image bi
where bi.id_business = '".$row['id_business']."' limit 1");
	$first_image = $first_image_sql->fetch();
	if(!empty($first_image['name'])){
		$theimage = ROOT_WWW."uploads/images/".$row['id_business']."/business/medium/".$first_image['name'];
	}else{
		$theimage = ROOT_WWW."img/noimage.png";
	}
	?>
	<figure style="float:left;" class="grid col-one-third mq1-col-one-half mq2-col-one-half mq3-col-full work_grid">
	<div class="drop-shadow raised" >
	<a href="<?php echo ROOT_WWW;?><?php echo $row['permalink'];?>/"> <img src="<?php echo $theimage;?>" alt=""></a>
	<figcaption> <a href="<?php echo ROOT_WWW;?><?php echo $row['permalink'];?>/" class="arrow"><?php echo $row['name'];?> <i class="fa fa-angle-double-right fa-lg"></i></a>
	<p><?php echo $row['address'];?>, <?php echo $row['city'];?>, <?php echo $row['full_state'];?>, <?php echo $row['zip'];?>, USA</p>
	</figcaption>
	</div>
	</figure>
	<?php
}
?>
</article><div style="clear:both;"></div>
<article id="navphilo">
<h2>About Us</h2>
<?php echo $siteconfig['site_description'];?>
</article>
</section>
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