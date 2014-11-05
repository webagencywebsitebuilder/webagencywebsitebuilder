<?php
include '../../config.php';

$siteconfig = getsiteconfig();
checkiflogged($_SESSION);
$b = $_GET['b'];
$h = $_GET['h'];
$solhash = md5(date('d'));
if($solhash == $_GET['monhash']){
if($_GET['action']=="desactivate"){
$update_pages_sql = $db->query("UPDATE business set status='0' where id_business = '".$b."' and businesshash='".$h."'");
}elseif($_GET['action']=="activate"){
$update_pages_sql = $db->query("UPDATE business set status='1' where id_business = '".$b."' and businesshash='".$h."'");
}elseif($_GET['action']=="delete"){


$db->query("DELETE FROM business where id_business = '".$b."' and businesshash='".$h."'");

$db->query("DELETE FROM business_categories where id_business = '".$b."' and businesshash='".$h."'");

$db->query("DELETE FROM business_image where id_business = '".$b."'");

$db->query("DELETE FROM business_image where id_business = '".$b."'");

$db->query("DELETE FROM product_categories_business where id_business = '".$b."' and businesshash='".$h."'");

$db->query("DELETE FROM pages_business where id_business = '".$b."' and businesshash='".$h."'");

$db->query("DELETE FROM jobs_business where id_business = '".$b."' and businesshash='".$h."'");

}
}




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
            <h1><i class="fa fa-users"></i> Manage Clients</h1>
			 </div>

        <div class="content">
            
			
			<table class="pure-table pure-table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
			<th>Login</th>
			<th>Status</th>
			<th>Domain</th>
			<th>Status</th>
			<th>Delete</th>
        </tr>
    </thead>

    <tbody>
        <?php
		$business_sql = $db->query("SELECT b.name,b.id_business,b.email ,b.wp ,b.status, c.name as categories_name, b.address, b.businesshash, b.phone_number, zc.city, zc.full_state, zc.zip FROM business b 
		left join business_zip_codes bzc on bzc.id_business = b.id_business
		left join zip_codes zc on bzc.id_zip_codes = zc.id_zip_codes
		left join business_categories bc on bc.id_business = b.id_business
		left join categories c on bc.id_categories = c.id_categories
		left join domains d on d.id_business = b.id_business
		order by b.name ASC");
while ($row = $business_sql->fetch()){	
?>
		<tr>
            <td></td>
            <td><?php echo $row['name'];?></td>
           <td style="font-size:0.9em;"><i class='fa fa-at'></i> <?php echo $row['email'];?><br>
		   <i class='fa fa-key'></i> <?php echo $row['wp'];?>
		   </td>
            <td><?php 
			if($row['status']=='1'){
			echo "<i class='fa fa-check-circle-o'></i> Active";
			}else{
			echo "<i class='fa fa-power-off'></i> Non active";
			}?></td>
			<td>
			<a class='pure-button'  href="modify_business.php?id_business=<?php echo $row['id_business'];?>"><i class='fa fa-arrow-circle-o-right'></i> Domain</a> 
			</td><td>
			<a class='pure-button'  href="?b=<?php echo $row['id_business'];?>&action=<?php 
			if($row['status']=='1'){
			echo "desactivate";
			}else{
			echo "activate";
			}?>&monhash=<?php echo md5(date('d'));?>&h=<?php echo $row['businesshash'];?>">
			<?php 
			if($row['status']=='1'){
			echo "<i class='fa fa-power-off'></i> Desactivate";
			}else{
			echo "<i class='fa fa-power-off'></i> Activate";
			}?></a>
			</td>
			<td>
			<a class='pure-button delete' href="?b=<?php echo $row['id_business'];?>&action=delete&monhash=<?php echo md5(date('d'));?>&h=<?php echo $row['businesshash'];?>"><i class='fa fa-remove'></i> Delete</a> 
			</td>
        </tr>
<?php
}
?>  
  </tbody>
</table>
			
			
        </div>
    </div>
	
<div class="footer">Thanks for creating with <a target="_blank" href="<?php echo ROOT_WWW;?>"><?php echo $siteconfig['site_name'];?></a></div>
	
	
</div>

<script src="<?php echo ROOT_WWW;?>admin/js/ui.js"></script>

</body>
</html>