<header id="navtop"> <a href="<?php echo ROOT_WWW;?><?php echo $single_business['permalink']."/";?>" class="logo fleft"><h1><?php echo $single_business['name'];?></h1></a>
    <nav class="fright">
	<?php
		$image_gallery_count = Site::check_image_gallery($single_business['id_business']);
		if( $image_gallery_count == 0){}else{
		?>
      <ul>
        <li><a href="<?php echo ROOT_WWW;?><?php echo $single_business['permalink'];?>/image_gallery"><i class="fa fa-camera"></i> Image Gallery</a></li>
      </ul>
	  <?php
	  }?>

      <ul>
        <li><a href="<?php echo ROOT_WWW;?><?php echo $single_business['permalink'];?>/contact_us"><i class="fa fa-envelope fa-lg"></i> Contact</a></li>
      </ul>
    </nav>
  </header>