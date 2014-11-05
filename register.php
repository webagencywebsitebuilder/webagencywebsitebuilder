<?php
include 'config.php';
$siteconfig = getsiteconfig();



if(isset($_POST['name'])){



$count_business_sql = $db->query("SELECT count(*) as count from business
where email='".$_POST['email']."'");
$count_business = $count_business_sql->fetch();
if($count_business['count']!='0'){

header("Location:register?e=email_exist");
exit;
}else{}

$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
$password_before_md = substr( str_shuffle( $chars ), 0, 8 );

	$password = md5($password_before_md);
	$businesshash = md5($_POST['name']);
	$permalink = create_slug($_POST['permalink']);
	
	
	$count_business_sql = $db->query("SELECT count(*) as count from business
where permalink='".$permalink."'");
$count_business = $count_business_sql->fetch();
if($count_business['count']!='0'){
header("Location:register?e=permalink");
exit;
}else{}
	
$insert_business_sql = $db->query("INSERT into business (name,
text,
email,
address,
permalink,
businesshash,
phone_number,
latitude,
longitude,
pw,
wp,
status,
date_created
) VALUES ('".$_POST['name']."',
'".$_POST['businessinfo']."',
'".$_POST['email']."',
'".$_POST['street_address']."',
'".$permalink."',
'".$businesshash."',
'".$_POST['phone']."',
'".$_POST['latitude']."',
'".$_POST['longitude']."',
'".$password."',
'".$password_before_md."',
'0',
NOW()
)
");
	$new_id_business = $db->lastInsertId();
	//insert_business_town_cities
	$db->query("INSERT into business_zip_codes (id_business,id_zip_codes,businesshash) VALUES ('".$new_id_business."','".$_POST['id_zip_codes']."','".$businesshash."')");
	//insert_business_categories
	$db->query("INSERT into business_categories (id_business,id_categories,businesshash) VALUES ('".$new_id_business."','".$_POST['id_categories']."','".$businesshash."')");
	//insert_domain
	$db->query("INSERT into domains (id_business,businesshash) VALUES ('".$new_id_business."','".$businesshash."')");
	

	
	
$to  = $_POST['email'];

$subject = "Registration for ".$_POST['name'];

$email_subject = $subject;

$pre_message = "<p><b>Name: </b>".$_POST['name'].
"<br><b>Email/Username: </b>".$_POST['email'].
"<br><b>Password: </b>".$password_before_md.
"</p>Business Info: ".$_POST['businessinfo'].
"<p><b>Address: </b>".$_POST['street_address'].
"<br><b>Phone number: </b>".$_POST['phone'].
"<br><b>Date created: </b>".date('Y-m-d')."</p>";

$message_admin = prepare_mail($siteconfig,$email_subject,$pre_message,"builder");


$pre_message .= "Please confirm your registration by clicking on the following link<br>
<a href='".ROOT_WWW."confirm/".$businesshash."/".$new_id_business."'>".ROOT_WWW."confirm/".$businesshash."/".$new_id_business."</a>";


$message = prepare_mail($siteconfig,$email_subject,$pre_message,"builder");


$name = $siteconfig['site_name'];
$email = $siteconfig['site_admin_username'];


$headers = "From: ".$name." <" . $email . "> \r\n" .
    "Reply-To: $email" . "\r\n" .
  "MIME-Version: 1.0\r\n" .
  "Content-Type: text/html; charset=ISO-8859-1\r\n";



mail($to, $subject, $message, $headers);
mail($siteconfig['site_admin_username'], $subject, $message_admin, $headers);
	
	
	
	header("Location:thank-you");
	

}






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
<script src="<?php echo ROOT_WWW;?>admin/ckeditor/ckeditor.js"></script>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo ROOT_WWW;?>js/validate/lib/jquery.js"></script>
<script src="<?php echo ROOT_WWW;?>js/md5/jquery.md5.js"></script>
<script src="<?php echo ROOT_WWW;?>js/validate/dist/jquery.validate.js"></script>
<script src="<?php echo ROOT_WWW;?>js/slug/slugify.js"></script>
<link href='http://fonts.googleapis.com/css?family=Kranky' rel='stylesheet' type='text/css'>
<script>
$().ready(function() {
	
	$('#permalink').slugify('#name');
	
	$( "#validate" ).blur(function() {
var answer = parseInt($("#validate").val());
	var newanswer =$.md5(answer);
	$("#mdvalidate").val(newanswer);
});
	
	
	// validate the comment form when it is submitted
	//$("#commentForm").validate();
	// validate signup form on keyup and submit
	$("#registerForm").validate({
	ignore: [],
rules: {
name: "required",
			street_address: "required",
username: {
required: true,
minlength: 2
			},
			confirm_email: {
required: true,
equalTo: "#email"
			},
	

validate: {	
required: true
	},
	
mdvalidate: {	
equalTo: "#validatemain"	
	},
			
email: {
required: true,
email: true
			},
			
phone: "required",
			//topic: {
			//	required: "#newsletter:checked",
			//	minlength: 2
			//},
agree: "required"
		},
messages: {
name: "Please enter your business name",
confirm_email: {
equalTo: "Please enter the same email as above"
},

validate: {
required: "Please enter answer",
},
mdvalidate: {
equalTo: "Please enter correct answer to above question"
},

email: "Please enter a valid email address",
answer:{
required: "Please Enter The Captcha Code",
remote: "Captcha Entered Incorrectly"
                        }
		}
	});
});
</script>
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
<p class="fleft"><a href="<?php echo ROOT_WWW;?>"><i class="fa fa-home fa-lg"></i> Home</a> > <i class="fa fa-magic fa-lg"></i> Register</p>
</header>
<div class="grid col-two-thirds mq2-col-full">
<h2>Sign Up Free</h2>
<?php
if($_GET['e']=="email_exist"){
?>
<h4><i class="fa fa-exclamation-triangle"></i> Email already exist!</h4>
<?php
}else{}
?>
<?php
if($_GET['e']=="permalink"){
?>
<h4><i class="fa fa-exclamation-triangle"></i> Your permalink is already in use</h4>
<?php
}else{}
?>
<form method="POST" id="registerForm" action="" >
<label for="regularInput"><i class="fa fa-info-circle"></i> Business/Activity Name</label>
<input type="text" name="name" id="name"><br><br>
<label for="regularInput"><i class="fa fa-link"></i> Permalink</label>
<input type="text" name="permalink" id="permalink"><br><br>
<label for="businessinfo"><i class="fa fa-file-text"></i> Business Info</label>
<textarea name="businessinfo" id="businessinfo"></textarea><br><br>
<script>
CKEDITOR.replace( 'businessinfo',
{
	toolbar : 'Basic'
});
</script>
<label for="email"><i class="fa fa-at"></i>  Email</label>
<input type="text" name="email" id="email"><br><br>

<label for="confirm_email"><i class="fa fa-at"></i> Confirm email</label>
<input type="text" name="confirm_email" id="confirm_email"><br><br>

<label for="phone"><i class="fa fa-phone"></i> Phone Number</label>
<input type="text" name="phone" id="phone"><br><br>
<label for="selectDistrict"><i class="fa fa-map-marker"></i> Select a State</label>
<select name="states" id="states">	
<option value="">Select a State</option>						
<?php
$allstates = $db->query("SELECT full_state FROM zip_codes group by full_state");
while($row = $allstates->fetch()){
	?>
	<option value="<?php echo $row['full_state'];?>"><?php echo $row['full_state'];?></option>
	<?php
}
?>
</select>
<br><br>
<label for="town_cities"><i class="fa fa-map-marker"></i> Select Town Cities</label>
<select name="id_zip_codes" id="id_zip_codes">
<option value="Option 1">Select a town first</option>
</select>
<br><br>
<label for="street_address"><i class="fa fa-map-marker"></i> Street, Address</label>
<input type="text" name="street_address" id="street_address"><br><br>

<i class="fa fa-arrows fa-2x"></i> <i>You can drag the map pointer and drop it exactly where your business is located.</i>
<div id="map_canvas" style="width:100%; height: 400px;margin-bottom:15px;"></div>
<div id="longitude_latitude">
<input type="hidden" id="longitude" name="longitude" value="" />
<input type="hidden" id="latitude" name="latitude" value="" />
<input type="hidden" id="town_cities_name" value="" />
<input type="hidden" id="zip" value="" require />
</div>
<script>
$(document).ready(function () {
	
	var geocoder = new google.maps.Geocoder();
	var address = "USA";
	geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			var latitude = results[0].geometry.location.lat();
			var longitude = results[0].geometry.location.lng();
			initialize(latitude,longitude,10);
		}
	});
	
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
		$.post('ajax/ajax_zip_codes.php', {value: $(this).val()}, function(data) {
			$('#id_zip_codes').html(data);
			$('#street_address').val("");
		});
	});
	$('#id_zip_codes').change(function() {
		$.post('ajax/ajax_get_longitude_latitude.php', {value: $(this).val()}, function(data) {

			$('#longitude_latitude').html(data);
			
			if( !$('#town_cities_name').val() ) {
				var latitude = $('#latitude').val();
				var longitude = $('#longitude').val();
				initialize(latitude,longitude,17);
				
			}else{
				
				var geocoder = new google.maps.Geocoder();
				var address = $('#street_address').val()+", "+$('#town_cities_name').val()+","+$('#zip').val()+", USA";
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
<label for="id_categories"><i class="fa fa-sitemap"></i> Select Category</label>
<select name="id_categories" id="id_categories">
<?php
$categories = $db->query("SELECT * FROM categories order by name ASC");
while ($row = $categories->fetch()){
	?>
	<option value="<?php echo $row['id_categories'];?>"><?php echo $row['name'];?></option>
	<?php
}?>
</select><br><br>

<?php
$numbers = range(1,10);
shuffle($numbers);
$theanswer = $numbers['0'] + $numbers['2'] + $numbers['4'];
?><div class="question">
Please answer the following question:<br>
<span id="num1"><?php echo $numbers['0'];?></span><i class="fa fa-plus"></i>
<span id="num2"><?php echo $numbers['2'];?></span><i class="fa fa-plus"></i>
<span id="num2"><?php echo $numbers['4'];?></span></div>
<input type="hidden" name="validatemain" value="<?php echo md5($theanswer);?>" id="validatemain">
<input type="text"  name="validate" value="" id="validate">
<input type="hidden"  name="mdvalidate" value="" id="mdvalidate">
<br><br>

<button type="submit"><i class="fa fa-magic"></i> Create NOW</button>
</form>
</div>
<div class="grid col-one-half mq2-col-full">
</div>
</section>
</div>
<!--main-->
<div class="divide-top">
<?php
include 'includes/main/footer_main.php';
?>
</div>
</div>
</script>
</body>
</html>