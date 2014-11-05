<?php
include '../../config.php';
$town_cities_sql = "SELECT * FROM town_cities where id_town_cities = '".$_REQUEST['value']."'";
$town_cities_result = mysql_query($town_cities_sql);
$town_cities = mysql_fetch_assoc($town_cities_result);
?>
<input id="longitude" name="longitude" value="<?php echo $town_cities['longitude'];?>" />
<input id="latitude" name="latitude" value="<?php echo $town_cities['latitude'];?>" />
<input id="town_cities_name" value="<?php echo $town_cities['name'];?>" />