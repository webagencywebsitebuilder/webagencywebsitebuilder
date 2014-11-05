<table style="border:1px solid #ccc;margin:10px;" cellpadding="10px" cellspacing="0px">
<tr>
<td>

<?php
$params = $_GET;


$single_business_sql = "SELECT * FROM business where id_business='$id_business'";
$single_business_result = mysql_query($single_business_sql);
$single_business = mysql_fetch_array($single_business_result);
?>
<h3><?php echo $single_business['name'];?></h3>
<p>
<?php echo $single_business['text'];?>
</p>
<p>
<b>Email:</b> <?php echo $single_business['email'];?>
</p>
<p>
<b>Email:</b> <?php echo $single_business['email'];?>
</p>
</ul>
<td>
<tr>
</table>