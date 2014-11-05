<?php
include '../../config.php';
$id_business = $_GET['id_business'];
header("Content-type: text/css", true);
$single_business_sql = "SELECT * FROM business where id_business='$id_business'";
$single_business_result = mysql_query($single_business_sql);
$single_business = mysql_fetch_array($single_business_result);

echo $single_business['customcss'];
?>