<?php
include '../../config.php';
$id_business = $_SESSION['logged_in']['id_business'];
$id_album = $_GET['id_album'];
$siteconfig = getsiteconfig();

$album = $db->query("SELECT * FROM album where id_album = '$id_album'");
$album = $album->fetch();



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

<link rel="stylesheet" href="<?php echo ROOT_WWW;?>admin/imageuploader/blueimp/blueimp-gallery.min.css">
<link rel="stylesheet" href="<?php echo ROOT_WWW;?>admin/imageuploader/blueimp/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo ROOT_WWW;?>admin/imageuploader/blueimp/bootstrap-theme.min.css">


<link rel="stylesheet" href="<?php echo ROOT_WWW;?>admin/imageuploader/css/jquery.fileupload.css">
<link rel="stylesheet" href="<?php echo ROOT_WWW;?>admin/imageuploader/css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="<?php echo ROOT_WWW;?>admin/uploadimage/css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="<?php echo ROOT_WWW;?>admin/uploadimage/css/jquery.fileupload-ui-noscript.css"></noscript>    

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
            <h1><i class="fa fa-camera"></i> Managing photos</h1>
			
			<h2><i class="fa fa-angle-double-right"></i> <?php echo $album['name'];?></h2>
			
        </div>

        <div class="content">
   






<br>
<input type="hidden" name='id_business' value="<?php echo $_SESSION['logged_in']['id_business'];?>" />
<input type="hidden" name='id_album' value="<?php echo $_GET['id_album'];?>" />

				<?php
				
$id_item=$_GET['id_album'];
$table='album';
include '../include/imageuploader.php';
?>

   
   
<a class="pure-button pure-button-primary" href="<?php echo ROOT_WWW;?>admin/albums" ><i class="fa fa-arrow-left"></i> Back</a>

        </div>
    </div>
	
<div class="footer" >Thanks for creating with <a target="_blank" href="<?php echo ROOT_WWW;?>"><?php echo $siteconfig['site_name'];?></a></div>
</div>



<script src="<?php echo ROOT_WWW;?>admin/js/ui.js"></script>


</body>
</html>
