<?php
include '../../config.php';
$siteconfig = getsiteconfig();
checkiflogged($_SESSION);
$id_business = $_SESSION['logged_in']['id_business'];
$id_pages = $_GET['id_pages'];
$solhash = md5(date('d'));
if($solhash == $_GET['monhash']){
	$db->query("DELETE FROM pages where id_pages = '$id_pages' and businesshash='".$_SESSION['logged_in']['businesshash']."'");
	header("Location:".ROOT_WWW."admin/page/list");
}
if($_POST['action']=='modify'){
	$update_pages_sql = $db->query("UPDATE pages set name='".$_POST['name']."', text='".$_POST['text']."' where id_pages = '".$_POST['id_pages']."' and businesshash='".$_SESSION['logged_in']['businesshash']."'");
	//$update_pages_result = mysql_query($update_pages_sql);
	header("Location:".ROOT_WWW."admin/page/list");
}elseif($_POST['action']=='add'){
	$insert_pages_sql = $db->query("INSERT into pages (name,text,businesshash,status) VALUES ('".$_POST['name']."','".$_POST['text']."','".$_SESSION['logged_in']['businesshash']."','".$_POST['status']."')");
	//mysql_query($insert_pages_sql);
	$id_pages = $db->lastInsertId();
	$insert_pages_business = $db->query("INSERT into pages_business (id_pages,id_business,businesshash) VALUES ('".$id_pages."','".$_POST['id_business']."','".$_SESSION['logged_in']['businesshash']."')");
	//mysql_query($insert_pages_business);
	header("Location:".ROOT_WWW."admin/page/list");
}
$pages_sql = $db->query("SELECT * FROM pages where id_pages = '$id_pages' and businesshash='".$_SESSION['logged_in']['businesshash']."'");
$pages = $pages_sql->fetch();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">
<title>Pages - <?php echo $siteconfig['site_name'];?></title>
<?php
include '../include/head.php';
?>
</head>
<body>


<script>
$().ready(function() {
	
$("#pagesForm").validate({
ignore: [],
rules: {
name: "required"
		},
messages: {
name: "Please enter page title"
		}
	});
});
</script>



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
<h1><i class="fa fa-file-text"></i> <?php if(!isset($id_pages)){
	echo "Add page";
}else{
	echo $pages['name'];
} ?></h1>
</div>
<div class="content">
<form method="POST" id="pagesForm" class="pure-form pure-form-stacked" action="" >
<fieldset>
<label for="name">Name</label> <input type="text" style="width:100%;" name='name' id="name" value="<?php echo $pages['name'];?>" />
<br>
<label for="text">Page Content:</label>
<textarea class="editor" name='text' id="editor1" ><?php echo $pages['text'];?></textarea>
<script>
CKEDITOR.replace( 'editor1',
{
	toolbar : 'Full'
});
</script>
<br>
<input type="hidden" name='id_business' value="<?php echo $_SESSION['logged_in']['id_business'];?>" />
<input type="hidden" name='id_pages' value="<?php echo $_GET['id_pages'];?>" />
<input type="hidden" name='action' value="<?php echo $_GET['action'];?>" />
<button type="submit" class="pure-button pure-button-primary" ><i class="fa fa-save"></i> Save page</button>
<a class="pure-button pure-button-primary" href="<?php echo ROOT_WWW;?>admin/page/list" ><i class="fa fa-arrow-left"></i> Back</a>

</fieldset>
</form>
</div>
</div>

<div style="font-size:0.8em;bottom:0px;width:100%;text-align:center;">Thanks for creating with <a target="_blank" href="<?php echo ROOT_WWW;?>"><?php echo $siteconfig['site_name'];?></a></div>


</div>
<script src="<?php echo ROOT_WWW;?>admin/js/ui.js"></script>
</body>
</html>
