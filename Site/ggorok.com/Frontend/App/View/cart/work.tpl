<!DOCTYPE html>
<html>
<head>
	
	<!--meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />-->
	
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
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on(touchOrClick,".Nav_Multi",function(){
				$(this).find(".Nav_Sub_Block").slideToggle(300);
			});
		});
	</script>
	<style type="text/css">
		#WorkTable{width:800px;}
		#WorkTable .H{height:30px;line-height:30px;background-color:#919191;color:white;}
		#WorkTable .oneDate{width:100%;line-height:30px;height:30px;background-color:#ededed;border-bottom:1px solid white;position:relative;}
		#WorkTable .subDate{width:100px;position:absolute;right:-100px;top:0;}
		#WorkTable .From{width:150px;text-align:center;}
		#WorkTable .To{width:150px;text-align:center;}
		#WorkTable .Hours{width:150px;text-align:center;}
		#WorkTable .Memo{width:350px;text-align:center;}
		#WorkTable .noWork{background-color:#cecece;color:#9a9a9a;}
		#WorkTable .Saturday{background-color:#ffe1e1;color:black;}
		#WorkTable .Sunday{background-color:#ffcfcf;color:black;}
		#WorkTable .Paid{width:100%;background-color:#e43737;text-align:center;color:White;}
		#WorkTable .totalHours{text-align:center;background-color:black;color:white;}
		
	</style>
</head>
<body>
	<div id="msgBox"></div>
	<div id="Main"><?php echo $MAIN_HTML;?></div>
</body>
</html>