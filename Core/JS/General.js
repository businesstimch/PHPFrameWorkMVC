var touchOrClick;

if("ontouchstart" in document && "onclick" in document)
	touchOrClick = 'touchstart click';
else if("ontouchstart" in document)
	touchOrClick = 'touchstart';
else
	touchOrClick = 'click';

if(__AjaxURL__ == undefined)
{
	var __AjaxURL__ = window.location.pathname;
}



$(document).ready(function(){

   var oldHash = location.hash;

	Pull.init();
	hashController.init();
	$(window).trigger( 'hashchange' );

   $(window).bind( 'hashchange', function(e) {
      if(oldHash != location.hash)
      {

         oldHash = location.hash;
         refreshPage.Submit();
      }
   });


   $(window).trigger( 'hashchange' );

   $(window).scroll(function(){
      $('.msgBox').css("top","20px");
      $('.msgBox').css("right","20px");
   });


   $(document).on(touchOrClick,'.xBTN',function(){
      $(this).parent().remove();
   });


   $(document).on(touchOrClick,'#TouchRight_Menu_Pull',function(){
      if($("#TouchRight").width() > 0)
         $("#TouchRight").css("width","0%");
      else
         $("#TouchRight").css("width","auto");
   });


});

Number.prototype.pad = function(size) {
   var s = String(this);
   while (s.length < (size || 2)) {s = "0" + s;}
   return s;
}


if("ontouchstart" in document && "onclick" in document)
   var touchOrClick = 'touchstart click';
else if("ontouchstart" in document)
   var touchOrClick = 'touchstart';
else
   var touchOrClick = 'click';

var catURL = '';

if(__AjaxURL__ == undefined)
{
   var __AjaxURL__ = window.location.pathname;
}

function getJSonSize(JSonOBJ)
{
   var Count = 0;
   for(Key in JSonOBJ)
   {
      Count++;
   }
   return Count;
};

function getCookie(cname)
{
   var name = cname + "=";
   var ca = document.cookie.split(';');
   for(var i=0; i<ca.length; i++)
   {
      var c = ca[i];
      while (c.charAt(0)==' ')
         c = c.substring(1);

      if (c.indexOf(name) == 0)
         return c.substring(name.length,c.length);
   }
   return "";
}
var timconfirm_val = false;
function timconfirm(title,msg,callback)
{
   timconfirm_val = false;
   var ID = "TimPop_"+Math.floor((Math.random() * 100000000) + 1);
   var html = "";
   html += '<div id="'+ID+'" class="popup popup_gray fadeandscale" style="max-width:44em;">';
   html += 	'<div class="Popoup_Title">'+title+'</div>';
   html +=	'<div class="Popup_OneLine">'+msg+'</div>';
   html +=	'<div class="w100">';
   html +=		'<button id="TimPOP_Btn_Yes" class="btn '+ID+'_close">확인</button>';
   html +=		'<button id="TimPOP_Btn_No" class="btn '+ID+'_close">닫기</button>';
   html +=	'</div>';
   html += '</div>';

   $("body").append(html);
   $("#"+ID).popup({
      transition: 'all 0.3s',
      autoopen:true,
      onopen:function(){
         $(document).on(touchOrClick,'#TimPOP_Btn_Yes',function(){
            timconfirm_val = true;
         });

         $(document).on(touchOrClick,'#TimPOP_Btn_No',function(){
            timconfirm_val = false;
         });
      },
      onclose:function(){
         if(timconfirm_val)
            callback(timconfirm_val);

         $(".popup_background").remove();
      }
   });
}

function timPopup(Argv_Html,noBox)
{
   var ID = "TimPop_"+Math.floor((Math.random() * 100000000) + 1);
   var html = "";


   html += '<div id="'+ID+'" class="popup TimPoPup fadeandscale '+(!noBox ? 'popup_gray' : 'popup_noBox')+'">';
   html += '<div class="xButton '+ID+'_close"></div>';
   html += 	Argv_Html;
   html += '</div>';

   $("body").append(html);
   $("#"+ID).popup({
      transition: 'all 0.3s',
      autoopen:true,
      onopen:function(){

      },
      onclose:function(){
         $(".popup_background").remove();
      }
   });
}
function checkNumberField()
{
   var result = true;
   $(".onlynumber").each(function(){

      if(!isNumber($(this).val()))
      {
         $(this).addClass("errorField");
         result = false;
      }
      else
         $(this).removeClass("errorField");
   });
   var moneyReg = /^[1-9]\d*(((,\d{3}){1})?(\.\d{0,2})?)$/;
   $(".onlymoney").each(function(){
      if(!moneyReg.test($(this).val()))
      {
         $(this).addClass("errorMoney");
         result = false;
      }
      else
         $(this).removeClass("errorMoney");
   });

   return result;
}

Number.prototype.number_format = function(c, d, t){
	var n = this,
		c = isNaN(c = Math.abs(c)) ? 2 : c,
		d = d == undefined ? "." : d,
		t = t == undefined ? "," : t,
		s = n < 0 ? "-" : "",
		i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
		j = (j = i.length) > 3 ? j % 3 : 0;
	return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

function timeStamp(Stamp) {
   /* Create a date object with the current time*/
   var now = new Date(Stamp * 1000);

   /* Create an array with the current month, day and time*/
   var date = [ now.getMonth() + 1, now.getDate(), now.getFullYear() ];

   /* Create an array with the current hour, minute and second*/
   var time = [ now.getHours(), now.getMinutes(), now.getSeconds() ];

   /* Determine AM or PM suffix based on the hour*/
   var suffix = ( time[0] < 12 ) ? "AM" : "PM";

   /* Convert hour from military time*/
   time[0] = ( time[0] < 12 ) ? time[0] : time[0] - 12;

   /* If hour is 0, set it to 12*/
   time[0] = time[0] || 12;

   /* If seconds and minutes are less than 10, add a zero*/
   for ( var i = 1; i < 3; i++ ) {
      if ( time[i] < 10 ) {
         time[i] = "0" + time[i];
      }
   }

   /* Return the formatted string*/
   return date.join("/") + " " + time.join(":") + " " + suffix;
}
function isMobile()
{
   var bro = (navigator.userAgent || navigator.vendor || window.opera);
   alert(bro);
   if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(bro) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(bro.substr(0, 4)))
     return true;
}
function isNumber(n) {
   return !isNaN(parseFloat(n)) && isFinite(n);
}


var msgbox_stack = [];

function checkURL(URL)
{
   var expression = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi;/*여기 다시봐*/
   var regex = new RegExp(expression);

   if (URL.match(regex) )
   {
      return true;
   } else {
      return false;
   }

}
function initDom()
{
   $(".datePicker").datepicker({
      dateFormat: "yy-m-d"
   });
}
function isNumber(n) {
   return !isNaN(parseFloat(n)) && isFinite(n);
}
var adDelay = 4000;

function generate_SEO_URL_FromTXT(txt)
{
   txt = txt.replace(/ /g,'-').toLowerCase();
   txt = txt.replace(/[^a-zA-Z0-9-]/g,'');
   return txt;
}

function showSideMSGBox(msg,box_class)
{
   if(box_class == undefined)
      box_class = 'msgBox_One_1';
   var randomNumber = Math.floor((Math.random()*100000)+1);
   $('.msgBox_One').addClass('msgBox_Gray');
   $('#msgBox').prepend('<div id="msgBoxID_'+randomNumber+'" class="Glow '+box_class+' msgBox_One"><div class="xBTN"></div><div class="msgBox_One_D">'+msg+'</div></div>');
/*
	 $('#msgBoxID_'+randomNumber).delay(5000).fadeOut(500,function(){
      $(this).remove();
   });
	*/
}

Array.prototype.hasValue = function(value) {
  var i;
  for (i=0; i<this.length; i++) { if (this[i] === value) return true; }
  return false;
};


function escapeRegExp(str) {
  return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
}

function isUrl(s) {
   var regexp = new RegExp("/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/");
   return regexp.test(s);
}

function ErrorOrNot(res)
{
   if(res.ack == 'success')
      return true;
   else
   {
      if(res.error_msg != undefined)
         msgBTN('<div><img src="/img/notice-icon.png" alt="Notice" /></div><div>'+res.error_msg+'</div>');
      return false;
   }


}

function playSound(SoundID)
{
   var SoundArr = {};
   SoundArr[1] = '/Template/Media/burugo-notification.ogg';
   var clickSound = new Audio(SoundArr[SoundID]);
   clickSound.play();
}

function passwordSecurityValidate(password,password_Confirm)
{
   var minimumLength = 5;

   var errorCode = Array();
   /*
      errorCode
      1 : Password Length
      2 :

   */
   if(password.length <= minimumLength)
      errorCode.push(1);
   else if(!password.match(/[0-9]/gi))
      errorCode.push(2);
   else if(!password.match(/[A-Za-z]/gi))
      errorCode.push(3);
   else if(password != password_Confirm)
      errorCode.push(4);

   if(errorCode.length > 0)
      return errorCode;
   else
      return false;
}

function validateEmail(email) {
   var re = new RegExp("/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/");
   return re.test(email);
}

function hashToUrl()
{

   var Args = "";
   var hashes = window.location.hash.replace("/","&").slice(1).split(/&(?=\w+=)/);

   for(var i = 0; i < hashes.length; i++)
   {
      Hash_One = hashes[i].split('=');
      if(Hash_One[1] == undefined)
         Hash_One[1] = "";
      Args += "&"+Hash_One[0] + "=" + Hash_One[1];
   }
   return Args;
}

function getHash(hashName)
{
   var vars =[] ,hash;

   var hashes = decodeURIComponent(window.location.hash).replace("/","&").slice(1).split(/&(?=\w+=)/);

   for(var i = 0; i < hashes.length; i++)
   {
      hash = hashes[i].split('=');
      vars.push(hash[0]);
      if(hash[1] == undefined)
         hash[1] = '';
      vars[hash[0]] = hash[1];
   }

   return vars;
}

function getRawHash()
{
   return (window.location.hash.slice(window.location.hash.indexOf('#')+1));
}
function removeHash(hashName)
{
   var hash_tmp;
   var hashes = window.location.hash.replace("/","&").slice(1).split(/&(?=\w+=)/);
   var exsist = false;

   var newHash = '#';

   for(var i = 0; i < hashes.length; i++)
   {

      hash_tmp = hashes[i].split('=');

      if(hash_tmp[0] != "" && hash_tmp[0] != hashName)
      {
         newHash += hash_tmp[0]+"="+hash_tmp[1]+"&";
      }
   }




   newHash = newHash.replace(/\&$/,"");

   if(newHash == "#")
      newHash = "";
   location.href = newHash;
}
function addHash(hashName,value)
{
   var hash_tmp;
   var hashes = window.location.hash.replace("/","&").slice(1).split(/&(?=\w+=)/);
   var exsist = false;

   var newHash = '#';
   if(hashes == "")
   {
      newHash += hashName+(value != undefined ? "="+value : "");
   }
   else
   {
      for(var i = 0; i < hashes.length; i++)
      {

         hash_tmp = hashes[i].split('=');

         if(hash_tmp[0] != "")
         {
            if(hash_tmp[0] == hashName)
            {
               hash_tmp[1] = value;
               exsist = true;
            }

            newHash += hash_tmp[0]+(hash_tmp[1] != undefined ? "="+hash_tmp[1] : "")+"&";
         }
      }

      if(!exsist)
      {
         newHash += hashName+(value != undefined ? "="+value : "");
      }
   }

   newHash = newHash.replace(/\&$/,"");

   location.href = newHash;

}

var _AJAX = new function()
{

   this.targetHTML = function(res){
      for(var key in res)
      {
         if(res.hasOwnProperty(key) && key.match(/Target_/))
         {
            $("#"+key.replace(/Target_/,"")).html(res[key]);
         }
      }

   };
}
var refreshPage = new function()
{
   this.FormGroup = new FormData();
   var AjaxURL = __AjaxURL__;
   var Target = '#Main';
   var Menu = 'refreshPage';
   this.Callback = function(){

   };

   var setTARGET = function(newTarget){
      Target = newTarget;
   };

   this.setURL = function(URL){
      AjaxURL = URL;
   };

   this.setMenu = function(NewMenu){
      Menu = NewMenu;
   };

   this.Submit = function(){
      var self = this;
      self.FormGroup.append('menu',Menu);

      for (var k in getHash())
      {
         if (Target.hasOwnProperty(k)) {
            self.FormGroup.append(getHash()[k],getHash()[getHash()[k]]);
         }
      }

      $.ajax({
         type: "POST",
         url: AjaxURL+"?ajaxProcess",
         processData: false,
         contentType: false,
         data: self.FormGroup,
         success: function(d){
            var res = $.parseJSON(d);
            if(res.ack == 'success')
            {

               for(var key in res)
               {
                  if(res.hasOwnProperty(key) && key.match(/Target_/))
                  {
                     $("#"+key.replace(/Target_/,"")).html(res[key]);
                  }

               }

               if(res.target != undefined)
                  Target = res.target;

               if(res.html != undefined)
               {
                  $(Target).html(res.html);
               }

               initDom();
            }
            else if(res.error_msg != undefined && res.error_msg != "")
               showSideMSGBox(res.error_msg,'msgBox_One_1');

            if(getHash()['ScrollTo'] != undefined && getHash()['ScrollTo'] != "")
               $.scrollTo("#"+getHash()['ScrollTo'],800);

            self.Callback(res);

         }
      });
   };

};



function addMultipleHash(HashToPush,DeleteExist)
{


   var hash_tmp;
   var Exsist_hashes = window.location.hash.replace("/","&").slice(1).split(/&(?=\w+=)/);
   var Exists = false;
   var newHash = '#';
   var Hash_Json = {};

   if(!DeleteExist)
      for(Exsist_hashes_K in Exsist_hashes)
      {


         if(Exsist_hashes.hasOwnProperty(Exsist_hashes_K))
         {
            Hash_Tmp = Exsist_hashes[Exsist_hashes_K].toString().split("=");
            if(Hash_Tmp[0] != "")
            {

               Hash_Json[Hash_Tmp[0]] = Hash_Tmp[1];
            }
         }
      }

   for(var HashToPush_K in HashToPush)
   {
      if(HashToPush.hasOwnProperty(HashToPush_K))
      {
         Hash_Json[HashToPush_K] = HashToPush[HashToPush_K];
      }
   }

   for(var Hash_Json_K in Hash_Json)
   {
      if(Hash_Json.hasOwnProperty(Hash_Json_K))
      {

         newHash += Hash_Json_K+"="+Hash_Json[Hash_Json_K]+"&";
      }
   }
   newHash = newHash.replace(/\&$/,"");
   location.href = newHash;

}




function getCreditCardType(accountNumber)
{
   /*
   -1 : Error
   0 : Unknown Cart But it's valid
   1 : Visa
   2 : Master
   3 : Amex
   4: Diner's
   5: Discover
   6 : JCB
   */
   var result = -1;
   if (/^4[0-9]{12}(?:[0-9]{3})?$/.test(accountNumber))
      result = 1;
   else if (/^5[1-5][0-9]{14}$/.test(accountNumber))
      result = 2;
   else if (/^3[47][0-9]{13}$/.test(accountNumber))
      result = 3;
   else if (/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/.test(accountNumber))
      result = 4;
   else if (/^6(?:011|5[0-9]{2})[0-9]{12}$/.test(accountNumber))
      result = 5;
   else if (/^(?:2131|1800|35\d{3})\d{11}$/.test(accountNumber))
      result = 6;
   else if (/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/.test(accountNumber))
      result = 0;

   return result;

}

(function($) {
   $.fn.flowtype = function(options) {
      /* Establish default settings/variables
       ====================================*/
      var settings = $.extend({
      maximum : 9999,
      minimum : 1,
      maxFont : 9999,
      minFont : 1,
      fontRatio : 35
      }, options),
      /* Do the magic math*/
      changes = function(el) {
      var $el = $(el),
      elw = $el.width(),
      width = elw > settings.maximum ? settings.maximum : elw < settings.minimum ? settings.minimum : elw,
      fontBase = width / settings.fontRatio,
      fontSize = fontBase > settings.maxFont ? settings.maxFont : fontBase < settings.minFont ? settings.minFont : fontBase;
      $el.css('font-size', fontSize + 'px');
      };
      /* Make the magic visible*/
      /* ======================*/
      return this.each(function() {
      /* Context for resize callback*/
      var that = this;
      /* Make changes upon resize*/
      $(window).resize(function(){changes(that);});
      /* Set changes on load*/
      changes(this);
      });
   };
}(jQuery));
