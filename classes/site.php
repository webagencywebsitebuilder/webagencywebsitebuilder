<?php

Class Site{

function getBusinessFromPermalink($permalink) {
global $db;
$single_business = $db->query("SELECT 
b.name
,b.id_business
,b.businesshash
,b.email
,b.phone_number
,b.address
,b.address
,b.permalink
,b.latitude
,b.longitude
,b.contact_detail
,b.opening_hours
,b.facebook
,b.twitter
,b.googleplus
,b.flickr
,b.text
,zc.city
,zc.zip
,zc.full_state
,zc.id_zip_codes
,d.domain_name
FROM business b
left join business_zip_codes bzc on bzc.id_business = b.id_business
left join zip_codes zc on bzc.id_zip_codes = zc.id_zip_codes
left join domains d on d.id_business = b.id_business
where b.permalink='$permalink'");
$single_business = $single_business->fetch();
if(empty($single_business)){
header("Location:".ROOT_WWW);
}
return $single_business;
}


//Check if there is Image Gallery
public static function check_image_gallery($id_business){
global $db;
$count_album_business = $db->query("SELECT count(*) as count FROM album_business where id_business='$id_business'");
$count_album_business = $count_album_business->fetch();
$count = $count_album_business['count'];
return $count;
}	

//Check if there is Jobs
public static function check_products($id_business){
global $db;
$count_product_categories_business= $db->query("SELECT count(*) as count FROM product_categories_business where id_business='$id_business'");
$count_product_categories_business = $count_product_categories_business->fetch();
$count = $count_product_categories_business['count'];
return $count;
}


function getMeta($id_business,$container) {
global $db;
$meta = array();
$meta_sql = "SELECT * FROM meta where id_business='$id_business' and container ='$container'";
$meta_result = mysql_query($meta_sql);
while($row = mysql_fetch_assoc($meta_result)){
  array_push($meta, $row);
}
return $meta;
}



}



class Template
{
    protected $_file;
    protected $_data = array();

    public function __construct($file = null)
    {
        $this->_file = $file;
    }

    public function set($key, $value)
    {
        $this->_data[$key] = $value;
        return $this;
    }

    public function render()
    {
        extract($this->_data);
        ob_start();
        include($this->_file);
        return ob_get_clean();
    }
}




?>