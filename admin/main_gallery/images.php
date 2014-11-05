<?php
include '../../config.php';
checkiflogged($_SESSION);
$siteconfig = getsiteconfig();
$id_business = $_SESSION['logged_in']['id_business'];


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

<link rel="stylesheet" href="<?php echo ROOT_WWW;?>admin/js/blueimp/css/blueimp-gallery.min.css">
<link rel="stylesheet" href="<?php echo ROOT_WWW;?>admin/js/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo ROOT_WWW;?>admin/js/bootstrap/css/bootstrap-theme.min.css">


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
               <h1><i class="fa fa-photo"></i> Business photos</h1>
			<h2>Upload some photos of your business premise or office.</h2>
        </div>

        <div class="content">
   



				<?php
				
$id_item=$_SESSION['logged_in']['id_business'];
$table='business';
include '../include/imageuploader.php';
?>

   
   
        </div>
    </div>
	
<div class="footer">Thanks for creating with <a target="_blank" href="<?php echo ROOT_WWW;?>"><?php echo $siteconfig['site_name'];?></a></div>
	
</div>

<script src="<?php echo ROOT_WWW;?>admin/js/ui.js"></script>

</body>
</html>