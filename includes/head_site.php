<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo ROOT_WWW;?>site/img/favicon.ico">
<link rel="shortcut icon" type="image/png" href="<?php echo ROOT_WWW;?>site/img/favicon.png">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo ROOT_WWW;?>site/css/style.css">

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>




<link href='http://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Maven+Pro' rel='stylesheet' type='text/css'>

<!-- Add jQuery library -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="<?php echo ROOT_WWW;?>js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo ROOT_WWW;?>js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

<link rel="stylesheet" href="<?php echo ROOT_WWW;?>js/font-awesome/css/font-awesome.css">

<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "<?php echo $siteconfig['sharethis'];?>, doNotHash: true, doNotCopy: true, hashAddressBar: false});</script>
<script>
$(document).ready(function(){

	// fade in #back-top
	$(function () {
	

		// scroll body to 0px on click
		$('#back-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});
</script>

