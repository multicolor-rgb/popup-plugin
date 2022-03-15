<?php

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");
 
# register plugin
register_plugin(
	$thisfile, //Plugin id
	'Popup plugin', 	//Plugin name
	'1.2', 		//Plugin version
	'Mateusz Skrzypczak',  //Plugin author
	'http://www.multicolor.ovh', //author website
	'Popup plugin for your website', //Plugin description
	'pages', //page type - on which admin tab to display
	'popup_settings'  //main function (administration)
);
 


register_script('popupscript', $SITEURL.'plugins/popup_plugin/js/script.js', '1.0',TRUE);
queue_script('popupscript',GSFRONT); 
register_style('popupstyle', $SITEURL.'plugins/popup_plugin/css/popupstyle.css', GSVERSION, 'screen');
queue_style('popupstyle',GSFRONT); 
# activate filter 
add_action('theme-footer','popup_footer'); 
 
# add a link in the admin tab 'theme'
add_action('pages-sidebar','createSideMenu',array($thisfile,'Popup settings'));
 
# functions



function popup_footer() {
    include('popup_plugin/popupfront.php');
}
 
function popup_settings() {
include('popup_plugin/popupsettings.php');
}
?>