<?php
include '../../../config.php';
?>
<select name='id_zip_codes'>
<?php
$cities = $db->query("SELECT * FROM zip_codes zc where zc.full_state = '".$_REQUEST['value']."' order by city asc");
while($row = $cities->fetch()){
?>
<option value="<?php echo $row['id_zip_codes'];?>" ><?php echo $row['city'];?> - <?php echo $row['zip'];?></option>
<?php
}
?></select>