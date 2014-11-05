<?php

include 'config.php';
include 'classes/site.php';
$siteconfig = getsiteconfig();
$single_business = Site::getBusinessFromPermalink($_GET['permalink']);
header('Content-Type: application/xml');
?>
<?xml version='1.0' encoding='UTF-8'?><urlset>
<url><loc><?php echo ROOT_WWW;?><?php echo $single_business['permalink'];?>/</loc></url>
<?php
$pages_sql = $db->query("SELECT * FROM pages p 
join pages_business pb on pb.id_pages = p.id_pages
where pb.id_business = '".$single_business['id_business']."'");
//$pages_result = mysql_query($pages_sql);
while ($row = $pages_sql->fetch()){
?>
<url><loc><?php echo ROOT_WWW;?><?php echo $single_business['permalink'];?>/about_us/<?php echo $row['id_pages'];?>/<?php echo generate_permalink($row['name']);?></loc></url>
<?php }?>

<url><loc><?php echo ROOT_WWW;?>web/<?php echo $single_business['permalink'];?></loc></url>
<url><loc><?php echo ROOT_WWW;?>web/<?php echo $single_business['permalink'];?>/contact_us</loc></url>
<url><loc><?php echo ROOT_WWW;?>web/<?php echo $single_business['permalink'];?>/product_catalogue</loc></url>
<url><loc><?php echo ROOT_WWW;?>web/<?php echo $single_business['permalink'];?>/image_gallery</loc></url>
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
	?>
<url><loc><?php echo ROOT_WWW;?><?php echo $permalink;?>/album/<?php echo $row['id_album'];?>/<?php echo generate_permalink($row['name']);?></loc></url>
<?php }?>

</urlset>