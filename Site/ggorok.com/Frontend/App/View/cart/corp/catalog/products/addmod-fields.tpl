<script type="text/javascript" src="<?php echo __DocumentRoot__;?>Core/JS/sparkingurl.min.js"></script>
<script type="text/javascript" src="/Core/JS/ACE/ace.js"></script>
<link href="<?php echo __DocumentRoot__;?>Template/CSS/Admin.css" rel="stylesheet" type="text/css" />
<style text="css/text">
	#PG_Menu{float:right;}
	#PG_Contents{width:100%;margin-top:10px;padding-bottom:50px;}
	#Total_Found{padding-left:5px;margin-top:10px;clear:both;}
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
	
	.PD_Line_One{width:100%;margin-top:5px;margin-bottom:10px;}
	.PD_Line_One .PD_T{width:20%;text-align:right;line-height:30px;}
	.PD_Line_One .PD_T span{margin-right:15px;}
	.PD_Line_One .PD_T i{color:red;margin-right:3px;}
	.PD_Line_One .PD_I{width:80%;}
	.PD_Line_One .PD_I input[type=text],
	.PD_Line_One .PD_I textarea,
	.PD_Line_One .PD_I select{box-sizing:border-box;width:100%;border:1px solid gray;padding:0;margin:0;border-radius:5px;padding:5px;}
	.PD_Line_One .PD_I input{height:30px;line-height:30px;}
	.PD_Line_One .PD_I textarea{height:150px;}
	
	.TP_File_One{width:100px;height:130px;border:1px solid #dcdce1;background-color:white;margin-right:20px;border-radius:5px;margin-bottom:10px;position:relative;}
	.TP_File_One .ItemImage_Selected{background-color:#ffa62e!important;}
	.TP_File_One .TP_File_Preview{width:90px;height:80px;line-height:80px;background-color:#dadae1;color:#616165;margin-left:5px;margin-top:5px;text-align:center;cursor:pointer;color:white;border-radius:5px;}
	.TP_File_One .TP_File_Preview img{width:100%;height:100%;}
	.TP_File_One .TP_EmbedFile_Btn,
	.TP_File_One .TP_Img_Default_Btn{width:90px;height:35px;margin-left:5px;margin-top:5px;background-color:#bdbdcd;color:white;text-align:center;cursor:pointer;line-height:35px;border-radius:5px;}
	
	.TP_File_One .TP_ImgDefault_Selected{background-color:#309df1;}
	.TP_File_One .TP_File_Inp{display:none;}
	.TP_File_One .deleteImg_BTN{display:none;}
	.TP_File_One .TP_IMG{width:100%;height:100%;}
	.TP_File_One .PD_Img_Default_Btn{width:90px;height:35px;margin-left:5px;margin-top:5px;background-color:#bdbdcd;color:white;text-align:center;cursor:pointer;line-height:35px;border-radius:5px;}
	.TP_File_One .PD_ImgDefault_Selected{background-color:#309df1;}
	.TP_File_One .TP_File_Inp,
	.TP_File_One .TP_File_Inp{display:none;}
	.TP_File_Selected{background-color:#dfdfdf!important;border:1px dotted #bcbcbc;}
	
	.CatList_Selected{background-color:#b0d6f3!important;}
	
	
	#PD_Tab{width:100%;height:100%;}
	#PD_Tab #PD_Tab_Menu{width:100%;min-height:30px;line-height:30px;border-bottom:1px solid #e7e7e7;margin-bottom:20px;}
	#PD_Tab .PD_Tab_One{padding-left:10px;padding-right:10px;margin-right:8px;border-radius:7px 7px 0 0;cursor:pointer;border:1px solid white;}
	#PD_Tab .PD_Tab_One:hover{background-color:#f2f2f2;}
	#PD_Tab .PD_Tab_Selected{border-left:1px solid #e7e7e7;border-top:1px solid #e7e7e7;border-right:1px solid #e7e7e7;background-color:white!important;box-sizing:border-box;}
	#PD_Tab .PD_Tab_Content_One{width:100%;display:none;}
	#GenerateSEOUrl_Btn{color:#309df1;text-decoration:normal;font-size:0.8em;text-decoration:underline;cursor:pointer;}
	#Prd_Desc_Botton_PrdINP{height:300px;}
	
	#Option_Block{width:100%;}
	#Search_Block{width:300px;margin-left:10px;}
	#Search_Block input[type=text]{width:100%;height:32px;line-height:32px;margin:0;padding:0;padding-left:10px;padding-right:10px;box-sizing:border-box;border-radius:5px;}
	.CatList_Block{width:100%;}
	.CatList_Group{width:100%;padding-left:20px;box-sizing:border-box;}
	.CatList_One{width:100%;background-color:#f7f7f7;line-height:30px;box-sizing:border-box;padding-left:20px;border-radius:5px;margin-bottom:3px;position:relative;}
	.CatList_One:hover{background-color:#e6e6e6;}
	
	
	
	
	.PD_List_One{width:100%;height:40px;line-height:40px;margin-bottom:1px;background-color:#f8f8f8;}
	.PD_List_One .PD_List_Col{box-sizing:border-box;padding-left:10px;height:100%;border-right:1px solid white;}
	.PD_List_One .PD_List_Name{width:40%;}
	.PD_List_One .PD_List_Price{width:20%;}
	.PD_List_One .PD_List_Sku{width:20%;}
	.PD_List_One .PD_List_Qty{width:20%;}
	#Prd_Desc_Long_PrdINP{height:500px;}
	
	.PD_List_Header{background-color:#f2f2f2;margin-top:10px;border-radius:10px 10px 0 0;}
	.PD_List_Header .PD_List_Col{background:none!important;color:#545454;font-weight:bold;}
	.PD_List_Contents_Selected{background-color:#b0d6f3!important}
	.PD_List_Contents:hover{background-color:#8c8c8c;color:white;}
	
	.OPT_Top_Btn{margin-left:10px;line-height:28px;height:28px;margin-right:5px;border:1px solid #a9a9a9;padding-left:10px;padding-right:10px;border-radius:5px;cursor:pointer;color:#4d4d4d;background-color:white;}
	.OPT_Top_Btn:hover i{color:#309df1;}
	
	.OptTopMenu_Block{padding-bottom:20px;border-bottom:1px solid #e7e7e7;}
	.OptTopMenu_Block input[type="text"],
	.OptTopMenu_Block select
	{
		border: 1px solid gray;
		border-radius: 5px;
		box-sizing: border-box;
		margin: 0;
		padding: 5px;
		height: 30px;
		line-height: 30px;
	}
	.OptTopMenu_Block #CustomOptGrp_Type_ID{width:200px;margin-left:10px;}
	.OptTopMenu_Block #CustomOptGrp_Name{width:200px;margin-right:10px;}
	.OptTopMenu_Block #OptGrpTpl_Search{width:250px;margin-left:10px;}
	
	#CustomOptGrp_Type_ID{margin-right:10px;}
	
	#OptGrp_Main_Block{min-height:300px;}
	#OptGrp_Main_Block .OptGrp_One{width:100%;background-color:#f2f2f2;border-bottom:1px solid white;position:relative;}
	#OptGrp_Main_Block .OptGrpName_Inp{
		width:100%;
		box-sizing:border-box;
		background-color:#f6f6f6;
		margin: 0;
		border:0;
		padding:0 10px 0 10px;
		height: 40px;
		line-height: 40px;
	}
	#OptGrp_Main_Block .OptGrpName_Inp:focus{
		background-color:white;
		margin: 0!important;
		border:0!important;
		padding:0 5px 0 5px!important;
	}
	#OptGrp_Main_Block .OptGrp_One .OptGrp_Btns_L{position:absolute;left:0;top:0;}
	#OptGrp_Main_Block .OptGrp_One .OptGrp_Btns_R{position:absolute;right:0;top:0;}
	#OptGrp_Main_Block .OptGrp_One .OptGrp_Btn{height:40px;width:40px;line-height:40px;text-align:center;cursor:pointer;background-color:#f2f2f2;}
	#OptGrp_Main_Block .OptGrp_One .OptGrp_Btn:hover{background-color:#929294;color:white;}
	
	#OptGrp_Main_Block .OptGrpName{padding-left:40px;padding-right:40px;width:100%;box-sizing:border-box;cursor:pointer;height:40px;}
	#OptGrp_Main_Block .OptGrpName:hover{background-color:#e4e4e4;}
	#OptGrp_Main_Block .AddSubOpt_Btn{margin-left:40px!important;}
	#OptGrp_Main_Block .OptGrp_Selected{background-color:#309df1!important;color:white;}
	#OptGrp_Main_Block .OptGrpContents{width:100%;padding-left:39px;padding-right:10px;box-sizing:border-box;}
	#OptGrp_Main_Block .OptGrpContents_Container{display:none;width:100%;}
	#OptGrp_Main_Block .OptGrpContents_Container_Menu{width:100%;height:28px;padding-top:10px;padding-bottom:10px;}
	#OptGrp_Main_Block .BTN_PlusMinus_Selected{background-color:#63b4f3!important;color:white!important;}
	#OptGrp_Main_Block .Opt_Sub_One input[type="text"]{height:32px;}
	#OptGrp_Main_Block .Opt_Sub_One input[type="text"],
	#OptGrp_Main_Block .Opt_Sub_One textarea,
	#OptGrp_Main_Block .Opt_Sub_One select{
		border: 1px solid gray;
		border-radius: 5px;
		box-sizing: border-box;
		margin: 0;
		padding: 5px;
		width: 100%;
	}
	#OptGrp_Main_Block .Opt_Drop_1 {
		width: 50%;
	}
	#OptGrp_Main_Block .Opt_Drop_2 {
		box-sizing: border-box;
		padding-left: 10px;
		padding-right: 10px;
		width: 10%;
	}
	#OptGrp_Main_Block .Opt_Drop_3 {
		box-sizing: border-box;
		padding-right: 10px;
		width: 10%;
	}
	#OptGrp_Main_Block .Opt_Drop_4 {
		width: 20%;
	}
	#OptGrp_Main_Block .Opt_Drop_5 {
		width: 10%;
	}
	
	#OptGrp_Main_Block .BTN_PlusMinus
	{
		background-color: white;
		border: 1px solid gray;
		border-radius: 5px;
		color: #5e5e5e;
		cursor: pointer;
		height: 30px;
		line-height: 30px;
		text-align: center;
		width: 100%;
	}
	
	#OptGrp_Main_Block .Opt_Sub_One {
		background-color: #e6e6e6;
		border: 1px solid white;
		border-radius: 10px;
		box-sizing: border-box;
		margin-bottom: 5px;
		padding: 10px;
		width: 100%;
	}
	#OptGrp_Main_Block .OptGrpContents_Menu{width:100%;margin-top:10px;margin-bottom:10px;}
	.OptGrp_Row_One{width:100%;background-color:#f3f3f3;border-bottom:1px solid #dcdcdc;cursor:pointer;}
	.OptGrp_Row_Name{height:40px;line-height:40px;overflow:hidden;}
	
	.OptGrp_Txt{width:100%;height:100%;text-align:center;line-height:300px;}
	
	#OptGrpTpl_AutoComplete{display:none;min-width:400px;position:absolute;top:35px;left:10px;border-radius:5px;background-color:white;border:1px solid #e7e7e7;overflow:hidden;z-index:100;}
	#OptGrpTpl_AutoComplete .notFoundOptTemplate{color:gray;}
	#OptGrpTpl_AutoComplete .notFoundOptTemplate,
	#OptGrpTpl_AutoComplete .TplSrc_One{line-height:30px;width:100%;padding-left:5px;box-sizing:border-box;}
	#OptGrpTpl_AutoComplete .TplSrc_One:hover{background-color:#f4f4f4;}
	#OptGrpTpl_AutoComplete .OptGrpTplSrc_L{overflow:hidden;width:280px;height:30px;line-height:30px;}
	#OptGrpTpl_AutoComplete .OptGrpTplSrc_R{width:100px;float:right;margin-right:15px;font-size:0.8em;font-weight:bold;}
	#OptGrpTpl_AutoComplete .TplSrc_One_Select{background-color:#309df1!important;}
	#OptGrpTpl_AutoComplete .TplSrc_One_Select div{color:white;}
	.OptGrpMethod_Selected{background-color:#e6f4ff;}
	.Mandatory_Btn_Selected{background-color:#f55757;color:white;}
	.Mandatory_Btn_Selected:hover i{color:white;}
	
	#Pagination{width:100%;margin-top:10px;}
	#Pagination .Pagi_Btn{cursor:pointer;width:35px;height:35px;line-height:35px;text-align:center;font-size:1.5em;background-color:#f2f2f2;border-radius:5px;border:1px solid #dedede;margin-right:10px;}
	#Pagination .PagiDisabled{color:#d0d0d0;}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		initDom();
		initEditor();
		Option.init();
		
		$(document).on('keyup',"#Search_Product_Keyword",function(e){
			if(e.which == 13)
				SubmitSearch();
		});
		$(document).on(touchOrClick,"#Search_Product",function(){
			SubmitSearch();
		});
		$(document).on(touchOrClick,".PagiNext_Btn,.PagiPrev_Btn",function(){
			var PGtoGo;
			if(getHash()['p'] == undefined && $(this).hasClass('PagiNext_Btn'))
				PGtoGo = 2;
			else if(!isNumber(getHash()['p']) && $(this).hasClass('PagiNext_Btn'))
				PGtoGo = 2;
			else if(!$(this).hasClass('PagiDisabled'))
			{
				if($(this).hasClass('PagiNext_Btn'))
					PGtoGo = parseInt(getHash()['p']) + 1;
				else
					PGtoGo = parseInt(getHash()['p']) - 1;
			}
			if(PGtoGo != undefined)
			{
				addHash('p',PGtoGo);
			}
		});
	
		
		
		
		$(document).on(touchOrClick,".TplSrc_One",function(){
			var ID = $(this).data("tplid");
			$("#OptGrpTpl_Search").val(ID+":"+$(".OptGrpTplSrc_L",this).text());
		});
		
		
		
		
		$(document).on(touchOrClick,".PD_Img_Default_Btn",function(){
			var pImgID = $(this).parents(".TP_File_One").data("pimgid");
			if(pImgID != "" && getHash()["pID"] != undefined)
			{
				
				if(!$(this).hasClass("PD_ImgDefault_Selected"))
				{
					$(".PD_Img_Default_Btn").removeClass("PD_ImgDefault_Selected");
					$(this).addClass("PD_ImgDefault_Selected");
					
					
					if(getHash()['pID'] != undefined)
					{
						var Argv = "&pImgID=" + pImgID + "&pID=" + getHash()["pID"];
						$.ajax({
							type: "POST",
							url: "<?php echo $AjaxURL;?>",
							data: "menu=default_Image"+Argv,
							success: function(d){
								var res = $.parseJSON(d);
								if(res.ack == 'success')
								{
									showSideMSGBox("<i class='fa fa-bell-o'></i> Default image has been changed.",'msgBox_One_1');
									initDom();
								}
								else if(res.error_msg != undefined && res.error_msg != "")
									showSideMSGBox(res.error_msg,'msgBox_One_2');
							}
						});
						
					}
					
					
					
				}
			}
			else
				showSideMSGBox("<i class='fa fa-warning'></i> Please upload an image then pick one.",'msgBox_One_3');
		});

		$(document).on(touchOrClick,".TP_File_Preview",function(){
			if($("img",this).length > 0)
			{
				/*Zoom in the image*/
				if($(this).parents(".TP_File_One").hasClass("TP_File_Selected"))
				{
					$(".TP_File_One").removeClass("TP_File_Selected");
					$(".deleteImg_BTN").fadeOut(500);
					$(".TP_File_One .deleteImg_BTN").fadeOut(500);
				}
				else
				{
					$(".TP_File_One").removeClass("TP_File_Selected");
					$(this).parents(".TP_File_One").addClass("TP_File_Selected");
					$(".TP_File_One .deleteImg_BTN").fadeOut(500);
					$(this).parents(".TP_File_One").find(".deleteImg_BTN").fadeIn(500);
				}
				
			}
			else
			{
				$(this).parents(".TP_File_One").find(".TP_File_Inp").click();
			}
		});
		$(document).on(touchOrClick,".deleteImg_BTN",function(){
			var obj = $(this).parents(".TP_File_Selected");
			
			/*Check if this image is selected*/
			
			if(obj.length > 0 )
			{
				timconfirm('<i class="fa fa-trash"></i> Delete','Are you sure?',function(){
					obj.remove();
				});
				
			
			}
		});
		$(document).on("change",".TP_File_Inp",function(){
			
			var Target = "";
			var fileType = $(this).data('type');
			var Menu = "";
			if(fileType == 'PrdFile')
			{
				Target = "#TP_DescFile_Block";
				Menu = "DescFiles_Html";
			}
			else if(fileType == 'PrdShowcaseImg')
			{
				Target = "#PD_Image_Block";
				Menu = "Images_Html";
				
			}
				
			
			if(this.files && this.files[0])
			{
				var obj = $(this);
				var reader = new FileReader();

				reader.onload = function (e) {
					obj.parents(".TP_File_One").find(".TP_File_Preview").html('<img class="PD_IMG" src="'+e.target.result+'" />');
					
				};
				reader.readAsDataURL(this.files[0]);
				
				$.ajax({
					type: "POST",
					url: "<?php echo $AjaxURL;?>",
					data: "menu="+Menu,
					success: function(d){
						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{
							$(Target).append(res.html);
							initDom();
						}
						else if(res.error_msg != undefined && res.error_msg != "")
							showSideMSGBox(res.error_msg,'msgBox_One_2');
					}
				});
				
				
			}
		});
		
		$(document).on(touchOrClick,"#Add_Product",function(){
			var hashToAdd = {};
			hashToAdd["PG"] = "addProduct";
			addMultipleHash(hashToAdd,true);
		});
		
		$(document).on(touchOrClick,"#GenerateSEOUrl_Btn",function(){
			if($("#Prd_Name_PrdINP").val() != "")
				$("#Prd_SEO_URL_PrdINP").val(getSlug($("#Prd_Name_PrdINP").val()));
			else
				showSideMSGBox("Product name is required to generate URL.",'msgBox_One_2');
		});
		
		
		

		
		$(document).on("keyup","#Prd_SEO_URL_PrdINP",function(){
			
			checkURLExist();
		});
		$(document).on(touchOrClick,".PD_Tab_One",function(){
			var tabID = $(this).data("tabid");
			if($(".PD_Tab_Content_One[data-tabID="+tabID+"]").css("display") != "block")
			{
				$(".PD_Tab_One").removeClass("PD_Tab_Selected");
				$(this).addClass("PD_Tab_Selected");
				$(".PD_Tab_Content_One").hide();
				$(".PD_Tab_Content_One[data-tabID="+tabID+"]").show();
			}
		});
		$(document).on(touchOrClick,"#Delete_Product",function(){
			if($(".PD_List_Contents_Selected").length > 0)
				timconfirm('<i class="fa fa-trash"></i> Delete a Product','Are you sure?',function(){
					var pID = $(".PD_List_Contents_Selected").data("pid");
					
					$.ajax({
						type: "POST",
						url: "<?php echo $AjaxURL;?>",
						data: "menu=deleteProduct&pID="+pID,
						success: function(d){
							var res = $.parseJSON(d);
							if(res.ack == 'success')
							{
								showSideMSGBox('<i class="fa fa-trash"></i> Deleted Successfully.','msgBox_One_1');
								refreshPage();
							}
							else if(res.error_msg != undefined && res.error_msg != "")
								showSideMSGBox(res.error_msg,'msgBox_One_2');
						}
					});
					
				});
		});
		$(document).on(touchOrClick,"#Edit_Product",function(){
			if($(".PD_List_Contents_Selected").length > 0)
			{
				
				var hashToAdd = {};
				hashToAdd["PG"] = "editProduct";
				hashToAdd["pID"] = $(".PD_List_Contents_Selected").data("pid");
				addMultipleHash(hashToAdd,true);
			}
			else
				showSideMSGBox("Please select a category first.",'msgBox_One_1');
		});
		$(document).on(touchOrClick,".PD_List_Contents",function(){
			if($(this).hasClass("PD_List_Contents_Selected"))
			{
				$(".PD_List_Contents").removeClass("PD_List_Contents_Selected");
				$(".PdSelectedMenu").fadeOut(300);
			}
			else
			{
				
				$(".PD_List_Contents").removeClass("PD_List_Contents_Selected");
				$(this).addClass("PD_List_Contents_Selected");
				$(".PdSelectedMenu").fadeIn(300);
			}
		});
		$(document).on(touchOrClick,".CatList_One",function(){
			if($(this).hasClass("CatList_Selected"))
			{
				$("#Add_Product").data("tooltip","Add Product");
				$(this).removeClass("CatList_Selected");
				$(".CatSelectedMenu").fadeOut(300);
			}
			else
			{
				
				$(this).addClass("CatList_Selected");
				$("#Add_Product").data("tooltip","Add Product : Under '<span style='color:#f3c922;'>"+$(this).text()+"</span>' Product");
				$(".CatSelectedMenu").fadeIn(300);
			}
		});
		$(document).on(touchOrClick,"#Refresh_BTN",function(){
			timconfirm("Refresh","Are you sure?",function(){
				refreshPage();
			});
		});
		
		$(document).on(touchOrClick,"#Save_BTN",function(){
			
			var Argv = new FormData();
			var Go = true;
			var Err_Msg = "<i class='fa fa-warning'></i> <b>Error</b> : Please fill out all fields have * mark.<br /><br />";
			
			if($("#Prd_Name_PrdINP").val() != "" && $("#Prd_SEO_URL_PrdINP").val() == "")
				$("#Prd_SEO_URL_PrdINP").val(getSlug($("#Prd_Name_PrdINP").val()));
				
			$("#Prd_SEO_URL_PrdINP").val(getSlug($("#Prd_SEO_URL_PrdINP").val()));
			
			/* GC Editor :: */
			$("#Prd_Desc_Short_PrdINP").val(GC_Editor['Prd_Desc_Short'].getValue());
			$("#Prd_Desc_Long_PrdINP").val(GC_Editor['Prd_Desc_Long'].getValue());
			/* GC Editor ;; */
			
			$(".Ajax_INP").each(function(){
				if($(this).hasClass("must") && $(this).val() == "")
				{
					console.log($(this).prop("id"));
					Go = false;
					Err_Msg += "- "+$(this).data("name")+"<br />";
				}
				
				if($(this).prop("type") == "checkbox")
					Argv.append($(this).attr("id"),($(this).is(":checked") ? 1:0));
				else
					Argv.append($(this).attr("id"),$(this).val());
					
			});
			
			
			var OptGrp = {};
			var OptGrp_Count = 0;
			var OptGrp_Sub_Count = 0;
			$(".OptGrp_One").each(function(){
				if(OptGrp[OptGrp_Count] == undefined)
				{
					OptGrp[OptGrp_Count] = {};
					/*OptGrp_Name*/
					OptGrp[OptGrp_Count][0] = encodeURIComponent($(this).find(".OptGrpName_Inp").val());
					OptGrp[OptGrp_Count][1] = $(this).data("grptype");
					OptGrp[OptGrp_Count][2] = $(this).data("ogid");
					OptGrp[OptGrp_Count][3] = ($(this).find(".Mandatory_Btn").hasClass("Mandatory_Btn_Selected") ? 1 : 0);
					OptGrp[OptGrp_Count][4] = {};
				}
				
				
				$(".Opt_Sub_One",this).each(function(){
					var OptID = $(this).data("optid");
					var Name = $(this).find(".Ogts_Name_OptINP").val();
					var Prefix = $(this).find(".BTN_PlusMinus_Selected").data("val");
					var Price = parseFloat($(this).find(".Ogts_Price_OptINP").val());
					/*console.log(Name+Prefix+Price);*/
					
					if(OptGrp[OptGrp_Count][4][OptGrp_Sub_Count] == undefined)
						OptGrp[OptGrp_Count][4][OptGrp_Sub_Count] = {};
					OptGrp[OptGrp_Count][4][OptGrp_Sub_Count][0] = OptID;
					OptGrp[OptGrp_Count][4][OptGrp_Sub_Count][1] = Name;
					OptGrp[OptGrp_Count][4][OptGrp_Sub_Count][2] = Price;
					OptGrp[OptGrp_Count][4][OptGrp_Sub_Count][3] = Prefix;
					
					OptGrp_Sub_Count++;
					if(Name == "" || (Prefix != "+" && Prefix != "-"))
					{
						Go = false;
						Err_Msg += "- Option Name Field shouldn't be blank.<br />";
						return false;
					}
				});
				OptGrp_Count++;
				if(OptGrp_Sub_Count == 0)
				{
					Go = false;
					Err_Msg += "- Option Group should have at least one option. Please add an option or delete the option group.<br />";
					return false;
				}
				OptGrp_Sub_Count = 0;
			});
			
			if(OptGrp_Count > 0)
				Argv.append("PrdOptGrps",JSON.stringify(OptGrp));
			
			if(_Get['pID'] != "undefined")
				Argv.append("Prd_ID_PrdINP",_Get['pID']);
				
			if(getHash()['Under'] != undefined)
				Argv.append("Prd_Parent_ID_PrdINP",getHash()['Under']);
			
			Argv.append("OptionDelete_IDs",JSON.stringify(Option.OptionDelete_IDs));
			
			
			if(Go)
			{
				timconfirm("Save","Do you want to save?",function(){
					
					
					/* Image, File Up : */
					var UploadIndex = {};
					
					$('.TP_File_Inp').each(function(){
						if($(this).val() != "")
						{
							if(UploadIndex[$(this).data("type")] == undefined)
								UploadIndex[$(this).data("type")] = 0;
							
							var File = $(this)[0];
							File = File.files[0];
							
							Argv.append($(this).data("type")+"_"+UploadIndex[$(this).data("type")]++,File);
						}
					});
					
					var Category_IDs = new Array();
					$(".CatList_Selected").each(function(){
						Category_IDs.push($(this).data("catid"));
					});
					
					Argv.append('Category_IDs',JSON.stringify(Category_IDs));
					Argv.append('menu','saveProduct');
					
					var PrdFileUploaded = [];
					$('.Prd_File_One[data-descfileid != ""]').each(function(){
						PrdFileUploaded.push($(this).data('descfileid'));
					});
					Argv.append("PrdFileUploaded",JSON.stringify(PrdFileUploaded));
					
					var ImgUploaded = [];
					$('.Prd_ShowCaseImg_One[data-pimgid != ""]').each(function(){
						ImgUploaded.push($(this).data('pimgid'));
					});
					Argv.append("ImgUploaded",JSON.stringify(ImgUploaded));
					
					$("#Save_BTN").hide();
					$.ajax({
						type: "POST",
						url: "<?php echo $AjaxURL;?>",
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
								Option.OptionDelete_IDs['Grp'] = Array();
								Option.OptionDelete_IDs['Opt'] = Array();
								if(res.newPrdID != undefined)
								{
									window.location = "<?php echo __AdminPath__;?>catalog/products/edit?pID="+res.newPrdID;
								}
								else
									location.reload();
								showSideMSGBox('<i class="fa fa-save"></i> Saved Successfully.','msgBox_One_1');
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
	
	function SubmitSearch()
	{
		var Keyword = $('#Search_Product_Keyword').val();
		if(Keyword.trim() == "")
		{
			removeHash("Search");
		}
		else
		{
			addHash("Search",encodeURIComponent(Keyword));
		}
	}
	
	var GC_Editor = {};
	function initEditor()
	{
		if($("#GC_Editor_Prd_Desc_Short").length > 0)
		{
			GC_Editor['Prd_Desc_Short'] = ace.edit("GC_Editor_Prd_Desc_Short");
			GC_Editor['Prd_Desc_Short'].setOption("showPrintMargin", false);
			GC_Editor['Prd_Desc_Short'].setTheme("ace/theme/crimson_editor");
			GC_Editor['Prd_Desc_Short'].getSession().setMode("ace/mode/html");
			GC_Editor['Prd_Desc_Short'].getSession().setUseSoftTabs(false);
			GC_Editor['Prd_Desc_Short'].getSession().setValue($("#Prd_Desc_Short_PrdINP").val());
			
			document.getElementById("GC_Editor_Prd_Desc_Short").addEventListener("dragstart", function(e) {
				// find image data from e.target
				console.log(1);
				e.dataTransfer.setData("Text", imageText);
			})
		}
		
		if($("#GC_Editor_Prd_Desc_Long").length > 0)
		{
			GC_Editor['Prd_Desc_Long'] = ace.edit("GC_Editor_Prd_Desc_Long");
			GC_Editor['Prd_Desc_Long'].setOption("showPrintMargin", false);
			GC_Editor['Prd_Desc_Long'].setTheme("ace/theme/crimson_editor");
			GC_Editor['Prd_Desc_Long'].getSession().setMode("ace/mode/html");
			GC_Editor['Prd_Desc_Long'].getSession().setUseSoftTabs(false);
			GC_Editor['Prd_Desc_Long'].getSession().setValue($("#Prd_Desc_Long_PrdINP").val());
		}
		
	}
	
	var Option = new function(){
		
		var self = this;
		this.OptionDelete_IDs = {};
		
		
		this.SearchTemplateGroupKeyword = $('#OptGrpTpl_Search').val();
		
		this.init = function(){
			
			self.OptionDelete_IDs['Grp'] = Array();
			self.OptionDelete_IDs['Opt'] = Array();
			
			$(document).on(touchOrClick,".Mandatory_Btn",function(){
				if($(this).hasClass("Mandatory_Btn_Selected"))
				{
					$(this).removeClass("Mandatory_Btn_Selected");
				}
				else
				{
					$(this).addClass("Mandatory_Btn_Selected");
				}
			});
			
			$(document).on(touchOrClick,".deleteOptGrp_Btn",function(){
				var Obj = $(this);
				
				timconfirm('<i class="fa fa-trash"></i> Delete','Are you sure? It will not effect until you save.',function(){
					Obj.parents(".OptGrp_One").slideUp(200,function(){
						if($(this).data("ogid") != "")
							self.OptionDelete_IDs['Grp'].push($(this).data("ogid"));
							
						$(this).remove();
					});
				});
			});
			
			$(document).on(touchOrClick,".DelSubOption_BTN",function(){
				var Obj = $(this);
				
				timconfirm('<i class="fa fa-trash"></i> Delete','Are you sure?',function(){
					Obj.parents(".Opt_Sub_One").slideUp(200,function(){
						if($(this).data("optid") != "")
							self.OptionDelete_IDs['Opt'].push($(this).data("optid"));
						
						$(this).remove();
					});
				});
			});
			$(document).on(touchOrClick,".BTN_PlusMinus",function(){
				
				var Obj = $(this).parents(".Opt_Sub_One").find(".BTN_PlusMinus");
				if(!$(this).hasClass("BTN_PlusMinus_Selected"))
				{
					Obj.removeClass("BTN_PlusMinus_Selected");
					$(this).addClass("BTN_PlusMinus_Selected");
				}
				
			});
			$(document).on(touchOrClick,".AddSubOpt_Btn,.AddSubOption_BTN",function(){
				var Obj = $(this);
				$.ajax({
					type: "POST",
					url: "<?php echo $AjaxURL;?>",
					data: "menu=Option_HTML&OptGrp_Type_ID="+Obj.parents(".OptGrp_One").data("grptype"),
					success: function(d){
						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{
							if(Obj.hasClass("AddSubOption_BTN"))
							{
								Obj.parents(".Opt_Sub_One").after(res.html);
							}
							else
								Obj.parents(".OptGrp_One").find(".OptGrpContents").append(res.html);
							initDom();
						}
						else if(res.error_msg != undefined && res.error_msg != "")
							showSideMSGBox(res.error_msg,'msgBox_One_2');
					}
				});
			});
			$(document).on(touchOrClick,".openCloseOptGrp_Btn",function(){
				if($(this).hasClass("OptGrp_Selected"))
				{
					$('.openCloseOptGrp_Btn').removeClass("OptGrp_Selected");
					$(".OptGrpContents_Container").slideUp({
						duration : 400,
						easing : 'easeOutQuad'
					});
				}
				else
				{
					$('.openCloseOptGrp_Btn').removeClass("OptGrp_Selected");
					$(this).addClass("OptGrp_Selected");
					$(".OptGrpContents_Container").slideUp({
						duration : 400,
						easing : 'easeOutQuad'
					});
					$(this).parents(".OptGrp_One").find(".OptGrpContents_Container").slideDown({
						duration : 400,
						easing : 'easeInQuad'
					});
				}
			});
			$(document).on(touchOrClick,"#AddOptGrpTpl_Btn",function(){
				var Go = false;
				var Argv = "";
				if($(".OptGrpMethod_Selected").length > 0 && $(".OptGrpMethod_Selected").val() != "")
				{
					if($(".OptGrpMethod_Selected").prop("id") == "CustomOptGrp_Name")
					{
						if($("#CustomOptGrp_Type_ID").val() != "")
						{
							Go = true;
							Argv += "&Method=Custom";
							Argv += "&OptGrpName="+encodeURIComponent($(".OptGrpMethod_Selected").val());
							Argv += "&TypeID="+$("#CustomOptGrp_Type_ID").val();
						}
						else
							showSideMSGBox("Please Select Option Type.",'msgBox_One_2');
						/*OptGrp_Txt*/
						
					}
					else
					{
						Go = true;
						Argv += "&Method=Template";
						Argv += "&TplID="+encodeURIComponent($(".OptGrpMethod_Selected").val());
					}
					
					if(Go)
					{
						$.ajax({
							type: "POST",
							url: "<?php echo $AjaxURL;?>",
							data: "menu=addOptionGroup&"+Argv,
							success: function(d){
								var res = $.parseJSON(d);
								if(res.ack == 'success')
								{
									if($(".OptGrp_One").length > 0)
									{
										$("#OptGrp_Main_Block").append(res.html);
									}
									else
									{
										$("#OptGrp_Main_Block").html(res.html);
									}
									initDom();
									
								}
								else if(res.error_msg != undefined && res.error_msg != "")
									showSideMSGBox(res.error_msg,'msgBox_One_2');
							}
						});
					}
				}
				else
					showSideMSGBox("You can create custom group optio or pick from templates. Please choose one.",'msgBox_One_2');
			});
			$(document).on("keyup","#CustomOptGrp_Name",function(e){
				if(!$(this).hasClass("OptGrpMethod_Selected"))
				{
					$("#OptGrpTpl_Search").removeClass("OptGrpMethod_Selected");
					$("#OptGrpTpl_Search").val("");
					self.SearchTemplateGroupKeyword = '';
					
					$(this).addClass("OptGrpMethod_Selected");
					$("#AddOptGrpTpl_Btn span").text("Add Custom Option Group");
					
					window.setTimeout(function() {
						$("#OptGrpTpl_AutoComplete").html("");
						$("#OptGrpTpl_AutoComplete").hide();
					},200);
				}
			});
			
			$(document).on("keyup","#OptGrpTpl_Search",function(e){
				
				if(!$(this).hasClass("OptGrpMethod_Selected"))
				{
					$("#CustomOptGrp_Name").removeClass("OptGrpMethod_Selected");
					$("#CustomOptGrp_Name").val("");
					$("#OptGrpTpl_Search").data("tplid","");
					$(this).addClass("OptGrpMethod_Selected");
					$("#AddOptGrpTpl_Btn span").text("Add Option Group From Template")
				}
				
				if(e.which == 38 && $(".TplSrc_One").length > 0)
				{
					
					if($(".TplSrc_One_Select").length == 0)
						$(".TplSrc_One:last-child").addClass("TplSrc_One_Select");
					else
					{
						var ToDelete = $(".TplSrc_One_Select");
						$(".TplSrc_One_Select").prev().addClass("TplSrc_One_Select");
						ToDelete.removeClass("TplSrc_One_Select");
					}
				}
				else if(e.which == 40 && $(".TplSrc_One").length > 0)
				{
					
					if($(".TplSrc_One_Select").length == 0)
						$(".TplSrc_One:first-child").addClass("TplSrc_One_Select");
					else
					{
						var ToDelete = $(".TplSrc_One_Select");
						$(".TplSrc_One_Select").next().addClass("TplSrc_One_Select");
						ToDelete.removeClass("TplSrc_One_Select");
					}
				}
				
				
				if($('#OptGrpTpl_Search').val() == "")
				{
					$("#OptGrpTpl_AutoComplete").html("");
					$("#OptGrpTpl_AutoComplete").hide();
				}
				else if($('#OptGrpTpl_Search').val() != self.SearchTemplateGroupKeyword)
				{
					self.SearchTemplateGroupKeyword = $('#OptGrpTpl_Search').val();
					$.ajax({
						type: "POST",
						url: "<?php echo $AjaxURL;?>",
						data: "menu=searchOptGrpTpl&K="+encodeURIComponent(self.SearchTemplateGroupKeyword),
						success: function(d){
							var res = $.parseJSON(d);
							if(res.ack == 'success')
							{
								if(res.html != "")
								{
									$("#OptGrpTpl_AutoComplete").html(res.html);
									$("#OptGrpTpl_AutoComplete").show();
								}
								else
								{
									$("#OptGrpTpl_AutoComplete").html('<div class="notFoundOptTemplate">Not found</div>');
									$("#OptGrpTpl_AutoComplete").show();
								}
								
							}
							else if(res.error_msg != undefined && res.error_msg != "")
								showSideMSGBox(res.error_msg,'msgBox_One_2');
						}
					});
				}
				
				
			});
		};
	};
	function checkURLExist()
	{
		
		if($("#Prd_SEO_URL_PrdINP").val() != "")
		{
			var Argv = "";
			Argv += (getHash()['pID'] != undefined? "pID="+getHash()['pID']:"");
			Argv += "&URL="+encodeURIComponent($("#Prd_SEO_URL_PrdINP").val());
			
			$.ajax({
				type: "POST",
				url: "<?php echo $AjaxURL;?>",
				data: "menu=checkURLExist&"+Argv,
				success: function(d){
					var res = $.parseJSON(d);
					if(res.Dup == 1)
					{
						$("#Prd_SEO_URL_PrdINP").addClass("error");
					}
					else
						$("#Prd_SEO_URL_PrdINP").removeClass("error");
				}
			});
		}
	}
	
	function initDom()
	{
		$(".OptGrpContents").sortable({
			handle:".changeOrder",
			axis: 'y'
		});
		
	}
	
</script>
<div id="PG_Menu">
	<a href="<?php echo __AdminPath__;?>catalog/products/" class="button button_white" data-tooltip="Back"><i class="fa fa-mail-reply"></i></a>
	<div id="Refresh_BTN" class="button button_gray" data-tooltip="Refresh"><i class="fa fa-rotate-left"></i></div>
	
	<div id="Save_BTN" class="button button_blue" data-tooltip="Save"><i class="fa fa-save"></i></div>
</div>
<div id="PG_Contents">
	<div id="PD_Tab">
		<div id="PD_Tab_Menu">
			<div class="PD_Tab_One noSelect PD_Tab_Selected" data-tabid="1"><i class="fa fa-home"></i> General</div>
			<div class="PD_Tab_One noSelect" data-tabid="2"><i class="fa fa-money"></i> Data</div>
			<div class="PD_Tab_One noSelect" data-tabid="5"><i class="fa fa-file-image-o"></i> Image</div>
			<div class="PD_Tab_One noSelect" data-tabid="7"><i class="fa fa-file-movie-o"></i> Video</div>
			<div class="PD_Tab_One noSelect" data-tabid="3"><i class="fa fa-sitemap"></i> Category</div>
			<div class="PD_Tab_One noSelect" data-tabid="4"><i class="fa fa-archive "></i> Options</div>
			<div class="PD_Tab_One noSelect" data-tabid="6"><i class="fa fa-globe"></i> SEO</div>
		</div>
		
		<div class="PD_Tab_Content_One" data-tabid="1" style="display:block;">
		
			<div class="PD_Line_One">
				<div class="PD_T"><span>Is Available?</span></div>
				<div class="PD_I">
					<input type="checkbox" id="Prd_isActive_PrdINP" class="Ajax_INP"<?php echo ($Prd_isActive ? ' checked="checked"' : "");?> />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>Is Featured Item?</span></div>
				<div class="PD_I">
					<input type="checkbox" id="Prd_isFeatured_PrdINP" class="Ajax_INP"<?php echo ($Prd_isFeatured ? ' checked="checked"' : "");?> />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><i>*</i><span>Product Name</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_Name_PrdINP" class="Ajax_INP must" data-name="Product Name" value="<?php echo $Prd_Name;?>" />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><i>*</i><span>SEO Friendly URL (<b id="GenerateSEOUrl_Btn">Generate</b>)</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_SEO_URL_PrdINP" placeholder="Allowed alphabetical characters and numbers. No blank space allowed." data-name="SEO URL" class="Ajax_INP must" value="<?php echo $Prd_SEO_URL;?>" />
				</div>
			</div>
			
			
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>Short Description</span></div>
				<div class="PD_I">
					<textarea id="Prd_Desc_Short_PrdINP" class="Ajax_INP hide"><?php echo $Prd_Desc_Short;?></textarea>
					<div id="GC_Editor_Prd_Desc_Short" class="GC_Editor"></div>
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>Files for Description</span></div>
				<div class="PD_I" id="TP_DescFile_Block">
					<?php echo $DescFiles;?>
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>Long Description</span></div>
				<div class="PD_I">
					<textarea id="Prd_Desc_Long_PrdINP" class="Ajax_INP hide"><?php echo $Prd_Desc_Long;?></textarea>
					<div id="GC_Editor_Prd_Desc_Long" class="GC_Editor"></div>
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><b class="fa fa-tags"></b> <span>Products Tags</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_Tags_PrdINP" placeholder="Type all related keywords seperated by (,) comma. It will be used for search system." data-name="Tags" class="Ajax_INP" value="<?php echo $Prd_Tags;?>" />
				</div>
			</div>
			
			
		</div>
		<div class="PD_Tab_Content_One" data-tabid="2">
			
			<div class="PD_Line_One">
				<div class="PD_T"><i>*</i><span>Price</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_Price_PrdINP" class="Ajax_INP must" data-name="Item Price" value="<?php echo $Prd_Price;?>" placeholder="Price of the product. Only number." />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>List Price</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_ListPrice_PrdINP" class="Ajax_INP" value="<?php echo $Prd_ListPrice;?>" placeholder="Price of the product. Only number." />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>Taxable Item</span></div>
				<div class="PD_I">
					<input type="checkbox" id="Prd_isTaxble_PrdINP" class="Ajax_INP"<?php echo ($Prd_isTaxble == 1 ? ' checked="checked"' : "");?> />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>Quantity</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_Qty_PrdINP" class="Ajax_INP" value="<?php echo $Prd_Qty;?>" placeholder="Set '-1' for unlimited items." />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>Minimum Quantity</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_MinimumQty_PrdINP" class="Ajax_INP" value="<?php echo $Prd_MinimumQty;?>" />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>SKU</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_SKU_PrdINP" class="Ajax_INP" value="<?php echo $Prd_SKU;?>" />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>UPC</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_UPC_PrdINP" class="Ajax_INP" value="<?php echo $Prd_UPC;?>" />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>EAN</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_EAN_PrdINP" class="Ajax_INP" value="<?php echo $Prd_EAN;?>" />
				</div>
			</div>
			
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>JAN</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_JAN_PrdINP" class="Ajax_INP" value="<?php echo $Prd_JAN;?>" />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>ISBN</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_ISBN_PrdINP" class="Ajax_INP" value="<?php echo $Prd_ISBN;?>" />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>MPN</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_MPN_PrdINP" class="Ajax_INP" value="<?php echo $Prd_MPN;?>" />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>Weight Unit</span></div>
				<div class="PD_I">
					<select id="Prd_Weight_Unit_PrdINP" class="Ajax_INP">
						<option value="1">Pound</option>
						<option value="2">Kilogram</option>
						<option value="3">Gram</option>
						<option value="4">Ounce</option>
					</select>
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>Weight</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_Weight_PrdINP" class="Ajax_INP" value="<?php echo $Prd_Weight;?>" />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>Length : Dimension</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_Dimension_L_PrdINP" class="Ajax_INP" value="<?php echo $Prd_Dimension_L;?>" />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>Width : Dimension</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_Dimension_W_PrdINP" class="Ajax_INP" value="<?php echo $Prd_Dimension_W;?>" />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>Height : Dimension</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_Dimension_H_PrdINP" class="Ajax_INP" value="<?php echo $Prd_Dimension_H;?>" />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>Reward Point</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_RewardPoint_PrdINP" class="Ajax_INP" value="<?php echo $Prd_RewardPoint;?>" />
				</div>
			</div>
			
		</div>
		<div class="PD_Tab_Content_One" data-tabid="3">
			<div class="PD_Line_One">
				<?php echo $CategoryList;?>
			</div>
		</div>
		
		
		<div class="PD_Tab_Content_One" data-tabid="4">
			<div class="w100 OptTopMenu_Block">
				<div>
					<select id="CustomOptGrp_Type_ID" class="center">
						<option value="">- Select Option Type -</option>
						<?php echo $OptType_HTML;?>
					</select>
					<input type="text" id="CustomOptGrp_Name" placeholder="Option Group Name" />
					<span>or</span>
				</div>
				<div class="relative">
					<input type="text" id="OptGrpTpl_Search" placeholder="Search : Option Group Template" />
					<div id="OptGrpTpl_AutoComplete">
						
					</div>
				</div>
				
				<div id="AddOptGrpTpl_Btn" class="noSelect OPT_Top_Btn"><i class="fa fa fa-plus"></i> <span>Add Option Group</span></div>
			</div>
			<div class="w100" id="OptGrp_Main_Block">
				<?php echo $OptGrp_HTML;?>
			</div>
		</div>
		<div class="PD_Tab_Content_One" data-tabid="5">
			<div class="PD_Line_One" id="PD_Image_Block">
				<?php echo $Product_Image;?>
			</div>
		</div>
		<div class="PD_Tab_Content_One" data-tabid="6">
			<div class="PD_Line_One">
				<div class="PD_T"><span>Meta Title</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_Meta_Title_PrdINP" class="Ajax_INP" value="<?php echo $Prd_Meta_Title;?>" />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>Meta Keywords</span></div>
				<div class="PD_I">
					<input type="text" id="Prd_Meta_Key_PrdINP" class="Ajax_INP" value="<?php echo $Prd_Meta_Key;?>" />
				</div>
			</div>
			
			<div class="PD_Line_One">
				<div class="PD_T"><span>Meta Description</span></div>
				<div class="PD_I">
					<textarea id="Prd_Meta_Desc_PrdINP" class="Ajax_INP"><?php echo $Prd_Meta_Desc;?></textarea>
				</div>
			</div>
		</div>
		
		<div class="PD_Tab_Content_One" data-tabid="7">
			<div class="PD_T"><span>Upload Video</span></div>
				<div class="PD_I">
					
				</div>
		</div>
	</div>
</div>