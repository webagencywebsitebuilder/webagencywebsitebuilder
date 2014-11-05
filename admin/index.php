<?php
include '../config.php';
checkiflogged($_SESSION);
$siteconfig = getsiteconfig();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">
<title><?php echo $siteconfig['site_name'];?></title>
<?php
include 'include/head.php';
?>
</head>
<body>
<div id="layout">
<!-- Menu toggle -->
<a href="#menu" id="menuLink" class="menu-link">
<!-- Hamburger icon -->
<span></span>
</a>
<?php
include 'include/sidebar.php';
?>
<div id="main">
<div class="header">
<h1>Welcome</h1>
</div>
<div class="content">
<h2 class="content-subhead">Hello <?php echo $_SESSION['logged_in']['name'];?></h2>
<?php
if($_SESSION['logged_in']['type']=='admin'){
?>
<h3>Web Agency Website Builder ( Free )</h3>

<a class="button" href="https://www.codester.com/items/412/web-agency-website-builder-php-script" >PURCHASE FULL VERSION</a> and obtain <b>Product Catalog and Job Module</b>.

<p>Multiple mobile friendly website builder script. Start, Run or Expand your web agency by providing quick and easy mobile website solution to businesses located within your area with the help of our website builder script.</p>
<p>No coding and designer cost involved which saves you time and money while running your web agency.&nbsp;Just what you need to boost your web development business.</p>
<h4>Demo of our full version builder script</h4>
<ul>
<li><a title="Link: http://webagencywebsitebuilder.hol.es/demo/" href="http://webagencywebsitebuilder.hol.es/demo/" target="_blank" rel="nofollow"><strong>DEMO</strong> - Website builder</a></li>
<li><a title="Link: http://webagencywebsitebuilder.hol.es/demo/about-us" href="http://webagencywebsitebuilder.hol.es/demo/about-us" target="_blank" rel="nofollow"><strong>DEMO</strong> - Website builder clients</a></li>
<li><a title="Link: http://webagencywebsitebuilder.hol.es/demo/joey-best-deals/" href="http://webagencywebsitebuilder.hol.es/demo/joey-best-deals/" target="_blank" rel="nofollow"><strong>DEMO</strong> - Client website 1</a></li>
<li><a title="Link: http://webagencywebsitebuilder.hol.es/demo/joey-best-deals/products/1/new-cars" href="http://webagencywebsitebuilder.hol.es/demo/joey-best-deals/products/1/new-cars" target="_blank" rel="nofollow"><strong>DEMO</strong> - Product Catalogue</a></li>
<li><a title="Link: http://webagencywebsitebuilder.hol.es/demo/joey-best-deals/product_detail/2/-audi-rsq3-25-tfsi-310ps-quattro-s-tronic" href="http://webagencywebsitebuilder.hol.es/demo/joey-best-deals/product_detail/2/-audi-rsq3-25-tfsi-310ps-quattro-s-tronic" target="_blank" rel="nofollow"><strong>DEMO</strong> - Product Detail page</a></li>
<li><a href="http://webagencywebsitebuilder.hol.es/demo/joey-best-deals/album/1/new-showroom-inauguration" target="_blank" rel="nofollow"><strong>DEMO</strong> - Image Gallery</a></li>
<li><a href="http://webagencywebsitebuilder.hol.es/demo/joey-best-deals/contact_us" target="_blank" rel="nofollow"><strong>DEMO</strong> - Contact us page</a></li>
<li><a href="http://webagencywebsitebuilder.hol.es/demo/tommy-furniture/" target="_blank" rel="nofollow"><strong>DEMO</strong> - Client website 2</a><a href="http://webagencywebsitebuilder.ml/"><br><br></a></li>
</ul>
<h3>Features of our full version website builder script</h3>
<ul>
<li>Build unlimited amount of websites on our website builder</li>
<li>CMS for clients</li>
<li>Product Catalogue</li>
<li>Photos Gallery</li>
<li>Google Map + Contact details</li>
<li>Rich content information page</li>
<li>Contact us form</li>
</ul>
<p><img src="http://1.bp.blogspot.com/-bvZIcsCtgEU/VFjozBFFt3I/AAAAAAAAACI/QugOjVx_LEc/s1600/dvdcasestack_800x748%2B(1).jpg" alt=""></p>
<h3>Included</h3>
<ul>
<li>MySQL Database&nbsp;</li>
<li>PHP codes&nbsp;</li>
</ul>
<h3>Requirements</h3>
<ul>
<li>PHP/MySQL/PDO Support</li>
</ul>

<a class="button" href="https://www.codester.com/items/412/web-agency-website-builder-php-script" >PURCHASE FULL VERSION</a> and obtain <b>Product Catalog and Job Module</b>.
<p>&nbsp;</p>
<?php
}else{
echo $siteconfig['admin_text'];
}
?>
</div>
</div>
</div>
<script src="<?php echo ROOT_WWW;?>admin/js/ui.js"></script>
</body>
</html>
