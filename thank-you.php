<?php
include 'config.php';
$siteconfig = getsiteconfig();
$new_created_business = getbusiness($_GET['id']);
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<title>All in One Mauritius</title>
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
<article id="navteam">
<h2>Thank you for signing up to <?php echo $siteconfig['site_name'];?></h2>
<p><i class="fa fa-envelope-o"></i> A confirmation mail has been sent to you together with your username and password.
<br><br>
<br>
</p>
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