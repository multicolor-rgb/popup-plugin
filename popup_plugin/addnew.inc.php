 <style>
 	.popnone {
 		display: none;
 	}

 	.successPopup {
 		width: 90%;
 		margin: 0 auto;
 		padding: 15px;
 		background: green;
 		border-radius: 5px;
 		display: none;
 	}

 	.successPopupShow {
 		display: block !important;
 	}

 	#editform {
 		border: solid 1px #ddd;
 		background: #fafafa;
 		padding: 10px;
 		box-sizing: border-box;
 	}

 	.date-picker {
 		width: 100%;
 		padding: 10px;
 		background: #fff;
 		display: block;
 		box-sizing: border-box;
 		border: solid 1px #ddd;
 	}

 	.this-date {
 		width: 100%;
 		padding: 10px;
 		margin-top: 10px;
 		border: solid 1px #ddd;
 		box-sizing: border-box;
 		border: solid 1px #ddd;
 	}

 	.popup-title {
 		width: 100%;
 		padding: 10px;
 		box-sizing: border-box;
 		margin-bottom: 10px;
 		border: solid 1px #ddd;
 	}

 	.btn {
 		padding: 0.4rem 0.5rem;
 		background: #000;
 		display: inline-block;
 		color: #fff !important;
 		text-decoration: none !important;
 		margin-bottom: 10px;
 	}
 </style>



 <a href="<?php echo $SITEURL . $GSADMIN . '/load.php?id=popup_plugin' ?>" class="btn">back to list</a>


 <form class="largeform" id="editform" action="#" method="post" accept-charset="utf-8">

 	<h3>Popup creator
 	</h3>

 	<input type="text" placeholder="name without spacebar" name="name" class="popup-title" required pattern="[a-zA-Z0-9]+" <?php if (isset($_GET['edit'])) {
																																echo ' value="' . $_GET['edit'] . '"';
																															};
																															?> />


 	<div style="width:100%;
	border:solid 1px #ddd;display:flex; align-items:center;justify-content:space-between;padding:5px;box-sizing:border-box;color:#fff;background:#000;margin-bottom:10px;">
 		<label for="popup-checkbox" style="margin:0;padding:0;color:#fff;" value="turnon">Turn on?</label>

 		<input type="checkbox" id="popup-checkbox" name="popup-checkbox" value="turnon" class="popupCheck" <?php

																											if (isset($_GET['edit'])) {
																												echo ($Json['settings'][0]['checkbox'] == 'turnon' ? 'checked="true"' : '');
																											};
																											?> />



 	</div>
 	<label style="margin-bottom:10px;padding:0;">Title popup</label>
 	<input type="text" placeholder="title" name="title" class="popup-title" <?php
																				if (isset($_GET['edit'])) {
																					echo 'value="' . $Json['settings'][0]['title'] . '"';
																				};
																				?>>



 	<div class="popuperContenter" style="width:100%;">

 		<label style="margin-bottom:5px;padding:0;">Popup date expires examples Fri, 1 Jan 2100 00:00:01 GMT </label>


 		<select class="date-picker" name="datePicker">
 			<option value="7days">7 days</option>
 			<option value="1month">1 month</option>
 			<option value="1year">1 year</option>
 		</select>

 		<?php if (isset($_GET['edit'])) {
				echo
				'<script>document.querySelector(".date-picker").value = "' . $Json['settings'][0]['datePicker'] . '"</script>';
			}; ?>



 		<input name="popupdata" class="this-date" type="input" value="<?php echo @file_get_contents(GSDATAOTHERPATH . "/popup_plugin/popupDateExpires.txt"); ?>">

 		<label style="margin-bottom:5px;padding:0;margin-top:10px;">Show again after close? </label>

 		<select name="showagain" style="
		
			width: 100%;
		padding: 10px;
		background: #fff;
		display: block;
		box-sizing: border-box;
		border: solid 1px #ddd;
		
		">

 			<option value="yes" <?php
									if (isset($_GET['edit'])) {
										echo ($Json['settings'][0]['showAgain'] == 'yes' ? "selected" : "");
									}; ?>>yes</option>
 			<option value="no" <?php
								if (isset($_GET['edit'])) {
									echo ($Json['settings'][0]['showAgain'] == 'no' ? "selected" : "");
								}; ?>>no</option>

 		</select>
 		<br><br>
 		<label style="margin-bottom:10px;padding:0;">Content popup</label>
 		<textarea id="post-content" name="post-content">





<?php

if (isset($_GET['edit'])) {
	echo file_get_contents(GSPLUGINPATH . 'popup_plugin/popuplist/' . $_GET['edit'] . '.txt');
}

?>
</textarea>


 		<script>
 			let date = new Date();

 			if (document.querySelector('.date-picker').value == "7days") {
 				date = new Date();
 				date.setDate(date.getDate() + 7);
 				console.log(date);
 				document.querySelector('.this-date').value = date;

 			}


 			if (document.querySelector('.date-picker').value == "1month") {
 				date = new Date();
 				date.setDate(date.getDate() + 30);
 				console.log(date);
 				document.querySelector('.this-date').value = date;

 			}

 			if (document.querySelector('.date-picker').value == "1year") {
 				date = new Date();
 				date.setDate(date.getDate() + 365);
 				console.log(date);
 				document.querySelector('.this-date').value = date;

 			}

 			document.querySelector('.date-picker').addEventListener('change', () => {

 				if (document.querySelector('.date-picker').value == "7days") {
 					date = new Date();
 					date.setDate(date.getDate() + 7);
 					console.log(date);
 					document.querySelector('.this-date').value = date;

 				}

 				if (document.querySelector('.date-picker').value == "1month") {
 					date = new Date();
 					date.setDate(date.getDate() + 30);
 					console.log(date);
 					document.querySelector('.this-date').value = date;

 				}

 				if (document.querySelector('.date-picker').value == "1year") {
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
background:#000;border:none;color:#fff;letter-spacing:1px;" value="Create popup">

 </form>
 <div class="successPopup">
 	<p style="color:#fff;text-align:center;padding:0;margin:0;">go to another page!</p>
 </div>

 <script type="text/javascript" src="template/js/ckeditor/ckeditor.js?t=3.3.15"></script>

 <script type="text/javascript">
 	CKEDITOR.timestamp = '3.3.15';
 	var editor = CKEDITOR.replace('post-content', {
 		skin: 'getsimple',
 		forcePasteAsPlainText: true,
 		entities: false,
 		// uiColor : '#FFFFFF',
 		height: '400px',
 		baseHref: 'http://localhost:81/',
 		tabSpaces: 10,
 		filebrowserBrowseUrl: 'filebrowser.php?type=all',
 		filebrowserImageBrowseUrl: 'filebrowser.php?type=images',
 		filebrowserWindowWidth: '730',
 		filebrowserWindowHeight: '500',
 		toolbar: 'advanced'
 	});

 	CKEDITOR.instances["post-content"].on("instanceReady", InstanceReadyEvent);

 	function InstanceReadyEvent(ev) {
 		_this = this;
 		this.document.on("keyup", function() {
 			$('#editform #post-content').trigger('change');
 			_this.resetDirty();
 		});

 		this.timer = setInterval(function() {
 			trackChanges(_this)
 		}, 500);

 	}

 	/**
 	 * keep track of changes for editor
 	 * until cke 4.2 is released with onchange event
 	 */
 	function trackChanges(editor) {
 		// console.log('check changes');
 		if (editor.checkDirty()) {
 			$('#editform #post-content').trigger('change');
 			editor.resetDirty();
 		}
 	};
 </script>