<?php 

$referer = $_SERVER['HTTP_REFERER'];

$details = parse_url($referer);

$newpath = str_replace("install/", "", $_SERVER['REQUEST_URI']);
$root_www = $details['scheme']."://".$details['host'].$newpath;
?>

<!DOCTYPE html>
<html>
<head>
<title>Webagency Regional Website Builder Installation Script</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://<?php echo  $_SERVER['HTTP_HOST'].$newpath;?>site/css/pure.css">
<link rel="stylesheet" href="http://<?php echo  $_SERVER['HTTP_HOST'].$newpath;?>js/slider/responsiveslides.css">


</head>
<body style="padding:25px;">

<a class="buttonbig" href="install.php?step=1" ><span>Install Script</span></a>
</body>
</html>