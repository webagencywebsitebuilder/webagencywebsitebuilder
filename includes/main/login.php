<div id="Sign-In">
<fieldset style="width:30%"><h2>LOG-IN HERE</h2>
<?php
if($error == '1'){
echo "<span class='error'><i class='fa fa-exclamation-triangle'></i> Invalid email or password</span>";
?>
<br><a class="various" data-fancybox-type="iframe" href="<?php echo ROOT_WWW?>forgotten_password">Forgotten your password?</a>
<script>
$(document).ready(function() {
	$(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
</script>
<?php
}elseif($error == '2'){
echo "<span class='error'>Your account is not active</span>";
}
?>


<script>
$().ready(function() {
	

	$("#loginForm").validate({
	ignore: [],
rules: {
pass: "required",
email: {
required: true,
email: true
			}
		},
messages: {
pass: "Please enter your password",
email: "Please enter a valid email address"
		}
	});
});
</script>



<form method="POST" id="loginForm" action=""><i class="fa fa-user fa-lg"></i> Email<br>
<input name="email" id="email" type="email" style="width:300px;"><br><br><i class="fa fa-key fa-lg"></i>  Password <br>
<input type="password" name="pass" id="pass" style="width:300px;"><br><br>



<input id="button" type="submit" name="submit" value="Log-In">
</form>
</fieldset>
</div>
