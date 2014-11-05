<?php
session_start();
include 'config_inc.php';
include 'classes/basic_functions.php';
try {
$db = new PDO('mysql:host='.DATABASE_HOST.';dbname='.DATABASE_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
echo 'ERROR: ' . $e->getMessage();

$referer = $_SERVER['HTTP_REFERER'];

$details = parse_url($referer);

$newpath = str_replace("/install/", "", $_SERVER['REQUEST_URI']);
$root_www = $details['scheme']."://".$details['host'].$newpath;

?>
<br><br><a href="http://<?php echo  $_SERVER['HTTP_HOST'].$newpath;?>install/">Proceed to Install</a>
<?php
exit();
}
//mysql_set_charset('utf8');
define('SERVER_ROOT', $_SERVER['DOCUMENT_ROOT'].PATH);
?>