<link rel="stylesheet" href="<?php echo ROOT_WWW;?>admin/css/layouts/pure.css">
<script src="<?php echo ROOT_WWW;?>admin/ckeditor/ckeditor.js"></script>
<!--[if lte IE 8]>
<link rel="stylesheet" href="css/layouts/side-menu-old-ie.css">
<![endif]-->
<!--[if gt IE 8]><!-->
<link rel="stylesheet" href="<?php echo ROOT_WWW;?>admin/css/layouts/side-menu.css">
<!--<![endif]-->
<link href="<?php echo ROOT_WWW;?>js/ui/css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="<?php echo ROOT_WWW;?>js/ui/js/jquery-1.10.2.js"></script>
<script src="<?php echo ROOT_WWW;?>js/ui/js/jquery-ui-1.10.4.custom.js"></script>
<link rel="stylesheet" href="<?php echo ROOT_WWW;?>js/font-awesome/css/font-awesome.css">
<link href="<?php echo ROOT_WWW;?>js/ui/css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<?php /*
<script src="<?php echo ROOT_WWW;?>js/validate/lib/jquery.js"></script>
*/ ?>
<script src="<?php echo ROOT_WWW;?>js/md5/jquery.md5.js"></script>
<script src="<?php echo ROOT_WWW;?>js/validate/dist/jquery.validate.js"></script>
<script src="<?php echo ROOT_WWW;?>js/slug/slugify.js"></script>

<script>
$(function() {
	$(".delete").on("click", null, function(){
		return confirm("Are you sure you want to delete selected item?");
	});
	
	
	$(".save").on("click", null, function(){
		return confirm("Are you sure you want to save?");
	});
	
});
</script>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo ROOT_WWW;?>site/img/favicon.ico">
<link rel="shortcut icon" type="image/png" href="<?php echo ROOT_WWW;?>site/img/favicon.png">