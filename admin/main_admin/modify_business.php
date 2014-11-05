<?php
include '../../config.php';

$siteconfig = getsiteconfig();
checkiflogged($_SESSION);

$id_business = $_SESSION['logged_in']['id_business'];
$id_pages = $_GET['id_pages'];
$b = $_POST['b'];
$h = $_POST['h'];

if($_POST['action']=='modify'){




$update_pages_sql = $db->query("UPDATE domains
set domain_name='".$_POST['domain_name']."'
, wherebought='".$_POST['wherebought']."' 
, emailaddress='".$_POST['emailaddress']."' 
, domain_bought_status='".$_POST['domain_bought_status']."' 
, client_paid='".$_POST['client_paid']."' 
, startdate='".$_POST['startdate']."' 
, expirydate='".$_POST['expirydate']."' 
, username='".$_POST['username']."' 
, password='".$_POST['password']."' 
, details='".$_POST['details']."'
where id_business = '".$b."' and businesshash='".$h."'");

header("Location:businesses.php");
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">

    <title><?php echo $siteconfig['site_name'];?></title>

<?php
include '../include/head.php';
?>

      <!-- Fetch DomainsBot plugin  -->
    <script src = "https://domainsbot.blob.core.windows.net/javascript/jquery.domainsbot-1.0.min.js"></script>
 
    <style type="text/css">
        #results>div>a {color: Black;}
        #results>div>a:hover {color:Black;}
		#results{
		border:1px solid #ccc;
		margin-top:10px;
		margin-bottom:10px;
		padding:25px;
		}
    </style>   

</head>
<body>






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
            <h1>Manage domain</h1>
			</div>

        <div class="content">
		
		<table class="pure-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone Number</th>
			<th>Category</th>
        </tr>
    </thead>

    <tbody>
        <?php
		$business_sql = $db->query("SELECT b.name, b.id_business, b.businesshash, c.name as categories_name
		, b.address
		, b.phone_number
		, zc.city
		, zc.full_state
		, zc.zip 
		, d.domain_name
		, d.wherebought
		, d.domain_bought_status
		, d.client_paid
		, d.startdate
		, d.expirydate
		, d.emailaddress 
		, d.username
		, d.password
		, d.details
		FROM business b 
		left join business_zip_codes bzc on bzc.id_business = b.id_business
		left join zip_codes zc on bzc.id_zip_codes = zc.id_zip_codes
		left join business_categories bc on bc.id_business = b.id_business
		left join categories c on bc.id_categories = c.id_categories
		left join domains d on d.id_business = b.id_business
		where b.id_business = '".$_GET['id_business']."'
		order by b.name ASC");
$row = $business_sql->fetch();
?>
		<tr class="pure-table-odd">
            <td>1</td>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['address'];?>, <?php echo $row['city'];?>, <?php echo $row['full_state'];?>, <?php echo $row['zip'];?>, USA</td>
            <td><?php echo $row['phone_number'];?></td>
			<td><?php echo $row['categories_name'];?></td>
        </tr>
<?php

?>  
  </tbody>
</table>
		
		
            <form method="POST" class="pure-form pure-form-stacked" action="" >
			
			
			
	<br/>
<input type="text" value="<?php echo $row['name'];?>" id="search_box" />
<button id="search_button" class="pure-button pure-button-primary" ><i class="fa fa-search"></i> Search</button>
 
<div id="loader"><img src="http://domainsbot.blob.core.windows.net/img/loading.gif" alt="Loading.."></div>
<div id="checking"><img src="http://domainsbot.blob.core.windows.net/img/checking.gif" alt="Checking.."></div>
<br/>
<br/>
<div id="results"></div>
<hr>
<script>
    $(document).ready(function ()
    {
        var client = $().domainsbot({
	     parameters : {
				"pageSize" : 5,
				"auth-token": "c24a37d06852d1ebd1b189385f315c57",
				"tlds" : "com,co,net,me"
				},
            results: "#results",
            loading: "#loader",
            checking: "#checking",
            searchTextbox : "#search_box",
            searchSubmit : "#search_button",
            searchParameter: "domain",
            autoComplete: true,
            // Events
            urlCheckout: "http://domainsbot.com/d/%domain%" //Replace with your check out url!
            //onCheckout: function(domain,evt){alert(domain.Domain);}
 
            //onSuccess: function(data){alert(data)},
            //onError: function(err){alert(err.message);}
 
        });
    });
</script>
		<fieldset>

			<h3>Domain details</h3>
				<div class="pure-control-group">
			<label for="option-one" class="pure-checkbox">
        <input id="option-one" name="domain_bought_status" id="domain_bought_status" type="checkbox" <?php 
		if($row['domain_bought_status']=='1'){
		echo "checked";
		}else{}
		?> value="1"> Domain bought
    </label>
	
	<label for="option-one" class="pure-checkbox">
        <input id="option-one"  name="client_paid" id="client_paid" type="checkbox" <?php 
		if($row['client_paid']=='1'){
		echo "checked";
		}else{}
		?> value="1"> Client paid
    </label>
	
 </div>
 
			
			
			<div class="pure-control-group">
            <label for="domain_name">Domain name</label>
            <input id="domain_name" name="domain_name" value="<?php echo $row['domain_name'];?>" type="text" placeholder="Domain bought"><br>
        </div>
	
	
		<div class="pure-control-group">
            <label for="domain_name"><i class="fa fa-calendar"></i> Dates</label>
            <input id="startdate" name="startdate" value="<?php echo $row['startdate'];?>" type="text" placeholder="Starting date">
			<input id="expirydate" name="expirydate" value="<?php echo $row['expirydate'];?>" type="text" placeholder="Expiry date">
        <br>
		</div>
	 <script>
  $(function() {
    $( "#startdate" ).datepicker({
      changeMonth: true,
	  dateFormat: "yy-mm-dd",
      changeYear: true
    });
	 $( "#expirydate" ).datepicker({
      changeMonth: true,
	  dateFormat: "yy-mm-dd",
      changeYear: true
    });
  });
  </script>
		
	<div class="pure-control-group">
            <label for="wherebought">Where was it bought</label>
            <input id="wherebought" name="wherebought" value="<?php echo $row['wherebought'];?>" type="text" placeholder="where"><br>
        </div>
		
		<div class="pure-control-group">
            <label for="emailaddress">Domain email Address</label>
            <input id="emailaddress" name="emailaddress" value="<?php echo $row['emailaddress'];?>" type="text" placeholder="Email Address"><br>
        </div>

        <div class="pure-control-group">
            <label for="username">Domain username</label>
            <input id="username" name="username" value="<?php echo $row['username'];?>" type="text" placeholder="Username"><br>
        </div>
		
		<input id="b" name="b" value="<?php echo $row['id_business'];?>" type="hidden">
		<input id="h" name="h" value="<?php echo $row['businesshash'];?>" type="hidden">
		<input id="action" name="action" value="modify" type="hidden">
		<div class="pure-control-group">
            <label for="password">Domain password</label>
            <input id="password" name="password" value="<?php echo $row['password'];?>" type="text" placeholder="Password"><br>
        </div>
        <div class="pure-control-group">
            <label for="details">Domain details</label>
          <textarea class="editor" name='details' id="editor1" ><?php echo $row['details'];?></textarea><br>

<script>
CKEDITOR.replace( 'editor1',
	{
		toolbar : 'Basic'
	});
</script>
        </div>
		


        <div class="pure-controls">


            <button type="submit" class="pure-button pure-button-primary">Save</button>
        </div>	
		
		
		</fieldset>
		
		
		
		
</form>
        </div>
    </div>
<div class="footer">Thanks for creating with <a target="_blank" href="<?php echo ROOT_WWW;?>"><?php echo $siteconfig['site_name'];?></a></div>
</div>

<script src="<?php echo ROOT_WWW;?>admin/js/ui.js"></script>

</body>
</html>
