<?php
$params = $_GET;
$categories_sql = "SELECT * FROM categories order by name ASC";
$categories_result = mysql_query($categories_sql);
?>
<h3>Categories</h3>
<ul>
<?php while ($row = mysql_fetch_assoc($categories_result)){
?>
<li><a href="<?php echo ROOT_WWW;?>district/<?php echo generate_permalink($row['id_categories']);?>/<?php echo generate_permalink($row['name']);?>"><?php echo $row['name'];?></a></li>
<?php
}
?>
</ul>