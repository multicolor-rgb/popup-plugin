<script>
	$(document).ready(function() {
    $(document).on('submit', '#editform', function() {
      // do your things
      return true;
     });
});
</script>

<style>
.popnone{
	display:none;
}

.successPopup{
	width:90%;
	margin:0 auto;
    padding:15px;
    background:green;
    border-radius:5px;
    display:none;
}

.successPopupShow{
    display: block !important;
}

#editform{
	text-align:center;
}
	</style>



<form class="largeform" id="editform" action="#" method="post" accept-charset="utf-8" >

<h3>Turn On Popup <input type="checkbox" name="popup-checkbox" class="popupCheck" <?php echo empty($_POST['popup-checkbox']) ? '' : ' checked="checked" '; ?>  style="margin:10px 0;margin-left:20px;"/>
</h3>



<button style="margin:5px 0;padding:10px 15px;text-transform:uppercase;
background:#000;border:none;color:#fff;letter-spacing:1px;" class="showPopupContent" >Edit Content</button>
	
<div class="popuperContenter" style="width:100%;">

<p style="margin-bottom:0;padding:0;">popup date expires examples  Fri, 1 Jan 2100 00:00:01 GMT </p>


<select id="cars"  name="datePicker">
  <option value="7days">7 days</option>
  <option value="1month">1 month</option>
  <option value="1year">1 year</option>
</select>

<input name="popupdata" class="this-date" type="input" value ="<?php echo file_get_contents( GSDATAOTHERPATH."/popup_plugin/popupDateExpires.txt");?>">


<br><br>
<p style="margin-bottom:0;padding:0;">Content popup</p>
<textarea id="post-content" name="post-content"  >
	
<?php echo file_get_contents( GSDATAOTHERPATH."/popup_plugin/popupbody.txt");?>
</textarea>







<script>

let date = new Date();


document.querySelector('#cars').addEventListener('change',()=>{

	if(document.querySelector('#cars').value == "7days"){
date = new Date();
	date.setDate(date.getDate() + 7);
console.log(date);
document.querySelector('.this-date').value = date;

}

if(document.querySelector('#cars').value == "1month"){
	date = new Date();
	date.setDate(date.getDate() + 30);
console.log(date);
document.querySelector('.this-date').value = date;

}

if(document.querySelector('#cars').value == "1year"){
	date = new Date();
	date.setDate(date.getDate() + 365);
console.log(date);
document.querySelector('.this-date').value = date;

}

});

</script>

</div>

<br>

<input type="submit" class="submitPopup" name="submitPopup" style="margin:15px 0;padding:10px 15px;text-transform:uppercase;
background:#000;border:none;color:#fff;letter-spacing:1px;" value="Save" >

</form>
<div class="successPopup">
	<p style="color:#fff;text-align:center;padding:0;margin:0;">go to another page!</p>
</div>

<script type="text/javascript" src="template/js/ckeditor/ckeditor.js?t=3.3.15"></script>

			<script type="text/javascript">
			CKEDITOR.timestamp = '3.3.15';
			var editor = CKEDITOR.replace( 'post-content', {
					skin : 'getsimple',
					forcePasteAsPlainText : true,
					entities : false,
					// uiColor : '#FFFFFF',
					height: '400px',
					baseHref : 'http://localhost:81/',
					tabSpaces:10,
					filebrowserBrowseUrl : 'filebrowser.php?type=all',
					filebrowserImageBrowseUrl : 'filebrowser.php?type=images',
					filebrowserWindowWidth : '730',
					filebrowserWindowHeight : '500'
					,toolbar: [["Cut","Copy","Paste","PasteFromWord","-","Undo","Redo","Find","Replace","-","SelectAll"],["Bold","Italic","Underline","NumberedList","BulletedList","JustifyLeft","JustifyCenter","JustifyRight","JustifyBlock","Table","TextColor","BGColor","Link","Unlink","Image","RemoveFormat","Source"],"\/",["Styles","Format","Font","FontSize","Undo","Redo","Maximize"],["Templates","AddCMSGrid","AddCMSGridRow","DeleteCMSGridRow","ExpandCMSColLeft","ExpandCMSColRight","SwapCMSCols"],["Iframe","ckawesome","oembed","simplebutton","ckeditor-gwf-plugin","spacingsliders"]]					
			});

			CKEDITOR.instances["post-content"].on("instanceReady", InstanceReadyEvent);

			function InstanceReadyEvent(ev) {
				_this = this;
				this.document.on("keyup", function () {
					$('#editform #post-content').trigger('change');
					_this.resetDirty();
				});

				this.timer = setInterval(function(){trackChanges(_this)},500);
				
			}		

			/**
			 * keep track of changes for editor
			 * until cke 4.2 is released with onchange event
			 */
			function trackChanges(editor) {
				// console.log('check changes');
				if ( editor.checkDirty() ) {
					$('#editform #post-content').trigger('change');
					editor.resetDirty();			
				}
			};


			document.querySelector('.popuperContenter').classList.add('popnone');

			document.querySelector('.showPopupContent').addEventListener('click',()=>{
			event.preventDefault();
			document.querySelector('.popuperContenter').classList.toggle('popnone');

			});
			

			const oner = '<?php echo file_get_contents( GSDATAOTHERPATH."/popup_plugin/popupOnOff.txt");?>';

			if(oner == ''){
				document.querySelector('.popupCheck').checked = false;
			}else if(oner == 'on'){
				document.querySelector('.popupCheck').checked = true;
			}

			</script>

            
      
            
			<?php // Set up the data
$PopupDate = $_POST['popupdata'];
$Popupdata = $_POST['post-content'];
$popupCheckbox = $_POST['popup-checkbox'];

// Set up the folder name and its permissions
// Note the constant GSDATAOTHERPATH, which points to /path/to/getsimple/data/other/
$folder        = GSDATAOTHERPATH . '/popup_plugin/';
$popupContent      = $folder . 'popupbody.txt';
$popupOnOff     = $folder . 'popupOnOff.txt';
$popupDateFile = $folder. 'popupDateExpires.txt';
$chmod_mode    = 0755;
$folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);

 
// Save the file (assuming that the folder indeed exists)
if ( isset($_POST['submitPopup'])) {
if($folder_exists){
  file_put_contents($popupContent, $Popupdata);
  file_put_contents($popupOnOff, $popupCheckbox);
  file_put_contents($popupDateFile, $PopupDate);
}
echo'<script> document.querySelector(".successPopup").classList.add("successPopupShow");
document.querySelector("#editform").style.display="none";
</script>';
  };
  
  ?>
				
				
		
		
		
        
