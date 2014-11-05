<?php
include '../../config.php';
$town_cities_sql = "SELECT * FROM town_cities tc
join district_town_cities dtc on dtc.id_town_cities = tc.id_town_cities
where dtc.id_district = '".$_REQUEST['value']."'
";
$town_cities_result = mysql_query($town_cities_sql);
while ($row = mysql_fetch_assoc($town_cities_result)){
?>
<option value="<?php echo $row['id_town_cities'];?>"><?php echo $row['name'];?></option>
<?php
}
?>