<?php 
$referer = $_SERVER['HTTP_REFERER'];

$details = parse_url($referer);

$newpath = str_replace("install/install.php", "", $details['path']);
$newpath = str_replace("install/", "", $newpath);
$root_www = $details['scheme']."://".$details['host'].$newpath;
?>
<!DOCTYPE html>
<html>
<head>
<title>Webagency Regional Website Builder Installation Script</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo $root_www;?>site/css/pure.css">
</head>
<body style="padding:25px;">
<h1>Installation of Web Angency Website Builder</h1>
<?php
function step_1(){ 

global $newpath;
global $root_www;

 if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agree'])){
  header('Location: install.php?step=2');
  exit;
 }
 if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['agree'])){
  echo "You must agree to the license.";
 }
?>

<h2>version 1</h2>

<iframe style="width:600px;height:400px;" src="license.html"  ></iframe>
 
 
 <form class="pure-form" action="install.php?step=1" method="post">
 <p>
  I agree to the license
  <input type="checkbox" name="agree" />
 </p>
  <input type="submit" class="pure-button pure-button-primary" value="Continue" />
 </form>
<?php 
}


function step_2(){

global $newpath;
global $root_www;

  if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['pre_error'] ==''){
   header('Location: install.php?step=3');
   exit;
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['pre_error'] != '')
   echo $_POST['pre_error'];
      
  if (phpversion() < '5.0') {
   $pre_error = 'You need to use PHP5 or above for our site!<br />';
  }
  if (ini_get('session.auto_start')) {
   $pre_error .= 'Our site will not work with session.auto_start enabled!<br />';
  }
  if (!extension_loaded('mysql')) {
   $pre_error .= 'MySQL extension needs to be loaded for our site to work!<br />';
  }
  if (!extension_loaded('gd')) {
   $pre_error .= 'GD extension needs to be loaded for our site to work!<br />';
  }
  if (!is_writable('../config_inc.php')) {
   $pre_error .= 'config_inc.php needs to be writable for our site to be installed!';
  }
  ?>
  <h2>version 1</h2>
  <h3>Checking server requirements</h3>
  <table class="pure-table pure-table-bordered pure-table-striped" >
  <tr>
   <td>PHP Version:</td>
   <td><?php echo phpversion(); ?></td>
   <td>5.0+</td>
   <td><?php echo (phpversion() >= '5.0') ? 'Ok' : 'Not Ok'; ?></td>
  </tr>
  <tr>
   <td>Session Auto Start:</td>
   <td><?php echo (ini_get('session_auto_start')) ? 'On' : 'Off'; ?></td>
   <td>Off</td>
   <td><?php echo (!ini_get('session_auto_start')) ? 'Ok' : 'Not Ok'; ?></td>
  </tr>
  <tr>
   <td>MySQL:</td>
   <td><?php echo extension_loaded('mysql') ? 'On' : 'Off'; ?></td>
   <td>On</td>
   <td><?php echo extension_loaded('mysql') ? 'Ok' : 'Not Ok'; ?></td>
  </tr>
  <tr>
   <td>GD:</td>
   <td><?php echo extension_loaded('gd') ? 'On' : 'Off'; ?></td>
   <td>On</td>
   <td><?php echo extension_loaded('gd') ? 'Ok' : 'Not Ok'; ?></td>
  </tr>
  <tr>
   <td>config_inc.php</td>
   <td><?php echo is_writable('../config_inc.php') ? 'Writable' : 'Unwritable'; ?></td>
   <td>Writable</td>
   <td><?php echo is_writable('../config_inc.php') ? 'Ok' : 'Not Ok'; ?></td>
  </tr>
  </table>
  <br>
  <form action="install.php?step=2" method="post">
   <input type="hidden" name="pre_error" id="pre_error" value="<?php echo $pre_error;?>" />
   <input type="submit" class="pure-button pure-button-primary" name="continue" value="Continue" />
  </form>
<?php
}


function step_3(){

global $newpath;
global $root_www;

  if (isset($_POST['submit']) && $_POST['submit']=="Install!") {
   $database_host=isset($_POST['database_host'])?$_POST['database_host']:"";
   $database_name=isset($_POST['database_name'])?$_POST['database_name']:"";
   $site_name=isset($_POST['site_name'])?$_POST['site_name']:"";
   $database_username=isset($_POST['database_username'])?$_POST['database_username']:"";
   $database_password=isset($_POST['database_password'])?$_POST['database_password']:"";
   $admin_email=isset($_POST['admin_email'])?$_POST['admin_email']:"";
   $admin_password=isset($_POST['admin_password'])?$_POST['admin_password']:"";
  
  if (empty($admin_email) || empty($admin_password) || empty($database_host) || empty($database_username) || empty($database_name)) {
   echo "All fields are required! Please re-enter.<br />";
  } else {
   $connection = mysql_connect($database_host, $database_username, $database_password);
   mysql_select_db($database_name, $connection);
  
   $file ='../webagency.sql';
   if ($sql = file($file)) {
   $query = '';
   foreach($sql as $line) {
    $tsl = trim($line);
   if (($sql != '') && (substr($tsl, 0, 2) != "--") && (substr($tsl, 0, 1) != '#')) {
   $query .= $line;
  
   if (preg_match('/;\s*$/', $line)) {
  
    mysql_query($query, $connection);
    $err = mysql_error();
    if (!empty($err))
      break;
   $query = '';
   }
   }
   }
   @mysql_query("UPDATE site_config SET 
   site_admin_username='".$admin_email."',
   site_name='".$site_name."',
   site_admin_password = md5('" . $admin_password . "') where id_site_config='1'");
   mysql_close($connection);
   }
   $f=fopen("../config_inc.php","w");
   $database_inf="<?php
     define('DATABASE_HOST', '".$database_host."');
     define('DATABASE_NAME', '".$database_name."');
     define('DATABASE_USERNAME', '".$database_username."');
     define('DATABASE_PASSWORD', '".$database_password."');
	 define('ROOT_WWW', '".$root_www."');
     define('PATH', '".$newpath."');
     define('ADMIN_EMAIL', '".$admin_email."');
     define('ADMIN_PASSWORD', '".$admin_password."');
     ?>";
  if (fwrite($f,$database_inf)>0){
   fclose($f);
  }
  

  
  header("Location: install.php?step=4");
  }
  }
?>
<h2>version 1</h2>
  <form method="post" class="pure-form" action="install.php?step=3">
  <fieldset>
  <p>
   <input type="text" name="database_host" value='localhost' size="30">
   <label for="database_host">Database Host</label>
 </p>
 <br>
 <p>
   <input type="text" name="database_name" size="30" value="<?php echo $database_name; ?>">
   <label for="database_name">Database Name</label>
 </p>
 <br>
 <p>
   <input type="text" name="database_username" size="30" value="<?php echo $database_username; ?>">
   <label for="database_username">Database Username</label>
 </p>
 <br>
 <p>
   <input type="text" name="database_password" size="30" value="<?php echo $database_password; ?>">
   <label for="database_password">Database Password</label>
  </p>
  <br/>
    <p>
   <input type="text" name="site_name" size="30" value="<?php echo $site_name; ?>">
   <label for="site_name">Website Name</label>
 </p>
 <br>
 <p>
   <input type="text" name="root_www_url" size="30" value="<?php echo $root_www;?>">
   <label for="root_www_url">Server ROOT</label>
 </p>
 <br>
  <p>
   <input type="text" name="path" size="30" value="<?php echo $newpath; ?>">
   <label for="path">Path</label>
 </p>
  <br>
  <p>
   <input type="text" name="admin_email" size="30" value="<?php echo $admin_email; ?>">
   <label for="admin_email">Admin Email</label>
 </p>
 <br>
 <p>
   <input name="admin_password" type="text" size="30" maxlength="15" value="<?php echo $admin_password; ?>">
   <label for="admin_password">Admin Password</label>
  </p>
 <p>
   <input type="submit" class="pure-button pure-button-primary" name="submit" value="Install!">
  </p>
  </fieldset>
  </form>
<?php
}



function step_4(){

global $newpath;
global $root_www;

?>

<h2>Your website has been installed</h2>
 <p><a href="<?php echo $root_www;?>">Site home page.</a></p>
 <p>Please delete or rename "/install/" folder for security reason.</p>
<?php 
}




$step = (isset($_GET['step']) && $_GET['step'] != '') ? $_GET['step'] : '';
switch($step){
  case '1':
  step_1();
  break;
  case '2':
  step_2();
  break;
  case '3':
  step_3();
  break;
  case '4':
  step_4();
  break;
  default:
  step_1();
}
?>
</body>
</html>