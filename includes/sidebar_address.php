  
	  <div id="sidebar" class="grid col-one-third mq2-col-full">
	
	<a id="work_all" href="<?php echo ROOT_WWW;?><?php echo $single_business['permalink'];?>/"><i class="fa fa-home"></i> Home</a><br>
			<?php
$pages_sql = $db->query("SELECT * FROM pages p 
join pages_business pb on pb.id_pages = p.id_pages
where pb.id_business = '".$single_business['id_business']."'");
//$pages_result = mysql_query($pages_sql);
while ($row = $pages_sql->fetch()){
?>
<a href="<?php echo ROOT_WWW;?><?php echo $single_business['permalink'];?>/about_us/<?php echo $row['id_pages'];?>/<?php echo generate_permalink($row['name']);?>"><i class="fa fa-angle-double-right"></i> <?php echo $row['name'];?></a><br>
<?php } ?>


	<br>
	
	  <div style="height:300px;width:95%;" class="shadow" id="map_canvas"></div>
	  <div class="side_info_box">
	  
		<address style="font-size:16px;"> 
	  <i class="fa fa-map-marker fa-2x"></i> <?php echo $single_business['address'];?>, <?php echo $single_business['city'];?>, <?php echo $single_business['full_state'];?>, <?php echo $single_business['zip'];?>, USA</address>
	  </div>
	  <div class="side_info_box" >
	    <i class="fa fa-at fa-2x"></i> <?php echo $single_business['email'];?>
	   </div>
	   <div class="side_info_box" >
	    <i class="fa fa-phone fa-2x"></i> <?php echo $single_business['phone_number'];?>
	   </div>
	   
	   
	     <?php if(!empty($single_business['contact_detail'])){
	  
	  ?>
	  <div class="side_info_box" >
	  <i class="fa fa-envelope-o fa-2x"></i>
	  <?php
	  echo $single_business['contact_detail'];
	  ?>
	   </div>
	   <?php
	  } ?> 
	  
	  
	   
	   
	   
	   <?php if(!empty($single_business['opening_hours'])){  ?>
	   <div class="side_info_box" >
	  <i class="fa fa-clock-o fa-2x"></i> <b>Opening hours:</b>
	  <?php echo $single_business['opening_hours'];?>
	   </div>
	   <?php
	   } ?>
      </div>

	<script>
var map;
function initialize() {
var centerLatlng = new google.maps.LatLng(<?php echo $single_business['latitude'];?>, <?php echo $single_business['longitude'];?>);

  var mapOptions = {
    zoom: 16,
    center: centerLatlng
  };
  map = new google.maps.Map(document.getElementById('map_canvas'),
      mapOptions);
	  
	marker = new google.maps.Marker({
        map: map,
        position: centerLatlng
    });  
	  
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->

