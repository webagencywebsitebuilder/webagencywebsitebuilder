<?php
include '../../config.php';
$siteconfig = getsiteconfig();
checkiflogged($_SESSION);
$id_business = $_SESSION['logged_in']['id_business'];


if(isset($_POST['id_business'])){
$db->query("UPDATE business SET name = '".$_POST['name']."', 
email = '".$_POST[email]."', 
phone_number = '".$_POST[phone_number]."', 
address = '".$_POST['street_address']."', 
permalink= '".$_POST['permalink']."', 
latitude = '".$_POST['latitude']."', 
longitude = '".$_POST['longitude']."', 
contact_detail = '".$_POST['contact_detail']."', 
opening_hours = '".$_POST['opening_hours']."', 
facebook = '".$_POST['facebook']."', 
twitter = '".$_POST['twitter']."', 
googleplus = '".$_POST['googleplus']."', 
flickr = '".$_POST['flickr']."', 
text = '".$_POST['text']."' 
where id_business = '".$_POST['id_business']."'");


//insert_business_town_cities
$db->query("UPDATE  business_zip_codes SET
id_zip_codes = '".$_POST['id_zip_codes']."'
where id_business='".$_POST['id_business']."' and businesshash='".$_SESSION['logged_in']['businesshash']."'");

//insert_business_categories
$db->query("UPDATE business_categories SET
id_categories = '".$_POST['id_categories']."'
where id_business='".$_POST['id_business']."' and businesshash='".$_SESSION['logged_in']['businesshash']."'");

header("Location:".ROOT_WWW."admin/");
}

$business = $db->query("SELECT 
b.name
,b.id_business
,b.email
,b.phone_number
,b.address
,b.address
,b.permalink
,b.latitude
,b.longitude
,b.contact_detail
,b.opening_hours
,b.facebook
,b.twitter
,b.googleplus
,b.flickr
,b.text
,bc.id_categories
,zc.city
,zc.zip
,zc.full_state
,zc.id_zip_codes
FROM business b
left join business_zip_codes bzc on bzc.id_business = b.id_business
left join zip_codes zc on bzc.id_zip_codes = zc.id_zip_codes
left join business_categories bc on bc.id_business = b.id_business
where b.id_business = '$id_business'");
$business = $business->fetch();

//print_r($business);


?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">
<title><?php echo $siteconfig['site_name'];?></title>

<?php
include '../include/head.php';
?>
    
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
</head>
<body>



<script>
$().ready(function() {
	
$('#permalink').slugify('#name');	
	
$("#siteConfig").validate({
ignore: [],
rules: {
name: "required",
email: {
required: true,
email: true
			},
phone_number: "required"
		},
messages: {
name: "Please enter your business name",
email: "Please enter a valid email address",
phone_number: "Please enter your phone number"
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
            <h1><i class="fa fa-gear"></i> Website detail</h1>
            <h2>Edit you basic website info</h2>
        </div>

        <div class="content">
            <form method="POST" id="siteConfig" class="pure-form pure-form-stacked" action="" >
<label for="name"><i class="fa fa-info-circle"></i> Name</label>
<input type="text" name='name' id="name" value="<?php echo $business['name'];?>" />
<br>
<label for="regularInput"><i class="fa fa-link"></i> Permalink</label>
<input type="text" name="permalink" value="<?php echo $business['permalink'];?>" id="permalink" />
<br>
<label for="email"><i class="fa fa-at"></i> Email</label>
<input type="text" name='email' id="email" value="<?php echo $business['email'];?>" />
<br>
<label for="phone_number"><i class="fa fa-phone"></i> Phone number</label>
<input type="text" name='phone_number' id='phone_number' value="<?php echo $business['phone_number'];?>" />
<br>

<label for="text"><i class="fa fa-file-text"></i> Home page text</label>
<textarea class="editor" name='text' id="editor1" ><?php echo $business['text'];?></textarea>

<script>
CKEDITOR.replace( 'editor1',
	{
	extraPlugins: 'oembed',
		toolbar : 'Full'
	});
</script>

<br>
<label for="text"><i class="fa fa-envelope-o"></i> Contact Detail:</label>
<textarea class="editor" name='contact_detail' id="contact_detail" ><?php echo $business['contact_detail'];?></textarea>
<script>
CKEDITOR.replace( 'contact_detail',
	{
		toolbar : 'Basic'
	});
</script>

<br>
<label for="text"><i class="fa fa-clock-o"></i> Opening Hours:</label>
<textarea class="editor" name='opening_hours' id="opening_hours" ><?php echo $business['opening_hours'];?></textarea>
<script>
CKEDITOR.replace( 'opening_hours',
	{
		toolbar : 'Basic'
	});
</script>

<input type="hidden" name='id_business'  value="<?php echo $business['id_business'];?>" />
<input type="hidden" name='latitude' id='LatitudeTextBox' value="<?php echo $business['latitude'];?>" />
<input type="hidden" name='longitude'  id='LongitudeTextBox'  value="<?php echo $business['longitude'];?>" />
<br>
<label for="street_address"><i class="fa fa-map-marker"></i> States</label>
<select name="states" id="states">	
<option value=""><i class="fa fa-map-marker"></i> Select a State</option>						
<?php
$allstates = $db->query("SELECT full_state FROM zip_codes group by full_state");

while($row = $allstates->fetch()){
?>
<option
<?php if($business['full_state'] == $row['full_state']){
echo "selected";
}else{}   ?> value="<?php echo $row['full_state'];?>"><?php echo $row['full_state'];?></option>
<?php
}
?>
</select>
<br>
<label for="town_cities"><i class="fa fa-map-marker"></i> Select Town Cities</label>
<select name="id_zip_codes" id="id_zip_codes">
<?php
$cities = $db->query("SELECT * FROM zip_codes zc where zc.full_state = '".$business['full_state']."' order by city asc");
while($row = $cities->fetch()){
?>
<option <?php if($business['id_zip_codes'] == $row['id_zip_codes']){
echo "selected";
}else{}   ?> value="<?php echo $row['id_zip_codes'];?>" ><?php echo $row['city'];?> - <?php echo $row['zip'];?></option>
<?php
}
?></select>
<br>
<label for="street_address"><i class="fa fa-map-marker"></i> Street, Address</label>
<input type="text" name="street_address" value="<?php echo $business['address'];?>" id="street_address"><br><br>

<i class="fa fa-arrows fa-2x"></i> <i>You can drag the map pointer and drop it exactly where your business is located.</i>
<div id="map_canvas" style="width:100%; height: 400px;margin-bottom:15px;"></div>
<div id="longitude_latitude">
<input type="hidden" id="longitude" name="longitude" value="<?php echo $business['longitude'];?>" />
<input type="hidden" id="latitude" name="latitude" value="<?php echo $business['latitude'];?>" />
<input type="hidden" id="town_cities_name" value="<?php echo $business['city'];?>" />
<input type="hidden" id="zip" value="<?php echo $business['zip'];?>" require />
</div>




<script>
	$(document).ready(function () {
	
	/*
	var geocoder = new google.maps.Geocoder();
    var address = "USA";
    geocoder.geocode( { 'address': address}, function(results, status) {

      if (status == google.maps.GeocoderStatus.OK) {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();
        initialize(latitude,longitude,10);
        } 
        }); 
		*/
		
		initialize(<?php echo $business['latitude'];?>,<?php echo $business['longitude'];?>,16);
		
    function initialize(latitude,longitude,thezoom) {
        var map;
var marker;
var latitudeTextBox = $("#latitude");
var longitudeTextBox = $("#longitude");
latitudeTextBox.val(latitude);
        longitudeTextBox.val(longitude);
jQuery(document).ready(function () {
    var centerLatlng = new google.maps.LatLng(latitude, longitude);

    var mapOptions = {
        zoom: thezoom,
        center: centerLatlng,
        scrollwheel: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DEFAULT
        },
        navigationControl: true,
        navigationControlOptions: {
            style: google.maps.NavigationControlStyle.DEFAULT
        }
    };

    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    // Display default marker
    marker = new google.maps.Marker({
        draggable: true,
        map: map,
        position: centerLatlng
    });

    // After dragging, updates both Lat and Lng.
    google.maps.event.addListener(marker, 'dragend', function () {
        var curLatLng = marker.getPosition();
        latitudeTextBox.val(curLatLng.lat());
        longitudeTextBox.val(curLatLng.lng());
    });

    google.maps.event.trigger(marker, "click");
});	
      }

$("#street_address").blur(function(){


          var geocoder = new google.maps.Geocoder();
    var address = $(this).val()+", "+$('#town_cities_name').val()+", "+$('#zip').val()+", USA";
	geocoder.geocode( { 'address': address}, function(results, status) {
	
	
      if (status == google.maps.GeocoderStatus.OK) {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();
        initialize(latitude,longitude,16);
                } 
        });   
});
	

	
	$('#states').change(function() {
	$.post('<?php echo ROOT_WWW;?>ajax/ajax_zip_codes.php', {value: $(this).val()}, function(data) {
    $('#id_zip_codes').html(data);
	 $('#street_address').val("");
    });
});


$('#id_zip_codes').change(function() {
	$.post('<?php echo ROOT_WWW;?>ajax/ajax_get_longitude_latitude.php', {value: $(this).val()}, function(data) {
	 $('#street_address').val("");
	$('#longitude_latitude').html(data);
	
	if( !$('#town_cities_name').val() ) {
var latitude = $('#latitude').val();
	var longitude = $('#longitude').val();
	initialize(latitude,longitude,17);
		  
    }else{
	
	  var geocoder = new google.maps.Geocoder();
    var address = $('#town_cities_name').val()+","+$('#zip').val()+", USA";
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();
        initialize(latitude,longitude,17);
                } 
        });
	
	
	}
	
	
});
});



$("#myform").submit(function(){
  alert("You can now submit the address together with it's longitude and latitude");
   return false;
   });


});
</script>

<br>
<label for="facebook"><i class="fa fa-sitemap"></i> Categories</label>
<select name="id_categories" id="id_categories">
<?php
$categories = $db->query("SELECT * FROM categories order by name ASC");
while ($row = $categories->fetch()){
	?>
	<option  <?php 
if($business['id_categories']==$row['id_categories']){
echo "selected";
}

	?> value="<?php echo $row['id_categories'];?>"><?php echo $row['name'];?></option>
	<?php
}?>
</select>

<br>
<label for="facebook"><i class="fa fa-facebook"></i> Facebook</label>
<input type="text" name='facebook' id="facebook" value="<?php echo $business['facebook'];?>" />
<br>
<label for="twitter"><i class="fa fa-twitter"></i> Twitter</label>
<input type="text" name='twitter' id="twitter" value="<?php echo $business['twitter'];?>" />
<br>
<label for="googleplus"><i class="fa fa-google-plus"></i> Google+</label>
<input type="text" name='googleplus' id="googleplus" value="<?php echo $business['googleplus'];?>" />
<br>
<label for="flickr"><i class="fa fa-flickr"></i> Flickr</label>
<input type="text" name='flickr' id="flickr" value="<?php echo $business['flickr'];?>" />
<br>
<input type='submit' class="pure-button pure-button-primary"  name='submit' value='submit' /><br>
</form>
        </div>
    </div>
	
<div style="font-size:0.8em;bottom:0px;width:100%;text-align:center;">Thanks for creating with <a target="_blank" href="<?php echo ROOT_WWW;?>"><?php echo $siteconfig['site_name'];?></a></div>

</div>





<script src="<?php echo ROOT_WWW;?>admin/js/ui.js"></script>


</body>
</html>
