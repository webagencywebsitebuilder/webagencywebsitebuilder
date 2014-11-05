<?php
include '../config.php';
$town_cities = $db->query("SELECT * FROM zip_codes where id_zip_codes = '".$_REQUEST['value']."'");
$town_cities = $town_cities->fetch();
?>
<input type="hidden" id="longitude" name="longitude" value="<?php echo $town_cities['longitude'];?>" />
<input type="hidden" id="latitude" name="latitude" value="<?php echo $town_cities['latitude'];?>" />
<input type="hidden" id="town_cities_name"name="town_cities_name"  value="<?php echo $town_cities['city'];?>" />
<input type="hidden" id="zip" name="zip" value="<?php echo $town_cities['zip'];?>" />