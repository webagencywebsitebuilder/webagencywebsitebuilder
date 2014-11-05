
 <div class="divide-top">
    <footer class="grid-wrap">
      
	  <div class="grid col-one-half ">
	  <ul class="social">
	  <li><a href="" id="back-top" title="Go back up"><i class="fa fa-chevron-up"></i></a></li>
	  <li><a target="_blank" href="<?php echo ROOT_WWW;?><?php echo $single_business['permalink'];?>/sitemap.xml"><i class="fa fa-sitemap fa-lg"></i> Sitemap</a></li>
	  
        <?php if(!empty($single_business['facebook'])){?>
		<li><a target="_blank" href="<?php echo $single_business['facebook'];?>"><i class="fa fa-facebook fa-lg"></i> Facebook</a></li><?php }?>
        <?php if(!empty($single_business['twitter'])){?><li><a target="_blank" href="<?php echo $single_business['twitter'];?>"><i class="fa fa-twitter fa-lg"></i> Twitter</a></li><?php }?>
        <?php if(!empty($single_business['googleplus'])){?><li><a target="_blank" href="<?php echo $single_business['googleplus'];?>"><i class="fa fa-google-plus fa-lg"></i> Google+</a></li><?php }?>
        <?php if(!empty($single_business['flickr'])){?><li><a target="_blank" href="<?php echo $single_business['flickr'];?>"><i class="fa fa-flickr fa-lg"></i> Flickr</a></li><?php }?>
      </ul>
	  </div>
      <nav class="grid col-one-half ">
        <ul>
          <?php if($single_business['client_paid']=='1'){ ?>
		  <li><i class="fa fa-copyright"></i> Copyright <?php
$phpdate = strtotime( $single_business['date_created'] );
		  echo $single_business['name'];?> <?php $date_created = date('Y', $phpdate);
		  if($date_created == date('Y')){
		  echo $date_created;
		  }else{
		  echo $date_created." - ".date('Y');
		  }
		  ?> - <?php ;?> <a href="<?php echo ROOT_WWW;?><?php echo $single_business['permalink'];?>/" ><?php echo $siteconfig['site_name'];?></a></li>
		  <?php }else{ ?>
		  <li><a href="<?php echo ROOT_WWW;?><?php echo $single_business['permalink'];?>/"><i class="fa fa-home fa-lg"></i> Home</a></li>
          <li>Powered by <a href="<?php echo ROOT_WWW;?>" ><?php echo $siteconfig['site_name'];?></a></li>
		 <?php } ?>
        </ul>
      </nav>
    </footer>
  </div>