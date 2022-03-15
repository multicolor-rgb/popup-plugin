<div class="foger__popup" >
    
<div class="foger__content">
    
<div class="foger__close">
<div class="close icon"></div>
</div>

<?php echo file_get_contents( GSDATAOTHERPATH."/popup_plugin/popupbody.txt");?>

</div>
</div>

<script>
let popupDate = ' <?php echo file_get_contents( GSDATAOTHERPATH."/popup_plugin/popupDateExpires.txt");?> ';

document.querySelector('.foger__close').addEventListener('click',()=>{
document.querySelector('.foger__popup').classList.add('popup__none');
document.cookie = "hidePopup=yes; path=/ ; expires="+popupDate+";";
const cookies = document.cookie.split(/; */);



});


function showCookie(name) {
    if (document.cookie !== "") {
        const cookies = document.cookie.split(/; */);

        for (let i=0; i<cookies.length; i++) {
            const cookieName = cookies[i].split("=")[0];
            const cookieVal = cookies[i].split("=")[1];
            if (cookieName === decodeURIComponent(name)) {
                return decodeURIComponent(cookieVal);
            }
        }
    };
};


document.querySelector('.foger__popup').style.display = "none";

window.onload=()=>{

const argumenter = showCookie("hidePopup");



const OnOff = <?php echo '"'. file_get_contents( GSDATAOTHERPATH."/popup_plugin/popupOnOff.txt").'"' ;?>;

if( OnOff == ""){
    document.querySelector('.foger__popup').style.display = "none";
    console.log('popup is off');
}else{
    console.log('popup is on');
    document.querySelector('.foger__popup').style.display = "flex";

};


if(argumenter == "yes" ){
    document.querySelector('.foger__popup').style.display = "none";
}
};

</script>