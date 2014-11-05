<div id="menu">
<div class="pure-menu pure-menu-open">
<a class="pure-menu-heading" target="_blank" href="<?php
			if($_SESSION['logged_in']['type']=='admin'){
			echo ROOT_WWW;
			}else{
			echo ROOT_WWW.$_SESSION['logged_in']['permalink'].'/';
			}
			?>"><i class="fa fa-eye"></i> View Website</a>
<ul>
<?php
if($_SESSION['logged_in']['type']=='admin'){
	?>
	<li class="menu-item-divided" ><a href="<?php echo ROOT_WWW;?>admin/siteconfig/siteconfig.php"><i class="fa fa-gears"></i> SiteConfig</a></li>
	<li class="menu-item-divided" ><a href="<?php echo ROOT_WWW;?>admin/categories/list"><i class="fa fa-sitemap"></i> Categories</a></li>
	
	<li class="menu-item-divided" ><a href="<?php echo ROOT_WWW;?>admin/main_admin/businesses.php"><i class="fa fa-users"></i> Manage Clients</a></li>
	<?php
}else{
	
	?>
	
	<li><a href="<?php echo ROOT_WWW;?>admin/website-detail"><i class="fa fa-gear"></i> Website Configuration</a></li>
	<li><a href="<?php echo ROOT_WWW;?>admin/business-photos"><i class="fa fa-photo"></i> Business Photos</a></li>
	<li class="menu-item-divided pure-menu-selected">
	<a href="<?php echo ROOT_WWW;?>admin/page/list"><i class="fa fa-file-text"></i> Pages</a>
	</li>

	<li class="menu-item-divided pure-menu-selected">
	<a href="<?php echo ROOT_WWW;?>admin/albums"><i class="fa fa-camera"></i> Photos Gallery</a>
	</li>

	<?php
}
?>
<li class="menu-item-divided" ><a href="<?php echo ROOT_WWW;?>admin/logout"><i class="fa fa-power-off"></i> Logout</a></li>
</ul>
</div>
</div>