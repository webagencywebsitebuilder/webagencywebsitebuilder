  <section class="works grid-wrap links" id="links" >
      <header class="grid col-full">
        <hr>
        <a href="<?php echo ROOT_WWW;?>web/<?php echo $single_business['permalink'];?>" class="arrow fright"><i class="fa fa-camera fa-lg"></i> View main gallery</a> </header>
		<?php
 $business_images = $db->query("SELECT * FROM business_image where id_business = '".$single_business['id_business']."'");
?>
<?php while ($row = $business_images->fetch()){
?><figure style="margin-bottom:2em;" class="grid col-one-quarter mq2-col-one-half mq3-col-full "><a class="fancybox drop-shadow raised" title="<?php echo $single_business['name'];?>" rel="group" href="<?php echo ROOT_WWW;?>/uploads/images/<?php echo $single_business['id_business'];?>/business/<?php echo $row['name'];?>"> <img src="<?php echo ROOT_WWW;?>/uploads/images/<?php echo $single_business['id_business'];?>/business/medium/<?php echo $row['name'];?>" alt=""></a>
      </figure>
	  <?php
	  }?>
    </section>
	
	
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
	
	$(document).ready(function() {
		$(".product").fancybox();
	});
	
</script>