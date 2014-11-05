<?php
include '../../config.php';

//Index of Module Page
$siteconfig = getsiteconfig();
checkiflogged($_SESSION);
$id_business = $_SESSION['logged_in']['id_business'];

$album_sql = $db->query("SELECT * FROM album where id_album = '$id_album' and businesshash='".$_SESSION['logged_in']['businesshash']."'");
$album = $album_sql->fetch();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">
<title><?php echo $siteconfig['site_name'];?></title>
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
<h1><i class="fa fa-camera"></i> List of album</h1>
<span><a class='pure-button' href="<?php echo ROOT_WWW;?>admin/add-album"><i class="fa fa-plus-circle"></i> Add album</a></span><br><br>
</div>
<div class="content">

<table class="pure-table pure-table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
			<th>Manage photos</th>
            <th>Edit</th>
			<th>Delete</th>
        </tr>
    </thead>

    <tbody>
	
	<?php
	$album_sidebar = $db->query("SELECT * FROM album p 
join album_business pb on pb.id_album = p.id_album
where pb.id_business = '".$_SESSION['logged_in']['id_business']."' and pb.businesshash = '".$_SESSION['logged_in']['businesshash']."'");
	$count = 1;
	while ($row = $album_sidebar->fetch()){

		?>
        <tr>
            <td><?php echo $count;?></td>
            <td><?php echo $row['name'];?></td>
			<td><a class='pure-button' href="<?php echo ROOT_WWW;?>admin/add-image-to-album/<?php echo $row['id_album'];?>"><i class="fa fa-camera-retro"></i> Manage photos</a></td>
            <td><a class='pure-button' href="<?php echo ROOT_WWW;?>admin/modify-album/<?php echo $row['id_album'];?>"><i class="fa fa-cog"></i> Edit</a></td>
			<td><a class='delete pure-button' href="<?php echo ROOT_WWW;?>admin/album/<?php echo $row['id_album'];?>/delete/<?php echo md5(date('d'));?>" ><i class="fa fa-remove"></i> Delete</a></td>
        </tr>
<?php

	$count = $count + 1;
	}
	?>
   
        
    </tbody>
</table>


</div>
</div>

<div class="footer" >Thanks for creating with <a target="_blank" href="<?php echo ROOT_WWW;?>"><?php echo $siteconfig['site_name'];?></a></div>

</div>
<script src="<?php echo ROOT_WWW;?>admin/js/ui.js"></script>
</body>
</html>
