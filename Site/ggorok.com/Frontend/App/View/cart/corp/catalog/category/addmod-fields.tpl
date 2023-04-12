<style tyle="css/text">
	#PG_Menu{float:right;}
		
	.GC_Editor{border:1px solid gray;box-sizing:border-box;}
	.GC_Editor div{float:none;}
	.GC_Editor *{font-size:12px;}
	.GC_Editor {
		float:none;
		width:100%;
		height:400px;
		border-radius:10px;
		overflow:hidden;
	}
	#PG_Contents{width:100%;margin-top:10px;}
	
	.CT_Line_One{width:100%;margin-top:5px;margin-bottom:10px;}
	.CT_Line_One .CT_T{width:20%;text-align:right;line-height:30px;}
	.CT_Line_One .CT_T span{margin-right:15px;}
	.CT_Line_One .CT_T i{color:red;margin-right:3px;}
	.CT_Line_One .CT_I{width:80%;}
	.CT_Line_One .CT_I input[type=text],
	.CT_Line_One .CT_I textarea{box-sizing:border-box;width:100%;border:1px solid gray;padding:0;margin:0;border-radius:5px;padding:5px;}
	.CT_Line_One .CT_I input{height:30px;line-height:30px;}
	.CT_Line_One .CT_I textarea{height:150px;}
	
	.TP_Image_One{width:100px;height:130px;border:1px solid #dcdce1;background-color:white;margin-right:20px;border-radius:5px;margin-bottom:10px;position:relative;}
	.TP_Image_One .ItemImage_Selected{background-color:#ffa62e!important;}
	.TP_Image_One .TP_Img_Preview{width:90px;height:80px;line-height:80px;background-color:#dadae1;color:#616165;margin-left:5px;margin-top:5px;text-align:center;cursor:pointer;color:white;border-radius:5px;}
	.TP_Image_One .TP_Img_Preview img{width:100%;height:100%;}
	.TP_Image_One .TP_Img_Default_Btn{width:90px;height:35px;margin-left:5px;margin-top:5px;background-color:#bdbdcd;color:white;text-align:center;cursor:pointer;line-height:35px;border-radius:5px;}
	.TP_Image_One .TP_ImgDefault_Selected{background-color:#309df1;}
	.TP_Image_One .TP_Img_Inp{display:none;}
	.TP_Image_One .deleteImg_BTN{display:none;}
	.TP_Image_One .TP_IMG{width:100%;height:100%;}
	.TP_Img_Selected{background-color:#dfdfdf!important;border:1px dotted #bcbcbc;}
	
	.CatList_One{width:100%;background-color:#f7f7f7;line-height:30px;box-sizing:border-box;padding-left:35px;border-radius:5px;position:relative;margin-bottom:5px;margin-top:5px;}
	.CatList_One:hover{background-color:#e6e6e6;}
	
	.CatList_One .changeOrder{width:35px;height:100%;position:absolute;left:0;top:0;text-align:center;color:#d0cece;cursor:all-scroll;}
	.CatList_One .changeOrder:before{content:"\f047";}
	.CatList_One .changeOrder:hover{color:#656565;}
	.CatList_Selected{background-color:#b0d6f3!important;}
	.CatList_Selected .changeOrder{color:white;}
	
	#CT_Tab{width:100%;height:100%;}
	#CT_Tab #CT_Tab_Menu{width:100%;height:30px;line-height:30px;border-bottom:1px solid #e7e7e7;margin-bottom:20px;}
	#CT_Tab .CT_Tab_One{padding-left:10px;padding-right:10px;margin-right:8px;border-radius:7px 7px 0 0;cursor:pointer;}
	#CT_Tab .CT_Tab_One:hover{background-color:#f2f2f2;}
	#CT_Tab .CT_Tab_Selected{border-left:1px solid #e7e7e7;border-top:1px solid #e7e7e7;border-right:1px solid #e7e7e7;background-color:white!important;}
	#CT_Tab .CT_Tab_Content_One{width:100%;display:none;}
	#GenerateSEOUrl_Btn{color:#309df1;text-decoration:normal;font-size:0.8em;text-decoration:underline;cursor:pointer;}
	.CatList_Block{width:100%;min-height:5px;}
	.error{background-color:#ffdbdb;}
	.CatList_Placeholder{margin-left:20px;width:100%;background-color:#f7f7f7;line-height:30px;height:30px;box-sizing:border-box;padding-left:35px;border-radius:5px;position:relative;margin-bottom:5px;margin-top:5px;background-color:#ffeda6;}
	.CatList_Group{width:100%;padding-left:20px;box-sizing:border-box;border-left:1px dotted #c5c5c5;}
	.CatList_Group .fa-folder-open-o{margin-right:5px;}
	
	.foldMenu{width:35px;height:100%;line-height:30px;position:absolute;right:0;top:0;text-align:center;color:gray;cursor:pointer;}
</style>
<script type="text/javascript" src="/Core/JS/ACE/ace.js"></script>
<script type="text/javascript" src="/Core/JS/sparkingurl.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		initEditor();
		$(document).on(touchOrClick,"#GenerateSEOUrl_Btn",function(){
			if($("#Cat_Name_CatINP").val() != "")
				$("#Cat_SEO_URL_CatINP").val(getSlug($("#Cat_Name_CatINP").val()));
			else
				showSideMSGBox("Category name is required to generate URL.",'msgBox_One_2');
		});
		$(document).on(touchOrClick,".TP_Img_Preview",function(){
			if($("img",this).length > 0)
			{
				/*Zoom in the image*/
				if($(this).parents(".TP_Image_One").hasClass("TP_Img_Selected"))
				{
					$(".TP_Image_One").removeClass("TP_Img_Selected");
					$(".deleteImg_BTN").fadeOut(500);
					$(".TP_Image_One .deleteImg_BTN").fadeOut(500);
				}
				else
				{
					$(".TP_Image_One").removeClass("TP_Img_Selected");
					$(this).parents(".TP_Image_One").addClass("TP_Img_Selected");
					$(".TP_Image_One .deleteImg_BTN").fadeOut(500);
					$(this).parents(".TP_Image_One").find(".deleteImg_BTN").fadeIn(500);
				}
				
			}
			else
			{
				$(this).parents(".TP_Image_One").find(".TP_Img_Inp").click();
			}
		});
		$(document).on(touchOrClick,".deleteImg_BTN",function(){
			var obj = $(this).parents(".TP_Img_Selected");
			
			/*Check if this image is selected*/
			if(obj.length > 0 )
			{
				timconfirm('<i class="fa fa-trash"></i> Delete','Are you sure?',function(){
					obj.fadeOut(500,function(){
						$(this).remove();
					});
				});
			}
		});
		
		$(document).on("change",".TP_Img_Inp",function(){
			
			
			if(this.files && this.files[0])
			{
				var obj = $(this);
				var reader = new FileReader();
	
				reader.onload = function (e) {
					obj.parents(".TP_Image_One").find(".TP_Img_Preview").html('<img class="TP_IMG" src="'+e.target.result+'" />');
					
				};
				reader.readAsDataURL(this.files[0]);
				
				$.ajax({
					type: "POST",
					url: "<?php echo __AdminPath__;?>catalog/category/?ajaxProcess",
					data: "menu=Images_Html",
					success: function(d){
						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{
							$("#TP_DescImage_Block").append(res.html);
							initDom();
						}
						else if(res.error_msg != undefined && res.error_msg != "")
							showSideMSGBox(res.error_msg,'msgBox_One_2');
					}
				});
				
				
			}
		});
		
	
		
		$(document).on("keyup","#Cat_SEO_URL_CatINP",function(){
			
			checkURLExist();
		});
		$(document).on(touchOrClick,".CT_Tab_One",function(){
			var tabID = $(this).data("tabid");
			
			if($(".CT_Tab_Content_One[data-tabID="+tabID+"]").css("display") != "block")
			{
				$(".CT_Tab_One").removeClass("CT_Tab_Selected");
				$(this).addClass("CT_Tab_Selected");
				$(".CT_Tab_Content_One").hide();
				$(".CT_Tab_Content_One[data-tabID="+tabID+"]").show();
			}
		});
		
		$(document).on(touchOrClick,"#Save_BTN",function(){
			
			var Argv = new FormData();
			var Go = true;
			var Err_Msg = "<i class='fa fa-warning'></i> <b>Error</b> : Please fill out all fields have * mark.<br /><br />";
			
			if($("#Cat_Name_CatINP").val() != "" && $("#Cat_SEO_URL_CatINP").val() == "")
				$("#Cat_SEO_URL_CatINP").val(getSlug($("#Cat_Name_CatINP").val()));
				
			$("#Cat_SEO_URL_CatINP").val(getSlug($("#Cat_SEO_URL_CatINP").val()));
			/* GC Editor :: */
			$("#Cat_Desc_Top_CatINP").val(GC_Editor['Cat_Desc_Top'].getValue());
			$("#Cat_Desc_Bottom_CatINP").val(GC_Editor['Cat_Desc_Bottom'].getValue());
			/* GC Editor ;; */
			
			$(".Ajax_INP").each(function(){
				if($(this).hasClass("must") && $(this).val() == "")
				{
					Go = false;
					Err_Msg += "- "+$(this).data("name")+"<br />";
				}
				
				if($(this).prop("type") == "checkbox")
					Argv.append($(this).attr("id"),($(this).is(":checked") ? 1:0));
				else
					Argv.append($(this).attr("id"),$(this).val());
					
			});
			
			if(_Get['cID'] != "undefined")
				Argv.append("Cat_ID_CatINP",_Get['cID']);
				
			if(Go)
			{
				timconfirm("Save","Do you want to save?",function(){
					
					Argv.append('menu','saveCategory');
					
					/* Image Up : */
					var imgindex = 0;
					$('.TP_Image_One').each(function(){
						$(this).data("imgindex",imgindex++);
					});
					
					
					$('.TP_Image_One[data-descimgid=""]').each(function(){
						if($(this).find(".TP_Img_Inp").val() != "")
						{
							var File = $(this).find(".TP_Img_Inp")[0];
							File = File.files[0];
							
							Argv.append("Img_"+$(this).data("imgindex"),File);
						}
					});
					
					
					var ImgUploaded = [];
					$('.TP_Image_One[data-descimgid != ""]').each(function(){
						ImgUploaded.push($(this).data('descimgid'));
						
					});
					Argv.append("ImgUploaded",JSON.stringify(ImgUploaded));
					
					$("#Save_BTN").hide();
					$.ajax({
						type: "POST",
						url: "<?php echo __AdminPath__;?>catalog/category/?ajaxProcess",
						data: Argv,
						processData: false,
						contentType: false,
						xhr: function() {
							myXhr = $.ajaxSettings.xhr();
							return myXhr;
						},
						success: function(d){
							$("#Save_BTN").show();
							var res = $.parseJSON(d);
							if(res.ack == 'success')
							{
								showSideMSGBox('<i class="fa fa-save"></i> Saved Successfully.','msgBox_One_1');
								
								if(res.newCatID != undefined)
								{
									window.location = "<?php echo __AdminPath__;?>catalog/category/edit?cID="+res.newCatID;
								}
								else
									location.reload();
							}
							else if(res.error_msg != undefined && res.error_msg != "")
								showSideMSGBox(res.error_msg,'msgBox_One_1');
						}
						
						
					});
				
					
				});
			}
			else
				showSideMSGBox(Err_Msg,"msgBox_One_2");
			
		});
	});
	var GC_Editor = {};
	function initEditor()
	{
		if($("#GC_Editor_Cat_Desc_Top").length > 0)
		{
			GC_Editor['Cat_Desc_Top'] = ace.edit("GC_Editor_Cat_Desc_Top");
			GC_Editor['Cat_Desc_Top'].setOption("showPrintMargin", false);
			GC_Editor['Cat_Desc_Top'].setTheme("ace/theme/crimson_editor");
			GC_Editor['Cat_Desc_Top'].getSession().setMode("ace/mode/html");
			GC_Editor['Cat_Desc_Top'].getSession().setUseSoftTabs(false);
			GC_Editor['Cat_Desc_Top'].getSession().setValue($("#Cat_Desc_Top_CatINP").val());
		}
		if($("#GC_Editor_Cat_Desc_Bottom").length > 0)
		{
			GC_Editor['Cat_Desc_Bottom'] = ace.edit("GC_Editor_Cat_Desc_Bottom");
			GC_Editor['Cat_Desc_Bottom'].setOption("showPrintMargin", false);
			GC_Editor['Cat_Desc_Bottom'].setTheme("ace/theme/crimson_editor");
			GC_Editor['Cat_Desc_Bottom'].getSession().setMode("ace/mode/html");
			GC_Editor['Cat_Desc_Bottom'].getSession().setUseSoftTabs(false);
			GC_Editor['Cat_Desc_Bottom'].getSession().setValue($("#Cat_Desc_Bottom_CatINP").val());
		}
		
	}
	function checkURLExist()
	{
		
		if($("#Cat_SEO_URL_CatINP").val() != "")
		{
			var Argv = "";
			<?php echo ($Cat_ID != "" ? 'Argv += "&cID='.$Cat_ID.'";':'');?>
			Argv += "&URL="+encodeURIComponent($("#Cat_SEO_URL_CatINP").val());
			$.ajax({
				type: "POST",
				url: "<?php echo __AdminPath__;?>catalog/category/?ajaxProcess",
				data: "menu=checkURLExist"+Argv,
				success: function(d){
					var res = $.parseJSON(d);
					if(res.Dup == 1)
					{
						$("#Cat_SEO_URL_CatINP").addClass("error");
					}
					else
						$("#Cat_SEO_URL_CatINP").removeClass("error");
				}
			});
		}
	}
</script>
<link href="<?php echo __DocumentRoot__;?>Template/CSS/Admin.css" rel="stylesheet" type="text/css" />
<div id="PG_Menu">
	<a href="<?php echo __AdminPath__;?>catalog/category/" class="button button_white" data-tooltip="Back"><i class="fa fa-mail-reply"></i></a>
	<div id="Refresh_BTN" class="button button_gray" data-tooltip="Refresh"><i class="fa fa-rotate-left"></i></div>
	
	<div id="Save_BTN" class="button button_blue" data-tooltip="Save"><i class="fa fa-save"></i></div>
</div>
<div id="PG_Contents">
	<div id="CT_Tab">
		<div id="CT_Tab_Menu">
			<div class="CT_Tab_One noSelect CT_Tab_Selected" data-tabid="1">General</div>
			<div class="CT_Tab_One noSelect" data-tabid="2">SEO</div>
		</div>
		
		<div class="CT_Tab_Content_One" data-tabid="1" style="display:block;">
			
			<div class="CT_Line_One">
				<div class="CT_T"><span>List Subcategory's Products?</span></div>
				<div class="CT_I">
					<input type="checkbox" id="Cat_DisplaySubCatPrd_CatINP" class="Ajax_INP"<? echo ($Cat_DisplaySubCatPrd ? ' checked="checked"' : "");?> />
				</div>
			</div>
			
			<div class="CT_Line_One">
				<div class="CT_T"><span>Category Image</span></div>
				<div class="CT_I" id="TP_CategoryImage_Block">
					<?php echo $Cat_DoorImage_HTML;?>
				</div>
			</div>
			
			<div class="CT_Line_One">
				<div class="CT_T"><i>*</i><span>Category Name</span></div>
				<div class="CT_I">
					<input type="text" id="Cat_Name_CatINP" data-name="Category Name" class="Ajax_INP must" value="<?php echo $Cat_Name;?>" />
				</div>
			</div>
			
			<div class="CT_Line_One">
				<div class="CT_T"><i>*</i><span>SEO Friendly URL (<b id="GenerateSEOUrl_Btn">Generate</b>)</span></div>
				<div class="CT_I">
					<input type="text" id="Cat_SEO_URL_CatINP" placeholder="Allowed alphabetical characters and numbers. No blank space allowed." data-name="SEO Friendly URL" class="Ajax_INP must" value="<?php echo $Cat_SEO_URL;?>" />
				</div>
			</div>
			
			
			<div class="CT_Line_One">
				<div class="CT_T"><span>Description Images</span></div>
				<div class="CT_I" id="TP_DescImage_Block">
					<?php echo $Cat_Image_HTML;?>
				</div>
			</div>
			
			<div class="CT_Line_One">
				<div class="CT_T"><span>Description Above List</span></div>
				<div class="CT_I">
					<textarea id="Cat_Desc_Top_CatINP" class="Ajax_INP hide"><?php echo $Cat_Desc_Top;?></textarea>
					<div id="GC_Editor_Cat_Desc_Top" class="GC_Editor"></div>
					
				</div>
			</div>
			
			<div class="CT_Line_One">
				<div class="CT_T"><span>Description Below List</span></div>
				<div class="CT_I">
				
					<textarea id="Cat_Desc_Bottom_CatINP" class="Ajax_INP hide"><?php echo $Cat_Desc_Bottom;?></textarea>
					<div id="GC_Editor_Cat_Desc_Bottom" class="GC_Editor"></div>
				</div>
			</div>
			
		</div>
		<div class="CT_Tab_Content_One" data-tabid="2">
			<div class="CT_Line_One">
				<div class="CT_T"><span>Meta Title</span></div>
				<div class="CT_I">
					<input type="text" id="Cat_Meta_Title_CatINP" class="Ajax_INP" value="<?php echo $Cat_Meta_Title;?>" />
				</div>
			</div>
			
			<div class="CT_Line_One">
				<div class="CT_T"><span>Meta Keywords</span></div>
				<div class="CT_I">
					<input type="text" id="Cat_Meta_Key_CatINP" class="Ajax_INP" value="<?php echo $Cat_Meta_Key;?>" />
				</div>
			</div>
			
			<div class="CT_Line_One">
				<div class="CT_T"><span>Meta Description</span></div>
				<div class="CT_I">
					<textarea id="Cat_Meta_Desc_CatINP" class="Ajax_INP"><?php echo $Cat_Meta_Desc;?></textarea>
				</div>
			</div>
		</div>
	</div>
</div>