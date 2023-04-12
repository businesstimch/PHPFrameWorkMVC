<!DOCTYPE html>
<html>
<head>
	
	<?php //<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />?>
	<title><?php echo $title;?></title>
	<meta name="Keywords" content="<?php echo $metaK;?>" />
	<meta name="Description" content="<?php echo $metaD;?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/jquery.min.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/jquery.migration.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/jquery-ui.min.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/ui-localization/datepicker-ko.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/jquery.touchpunch.min.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/jquery.scrollTo-min.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/jquery.popupoverlay.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/mediaelement/mediaelement-and-player.min.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/jquery.ggorok.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/jquery.hoverIntent.minified.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/box/jquery.fancybox.pack.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="/Core/JS/General.js?<?php echo __JS_Ver__;?>"></script>
	<script type="text/javascript" src="/Template/JS/_Front.js?<?php echo __JS_Ver__;?>"></script>
	
	<link href="/Core/CSS/global.css" rel="stylesheet" type="text/css" />
	<link href="/Core/CSS/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="/Template/CSS/Front.css" rel="stylesheet" type="text/css" />
	<link href="/Core/JS/ui-themes/hotsneaks/jquery-ui.min.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		.outline{max-width:1025px;width:1025px;float:none;margin-left:auto;margin-right:auto;}
		#TB_Block_Yellow{background-color:#ffc600;}
		#Logo{width:145px;height:153px;background-image:url('/Template/Img/Logo.png');}
		#TBBY_Wrap{position:relative;}
		#Top_SummaryBlock{position:absolute;top:0;right:17px;width:861px;height:45px;background-image:url('/Template/Img/TopCart-Block.png');}
		#Flag_Block{margin-left:484px;margin-top:5px;}
		#Flag_Block .Flag_One{background-image:url('/Template/Img/Flags.png');width:49px;height:33px;margin-right:6px;}
		#Flag_Block #Flag_SPN{background-position:-49px 0;}
		#Flag_Block #Flag_KOR{background-position:-98px 0;}
		#Top_ContactInfo{background-image:url('/Template/Img/Top-ContactInfo.png');width:863px;height:34px;margin-top:62px;}
		
		#TopCategory_Block{background-color:#666563;height:43px;}
		#TopCategory_Block .TopMenu_One{padding-left:28px;padding-right:28px;height:100%;line-height:43px;font-size:15px;cursor:pointer;display:block;float:left;}
		#TopCategory_Block .TM_White{color:white;}
		#TopCategory_Block .TM_Yellow{color:#ffcc00;}
		#TopCategory_Block .TM_Blue{color:#88dcff;}
		
		#TopLineBanner_Block{height:42px;text-align:center;line-height:42px;font-size:15px;}
		#TopLineBanner_Block .TLB_Sky{background-color:#88dcff;color:#006893;}
		#TopLineBanner_Block .TLBB_One{height:100%;float:left;}
		#TopLineBanner_Block .TLBB_One span{vertical-align:middle;}
		#TopLineBanner_Block #TLBB_1 img{vertical-align: middle;}
		
		
		#TopSearch_Block{max-width:864px;width:100%;height:50px;}
		#TopSearch_Block .TSB_Side{background-image:url('/Template/Img/SearchBlock_BG.png');}
		#TopSearch_Block .TSB_Left{height:50px;width:11px;}
		
		#TopSearch_Block .TSB_Middle{width:100%;max-width:790px;background-color:#ffe88a;height:100%;}
		#TopSearch_Block #SearchKeyword_INP{width:100%;height:38px;padding:0;margin:0;border:0;margin-top:6px;font-size:16px;color:#715f2b;text-align:center;}
		#TopSearch_Block .TSB_RightBTN{height:50px;width:63px;background-position:-11px 0;}
		#TopSearch_Block #TSB_Suggestion{display:none;max-width:864px;width:100%;background-color:white;min-height:40px;border-radius:10px;top:54px;position:absolute;}
		
	</style>
	<script type="text/javascript">
		$(document).ready(function(){
			Search.init();
		});
		
		var Search = new function(){
			var currentKeyword;
			var SearchINP = $('#SearchKeyword_INP');
			
			
			this.init = function(){
				currentKeyword = SearchINP.val();
				setCurrentKeyword();
				KeyEventSearch();
				
			};
			
			var KeyEventSearch = function(){
				
				$(document).on('keyup','#SearchKeyword_INP',function(e){
					if(SearchINP.val().trim() == "")
					{
						console.log(SearchINP.val());
						hideSearchBox();
					}
					else
					{
						showSearchBox();
						if(setCurrentKeyword != SearchINP.val())
						{
							
						}
					}
					
					setCurrentKeyword();
				});
			};
			
			var showSearchBox = function(){
				$('#TSB_Suggestion').show();
			};
			var hideSearchBox = function(){
				$('#TSB_Suggestion').hide();
			}
			var searchSuggestion = function(){
				
			};
			
			var setCurrentKeyword = function(){
				SearchINP = $("#SearchKeyword_INP");
			};
			
		};
	</script>
</head>
<body>
	<div id="msgBox"></div>
	
	
	<header>
		
		<div id="TB_Block_Yellow" class="w100">
			<div id="TBBY_Wrap" class="outline">
				<a href="/" id="Logo" class="block"></a>
				<div id="Top_SummaryBlock">
					<div id="Flag_Block">
						<div class="Flag_One" id="Flag_US"></div>
						<div class="Flag_One" id="Flag_SPN"></div>
						<div class="Flag_One" id="Flag_KOR"></div>
					</div>
				</div>
				<div id="Top_ContactInfo"></div>
				<div id="TopSearch_Block" class="relative">
					<div class="TSB_Side TSB_Left"></div>
					<div class="TSB_Middle">
						<input type="text" id="SearchKeyword_INP" placeholder="SEARCH ITEM ( SKU#, NAME, DESCRIPTION, PRICE )" />
					</div>
					<div class="TSB_Side TSB_RightBTN"></div>
					<div id="TSB_Suggestion">
						<div></div>
					</div>
				</div>
			</div>
		</div>
		
		<div id="TopCategory_Block" class="w100">
			<div id="TCB_Wrap" class="outline">
				<div class="TopMenu_One TM_White">CATEGORY</div>
				<a class="TopMenu_One TM_White">ABOUT US</a>
				<a class="TopMenu_One TM_Yellow">SPECIAL DEALS</a>
				<a class="TopMenu_One TM_White">MY ACCOUNT</a>
				<a class="TopMenu_One TM_Blue">JOIN FRANCHISE</a>
				<a class="TopMenu_One TM_White">CHECKOUT</a>
				<a href="/login" class="TopMenu_One TM_White">LOGIN</a>
			</div>
		</div>
		<div id="TopLineBanner_Block" class="w100">
			<div data-adindex="1" id="TLBB_1" class="TLBB_One w100 TLB_Sky">
				<img src="/Template/Img/GiftIcon.png"> &nbsp;<span>NASHVILLE STORE / 25% CASHBACK EVENT   |   All Cusotmers Who Visit Store in Nashville, TN &nbsp; <u>Click For Detail</u></span>
			</div>
		</div>
		
	</header>
	