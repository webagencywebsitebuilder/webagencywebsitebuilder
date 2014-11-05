<?php
include 'config.php';
$siteconfig = getsiteconfig();
$new_created_business = getbusiness($_GET['id_business']);

$business = $db->query("SELECT * FROM business where id_business = '".$_GET['id_business']."' and  businesshash='".$_GET['businesshash']."'");
$business = $business->fetch();



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
<p class="fleft">Account Confirmation</p>
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


<?php

if(!empty($business)){

$update_pages_sql = $db->query("UPDATE business set status='1' where id_business = '".$new_created_business['id_business']."' and businesshash='".$new_created_business['businesshash']."'");

?>
<h2><i class="fa fa-check-circle"></i> Your account is now confirmed  <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i></h2>
<h3>You can now access admin area of your account by login in with your username and password <i class="fa fa-smile-o"></i> </h3>
<h4><a href="<?php echo ROOT_WWW;?>"><?php echo ROOT_WWW;?></a></h4><hr>
<h3><i class="fa fa-check-circle"></i> You can access your website at:</h3>
<h4><a target="_blank" href="<?php echo ROOT_WWW;?><?php echo $new_created_business['permalink'];?>/"><?php echo ROOT_WWW;?><?php echo $new_created_business['permalink'];?>/</a></h4>
<?php
}else{
?>
<h2><i class="fa fa-frown-o"></i> Sorry, we didn't find any account to activate.</h2>
Please check again the confirmation link.<br>
or contact admin at.<br>
<a href="<?php echo ROOT_WWW;?>contact-us"><?php echo ROOT_WWW;?>contact-us</a>
<?php
}
?>
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