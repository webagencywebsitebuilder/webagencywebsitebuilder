<?php
$params = $_GET;
$business_sql = "SELECT * FROM business b 
join business_town_cities btc on btc.id_business = b.id_business
where btc.id_town_cities = '".$_GET['id_town_cities']."' order by b.name ASC";


$business_result = mysql_query($business_sql);
?>
<div class="grid-wrap works">
<?php while ($row = mysql_fetch_assoc($business_result)){

$first_image_sql = "SELECT * FROM business_image bi
where bi.id_business = '".$row['id_business']."' limit 1";
$first_image_result = mysql_query($first_image_sql);

$first_image = mysql_fetch_array($first_image_result);

$get_district_town_cities_sql = "SELECT tc.name as town_cities_name, d.name as district_name FROM business_town_cities btc
join town_cities tc on btc.id_town_cities = tc.id_town_cities
join district_town_cities dtc on dtc.id_town_cities = btc.id_town_cities
join district d on d.id_district = dtc.id_district
where btc.id_business = '".$row['id_business']."' limit 1";
$get_district_town_cities_result = mysql_query($get_district_town_cities_sql);
$get_district_town_cities = mysql_fetch_array($get_district_town_cities_result);

?>
<figure style="margin-bottom:2em;" class="grid col-one-third mq1-col-one-half mq2-col-one-third mq3-col-full work_1"><a href="<?php echo ROOT_WWW;?><?php echo $section_url.$section_url_town_cities;?>/<?php echo $row['id_business'];?>/<?php echo generate_permalink($row['name']);?>">
<?php
if(!empty($first_image)){
?>
<img src="<?php echo ROOT_WWW;?>uploads/images/<?php echo $row['id_business'];?>/business/medium/<?php echo $first_image['name'];?>" alt=""><span class="zoom"></span>
<?php
}else{
?>
<img src="<?php echo ROOT_WWW;?>img/no_image.jpg" alt=""><span class="zoom"></span>
<?php
}?>


</a>
 <figcaption style="height:7em;"> <a href="<?php echo ROOT_WWW;?><?php echo $section_url.$section_url_town_cities;?>/<?php echo $row['id_business'];?>/<?php echo generate_permalink($row['name']);?>" style="font-size:1em;" class="arrow"><?php echo $row['name'];?></a>
<address style="display:block;font-size:0.7em;">
<?php echo $row['address'];?>, <?php echo $get_district_town_cities['town_cities_name'];?>, <?php echo $get_district_town_cities['district_name'];?>, Mauritius
</address>
</figcaption>

</figure>
<?php
}
?>
</div>