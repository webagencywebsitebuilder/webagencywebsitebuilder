<?php
include '../../config.php';

//Index of Module Page
$siteconfig = getsiteconfig();
checkiflogged($_SESSION);
$id_business = $_SESSION['logged_in']['id_business'];

$pages_sql = $db->query("SELECT * FROM pages where id_pages = '$id_pages' and businesshash='".$_SESSION['logged_in']['businesshash']."'");
$pages = $pages_sql->fetch();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">
<title>Pages - <?php echo $siteconfig['site_name'];?></title>
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
<h1><i class="fa fa-file-text"></i> List of pages</h1>
<span><a class='pure-button' href="<?php echo ROOT_WWW;?>admin/add-page"><i class="fa fa-plus-circle"></i> Add page</a></span><br><br>
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
	$pages_sidebar = $db->query("SELECT * FROM pages p 
join pages_business pb on pb.id_pages = p.id_pages
where pb.id_business = '".$_SESSION['logged_in']['id_business']."' and pb.businesshash = '".$_SESSION['logged_in']['businesshash']."'");
	$count = 1;
	while ($row = $pages_sidebar->fetch()){

		?>
        <tr>
            <td><?php echo $count;?></td>
            <td><?php echo $row['name'];?></td>
            <td><?php $shortdesc = myTruncate($row['text'], 30);
			echo $shortdesc;
			?></td>
            <td><a class='pure-button' href="<?php echo ROOT_WWW;?>admin/modify-page/<?php echo $row['id_pages'];?>"><i class="fa fa-cog"></i> Edit</a></td>
			<td><a class='delete pure-button' href="<?php echo ROOT_WWW;?>admin/page/<?php echo $row['id_pages'];?>/delete/<?php echo md5(date('d'));?>" ><i class="fa fa-remove"></i> Delete</a></td>
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
