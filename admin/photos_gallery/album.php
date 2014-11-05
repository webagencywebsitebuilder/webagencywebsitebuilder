<?php
include '../../config.php';
$id_business = $_SESSION['logged_in']['id_business'];
$id_album = $_GET['id_album'];
$siteconfig = getsiteconfig();

$solhash = md5(date('d'));
if($solhash == $_GET['monhash']){
$db->query("DELETE FROM album where id_album = '".$id_album."' and businesshash='".$_SESSION['logged_in']['businesshash']."'");
$db->query("DELETE FROM album_business where id_album = '".$id_album."' and businesshash='".$_SESSION['logged_in']['businesshash']."'");
$db->query("DELETE FROM album_image where id_album = '".$id_album."'");
header("Location:".ROOT_WWW."admin/albums");
}


if($_POST['action']=='modify'){

$update_album = $db->query("UPDATE album set name='".$_POST['name']."', text='".$_POST['text']."' where id_album = '".$_POST['id_album']."' and businesshash='".$_SESSION['logged_in']['businesshash']."'");
//$update_album_result = mysql_query($update_album_sql);
header("Location:".ROOT_WWW."admin/albums");

}elseif($_POST['action']=='add'){
$insert_album = $db->query("INSERT into album (name,text,businesshash) VALUES ('".$_POST['name']."','".$_POST['text']."','".$_SESSION['logged_in']['businesshash']."')");
//mysql_query($insert_album_sql);
$id_album = $db->lastInsertId();
$insert_album_business = $db->query("INSERT into album_business (id_album,id_business,businesshash) VALUES ('".$id_album."','".$_POST['id_business']."','".$_SESSION['logged_in']['businesshash']."')");
//mysql_query($insert_album_business);
header("Location:".ROOT_WWW."admin/albums");
}

$album_sql = $db->query("SELECT * FROM album where id_album = '$id_album' and businesshash='".$_SESSION['logged_in']['businesshash']."'");
$album = $album_sql->fetch();
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
    

</head>
<body>



<script>
$().ready(function() {
$("#albumForm").validate({
ignore: [],
rules: {
name: "required"
		},
messages: {
name: "Please enter album name"
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
            <h1><i class="fa fa-camera"></i> <?php
			if(isset($_GET['id_album'])){
			echo $album['name'];
			}else{
			echo "Add Album";
			}
			?></h1>
		</div>

        <div class="content">
           <form method="POST" id="albumForm" class="pure-form pure-form-stacked" action="" >
<label for="name">Album name</label>
<input type="text" name='name' id="name" value="<?php echo $album['name'];?>" />
<br>
<label for="text">Album description</label>
<textarea class="editor" name='text' id="editor1" ><?php echo $album['text'];?></textarea>

<script>
CKEDITOR.replace( 'editor1',
	{
		toolbar : 'Basic'
	});
</script>

<br>
<input type="hidden" name='id_business' value="<?php echo $_SESSION['logged_in']['id_business'];?>" />
<input type="hidden" name='id_album' value="<?php echo $_GET['id_album'];?>" />
<input type="hidden" name='action' value="<?php echo $_GET['action'];?>" />
<button type="submit" class="pure-button pure-button-primary" ><i class="fa fa-save"></i> Save album</button>

<a class="pure-button pure-button-primary" href="<?php echo ROOT_WWW;?>admin/albums" ><i class="fa fa-arrow-left"></i> Back</a>

</form>
        </div>
    </div>

<div class="footer" >Thanks for creating with <a target="_blank" href="<?php echo ROOT_WWW;?>"><?php echo $siteconfig['site_name'];?></a></div>	
	
</div>

<script src="<?php echo ROOT_WWW;?>admin/js/ui.js"></script>

</body>
</html>
