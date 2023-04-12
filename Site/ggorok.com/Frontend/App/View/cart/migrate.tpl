<!DOCTYPE html>
<html>
<head>
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
	
	<script type="text/javascript">
		$(document).ready(function(){
			
			migrate.Start();
			
			
			
			/* Do this always after all */
			/* migrate.Image();*/
			
			
		});
		
		var migrate = new function(){
			var MigList = [
				
				/*
				'startCategory',
				'startProduct',
				'startProductToCategory',
				'startCategory',
				'resetShowCaseImage'
				*/
				
				
			];
			
			var DoneList = [];
			
			this.resetShowCaseImage = function(){
				$.ajax({
					type: "POST",
					url: "?ajaxProcess",
					data: "menu=resetShowCaseImage",
					success: function(d){
						
						$("#loading").fadeOut(1000);
						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{
							$('#log').append(res.msg);
						}
						
					}
				});
			};
			this.Image = function(){
				
				$("#loading").fadeIn(1000);
				$.ajax({
					type: "POST",
					url: "?ajaxProcess",
					data: "menu=getImageList",
					success: function(d){
						
						$("#loading").fadeOut(1000);
						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{
							ImageProcess_Done = 0;
							$('#log').append(res.msg);
							$('#log').append('<div id="PrdShowcaseImg" class="ProgressBar"><div class="PB_Percentage"></div></div>');
							if(res.Img.length > 0)
							{
								
								ImageProcess(res.Img,0,res.Img.length);
								
							}
						}
						else if(typeof res.error_msg != "undefined")
						{
							showSideMSGBox(res.error_msg,'msgBox_One_2');
						}
						
					}
				});
			};
			
			var ProgressBar = function(Obj, Total, Current){
				$("#CurrentImageInx").text(Current+"/");
				Obj.find('.PB_Percentage').css('width',(((100 / Total) * Current).toFixed(0))+'%');
			};
			
			var ImageProcess = function(Data,Index,Length){
				
				var ToArr = 10;
				if(Length > (Index + 1))
				{
					var FromArr;
					
					if(Index == 0)
						FromArr = 0;
					else
					{
						FromArr = (Index * ToArr);
						ToArr = (Index * ToArr) + ToArr;
					}
					
					
					$.ajax({
						type: "POST",
						url: "?ajaxProcess",
						data: "menu=SampleImage&Type=PrdShowcase&Data="+encodeURIComponent(JSON.stringify(Data.slice(FromArr, ToArr))),
						success: function(d){
							var res = $.parseJSON(d);
							if(res.ack == 'success')
							{
								
								ProgressBar($('#PrdShowcaseImg'),Length, ToArr);
								ImageProcess(Data,(Index + 1),Length);
							}
						}
					});
					
				}
				
			};
			this.Start = function(){
				if(MigList.length > 0)
					Send(MigList[0],0);
			};
			
			var Send = function(menu,Index){
				$("#loading").fadeIn(1000);
				$.ajax({
					type: "POST",
					url: "?ajaxProcess",
					data: "menu="+menu,
					success: function(d){
						DoneList[Index] = menu;
						
						$("#loading").fadeOut(1000);
						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{
							$('#log').append(res.msg);
						}
						else if(typeof res.error_msg != "undefined")
						{
							showSideMSGBox(res.error_msg,'msgBox_One_2');
						}
						
						if(MigList.length > DoneList.length)
							Send(MigList[(Index + 1)],(Index + 1));
					}
				});
			};
			
		};
	</script>
	<style type="text/css">
		#log{margin:20px;background-color:gray;border-radius:10px;width:400px;height:400px;padding:20px;color:white;line-height:25px;}
		#loading{display:none;width:100%;position:fixed;text-align:center;padding-top:10px;}
		.ProgressBar{width:100%;height:40px;background-color:#6d6d6d;margin-top:10px;margin-bottom:10px;}
		.PB_Percentage{width:0;height:40px;background-color:#66d6f2;}
		#ProgressBar{color:yellow;}
	</style>
</head>
<body>
	<div id="msgBox"></div>

<div id="log"></div>
<div id="loading">Migration is in Progress...</div>