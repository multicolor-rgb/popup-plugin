<?php

# get correct id for plugin
$thisfile = basename(__FILE__, ".php");

# register plugin
register_plugin(
	$thisfile, //Plugin id
	'Popup plugin', 	//Plugin name
	'2.0', 		//Plugin version
	'Mateusz Skrzypczak',  //Plugin author
	'http://www.multicolor.ovh', //author website
	'Popup plugin for your website', //Plugin description
	'pages', //page type - on which admin tab to display
	'popup_settings'  //main function (administration)
);



register_style('popupstyle', $SITEURL . 'plugins/popup_plugin/css/popupstyle.css', GSVERSION, 'screen');
queue_style('popupstyle', GSFRONT);
# activate filter 

# add a link in the admin tab 'theme'
add_action('pages-sidebar', 'createSideMenu', array($thisfile, 'Popup Plugin 🐱‍👤'));

# functions


require GSPLUGINPATH . 'popup_plugin/popup.class.php';
$pop = new Popup();


function popup_settings()
{

	global $pop;

	global $SITEURL;
	global $GSADMIN;

	if (isset($_GET['addnew'])) {
		include('popup_plugin/addnew.inc.php');
	} elseif (isset($_GET['edit'])) {
		$Json = json_decode(file_get_contents(GSPLUGINPATH . 'popup_plugin/popuplist/' . $_GET['edit'] . '.json'), true);
		$content = file_get_contents(GSPLUGINPATH . 'popup_plugin/popuplist/' . $_GET['edit'] . '.txt');
		include('popup_plugin/addnew.inc.php');
	} else {
		include('popup_plugin/list.inc.php');
	}

	if (isset($_POST['submitPopup'])) {
		$pop->create();
	}

	if (isset($_GET['delete'])) {
		$pop->del();
	};


	echo '<div class="sponsor" style="width:100%;padding:10px;text-align:center;background:#fafafa;border:solid 1px #ddd;box-sizing:border-box; margin-top:10px;">
    <p class="lead" style="margin:5px;">Buy me ☕ if you want to see new plugins :) </p>
    <a href="https://www.paypal.com/donate/?hosted_button_id=TW6PXVCTM5A72">
    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif"  />
    </a>
    </div>
    ';
  

}


function showPopup($name)
{

	$content = file_get_contents(GSPLUGINPATH . 'popup_plugin/popuplist/' . $name . '.txt');
	$contentJson = json_decode(file_get_contents(GSPLUGINPATH . 'popup_plugin/popuplist/' . $name . '.json'), true);

	echo '<div id="modal" class="popup-'.$name.'" >
	<div class="modal-background"></div>
	<div class="modal">
		<div class="modal-header">
			<h3>' . $contentJson['settings'][0]['title'] . '</h3>
			<div class="modal-close">
				<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAdVBMVEUAAABNTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU0N3NIOAAAAJnRSTlMAAQIDBAUGBwgRFRYZGiEjQ3l7hYaqtLm8vsDFx87a4uvv8fP1+bbY9ZEAAAB8SURBVBhXXY5LFoJAAMOCIP4VBRXEv5j7H9HFDOizu2TRFljedgCQHeocWHVaAWStXnKyl2oVWI+kd1XLvFV1D7Ng3qrWKYMZ+MdEhk3gbhw59KvlH0eTnf2mgiRwvQ7NW6aqNmncukKhnvo/zzlQ2PR/HgsAJkncH6XwAcr0FUY5BVeFAAAAAElFTkSuQmCC" width="16" height="16" alt="">
			</div>
		</div> 
		<div class="modal-content">
' . $content . '
		</div>
	</div>
	</div>';


	echo '<script async>
	/*close modal */
document.querySelector(".modal-close").addEventListener("click",()=>{
document.querySelector(".popup-'.$name.'").style.display="none";
let popupDate = "' . $contentJson['settings'][0]['date'] . '";
document.cookie = "' . $name . 'Popup=' . $contentJson['settings'][0]['showAgain'] . '; path=/ ; expires=" + popupDate + ";";
	const cookies = document.cookie.split(/; */);
 
});



function showCookie(name) {
	if (document.cookie !== "") {
		const cookies = document.cookie.split(/; */);

		for (let i = 0; i < cookies.length; i++) {
			const cookieName = cookies[i].split("=")[0];
			const cookieVal = cookies[i].split("=")[1];
			if (cookieName === decodeURIComponent(name)) {
				return decodeURIComponent(cookieVal);
			}
		}
	};
};


 

	const argumenter = showCookie("' . $name . 'Popup");
 
 
 
	if (argumenter=="yes" || argumenter == undefined){
		document.querySelector(".popup-'.$name.'").style.display="block";
	}else{
		document.querySelector(".popup-'.$name.'").style.display="none";
	}

 

</script>';
};


add_action('theme-header', 'pageBeginPopupPlugin');
function pageBeginPopupPlugin()
{
	global $content;
	$newcontent = preg_replace_callback(
		'/\\[% popup=(.*) %\\]/i',
		'runPopupShortcode',
		$content
	);
	$content = $newcontent;
};


function runPopupShortcode($matches)
{

	$name = $matches[1];

	$content = file_get_contents(GSPLUGINPATH . 'popup_plugin/popuplist/' . $name . '.txt');
	$contentJson = json_decode(file_get_contents(GSPLUGINPATH . 'popup_plugin/popuplist/' . $name . '.json'), true);

	$html = '<div id="modal" class="popup-'.$name.'"  >
	<div class="modal-background"></div>
	<div class="modal">
		<div class="modal-header">
			<h3>' . $contentJson['settings'][0]['title'] . '</h3>
			<div class="modal-close">
				<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAdVBMVEUAAABNTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU0N3NIOAAAAJnRSTlMAAQIDBAUGBwgRFRYZGiEjQ3l7hYaqtLm8vsDFx87a4uvv8fP1+bbY9ZEAAAB8SURBVBhXXY5LFoJAAMOCIP4VBRXEv5j7H9HFDOizu2TRFljedgCQHeocWHVaAWStXnKyl2oVWI+kd1XLvFV1D7Ng3qrWKYMZ+MdEhk3gbhw59KvlH0eTnf2mgiRwvQ7NW6aqNmncukKhnvo/zzlQ2PR/HgsAJkncH6XwAcr0FUY5BVeFAAAAAElFTkSuQmCC" width="16" height="16" alt="">
			</div>
		</div> 
		<div class="modal-content">
' . $content . '
		</div>
	</div>
	</div>';


	$html .=  '<script async>
	/*close modal */
document.querySelector(".modal-close").addEventListener("click",()=>{
document.querySelector(".popup-'.$name.'").style.display="none";
let popupDate = "' . $contentJson['settings'][0]['date'] . '";
document.cookie = "' . $name . 'Popup=' . $contentJson['settings'][0]['showAgain'] . '; path=/ ; expires=" + popupDate + ";";
	const cookies = document.cookie.split(/; */);
 
});



function showCookie(name) {
	if (document.cookie !== "") {
		const cookies = document.cookie.split(/; */);

		for (let i = 0; i < cookies.length; i++) {
			const cookieName = cookies[i].split("=")[0];
			const cookieVal = cookies[i].split("=")[1];
			if (cookieName === decodeURIComponent(name)) {
				return decodeURIComponent(cookieVal);
			}
		}
	};
};


const argumenter = showCookie("' . $name . 'Popup");
 
 
 
if (argumenter=="yes" || argumenter == undefined){
	document.querySelector(".popup-'.$name.'").style.display="block";
}else{
	document.querySelector(".popup-'.$name.'").style.display="none";
}



</script>';

	return $html;
};
