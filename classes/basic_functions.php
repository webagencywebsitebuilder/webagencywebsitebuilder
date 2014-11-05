<?php
setlocale(LC_ALL, 'en_US.UTF8');

function get_map_icon($id_categories){

if($id_categories=='3'){
$icon = 'taxi.png';
}else{

$icon = 'default.png';
}


return $icon;

}

function create_slug($string){
   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
   return $slug;
}


function getbusiness($id){
global $db;
$single_business = $db->query("SELECT * FROM business where id_business='$id'");
$single_business = $single_business->fetch();
return $single_business;
}


function myTruncate($string, $limit, $break=".", $pad="...")
{

$string = strip_tags($string);


  // return with no change if string is shorter than $limit
  if(strlen($string) <= $limit){

  return $string;
  
  }else{

  // is $break present between $limit and the end of the string?
  if(false !== ($breakpoint = strpos($string, $break, $limit))) {
    if($breakpoint < strlen($string) - 1) {
      $string = substr($string, 0, $breakpoint) . $pad;
    }
  }else{
  $string = substr($string, 0, $limit) . $pad;
  }

  return $string;
  
  }
}


function getsiteconfig(){
global $db;
$siteconfig = $db->query("SELECT * FROM site_config where id_site_config='1'");
$siteconfig = $siteconfig->fetch();
return $siteconfig;
}



function checkiflogged($session){
if(!isset($session['logged_in']['type'])){
header("Location:".ROOT_WWW);
}else{
}
}




function  prepare_mail($sitedetail,$email_subject,$pre_message,$type){
if($type=="builder"){

$footer_name = $sitedetail['site_name'];
$footer_main_link = ROOT_WWW;
$footer_email = $sitedetail['site_admin_username'];
$footer_contact_detail = $sitedetail['contact_detail'];
$twitter = $sitedetail['twitter'];
$facebook = $sitedetail['facebook'];
$googleplus = $sitedetail['googleplus'];

}else{

$footer_name = $sitedetail['name'];
$footer_main_link = ROOT_WWW.$sitedetail['permalink'];
$footer_email = $sitedetail['email'];
$footer_contact_detail = $sitedetail['phone_number']."<br>".$sitedetail['contact_detail'];
$twitter = $sitedetail['twitter'];
$facebook = $sitedetail['facebook'];
$googleplus = $sitedetail['googleplus'];

}

$the_message = "<table class=\"wrapper\" style=\"border-collapse: collapse;border-spacing: 0;background-color: #fbfbfb;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;table-layout: fixed\">
        <tbody><tr>
          <td style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top\">
            <center>
              <table class=\"preheader\" style=\"border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto;background-color: #fbfbfb;background-image: none;background-attachment: scroll;background-repeat: repeat;background-position: top left\">
                <tbody><tr>
                  <td style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top\">
                    <table style=\"border-collapse: collapse;border-spacing: 0;width: 602px\">
                      <tbody><tr>
                        <td class=\"title\" style=\"padding-top: 10px;padding-bottom: 12px;padding-left: 0;padding-right: 0;vertical-align: top;color: #999999;font-family: Georgia, serif;font-size: 12px;font-style: italic;line-height: 21px;text-align: left\"></td>
                        <td class=\"webversion\" style=\"padding-top: 10px;padding-bottom: 12px;padding-left: 0;padding-right: 0;vertical-align: top;color: #999999;font-family: Georgia, serif;font-size: 12px;font-style: italic;line-height: 21px;text-align: right;width: 300px\">
                         ".date("Y-m-d")."
                        </td>
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
              </tbody></table>
              
            </center>
          </td>
        </tr>
      </tbody></table>
      
          <table class=\"wrapper\" style=\"border-collapse: collapse;border-spacing: 0;background-color: #fbfbfb;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;table-layout: fixed\">
            <tbody><tr>
              <td style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top\">
                <center>
                  <table style=\"border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto\">
                    <tbody><tr class=\"border\" style=\"font-size: 1px;line-height: 1px;background-color: #e9e9e9;height: 1px\"><td style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top;line-height: 1px\" colspan=\"3\">&nbsp;</td></tr>
                    <tr>
                      <td class=\"border\" style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top;font-size: 1px;line-height: 1px;background-color: #e9e9e9;width: 1px\">&#8203;</td>
                      <td style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top\">
                        <table class=\"one-col\" style=\"border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto;width: 600px;background-color: #ffffff;font-size: 14px\">
                          <tbody><tr>
                            <td class=\"column\" style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top;text-align: left\">
                              <div><div class=\"column-top\" style=\"font-size: 32px;line-height: 32px\">&nbsp;</div></div>
                                <table class=\"contents\" style=\"border-collapse: collapse;border-spacing: 0;width: 100%\">
                                  <tbody><tr>
                                    <td class=\"padded\" style=\"padding-top: 0;padding-bottom: 0;padding-left: 32px;padding-right: 32px;vertical-align: top\">
                                      
            <h1 style=\"Margin-top: 0;font-weight: 700;letter-spacing: -0.03em;-webkit-font-smoothing: antialiased;color: #565656;font-size: 28px;line-height: 42px;Margin-bottom: 18px;font-family: sans-serif\">".$email_subject."</h1>
			
			<p style=\"Margin-top: 0;-moz-osx-font-smoothing: grayscale;font-family: Georgia, serif;color: #565656;Margin-bottom: 24px;-webkit-font-smoothing: antialiased;font-size: 16px;line-height: 24px\">".$pre_message."</p>
          
                                    </td>
                                  </tr>
                                </tbody></table>
                              
                              <div class=\"column-bottom\" style=\"font-size: 8px;line-height: 8px\">&nbsp;</div>
                            </td>
                          </tr>
                        </tbody></table>
                      </td>
                      <td class=\"border\" style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top;font-size: 1px;line-height: 1px;background-color: #e9e9e9;width: 1px\">&#8203;</td>
                    </tr>
                  </tbody></table>
                </center>
              </td>
            </tr>
          </tbody></table>
        
          <table class=\"wrapper\" style=\"border-collapse: collapse;border-spacing: 0;background-color: #fbfbfb;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;table-layout: fixed\">
            <tbody><tr>
              <td style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top\">
                <center>
                  <table class=\"border\" style=\"border-collapse: collapse;border-spacing: 0;font-size: 1px;line-height: 1px;background-color: #e9e9e9;Margin-left: auto;Margin-right: auto\" width=\"602\">
                    <tbody><tr><td style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top\">&nbsp;</td></tr>
                  </tbody></table>
                </center>
              </td>
            </tr>
          </tbody></table>
        
      <div class=\"spacer\" style=\"font-size: 1px;line-height: 32px\">&nbsp;</div>
      <table class=\"wrapper\" style=\"border-collapse: collapse;border-spacing: 0;background-color: #fbfbfb;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;table-layout: fixed\">
        <tbody><tr>
          <td style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top\">
            <center>
              <table class=\"footer\" style=\"border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto;width: 602px\">
                <tbody><tr>
                  <td class=\"social\" style=\"padding-top: 32px;padding-bottom: 22px;padding-left: 0;padding-right: 0;vertical-align: top\" align=\"center\">
                    <table style=\"border-collapse: collapse;border-spacing: 0\">
                      <tbody><tr>
                        <td class=\"social-link\" style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top\">
                          <table style=\"border-collapse: collapse;border-spacing: 0\">
                            <tbody><tr>
                              <td style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top\">
                                <a target=\"_blank\" style=\"color: #41637e;text-decoration: none;transition: color .2s\" href=\"".$facebook."\" rel=\"cs_facebox\">
                                  <img style=\"border-left-width: 0;border-top-width: 0;border-bottom-width: 0;border-right-width: 0;-ms-interpolation-mode: bicubic\" src=\"".ROOT_WWW."site/img/facebook.png\" width=\"26\" height=\"21\">
                                </a>
                              </td>
                              <td class=\"social-text\" style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: middle !important;height: 21px;color: #41637e;font-size: 10px;font-weight: bold;letter-spacing: 0.1em;text-decoration: none;text-transform: uppercase;font-family: sans-serif\">
                                <a target=\"_blank\" style=\"color: #41637e;text-decoration: none;transition: color .2s\" href=\"".$facebook."\" rel=\"cs_facebox\">
                                  Like
                                </a>
                              </td>
                            </tr>
                          </tbody></table>
                        </td>
                        <td class=\"divider\" style=\"padding-top: 0;padding-bottom: 0;padding-left: 14px;padding-right: 14px;vertical-align: top;color: #e9e9e9;font-family: sans-serif;font-size: 10px;line-height: 21px;text-align: center\">
                          &#9830;&#65038;
                        </td>
                        <td class=\"social-link\" style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top\">
                          <table style=\"border-collapse: collapse;border-spacing: 0\">
                            <tbody><tr>
                              <td style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top\">
                                <img style=\"border-left-width: 0;border-top-width: 0;border-bottom-width: 0;border-right-width: 0;-ms-interpolation-mode: bicubic\" src=\"".ROOT_WWW."site/img/twitter.png\" width=\"26\" height=\"21\">
                              </td>
                              <td class=\"social-text\" style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: middle !important;height: 21px;color: #41637e;font-size: 10px;font-weight: bold;letter-spacing: 0.1em;text-decoration: none;text-transform: uppercase;font-family: sans-serif\">
                                <a target=\"_blank\" style=\"color: #41637e;text-decoration: none;transition: color .2s\" href=\"".$twitter."\">
                                  Tweet
                                </a>
                              </td>
                            </tr>
                          </tbody></table>
                        </td>
                        <td class=\"divider\" style=\"padding-top: 0;padding-bottom: 0;padding-left: 14px;padding-right: 14px;vertical-align: top;color: #e9e9e9;font-family: sans-serif;font-size: 10px;line-height: 21px;text-align: center\">
                          &#9830;&#65038;
                        </td>
                        <td class=\"social-link\" style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top\">
                          <table style=\"border-collapse: collapse;border-spacing: 0\">
                            <tbody><tr>
                              <td style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top\">
                                <a target=\"_blank\" style=\"color: #41637e;text-decoration: none;transition: color .2s\" href=\"".$googleplus."\">
                                  <img style=\"border-left-width: 0;border-top-width: 0;border-bottom-width: 0;border-right-width: 0;-ms-interpolation-mode: bicubic\" src=\"".ROOT_WWW."site/img/googleplus.png\" width=\"26\" height=\"21\">
                                </a>
                              </td>
                              <td class=\"social-text\" style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: middle !important;height: 21px;color: #41637e;font-size: 10px;font-weight: bold;letter-spacing: 0.1em;text-decoration: none;text-transform: uppercase;font-family: sans-serif\">
                                <a target=\"_blank\" style=\"color: #41637e;text-decoration: none;transition: color .2s\" href=\"".$googleplus."\">
                                  Forward
                                </a>
                              </td>
                            </tr>
                          </tbody></table>
                        </td>
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
                <tr class=\"border\" style=\"font-size: 1px;line-height: 1px;background-color: #e9e9e9;height: 1px\"><td style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top;line-height: 1px\">&nbsp;</td></tr>
                <tr>
                  <td style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top\">
                    <table style=\"border-collapse: collapse;border-spacing: 0\">
                      <tbody><tr>
                        <td class=\"address\" style=\"padding-top: 32px;padding-bottom: 64px;padding-left: 0;padding-right: 0;vertical-align: top;width: 250px\">
                          <table class=\"contents\" style=\"border-collapse: collapse;border-spacing: 0;width: 100%\">
                            <tbody><tr>
                              <td class=\"padded\" style=\"padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 10px;vertical-align: top;color: #999999;font-family: Georgia, serif;font-size: 12px;line-height: 20px;text-align: left\">
                                <div>".$footer_name."<br>
".$footer_main_link."<br>
".$footer_email."<br>".$footer_contact_detail."</div>
                              </td>
                            </tr>
                          </tbody></table>
                        </td>
                        <td class=\"subscription\" style=\"padding-top: 32px;padding-bottom: 64px;padding-left: 0;padding-right: 0;vertical-align: top;width: 350px;text-align: right\">
                          <table class=\"contents\" style=\"border-collapse: collapse;border-spacing: 0;width: 100%\">
                            <tbody><tr>
                              <td class=\"padded\" style=\"padding-top: 0;padding-bottom: 0;padding-left: 10px;padding-right: 0;vertical-align: top;color: #999999;font-family: Georgia, serif;font-size: 12px;line-height: 20px;text-align: right\">
                                
                               
                              </td>
                            </tr>
                          </tbody></table>
                        </td>
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
              </tbody></table>
            </center>
          </td>
        </tr>
      </tbody></table>";

return $the_message;
	  }





function generate_permalink($str, $replace=array(), $delimiter='-') {
	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}

	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	return $clean;
}
$section_url = "";

if(isset($_GET['id_region'])){
$id_region = $_GET['id_region'];
$section_url = 'region/'.$id_region.'/'.$_GET['region'];
}elseif(isset($_GET['id_district'])){
$id_district = $_GET['id_district'];
$section_url = 'district/'.$id_district.'/'.$_GET['district'];
}

if(isset($_GET['id_town_cities'])){
$id_town_cities = $_GET['id_town_cities'];

$section_url_town_cities = "/".$id_town_cities."/".$_GET['town_cities'];
}else{
$section_url_town_cities = "";
}

if(isset($_GET['id_business']) && !empty($_GET['business'])){
$id_business = $_GET['id_business'];
$section_url_business = "/".$id_business."/".$_GET['business'];

}else{
$section_url_business = "";
}


?>