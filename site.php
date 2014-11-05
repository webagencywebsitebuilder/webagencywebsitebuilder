<?php
include 'config.php';
include 'classes/site.php';
$current_business = Site::getBusinessFromPermalink($_GET['permalink']);
$template = new Template('templates/'.$current_business['theme'].'/index.php');
$template->set('title', $current_business['name']);
$template->set('current_business', $current_business);
$template->set('root_www', ROOT_WWW);
echo $template->render();
?>