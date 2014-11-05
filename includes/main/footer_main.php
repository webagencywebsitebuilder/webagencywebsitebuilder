<footer class="grid-wrap">
<ul class="grid col-one-half social">
<li><a href="" id="back-top" title="Go back up"><i class="fa fa-chevron-up"></i></a></li>
<?php if(!empty($siteconfig['facebook'])){?><li><a target="_blank" href="<?php echo $siteconfig['facebook'];?>"><i class="fa fa-facebook fa-lg"></i> Facebook</a></li><?php }?>
<?php if(!empty($siteconfig['twitter'])){?><li><a target="_blank"  href="<?php echo $siteconfig['twitter'];?>"><i class="fa fa-twitter fa-lg"></i> Twitter</a></li><?php }?>
<?php if(!empty($siteconfig['googleplus'])){?><li><a target="_blank"  href="<?php echo $siteconfig['googleplus'];?>"><i class="fa fa-google-plus fa-lg"></i> Google+</a></li><?php }?>
<?php if(!empty($siteconfig['flickr'])){?><li><a target="_blank"  href="<?php echo $siteconfig['flickr'];?>"><i class="fa fa-flickr fa-lg"></i> Flickr</a></li><?php }?>
</ul>
<nav class="grid col-one-half">
<ul>
<li><a href="<?php echo ROOT_WWW;?>"><i class="fa fa-home fa-lg"></i> Home</a></li>
<li><a href="<?php echo ROOT_WWW;?>about-us"><i class="fa fa-briefcase fa-lg"></i> Our Work</a></li>
<li><a href="<?php echo ROOT_WWW;?>register"><i class="fa fa-magic"></i> Sign Up Free</a></li>
<li><a href="<?php echo ROOT_WWW;?>contact-us"><i class="fa fa-envelope"></i> Contact Us</a></li>
</ul>
</nav>
</footer>