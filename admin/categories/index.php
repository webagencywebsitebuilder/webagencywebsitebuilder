<?php
include '../../config.php';

//Index of Module Page
$siteconfig = getsiteconfig();
checkiflogged($_SESSION);
$id_business = $_SESSION['logged_in']['id_business'];

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">
<title>Categories - <?php echo $siteconfig['site_name'];?></title>
<?php
include '../include/head.php';
?>
</head>
<body>
<div id="layout">
<!-- Menu toggle -->
<a href="#menu" id="menuLink" class="menu-link">
<!-- Hamburger icon -->
<span></span>
</a>
<?php
include '../include/sidebar.php';
?>
<div id="main">
<div class="header">
<h1><i class="fa fa-sitemap"></i> List of categories</h1>
<span><a class='pure-button' href="<?php echo ROOT_WWW;?>admin/add-category"><i class="fa fa-plus-circle"></i> Add category</a></span><br><br>
</div>
<div class="content">

<table class="pure-table pure-table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Edit</th>
			 <th>Delete</th>
        </tr>
    </thead>

    <tbody>
	
	<?php
	$categories = $db->query("SELECT * FROM categories");
	$count = 1;
	while ($row = $categories->fetch()){
$count_business_sql = $db->query("SELECT count(*) as count from business_categories where id_categories='".$row['id_categories']."'");
$count_business = $count_business_sql->fetch();
		?>
        <tr>
            <td><?php echo $count;?></td>
            <td><?php echo $row['name'];?> (<?php echo $count_business['count'];?>)</td>
            <td><?php $shortdesc = myTruncate($row['text'], 30);
			echo $shortdesc;
			?></td>
            <td><a class='pure-button' href="<?php echo ROOT_WWW;?>admin/modify-category/<?php echo $row['id_categories'];?>"><i class="fa fa-cog"></i> Edit</a></td>
			<td>
			<?php
			if($count_business['count'] == "0"){
			?><a class='delete pure-button' href="<?php echo ROOT_WWW;?>admin/category/<?php echo $row['id_categories'];?>/delete/<?php echo md5(date('d'));?>" ><i class="fa fa-remove"></i> Delete</a>
			<?php 
			}else{}
			?>
			</td>
        </tr>
<?php

	$count = $count + 1;
	}
	?>
   
        
    </tbody>
</table>


</div>
</div>
<div style="font-size:0.8em;bottom:0px;width:100%;text-align:center;">Thanks for creating with <a target="_blank" href="<?php echo ROOT_WWW;?>"><?php echo $siteconfig['site_name'];?></a></div>
</div>
<script src="<?php echo ROOT_WWW;?>admin/js/ui.js"></script>
</body>
</html>
