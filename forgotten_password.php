<?php
include 'config.php';
$siteconfig = getsiteconfig();
$error = '0';
$success = '0';
if(isset($_POST['email'])){
	$user_sql = $db->query("SELECT * FROM business where email = '".$_POST['email']."'");
	$user = $user_sql->fetch();
	if(!empty($user)){
	

	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
$password_before_md = substr( str_shuffle( $chars ), 0, 8 );
$password = md5($password_before_md);


	$update_pages_sql = $db->query("UPDATE business set pw='".$password."', wp='".$password_before_md."' where id_business = '".$user['id_business']."' and businesshash='".$user['businesshash']."'");


	
$to  = $user['email'];

$subject = "Retrieve password for ".$user['name'];

$email_subject = $subject;

$pre_message = 'Hello User
<br>Your new password : '.$password_before_md.'
<br>E-mail: '.$user['email'].'
<br>Now you can login with this email and password
<br><a href="'.ROOT_WWW.'">'.ROOT_WWW.'</a>';
$message = prepare_mail($siteconfig,$email_subject,$pre_message,"builder");

$name = $siteconfig['site_name'];
$email = $siteconfig['site_admin_username'];

$headers = "From: ".$name." <" . $email . "> \r\n" .
    "Reply-To: $email" . "\r\n" .
  "MIME-Version: 1.0\r\n" .
  "Content-Type: text/html; charset=ISO-8859-1\r\n";
  
  

mail($to, $subject, $message, $headers);
mail($siteconfig['site_admin_username'], $subject, $message, $headers);
	
		$success = '1';
	}else{
		$admin_sql = $db->query("SELECT * FROM site_config where site_admin_username = '".$_POST['email']."'");
		$admin_check = $admin_sql->fetch();
		if(!empty($admin_check)){
		
		
			$to  = $siteconfig['site_admin_username'];

$subject = "Retrieve password for ".$siteconfig['site_name'];

$email_subject = $subject;

$pre_message = 'Hello User
<br>Your new password : '.ADMIN_PASSWORD.'
<br>E-mail: '.$siteconfig['site_admin_username'].'
<br>Now you can login with this email and password
<br><a href="'.ROOT_WWW.'">'.ROOT_WWW.'</a>';
$message = prepare_mail($siteconfig,$email_subject,$pre_message,"builder");

$name = $siteconfig['site_name'];
$email = $siteconfig['site_admin_username'];

$headers = "From: ".$name." <" . $email . "> \r\n" .
    "Reply-To: $email" . "\r\n" .
  "MIME-Version: 1.0\r\n" .
  "Content-Type: text/html; charset=ISO-8859-1\r\n";
  
  

mail($to, $subject, $message, $headers);
			$success = '1';
		
		}else{
			$error = '3';
		}
	}
}
?>
<html>
<head>
<?php
include 'includes/main/head_main.php';
?>
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
	$("#forgottenPassword").validate({
	ignore: [],
rules: {

email: {
required: true,
email: true
			},

validate: {	
required: true
	},
	
mdvalidate: {	
equalTo: "#validatemain"	
	}
		},
messages: {
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
<h3>Retrieve your account password</h3>
<?php if($error == '3'){
	?><i class="fa fa-frown-o fa-2x" ></i> <i>We are sorry to inform you that the email you provided, being <?php echo $_POST['email'];?>, was not found within our system.</i>
	<?php
} ?>
<?php if($success == '1'){
	?><i class="fa fa-check fa-2x" ></i> <i>Your new password has been sent to your email (<?php echo $_POST['email'];?>).</i>
	<?php
} ?>

<?php if($success == '1'){}else{
	?>

<form name="forgottenPassword" id="forgottenPassword" method="post" action="" class="pure-form">
<fieldset>
<input type="email" name="email" id="email"  placeholder="Please enter your email"><br><br>
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
<input type="hidden"  name="mdvalidate" value="" id="mdvalidate"><br><br>
<button type="submit" class="button"><i class="fa fa-send fa-lg"></i> Retrieve password</button>
</fieldset>
</form>
<?php } ?>
</body>
</html>