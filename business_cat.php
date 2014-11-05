<?php
include 'config.php';
$regions_sql = "SELECT * FROM region";
$siteconfig = getsiteconfig();
$single_categories_sql = "SELECT * FROM categories where id_categories='".$_GET['id_categories']."'";
$single_categories_result = mysql_query($single_categories_sql);
$single_categories = mysql_fetch_array($single_categories_result);
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<title><?php echo $siteconfig['site_name'];?></title>
<?php
include 'includes/main/head_main.php';
?>
</head>
<body>
<div class="container">
<?php
include 'includes/main/header_main.php';
?>
<div class="home-page main">
<section class="grid-wrap">
<header class="grid col-full">
<hr>
<a href="about.html" class="arrow fright">see more infos</a> </header>
<div class="grid">
<div style="height:400px;width:100%;" id="map_canvas"></div>
<script type="text/javascript">
var geocoder = new google.maps.Geocoder();
<?php
$single_town_cities_sql = "SELECT * FROM town_cities where id_town_cities='$id_town_cities'";
$single_town_cities_result = mysql_query($single_town_cities_sql);
$single_town_cities = mysql_fetch_array($single_town_cities_result);
?>
var address = "<?php echo $single_town_cities['name'];?>, Mauritius";
geocoder.geocode( { 'address': address}, function(results, status) {
	if (status == google.maps.GeocoderStatus.OK) {
		var latitude = results[0].geometry.location.lat();
		var longitude = results[0].geometry.location.lng();
		initialize(latitude,longitude);
	} 
}); 
function initialize(latitude,longitude) {
	jQuery(document).ready(function () {
		// Setup the different icons and shadows
		var iconURLPrefix = '<?php echo ROOT_WWW;?>/img/icons/';
		
		var locations = [
		<?php
		$business_sql = "SELECT * FROM business b 
join business_town_cities btc on btc.id_business = b.id_business
join business_categories bc on bc.id_business = btc.id_business
where btc.id_town_cities = '".$_GET['id_town_cities']."'
and bc.id_categories = '".$_GET['id_categories']."'
order by b.name ASC";
		$business_result = mysql_query($business_sql);
		$comma = "";
		while ($row = mysql_fetch_assoc($business_result)){
			$first_image_sql = "SELECT * FROM business_image bi
where bi.id_business = '".$row['id_business']."' limit 1";
			$first_image_result = mysql_query($first_image_sql);
			$first_image = mysql_fetch_array($first_image_result);
			$icon = get_map_icon($row['id_categories']);
			echo $comma;
			?>['<h5><?php echo addslashes($row['name']);?></h5><?php if(!empty($first_image)){ ?><img src="<?php echo ROOT_WWW;?>uploads/images/<?php echo $row['id_business'];?>/business/thumbnail/<?php echo $first_image['name'];?>" alt=""><?php  }else{}?><address style="font-size:14px;"><?php echo $row['address'];?> Rose Belle, Mauritius</address><span style="font-size:14px;" >Tel: <?php echo $row['photo_number'];?></span><br><span style="font-size:14px;" >Email: <?php echo $row['email'];?></span>', 
			<?php echo $row['latitude'];?>, 
			<?php echo $row['longitude'];?>,iconURLPrefix+'<?php echo $icon;?>']<?php $comma = ',';
		}?>
		];
		
		var icons = [
		iconURLPrefix + 'red-dot.png',
		iconURLPrefix + 'green-dot.png',
		iconURLPrefix + 'blue-dot.png',
		iconURLPrefix + 'orange-dot.png',
		iconURLPrefix + 'purple-dot.png',
		iconURLPrefix + 'pink-dot.png',      
		iconURLPrefix + 'yellow-dot.png'
		]
		var icons_length = icons.length;
		
		
		
		
		
		
		var shadow = {
anchor: new google.maps.Point(15,33),
url: iconURLPrefix + 'msmarker.shadow.png'
		};
		var map = new google.maps.Map(document.getElementById('map_canvas'), {
zoom: 12,
center: new google.maps.LatLng(latitude, longitude),
mapTypeId: google.maps.MapTypeId.ROADMAP,
mapTypeControl: true,
streetViewControl: false,
panControl: true,
zoomControlOptions: {
position: google.maps.ControlPosition.LEFT_BOTTOM
			}
		});
		var infowindow = new google.maps.InfoWindow({
maxWidth: 160
		});
		var marker;
		var markers = new Array();
		
		//var iconCounter = 0;
		
		// Add the markers and infowindows to the map
		for (var i = 0; i < locations.length; i++) {  
			marker = new google.maps.Marker({
position: new google.maps.LatLng(locations[i][1], locations[i][2]),
map: map
				//icon : locations[i][3]
				//shadow: shadow
			});
			markers.push(marker);
			google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function() {
					infowindow.setContent(locations[i][0]);
					infowindow.open(map, marker);
				}
			})(marker, i));
			
			// iconCounter++;
			// We only have a limited number of possible icon colors, so we may have to restart the counter
			//if(iconCounter >= icons_length){
			//	iconCounter = 0;
			// }
		}
		function AutoCenter() {
			//  Create a new viewpoint bound
			var bounds = new google.maps.LatLngBounds();
			//  Go through each...
			$.each(markers, function (index, marker) {
				bounds.extend(marker.position);
			});
			//  Fit these bounds to the map
			map.fitBounds(bounds);
		}
		AutoCenter();	
	});	
}</script>
</div>
</section>
<section class="grid-wrap">
<div class=" grid col-two-thirds mq2-col-full">
<h3><?php echo $single_categories['name'];?> within - <a href="<?php echo ROOT_WWW;?><?php echo $section_url;?>/<?php echo $single_town_cities['id_town_cities'];?>/<?php echo generate_permalink($single_town_cities['name']);?>"><?php echo $single_town_cities['name'];?></a></h3>
<?php
include 'includes/business_cat.php';
?>
</div>
<div class="grid col-one-third mq2-col-full">
<?php
include 'includes/categories_within_town.php';
?>
<br><br>
<?php
include 'includes/district.php';
?>
</div>  
</section>
</div>
<!--main-->
<div class="divide-top">
<footer class="grid-wrap">
<ul class="grid col-one-third social">
<li><a href="#">RSS</a></li>
<li><a href="#">Facebook</a></li>
<li><a href="#">Twitter</a></li>
<li><a href="#">Google+</a></li>
<li><a href="#">Flickr</a></li>
</ul>
<div class="up grid col-one-third "> <a href="#navtop" title="Go back up">&uarr;</a> </div>
<nav class="grid col-one-third ">
<ul>
<li><a href="index.html">Home</a></li>
<li><a href="about.html">About</a></li>
<li><a href="works.html">Works</a></li>
<li><a href="services.html">Services</a></li>
<li><a href="blog.html">Blog</a></li>
<li><a href="contact.html">Contact</a></li>
</ul>
</nav>
</footer>
</div>
</div>
</body>
</html>