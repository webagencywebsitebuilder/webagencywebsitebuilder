<?php
$params = $_GET;
$districts_sql = "SELECT * FROM district order by name ASC";
$districts_result = mysql_query($districts_sql);
?>
<h3>Distrik</h3>
<ul>
<?php while ($row = mysql_fetch_assoc($districts_result)){
$district_business_sql = "SELECT count(*) as count FROM district_town_cities dtc
join business_town_cities btc on btc.id_town_cities = dtc.id_town_cities
where dtc.id_district = '".$row['id_district']."'";
$district_business_result = mysql_query($district_business_sql);
$district_business = mysql_fetch_array($district_business_result);
?>
<li>
<?php
if($district_business['count']=='0'){
?><?php echo $row['name'];?>
<?php
}else{
?>
<a href="<?php echo ROOT_WWW;?>district/<?php echo generate_permalink($row['id_district']);?>/<?php echo generate_permalink($row['name']);?>"><?php echo $row['name'];?></a> (<?php echo $district_business['count'];?>)
<?php
}
?>
</li>
<?php
}
?>
</ul>