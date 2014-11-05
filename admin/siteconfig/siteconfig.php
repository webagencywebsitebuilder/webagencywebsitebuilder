<?php
include '../../config.php';


checkiflogged($_SESSION);
$siteconfig = getsiteconfig();

if(isset($_POST['id_site_config'])){

$update_site_config = $db->query("UPDATE site_config set site_name='".$_POST['site_name']."'
,site_description='".$_POST['site_description']."'
,contact_detail='".$_POST['contact_detail']."'
,admin_text='".$_POST['admin_text']."'
,facebook='".$_POST['facebook']."'
,twitter='".$_POST['twitter']."'
,googleplus='".$_POST['googleplus']."'
,flickr='".$_POST['flickr']."'


,sharethis='".$_POST['sharethis']."'
,box_one='".$_POST['box_one']."'
,box_two='".$_POST['box_two']."'
,box_three='".$_POST['box_three']."'

where id_site_config = '".$_POST['id_site_config']."'");
header("Location:../");
}

$site_config = $db->query("SELECT * FROM site_config");
$site_config = $site_config->fetch();
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
            <h1><i class="fa fa-gears"></i> Site Config</h1><?php echo date('Y-m-d');?>
		</div>

        <div class="content">
            <form method="POST" class="pure-form pure-form-stacked" action="" >
<fieldset>
<label for="name">Website name:</label> <input type="text" style="width:100%;" name='site_name' id="site_name" value="<?php echo $site_config['site_name'];?>" />
<br>
<label for="text">About Us:</label>
<textarea class="editor" name='site_description' id="editor1" ><?php echo $site_config['site_description'];?></textarea>
<script>
CKEDITOR.replace( 'editor1',
	{
		toolbar : 'Full'
	});
</script>
<br>




<label for="text">Contact Detail:</label>
<textarea class="editor" name='contact_detail' id="contact_detail" ><?php echo $site_config['contact_detail'];?></textarea>
<script>
CKEDITOR.replace( 'contact_detail',
	{
		toolbar : 'Basic'
	});
</script>

<br>

<label for="text">Admin text:</label>
<textarea class="editor" name='admin_text' id="admin_text" ><?php echo $site_config['admin_text'];?></textarea>
<script>
CKEDITOR.replace( 'admin_text',
	{
		toolbar : 'Full'
	});
</script>


<br>




<div class="pure-g">
    <div class="pure-u-1-3"><textarea class="editor" name='box_one' id="box_one" ><?php echo $site_config['box_one'];?></textarea></div>
    <div class="pure-u-1-3"><textarea class="editor" name='box_two' id="box_two" ><?php echo $site_config['box_two'];?></textarea></div>
    <div class="pure-u-1-3"><textarea class="editor" name='box_three' id="box_three" ><?php echo $site_config['box_three'];?></textarea></div>
</div>

<script>
CKEDITOR.replace( 'box_one',
	{
		toolbar : 'Custom'
	});
</script>
<script>
CKEDITOR.replace( 'box_two',
	{
		toolbar : 'Custom'
	});
</script>
<script>
CKEDITOR.replace( 'box_three',
	{
		toolbar : 'Custom'
	});
</script>

<br>
<label for="sharethis">Sharethis Publisher Key:</label>
<input type="text" name='sharethis' id="sharethis" value="<?php echo $site_config['sharethis'];?>" />


<label for="facebook">Facebook:</label>
<input type="text" name='facebook' id="facebook" value="<?php echo $site_config['facebook'];?>" />

<label for="twitter">Twitter:</label>
<input type="text" name='twitter' id="twitter" value="<?php echo $site_config['twitter'];?>" />

<label for="googleplus">Google+:</label>
<input type="text" name='googleplus' id="googleplus" value="<?php echo $site_config['googleplus'];?>" />

<label for="flickr">Flickr:</label>
<input type="text" name='flickr' id="flickr" value="<?php echo $site_config['flickr'];?>" />
<br>
<input type="hidden" name='id_site_config' value="<?php echo $site_config['id_site_config'];?>" />
<input type="hidden" name='action' value="<?php echo $_GET['action'];?>" />
<input type='submit' class="pure-button pure-button-primary" name='submit' value='submit' /><br>
</fieldset>
</form>
        </div>
    </div>
<div style="font-size:0.8em;bottom:0px;width:100%;text-align:center;">Thanks for creating with <a target="_blank" href="<?php echo ROOT_WWW;?>"><?php echo $siteconfig['site_name'];?></a></div>
</div>
<script src="../js/ui.js"></script>
</body>
</html>
