<?php
include 'config.php';
include 'classes/site.php';
$siteconfig = getsiteconfig();
$single_business = Site::getBusinessFromPermalink($_GET['permalink']);

$email_sent = '0';

if(isset($_POST['email'])){

$to  = $single_business['email'];

$subject = $_POST['subject'];

$email_subject = $subject;
$pre_message = "<b>Name: </b>".$_POST['name'].
"<br><b>Email: </b>".$_POST['email'].
"<br><b>Phone: </b>".$_POST['phone_number'].
"<br><b>Message: </b><br>".$_POST['message'];

$message = prepare_mail($single_business,$email_subject,$pre_message,"website");

$name = $_POST['name'];
$email = $_POST['email'];

$headers = "From: ".$name." <" . $email . "> \r\n" .
    "Reply-To: $email" . "\r\n" .
  "MIME-Version: 1.0\r\n" .
  "Content-Type: text/html; charset=ISO-8859-1\r\n";

mail($to, $subject, $message, $headers);

$email_sent = '1';

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
<title><?php echo $single_business['name'];?>, <?php echo $siteconfig['site_name'];?></title>
<?php
include 'includes/head_site.php';
?>
<script src="<?php echo ROOT_WWW;?>admin/ckeditor/ckeditor.js"></script>
<script src="<?php echo ROOT_WWW;?>js/md5/jquery.md5.js"></script>
<script src="<?php echo ROOT_WWW;?>js/validate/dist/jquery.validate.js"></script>
<link href='http://fonts.googleapis.com/css?family=Kranky' rel='stylesheet' type='text/css'>
<script>
$().ready(function() {
	
	//$('#permalink').slugify('#name');
	
	
		$( "#validate" ).blur(function() {
var answer = parseInt($("#validate").val());
	var newanswer =$.md5(answer);
	$("#mdvalidate").val(newanswer);
});
	
	
	// validate the comment form when it is submitted
	//$("#commentForm").validate();
	// validate signup form on keyup and submit
	$("#contactForm").validate({
	ignore: [],
rules: {
name: "required",
email: {
required: true,
email: true
			},
			
validate: {	
required: true
	},
	
mdvalidate: {	
equalTo: "#validatemain"	
	},
			
phone_number: "required"
		},
messages: {
name: "Please enter your business name",
phone_number: "Please enter your phone number",
validate: {
required: "Please enter answer",
},
mdvalidate: {
equalTo: "Please enter correct answer to above question"
},
email: "Please enter a valid email address"
		}
	});
});
</script>



</head>
<body>
<div class="container">
<?php
include 'includes/header_site.php';
?>
<div class="home-page main">
<section class="grid-wrap">
<header class="grid col-full">
<hr>
<p class="fleft"><a href="<?php echo ROOT_WWW;?><?php echo $single_business['permalink'];?>/"><i class="fa fa-home fa-lg"></i> Home</a> > <i class="fa fa-envelope fa-lg"></i> Contact us</p>
</header>
<div class="grid col-two-thirds mq2-col-full" style="margin-bottom:3em;">
<h2>Contact Us</h2>
<?php if($email_sent=='1'){ ?>
<h3><i class="fa fa-check"></i> Your email was sent.</h3> 
<p>Thanks for contacting <?php echo $single_business['name'];?>. We will reply to you shortly.</p>
<?php }else{
?>
<form id="contactForm" name="contactForm" class="contact_form" action="" method="post" >
<ul>

<li>
<label for="name"><i class="fa fa-info fa-lg"></i> Subject:</label>
<input type="text" name="subject" id="subject" >
</li>

<li>
<label for="name"><i class="fa fa-user fa-lg"></i> Your name:</label>
<input type="text" name="name" id="name" >
</li>
<li>
<label for="email"><i class="fa fa-at fa-lg"></i> Email:</label>
<input type="email" name="email" id="email" required placeholder="JohnDoe@gmail.com" class="required email">
</li>
<li>
<label for="phone_number"><i class="fa fa-phone-square fa-lg"></i> Phone number:</label>
<input type="text" name="phone_number" id="phone_number" >
</li>
<li>
<label for="message"><i class="fa fa-envelope-o fa-lg"></i> Message:</label>
<textarea name="message" id="message" cols="100" rows="6" ></textarea>
</li>
<li>
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
</li>


<li>
<button type="submit" id="submit" name="submit" class="button"><i class="fa fa-send fa-lg"></i> Send it</button>
</li>
</ul>
</form>
<?php } ?>
</div>
<?php
include 'includes/sidebar_address.php';
?>
</section>
<?php
include 'includes/main_gallery.php';
?>
</div>
<!--main-->
<?php
include 'includes/footer_site.php';
?>
</div>
</body>
</html>