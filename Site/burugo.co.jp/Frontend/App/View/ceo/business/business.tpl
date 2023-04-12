<style type="text/css">
	.Front_Contents_Body{
		padding:0 30px 0 30px;
		background-image: url('/Template/Img/ceo-olympic-bg.png');
	}
	#Top_Box{background-image:url('/Template/Img/ceo-add-top-bg.jpg');height:138px;max-width:1430px;min-width:350px;width:100%;margin-left:auto;margin-right:auto;float:none;color:white;text-align:center;line-height:138px;font-size:30px;}
	.Box_Row{width:100%;border-bottom:1px dotted #c8c8c8;padding-top:15px;padding-bottom:15px;}
	.Box_Row .Box_Title{width:100%;line-height:20px;}
	.Box_Row .Box_Title b{color:#e02f2f;margin-right:3px;}
	.Box_Row .Box_Title span{color:#aaaaaa;}
	.Box_Row .Box_Field{width:100%;margin-top:10px;}
	.Box_Row .Box_Field input[type=text],
	.Box_Row .Box_Field textarea{width:100%;border:1px solid #929292;margin:0;padding:10px;box-sizing:border-box;font-size:14px;margin-bottom:5px;}
	.Box_Row .Box_Desc{width:100%;color:#999999;margin-top:10px;line-height:20px;}
	.Image_Frame{width:126px;height:96px;background-color:#e9e9e9;border:3px dotted #d0d0d0;border-radius:10px;color:gray;text-align:center;line-height:96px;cursor:pointer;}
	.GC_Editor{width:100%;min-height:300px;}
	.GC_Editor_Wrap div{float:none;}
	
	.BusinessHours_One{width:100%;height:40px;line-height:40px;margin-bottom:5px;border-bottom:1px dotted #eeeeee;}
	.BusinessHours_One .Day_Txt{margin-left:10px;margin-right:10px;}
	.BusinessHours_One .Day_Menu{float:right;width:40px;text-align:center;cursor:pointer;border-radius:5px;}
	
	#OpenHours_Box{width:100%;border:1px dotted gray;padding:10px;box-sizing:border-box;border-radius:5px;color:gray;}
	
	#Address_Search_Box_Wrap{position:relative;}
	#Address_Search_Box{position:absolute;top:-5px;border:1px solid #d8d8d8;box-sizing:border-box;max-height:300px;overflow:auto;}
	#Address_Search_Box div{width:100%;line-height:40px;height:40px;background-color:white;border-bottom:1px solid #ececec;cursor:pointer;}
	#Address_Search_Box div span{margin-left:10px;}
	#Address_Search_Box div:hover{background-color:#00b3ff;color:#034866;}
	.Contents_Box_Wrap{margin-top:30px;}
	
	
	#AddHours_BTN{margin-top:10px;margin-left:10px;}
	
	.ItemAndGroup_Header{background-color: #f5f5f5;box-sizing: border-box;padding: 5px 15px 5px 15px;width: 100%;border-bottom:1px solid white;}
	.ItemAndGroup_Header div{text-align:center;color:#5a5a5a;}
	#ItemGroup_Header .col1{width:300px;}
	#ItemGroup_Header .col2{width:180px;float:right;}
	
	#Item_Header .col1{width:300px;}
	#Item_Header .col2{width:180px;float:right;}
	.ItmAndGrp_Box{width:100%;padding:15px;box-sizing:border-box;background-color:#eaeaea;margin-bottom:10px;}
	.ItmAndGrp_Box .noGroup{width:100%;text-align:center;color:gray;}
	.ItemGroup_One{width:100%;margin-bottom:5px;}
	.ItemGroup_One input{margin-bottom:0!important;}
	.ItemGroup_One .ItemGroup_Menu_Box{float:right;}
	.ItemGroup_One .ItemGroup_Menu_Box div{width:38px;height:38px;line-height:38px;border:1px solid white;text-align:center;background-color:#70b2e9;color:white;border-radius:5px;cursor:pointer;margin-left:5px;}
	.ItemGroup_One .ItemGroup_Menu_Box div:hover{border:1px solid #095594;}
	.ItemGroup_One .ItemGroup_Name_Box{width:300px;}
	.ItemGroup_One .ItemGroup_ItemList_Box{width:100%;box-sizing:border-box;padding:10px;margin-top:8px;margin-bottom:5px;background-color:#f7f7f7;display:none;}
	.ItemGroup_One .Group_noItemAdded{color:#a4a4a4;}
	
	.Item_One{width:100%;margin-bottom:5px;}
	.Item_One input{margin-bottom:0!important;}
	.Item_One .Item_Menu_Box{float:right;}
	.Item_One .Item_AddGroup_Box{margin-right:5px;}
	.Item_One .Item_AddGroup_Box div,
	.Item_One .Item_Menu_Box div{width:38px;height:38px;line-height:38px;border:1px solid white;text-align:center;background-color:#70b2e9;color:white;border-radius:5px;cursor:pointer;margin-left:5px;}
	.Item_One .Item_AddGroup_Box div:hover,
	.Item_One .Item_Menu_Box div:hover{border:1px solid #095594;}
	.Item_One .Item_Name_Box{width:300px;}
	.Item_One .Item_Detail{padding:10px;width:100%;box-sizing:border-box;background-color:#f7f7f7;margin-top:5px;}
	.Item_One .ItemD_Close_Box{margin-top:10px;}
	.Item_One .ItemD_One{width:100%;}
	.Item_One .ItemD_Header{width:100%;line-height:30px;margin-bottom:3px;}
	.Item_One .ItemD_Fields{width:100%;}
	.Item_One .ItemD_Desc{line-height:20px;color:gray;margin-top:5px;margin-bottom:5px;}
	.Item_One .Item_Pic_Box{width:49px;height:37px;background-color:white;margin-right:5px;overflow:hidden;border-radius:5px;color:#a5a5a5;line-height:39px;text-align:center;font-size:18px;border:1px solid #929292;cursor:pointer;}
	.Item_One .Item_Pic_Inp{display:none;}
	.Item_One .IP_IMG{width:100%;height:100%;}
	#Submit_Box{width:100%;max-width:1430px;float:none;margin-left:auto;margin-right:auto;margin-bottom:100px;}
	#Submit_Box button{width:100%;height:40px;font-size:14px;}
	#SEOUrl_DupResult{margin-left:10px;}
	.Image_Frame img{width:100%;height:100%;}
	.error_fill{background-color:#ffcfcf;}
	.Green{color:#89c64e;}
	.Red{color:#f79696;}
	#SEOUrl_INP{ime-mode:disabled;text-transform: lowercase;}
	#FrontImage_TMP_INP{display:none;}
	#BusinessKeyword_Box{
		border: 1px dotted gray;
		border-radius: 5px;
		box-sizing: border-box;
		color: gray;
		padding: 20px;
		width: 100%;
		margin-bottom:10px;
	}
	.StoreKeyword{padding-left:10px;padding-right:10px;height:25px;line-height:25px;background-color:#b8e5ff;border-radius:5px;position:relative;cursor:default;border:3px dotted #82c3e9;color:#004b76;margin-right:10px;margin-bottom:10px;}
	.StoreKeyword:hover .SKDelete_BTN{display:block;}
	.StoreKeyword i{color:#3f3f3f;}
	.StoreKeyword .SKDelete_BTN{display:none;cursor:pointer;line-height:25px;height:25px;font-size:16px;margin-left:5px;}
	#searchingAddressIdea{display:none;margin-left:10px;}
	#Address1_INP{color:black;}
	#SEOUrl_Preview{color:#e02f2f;}
	
	.Card_One{width:360px;height:200px;border-radius:10px;background-color:white;border:1px solid #e5e6e9;position:relative;overflow:hidden;float:none;margin-left:auto;margin-right:auto;margin-bottom:15px;}
	.Card_One:hover{border:1px solid #d5d5d8;}
	.Card_One input[type=text]{width:100%;box-sizing:border-box;border:0;background-color:transparent;height:25px;padding-left:10px;padding-right:10px;}
	.Card_One .C_Comon{position:absolute;}
	.Card_One .Card_Pic img{width:100%;height:100%;}
	.Card_One #Card_Pic_Main{background-color:#f6f7f8;width:80px;height:80px;border-radius:5px;left:10px;top:10px;text-align:center;color:gray;text-align:center;line-height:80px;font-size:12px;cursor:pointer;overflow:hidden;border:1px solid #a5a5a5;}
	.Card_One #Card_Pic_Main:hover{background-color:#ededed;}
	.Card_One .Card_Pic_Addt{height:35px;width:290px;top:95px;left:10px;}
	
	.Card_One .Card_BusinessName{width:190px;left:100px;border-radius:2px;top:12px;line-height:25px;font-weight:bold;max-height:54px;overflow:hidden;}
	.Card_One .Card_BusinessName #CN_BusinessName{font-size:23px;color:#36a7db;}
	.Card_One #Card_OwnerName{top:50px;left:100px;font-weight:bold;color:#3b3b3b;font-size:15px;}
	.Card_One #Card_ContactNumber{top:73px;left:100px;color:#b02c29;}
	.Card_One .Card_Address{top:100px;left:15px;max-width:280px;color:#909090;font-size:12px;line-height:20px;}
	.Card_One .Card_Age{width:100px;left:100px;border-radius:2px;top:60px;font-size:11px;color:#bd6565;}
	.Card_One .Card_Menu{width:60px;right:0;top:0;height:200px;background-color:white;background-color:#f0f0f0;}
	.Card_One .CM_Icon_One{width:40px;height:40px;background-color:white;font-size:20px;text-align:center;line-height:40px;margin-left:10px;border-radius:5px;margin-top:8px;color:white;cursor:pointer;}
	.Card_One .CMI_Phone{background-color:#71cbf5;}
	.Card_One .CMI_Chat{background-color:#6cc5ee;}
	.Card_One .CMI_Map{background-color:#43a6d4;}
	.Card_One .CMI_Detail{background-color:#2d95c6;}
	.Card_One #Card_ShortD{padding-bottom:10px;padding-top:10px;left:10px;top:150px;border-left:5px solid #f6f7f8;padding-left:10px;color:#8a8a8a;max-width:260px;}
	.Card_One #Card_ShortD p{overflow:hidden;max-height:30px;line-height:15px;}
	.Card_One .CM_Icon_One:hover{background-color:#616161;color:white;}
	
	@media all and (max-width:750px) {
		
	}
	
	@media (min-width:800px) {}
	@media (min-width:1400px) {
		
	}
</style>
<script type="text/javascript" src="/Core/JS/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	<?php
	if(isset($Business['B']))
	{
		echo 'var Store_ID = "'.$Business['B'][0]['Store_ID'].'";';
	}
	?>
	$(document).ready(function(){
		Editor();
		PreviewCard.init();
		Address.init();
		Items.init();
		BusinessHours.init();
		SEOUrl.init();
		Submit.init();
		StoreImage.init();
		BusinessKeyword.init();
		BusinessLongDesc_Image.init();
		
		
	});
	
	var PreviewCard = new function(){
		
		
		this.init = function(){
			var Timer;
			var self = this;
			$(document).on("focus",".rapidUpdate_Card",function(){
				var obj = $(this);
				clearInterval(Timer);
				Timer = setInterval(function(){
					$("#"+obj.data('target')).text(obj.val());
				},200);
			});
			
			
			$(document).on("focusout",".rapidUpdate_Card",function(){
				clearInterval(Timer);
			});
			
			
			/*
			$('.Card_One').hoverIntent({
				over: function(){
					$(this).find('.Card_Menu').fadeIn(300);
				},
				out: function(){
					$(this).find('.Card_Menu').fadeOut(300);
				},
				timeout: 300
			});
			*/
			
		};
	};
	
	var BusinessKeyword = new function(){
		this.Keyword = "";
		this.NewKeyword = "";
		this.noKeywordMSG = '<div id="NoKeywordMSG" class="w100 center"><?php echo $this->_Lang_ceo_business['err_no_keyword_added'];?></div>';
		this.maximum_keyword = 10;
		this.current_keyword = 0;
		
		this.init = function(){
			var self = this;
			
			self.refreshCurrentKeyword();
			
			if(this.current_keyword == 0)
				$("#BusinessKeyword_Box").html(this.noKeywordMSG);
			
			$(document).on(touchOrClick,"#AddBusinessKeyword_Btn",function(){
				self.addKeyword();
			});
			
			
			$(document).on(touchOrClick,".SKDelete_BTN",function(){
				var obj = $(this);
				timconfirm("<?php echo $this->_Lang_general['confirm'];?>","<?php echo $this->_Lang_general['confirm_delete'];?>",function(){
					obj.parents('.StoreKeyword').fadeOut().remove();
					if($(".StoreKeyword").length == 0)
					{
						$("#BusinessKeyword_Box").html(self.noKeywordMSG);
					}
					self.refreshCurrentKeyword();
				});
			});
			$(document).on("keyup","#BusinessKeyword_INP",function(e){
				if(e.which == 13)
				{
					self.addKeyword();
				}
			});
		};
		
		this.addKeyword = function(){
			var self = this;
			
			if(self.maximum_keyword <= self.current_keyword)
			{
				showSideMSGBox('<i class="fa fa-info-circle"> <?php echo $this->_Lang_ceo_business['err_keyword_maximum_1'];?> '+self.maximum_keyword+'<?php echo $this->_Lang_ceo_business['err_keyword_maximum_2'];?>','msgBox_One_2');
			}
			else
			{
				if(!self.isDupicated())
				{
					if($("#BusinessKeyword_INP").val() != "")
					{
						$("#NoKeywordMSG").remove();
						$("#BusinessKeyword_Box").append('<div class="StoreKeyword"><div class="SK_Text">'+$("#BusinessKeyword_INP").val()+'</div><div class="SKDelete_BTN"><i class="fa fa-times-circle"></div></div>');
						self.refreshCurrentKeyword();
						$("#BusinessKeyword_INP").val("");
					}
					else
					{
						showSideMSGBox('<i class="fa fa-info-circle"> <?php echo $this->_Lang_ceo_business['insert_keyword'];?>','msgBox_One_2');
					}
				}
				else
				{
					showSideMSGBox('<i class="fa fa-info-circle"> <?php echo $this->_Lang_ceo_business['keyword_added_already'];?>','msgBox_One_2');
				}
			}
		};
		this.refreshCurrentKeyword = function(){
			this.current_keyword = $(".StoreKeyword").length;
			$("#CurrentKeyword_Count").text(this.current_keyword);
		};
		
		this.isDupicated = function(){
			var isDuplicated = false;
			$(".StoreKeyword").each(function(){
				if($(this).find('.SK_Text').text() == $("#BusinessKeyword_INP").val())
					isDuplicated = true;
			});
			
			return isDuplicated;
		};
	
	};
	
	var StoreImage = new function(){
		this.init = function(){
			
			
			
			$(document).on(touchOrClick,"#Card_Pic_Main,#FrontImage_BTN",function(){
				$("#FrontImage_TMP_INP").click();
			});
			
			$(document).on("change","#FrontImage_TMP_INP",function(){
				if(this.files && this.files[0])
				{
					var obj = $(this);
					var reader = new FileReader();

					reader.onload = function (e) {
						$("#FrontImage_BTN").html('<img class="TP_IMG" src="'+e.target.result+'" />');
						$("#Card_Pic_Main").html('<img src="'+e.target.result+'" />');
					};
					reader.readAsDataURL(this.files[0]);
					
				}
			});
		};
	};
	
	var BusinessLongDesc_Image = new function(){
		this.init = function(){
			$('#DescImage_TMP_INP').change(function(){
				
				if(typeof Store_ID != "undefined")
				{
					var FormGroup = new FormData();
					FormGroup.append('menu','uploadLongDescImg');
					FormGroup.append('Store_ID',Store_ID);
					
					if($("#DescImage_TMP_INP") != "")
					{
						var ImgFile = $("#DescImage_TMP_INP")[0];
						FormGroup.append('ImgFile',ImgFile.files[0]);
					}
					$.ajax({
						type: "POST",
						url: "/add?ajaxProcess",
						data: FormGroup,
						processData: false,
						contentType: false,
						xhr: function() {
							myXhr = $.ajaxSettings.xhr();
							return myXhr;
						},
						success: function(d){
							var res = $.parseJSON(d);
							if(res.ack == 'success')
							{
								if(res.imgs.length > 0)
								{
									CKEDITOR.instances.StoreDescLong_INP.insertHtml('<img src="/Template/'+res.imgs[0]+'" />');
								}
								
							}
							else if ('error_msg' in res)
							{
                                showSideMSGBox(res.error_msg,'msgBox_One_2');
                            }
						}
					});
				}
				else
					showSideMSGBox('<i class="fa fa-info-circle"> "자세한 설명"의 사진 업로드 기능은 비지니스 등록 후 사용 가능 합니다.','msgBox_One_2');
			});
				
			
		};
	};
	
	
	var Submit = new function(){
		this.init = function(){
			var self = this;
			$(document).on(touchOrClick,'#Submit_BTN',function(){
				timconfirm("<?php echo $this->_Lang_general['confirm'];?>","<?php echo $this->_Lang_general['confirm_save'];?>",function(){
					
					
					var output = self.validate();
					if(output.ack == 'success')
						self.submit();
					else if(output.ack == 'error')
					{
						if(output.errorMSG != '')
						{
							showSideMSGBox('<i class="fa fa-info-circle"> <?php echo $this->_Lang_ceo_business['err_try_again'];?><br /><br />'+output.errorMSG,'msgBox_One_2');
						}
					}
				});
			});
			
			$(document).on('focusout','.must',function(){
				if($(this).is("input"))
				{
					if($(this).prop("type") == 'text')
					{
						if($(this).val() != "")
						{
							$(this).removeClass('error_fill');
						}
							
					}
					
				}
			});
		};
		
		this.submit = function(){
			var FormGroup = new FormData();
			
			var args = {};
			
			$('input[data-submit=true],textarea[data-submit=true],div[data-submit=true]').each(function(){
				if($(this).is('input') || $(this).is('textarea'))
				{
					args[$(this).prop('id')] = $(this).val();
				}
				else if($(this).is('div'))
				{
					args[$(this).prop('id')] = $(this).data('value');
				}
			});
			
			args['StoreDescLong_INP'] = CKEDITOR.instances.StoreDescLong_INP.getData();
			
			
			var i = 0;
			args['StoreBusinessHours_INP'] = {};
			$('.BusinessHours_One').each(function(){
				if(typeof args['StoreBusinessHours_INP'][i] == "undefined")
					args['StoreBusinessHours_INP'][i] = {};
				
				args['StoreBusinessHours_INP'][i]['ID'] = $(this).data('value');
				args['StoreBusinessHours_INP'][i]['O'] = $(this).find('.O_HH').val()+":"+$(this).find('.O_MM').val();
				args['StoreBusinessHours_INP'][i]['C'] = $(this).find('.C_HH').val()+":"+$(this).find('.C_MM').val();
				i++;
			});
			
			var i = 0;
			args['CardKeywords_INP'] = {};
			$('.StoreKeyword').each(function(){
				args['CardKeywords_INP'][i] = $(this).find('.SK_Text').text();
				i++;
			});
			
			if($("#FrontImage_TMP_INP") != "")
			{
				var ImgFile = $("#FrontImage_TMP_INP")[0];
				FormGroup.append('StoreImage',ImgFile.files[0]);
			}
			
			FormGroup.append('menu','saveStore');
			if(typeof Store_ID != "undefined")
				args['Store_ID'] = Store_ID;
			
			var i = 0;
			args['ItemGrp'] = {};
			$(".ItemGroup_Name").each(function(){
				if(typeof args['ItemGrp'][i] == "undefined")
					args['ItemGrp'][i] = {};
				
				args['ItemGrp'][i]['ID'] = $(this).parents('.ItemGroup_One').data('id');
				args['ItemGrp'][i]['N'] = $(this).val();
				i++;
			});
				
			FormGroup.append('Args',JSON.stringify(args));
			
			
			
			
			$.ajax({
				type: "POST",
				url: "/add?ajaxProcess",
				data: FormGroup,
				processData: false,
				contentType: false,
				xhr: function() {
					myXhr = $.ajaxSettings.xhr();
					return myXhr;
				},
				success: function(d){
					var res = $.parseJSON(d);
					if(res.ack == 'success')
					{
						
						if(typeof Store_ID != "undefined")
							showSideMSGBox('<i class="fa fa-info-circle"> <?php echo $this->_Lang_ceo_business['save_completed'];?>','msgBox_One_1');
						else
						{
							showSideMSGBox('<i class="fa fa-info-circle"> <?php echo $this->_Lang_ceo_business['register_completed'];?>','msgBox_One_1');
							window.location = '/dashboard';
						}
						
					}
				}
			});
			
			/*console.log(args);*/
		};
		this.validate = function(){
			var output = {};
			output.ack = 'success';
			output.errorMSG = '';
			$(".must").each(function(){
				if($(this).is("input"))
				{
					if($(this).prop("type") == 'text')
					{
						if($(this).val() == "")
						{
							output.ack = 'error';
							output.errorMSG = '<?php echo $this->_Lang_ceo_business['err_fill_must'];?>';
							$(this).addClass('error_fill');
						}
					}
					
				}
				
			});
			
			return output;
		};
	};
	
	var SEOUrl = new function(){
		this.Keyword;
		this.Keyword_New;
		this.init = function(){
			var Timer = null;
			var self = this;
			
			self.Keyword = $("#SEOUrl_INP").val();
			self.Keyword_New = self.Keyword;
			$(document).on("focus","#SEOUrl_INP",function(){
				clearInterval(Timer);
				Timer = setInterval(function(){
					self.Keyword = $('#SEOUrl_INP').val();
					if(self.Keyword != "")
					{
						
						if(self.Keyword_New != self.Keyword)
						{
							self.CheckURL();
							self.Keyword_New = self.Keyword;
						}
					}
					else
						$('#SEOUrl_DupResult').html("");
					
				},200);
			});
		};
		
		this.CheckURL = function(){
			var self = this;
			$.ajax({
				type: "POST",
				url: "/add?ajaxProcess",
				data: "menu=checkSEOURL&Store_URL="+self.Keyword,
				success: function(d){
					var res = $.parseJSON(d);
					if(res.ack == 'success')
					{
						if(res.dupl == 0)
						{
							$("#SEOUrl_DupResult").html('<i class="fa fa-check-circle Green"></i> <?php echo $this->_Lang_ceo_business['can_use'];?>');
						}
						else if(res.dupl == 1)
							$("#SEOUrl_DupResult").html('<i class="fa fa-check-circle Green"></i> <?php echo $this->_Lang_ceo_business['cant_use'];?>');
						
					}
				}
			});
		};
	};
	
	var BusinessHours = new function(){
		this.noHoursAdded_Text;
		this.selectedValue = {};
		
		
		this.init = function(){
			var Self = this;
			this.noHoursAdded_Text = $("#OpenHours_Box").html();
			this.assignCurrentValue();
			$(document).on(touchOrClick,'#AddHours_BTN',function(){
				Self.assignCurrentValue();
				Self.getInsertHTML(Self.selectedValue.value,Self.selectedValue.text);
			});
			$(document).on(touchOrClick,'.Day_Menu',function(){
				var Obj = $(this).parents('.BusinessHours_One');
				timconfirm("<?php echo $this->_Lang_general['confirm'];?>","<?php echo $this->_Lang_general['confirm_delete'];?>",function(){
					Obj.slideUp(100,function(){
						$(this).remove();
						if($(".BusinessHours_One").length == 0)
						{
							$("#OpenHours_Box").html(Self.noHoursAdded_Text);
						}
					});
					
					
				});
			});
			
			
			
			$("#BusinessHours_SLT").GGoRokSelect(function(){
			});
		};
		
		this.getInsertHTML = function(Value,Text){
			var Self = this;
			Self.assignCurrentValue();
			if(Self.selectedValue.value == -1)
			{
				showSideMSGBox('<i class="fa fa-info-circle"> <?php echo $this->_Lang_ceo_business['select_date'];?>','msgBox_One_2');
			}
			else
			{
				$.ajax({
					type: "POST",
					url: "/add?ajaxProcess",
					data: "menu=businessHours_HTML&dID="+Value,
					success: function(d){
						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{
							
							
							if($('.BusinessHours_One').length == 0)
							{
								$("#OpenHours_Box").html('');
								$("#OpenHours_Box").append(res.html/*Self.getInsertHTML(Self.selectedValue.value,Self.selectedValue.text)*/);
							}
							else
							{
								var i = 0;
								$(".BusinessHours_One").each(function(){
									i++;
									
									if($(this).data('value') > Self.selectedValue.value)
									{
										$(this).before(res.html/*Self.selectedValue.value,Self.selectedValue.text)*/);
										return false;
									}
									else if($(".BusinessHours_One").length == i)
									{
										$("#OpenHours_Box").append(res.html/*Self.selectedValue.value,Self.selectedValue.text*/);
									}
									
									
								});
							}
							
							
						}
					}
				});
			}
			
		};
		
		this.assignCurrentValue = function(){
			this.selectedValue = {"value" : $("#BusinessHours_SLT").data('value'),"text" : $("#BusinessHours_SLT .SLT_Selected_Text").text()};
		};
		
		
	};
	var Items = new function(){
		
		this.noGroupAdded_Text;
		this.noItemAdded_Text;
		this.addGroup_HTML;
		this.addItem_HTML;
		
		this.init = function(){
			var self = this;
			this.noGroupAdded_Text = $("#ItemGroup_Box").html();
			this.noItemAdded_Text = $("#Item_Box").html();
			
			$.ajax({
				type: "POST",
				url: "/add?ajaxProcess",
				data: "menu=getAddItemAndGroup_HTML",
				success: function(d){
					var res = $.parseJSON(d);
					if(res.ack == 'success')
					{
						self.addGroup_HTML = res.itemgroup_html;
						self.addItem_HTML = res.item_html;
						
					}
				}
			});
			$(document).on(touchOrClick,'.IG_Up_BTN',function(){
				var MeObj = $(this).parents('.ItemGroup_One');
				var PrevObj = MeObj.prev('.ItemGroup_One');
				
				if(PrevObj.length > 0)
				{
					var PrevHTML = PrevObj[0].outerHTML;
					var MeHTML = MeObj[0].outerHTML;
					
					$(this).parents('.ItemGroup_One').replaceWith(PrevHTML);
					PrevObj.replaceWith(MeHTML);
					
					
				}
			});
			
			$(document).on(touchOrClick,'.IG_Down_BTN',function(){
				var MeObj = $(this).parents('.ItemGroup_One');
				var NextObj = MeObj.next('.ItemGroup_One');
				
				if(NextObj.length > 0)
				{
					var NextHTML = NextObj[0].outerHTML;
					var MeHTML = MeObj[0].outerHTML;
					
					$(this).parents('.ItemGroup_One').replaceWith(NextHTML);
					NextObj.replaceWith(MeHTML);
					
					
				}
			});
			
			
			
			
			$(document).on("change",".Item_Pic_Inp",function(){
				if(this.files && this.files[0])
				{
					var obj = $(this);
					var reader = new FileReader();

					reader.onload = function (e) {
						obj.parents(".Item_One").find(".Item_Pic_Box").html('<img class="IP_IMG" src="'+e.target.result+'" />');
						
					};
					reader.readAsDataURL(this.files[0]);
					
				}
			});
			$(document).on(touchOrClick,'.Item_Pic_Box',function(){
				$(this).parents('.Item_One').find('.Item_Pic_Inp').click();
			});
			$(document).on(touchOrClick,'.I_Edit_BTN,.ItemD_Close_Box',function(){
				$(this).parents(".Item_One").find(".Item_Detail").slideToggle();
			});
			
			$(document).on(touchOrClick,'.IG_List_BTN',function(){
				$(this).parents('.ItemGroup_One').find('.ItemGroup_ItemList_Box').slideToggle();
			});
			$(document).on(touchOrClick,'.IG_Activate_BTN',function(){
				var Obj = $(this).find('i');
				if(Obj.hasClass('fa-eye'))
					Obj.switchClass( "fa-eye", "fa-eye-slash", 1000, "easeInOutQuad" );
				else
					Obj.switchClass( "fa-eye-slash", "fa-eye", 1000, "easeInOutQuad" );
			});
			
			$(document).on(touchOrClick,'.I_Activate_BTN',function(){
				var Obj = $(this).find('i');
				if(Obj.hasClass('fa-eye'))
					Obj.switchClass( "fa-eye", "fa-eye-slash", 1000, "easeInOutQuad" );
				else
					Obj.switchClass( "fa-eye-slash", "fa-eye", 1000, "easeInOutQuad" );
			});
		
			$(document).on(touchOrClick,'.I_Delete_BTN',function(){
				var Obj = $(this).parents('.Item_One');
				timconfirm("<?php echo $this->_Lang_general['confirm'];?>","<?php echo $this->_Lang_general['confirm_delete'];?>",function(){
					
					Obj.slideUp(100,function(){
						$(this).remove();
						if($(".Item_One").length == 0)
						{
							$("#Item_Box").html(self.noGroupAdded_Text);
						}
					});
					
				});
			});
			
			$(document).on(touchOrClick,'.IG_Delete_BTN',function(){
				var Obj = $(this).parents('.ItemGroup_One');
				timconfirm("<?php echo $this->_Lang_general['confirm'];?>","<?php echo $this->_Lang_general['confirm_delete'];?>",function(){
					
					Obj.slideUp(100,function(){
						$(this).remove();
						if($(".ItemGroup_One").length == 0)
						{
							$("#ItemGroup_Box").html(self.noGroupAdded_Text);
						}
					});
					
				});
			});

			$(document).on(touchOrClick,'#AddItemGroup_BTN',function(){
				if($(".ItemGroup_One").length == 0)
				{
					$("#ItemGroup_Box").html("");
				}
				
				$("#ItemGroup_Box").append(self.addGroup_HTML);
			});
			
			$(document).on(touchOrClick,'#AddItem_BTN',function(){
				
				if($(".Item_One").length == 0)
				{
					$("#Item_Box").html("");
				}
				
				$("#Item_Box").append(self.addItem_HTML);
				
				
				
			});
		};
		
	};
	
	var Address = new function(){
		this.Keyword = "";
		this.Keyword_New = "";
		this.delayTimer = 0;
		this.delayTime = 1000;
		
		this.init = function(){
			var Self = this;
			var Timer = null;
			
			
			$(document).on('focus','#SearchAddr_INP',function(){
				clearInterval(Timer);
				Timer = setInterval(function(){
					Self.Keyword = $('#SearchAddr_INP').val();
					if(Self.Keyword != "")
					{
						
						if(Self.Keyword_New != Self.Keyword)
						{
							Self.Search();
							Self.Keyword_New = Self.Keyword;
						}
					}
					else
						Self.reset();
				},200);
			});
			
			
			$(document).on(touchOrClick,'#Address_Search_Box div',function(){
				$("#Address1_INP").val($(this).text());
				$("#Card_Address1_SPN").text($(this).text());
				$("#SearchAddr_INP").val("");
				Self.reset();
			});
			
			
		};
		
		this.reset = function(){
			$("#Address_Search_Box").html("");
		};
		
		this.Search = function(){
			var Self = this;
			this.Delay(function(){
				$('#searchingAddressIdea').show();
				$.ajax({
					type: "POST",
					url: "/add?ajaxProcess",
					data: "menu=getAddressIdea&K="+Self.Keyword,
					success: function(d){
						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{
							$("#Address_Search_Box").html(res.html);
							
						}
						$('#searchingAddressIdea').hide();
					}
				});
			},this.delayTime);
		};
		
		this.Delay = function(callback,ms){
			clearTimeout (this.delayTimer);
			this.delayTimer = setTimeout(callback, ms);
		};
	};
	
	function Editor()
	{
		
		CKEDITOR.replace( 'StoreDescLong_INP', {
			extraAllowedContent : 'img[src,alt,width,height]',
			language: '<?php echo (__langID__ == 1 ? 'ko':'');?><?php echo (__langID__ == 3 ? 'ja':'');?>',
			extraPlugins: 'burugodescimage',
			toolbar:[
				
				{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo' ] },
				{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'] },
				{ name: 'insert', items: [ 'BurugoDescImage','Table', 'HorizontalRule', 'SpecialChar', 'PageBreak' ] },
				{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
				{ name: 'styles', items: [ 'Font', 'FontSize' ] },
				{ name: 'colors', items: [ 'TextColor', 'BGColor' ] }
			]
			
		});
		
	}
	
</script>
<?php

echo $this->Load->View('www/inc/left_tab.tpl',array(
	"PG"=> (isset($Left_Menu) ? $Left_Menu : "dashboard")
));

?>


<div class="Front_Contents_Body Cover">
	<div id="Top_Box" class="Cover">
		<?php echo $this->_Lang_ceo_business['business_burume_card'].' '.(isset($Business['B']) ? $this->_Lang_general['edit'] : $this->_Lang_ceo_business['create'] );?>
	</div>
	<div class="Contents_Box_Wrap">
		<div class="Contents_Box_One Glow">
			<div class="CBox_Title"><span><?php echo $this->_Lang_ceo_business['default_info'];?></span></div>
			<div class="CBox_Body">
				<div class="Box_Row">
					<div class="Card_One Glow">
						<div id="Card_Pic_Main" class="Card_Pic Glow C_Comon" data-picaddtid="1" data-tooltip="사진 업로드"><?php echo (isset($Business['B'][0]['MainImage']) ? '<img src="/Template/Img/CData/'.$this->login->_customerID.'/B/'.$Business['B'][0]['Store_ID'].'/MainImg/'.$Business['B'][0]['MainImage'].'" />' : $this->_Lang_ceo_business['create'] );?></div>
						
								
						<div class="hidden">
							<input type="file" class="CardPic_Inp" data-picaddtid="1" />
						</div>
						<div class="Card_BusinessName C_Comon"><span id="CN_BusinessName"><?php echo (isset($Business['B']) ? $Business['B'][0]['Store_Name'] : '부르고 주식회사');?></span></div>
						<div id="Card_OwnerName" class="C_Comon"><?php echo (isset($Business['B']) ? $Business['B'][0]['Store_OwnerName'] : '대표이사 / 홍길동');?></div>
						<div id="Card_ContactNumber" class="C_Comon"><?php echo (isset($Business['B']) ? $Business['B'][0]['Store_ContactNumber'] : '010-1234-5678');?></div>
						<div class="Card_Address C_Comon">
							<span style="color:#737373;font-weight:bold;font-style:italic;">찾아오시는길</span><br />
							<span id="Card_Address1_SPN"><?php echo (isset($Business['B']) ? $Business['B'][0]['Store_Address1'] : '서울 강남구 테헤란로 0길 0');?></span> <span id="Card_Address2_SPN"><?php echo (isset($Business['B']) ? $Business['B'][0]['Store_Address2'] : '부르고 빌딩 1092호');?></span>
						</div>
						<div class="Card_Menu C_Comon">
							<div class="CM_Icon_One CMI_Phone Glow" data-tooltip="연락처"><i class="fa fa-phone"></i></div>
							<div class="CM_Icon_One CMI_Chat Glow" data-tooltip="채팅"><i class="fa fa-commenting-o"></i></div>
							<div class="CM_Icon_One CMI_Map Glow" data-tooltip="위치"><i class="fa fa fa-map-o"></i></div>
							<div class="CM_Icon_One CMI_Detail Glow" data-tooltip="자세히"><i class="fa fa-folder-open-o"></i></div>
						</div>
						<div id="Card_ShortD" class="C_Comon">
							<p id="Card_ShortD_Contents"><?php echo (isset($Business['B']) ? $Business['B'][0]['Store_ShortDesc'] : '간략한 소개글');?></p>
						</div>
					</div>
					<div class="Box_Desc">
						비지니스 명함 미리보기 화면 입니다. 손님들에게 처음으로 보여지게 되는 카드인만큼 형식에 맞게 예쁘게 꾸며 보세요.
					</div>
				</div>
				<div class="Box_Row">
					<div class="Box_Title"><b>*</b><?php echo $this->_Lang_ceo_business['business_name'];?></div>
					<div class="Box_Field">
						<input class="must rapidUpdate_Card" data-target="CN_BusinessName" id="StoreName_INP" data-submit="true" type="text" value="<?php echo (isset($Business['B']) ? $Business['B'][0]['Store_Name'] : '');?>" placeholder="<?php echo $this->_Lang_ceo_business['business_name_ex'];?>" />
					</div>
				</div>
				
				<div class="Box_Row">
					<div class="Box_Title"><b>*</b><?php echo $this->_Lang_ceo_business['ceo_name'];?></div>
					<div class="Box_Field">
						<input type="text" class="must rapidUpdate_Card" data-target="Card_OwnerName" id="StoreOwnerName_INP" value="<?php echo (isset($Business['B']) ? $Business['B'][0]['Store_OwnerName'] : '');?>" data-submit="true" placeholder="<?php echo $this->_Lang_ceo_business['ceo_name_ex'];?>" />
					</div>
				</div>
				
				<div class="Box_Row">
					<div class="Box_Title"><b>*</b>연락처</div>
					<div class="Box_Field">
						<input class="must rapidUpdate_Card" data-target="Card_ContactNumber" id="StoreContactNumber_INP" data-submit="true" type="text" value="<?php echo (isset($Business['B']) ? $Business['B'][0]['Store_ContactNumber'] : '');?>" placeholder="예) 010-1234-5678" />
					</div>
				</div>
				
				
				
				
				<div class="Box_Row">
					<div class="Box_Title"><?php echo $this->_Lang_ceo_business['business_address'];?><span id="searchingAddressIdea"><img src="/Template/Img/ajax-loader-1.gif" /></span></div>
					<div class="Box_Field">
						<div class="w100">
							<input id="SearchAddr_INP" type="text" placeholder="<?php echo $this->_Lang_ceo_business['business_address_ex'];?>" />
						</div>
						<div class="w100" id="Address_Search_Box_Wrap">
							<div class="w100" id="Address_Search_Box"></div>
						</div>
						<div class="w100">
							<input class="must rapidUpdate_Card" data-target="Card_Address1_SPN" type="text" data-submit="true" value="<?php echo (isset($Business['B']) ? $Business['B'][0]['Store_Address1'] : '');?>" data-tooltip="<?php echo $this->_Lang_ceo_business['business_address_1_tooltip'];?>" id="Address1_INP" placeholder="<?php echo $this->_Lang_ceo_business['business_address_1_ex'];?>" />
							<input class="must rapidUpdate_Card" data-target="Card_Address2_SPN" type="text" id="Address2_INP" value="<?php echo (isset($Business['B']) ? $Business['B'][0]['Store_Address2'] : '');?>" data-submit="true" placeholder="<?php echo $this->_Lang_ceo_business['business_address_2_ex'];?>" />
						</div>
					</div>
					<div class="Box_Desc">
						<?php echo $this->_Lang_ceo_business['business_address_desc'];?>
					</div>
				</div>
				
				
				<div class="Box_Row">
					<div class="Box_Title"><b>*</b><?php echo $this->_Lang_ceo_business['main_pic'];?></div>
					<div class="Box_Field">
						<div id="FrontImage_BTN" class="Image_Frame">
							<?php
							
							if(isset($Business['B'][0]['MainImage']))
								echo '<img src="/Template/Img/CData/'.$this->login->_customerID.'/B/'.$Business['B'][0]['Store_ID'].'/MainImg/'.$Business['B'][0]['MainImage'].'" />';
							else
								echo '<i class="fa fa-file-image-o"></i> '.$this->_Lang_ceo_business['upload'].'(+)';
							?>
						</div>
						<input id="FrontImage_TMP_INP" type="file" />
					</div>
				</div>
				
				<div class="Box_Row">
					<div class="Box_Title"><?php echo $this->_Lang_ceo_business['short_desc'];?></div>
					<div class="Box_Field">
						<input type="text" class="rapidUpdate_Card" data-target="Card_ShortD_Contents" value="<?php echo (isset($Business['B']) ? $Business['B'][0]['Store_ShortDesc'] : '');?>" id="StoreShortDesc_INP" data-submit="true" placeholder="<?php echo $this->_Lang_ceo_business['short_desc_ex'];?>" />
					</div>
					<div class="Box_Desc">
						<?php echo $this->_Lang_ceo_business['short_desc_desc'];?>
					</div>
				</div>
				
				<div class="Box_Row">
					<div class="Box_Title"><b>*</b><?php echo $this->_Lang_ceo_business['seo_url'];?><span id="SEOUrl_DupResult"></span></div>
					<div class="Box_Field">
						<input class="must" type="text" id="SEOUrl_INP" data-submit="true" value="<?php echo (isset($Business['B']) ? $Business['B'][0]['Store_URL'] : '');?>" placeholder="<?php echo $this->_Lang_ceo_business['seo_url_ex'];?>" />
					</div>
					<div class="Box_Desc">
						<?php echo $this->_Lang_ceo_business['seo_url_desc'];?>
					</div>
				</div>
				
				<div class="Box_Row">
					<div class="Box_Title"><b>*</b><?php printf($this->_Lang_ceo_business['keyword_to_call'],'(<b id="CurrentKeyword_Count">0</b>/10)');?></div>
					<div class="Box_Field">
						<div id="BusinessKeyword_Box"><?php
							if(isset($Business['B']))
							{
								foreach($Business['B'][0]['BusinessKeywords'] AS $BusinessKeywords_F)
								{
									if($BusinessKeywords_F['Keyword_Activated'] == 1)
										echo '<div class="StoreKeyword"><div class="SK_Text">'.$BusinessKeywords_F['Keyword'].'</div><div class="SKDelete_BTN"><i class="fa fa-times-circle"></i></div></div>';
								}
							}
						?></div>
						<div class="w100">
							<input id="BusinessKeyword_INP" type="text" placeholder="<?php echo $this->_Lang_ceo_business['keyword_ex'];?>" />
						</div>
						<div class="w100">
							<button class="Button_1 Glow" id="AddBusinessKeyword_Btn"><i class="fa fa-plus-circle"></i> <?php echo $this->_Lang_ceo_business['add_keyword'];?></button> <span style="color:gray;margin-left:5px;"><i class="fa fa-keyboard-o"></i> <?php echo $this->_Lang_ceo_business['can_enter'];?></span>
						</div>
					</div>
					
					<div class="Box_Desc">
						 <?php echo $this->_Lang_ceo_business['keyword_desc'];?>
					</div>
				</div>
				
				
				
				
			</div>
		</div>
		
	
	
	
		<div class="Contents_Box_One Glow">
			<div class="CBox_Title"><span><?php echo $this->_Lang_ceo_business['detail_info'];?></span></div>
			<div class="CBox_Body">
				
				<div class="Box_Row">
					<div class="Box_Title"><?php echo $this->_Lang_ceo_business['long_desc'];?></div>
					<div class="Box_Field GC_Editor_Wrap">
						<div>
							<div class="DescImg_Upload">
								<input id="DescImage_TMP_INP" class="hidden" type="file" />
							</div>
						</div>
						<div class="w100">
							<textarea id="StoreDescLong_INP" class="GC_Editor"><?php echo (isset($Business['B']) ? $Business['B'][0]['Store_Desc'] : '');?></textarea>
						</div>
					</div>
					
				</div>
				
				
				<div class="Box_Row">
					<div class="Box_Title"><?php echo $this->_Lang_ceo_business['b_hours'];?></div>
					<div class="Box_Field">
						<div class="SLT_Box clearB noSelect" id="BusinessHours_SLT" data-value="-1">
							<div class="SLT_Selected">
								<div class="SLT_Selected_Text"><?php echo $this->_Lang_general['select'];?></div>
								<i class="fa fa-caret-down SLT_DropDown"></i>
							</div>
							<div class="SLT_Lists">
								<div class="SLT_List_One Glow" data-value="-1"><?php echo $this->_Lang_general['select'];?></div>
								<div class="SLT_List_One Glow" data-value="1"><?php echo $this->_Lang_general['sunday'];?></div>
								<div class="SLT_List_One Glow" data-value="2"><?php echo $this->_Lang_general['monday'];?></div>
								<div class="SLT_List_One Glow" data-value="3"><?php echo $this->_Lang_general['tuesday'];?></div>
								<div class="SLT_List_One Glow" data-value="4"><?php echo $this->_Lang_general['wednesday'];?></div>
								<div class="SLT_List_One Glow" data-value="5"><?php echo $this->_Lang_general['thursday'];?></div>
								<div class="SLT_List_One Glow" data-value="6"><?php echo $this->_Lang_general['friday'];?></div>
								<div class="SLT_List_One Glow" data-value="7"><?php echo $this->_Lang_general['saturday'];?></div>
							</div>
						</div>
						<div>
							<button id="AddHours_BTN" class="Button_1 Glow"><i class="fa fa-clock-o"></i> <?php echo $this->_Lang_ceo_business['add_hours'];?></button>
						</div>
						
						<div id="OpenHours_Box">
						<?php
							echo $Business_Hours_HTML;
						?>
						</div>
						
					</div>
					<div class="Box_Desc">
						<?php echo $this->_Lang_ceo_business['b_hours_desc'];?>
					</div>
				</div>
				
				
				
				
				
			</div>
		</div>
		

		<div class="Contents_Box_One Glow">
			<div class="CBox_Title"><span><?php echo $this->_Lang_ceo_business['item_product'];?></span></div>
			<div class="CBox_Body">
				<div class="Box_Row">
					<div class="Box_Title"><?php echo $this->_Lang_ceo_business['item_name'];?></div>
					<div class="Box_Field">
						<input type="text" placeholder="<?php echo $this->_Lang_ceo_business['item_name_ex'];?>" id="ItemTitle_INP" data-submit="true" />
					</div>
					<div class="Box_Desc">
						<?php echo $this->_Lang_ceo_business['item_name_desc'];?>
					</div>
				</div>
				<div class="Box_Row">
					<div class="Box_Title"><?php echo $this->_Lang_general['category'];?></div>
					<div class="Box_Field">
						<button class="Button_1 Glow" id="AddItemGroup_BTN"><i class="fa fa-folder"></i> <?php echo $this->_Lang_ceo_business['add_category'];?></button>
					</div>
					<div class="Box_Desc">
						<?php echo $this->_Lang_ceo_business['add_category_desc'];?>
					</div>
					<div class="Box_Field">
						<div id="ItemGroup_Header" class="ItemAndGroup_Header">
							<div class="col1"><?php echo $this->_Lang_ceo_business['group_name'];?></div>
							<div class="col2"><?php echo $this->_Lang_general['menu'];?></div>
						</div>
						<div id="ItemGroup_Box" class="ItmAndGrp_Box">
							<div class="noGroup"><?php echo (isset($ItemGroup_HTML) ? $ItemGroup_HTML : $this->_Lang_ceo_business['no_category_added']);?></div>
						</div>
					</div>
				</div>
					
				<div class="Box_Row">
					<div class="Box_Title"><?php echo $this->_Lang_ceo_business['item_product'];?></div>
					<div class="Box_Field">
						<button class="Button_1 Glow" id="AddItem_BTN"><i class="fa fa-cubes"></i> <?php echo $this->_Lang_ceo_business['add_item_category'];?></button>
					</div>
					<div class="Box_Desc">
						
					</div>
					<div class="Box_Field">
						<div id="Item_Header" class="ItemAndGroup_Header">
							<div class="col1"><?php echo $this->_Lang_ceo_business['item_name2'];?></div>
							<div class="col2"><?php echo $this->_Lang_general['menu'];?></div>
						</div>
						<div id="Item_Box" class="ItmAndGrp_Box">
							<div class="noGroup"><?php echo $this->_Lang_ceo_business['add_item_to_sell'];?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
	<div id="Submit_Box"><button class="Button_1 Glow" id="Submit_BTN"><i class="fa fa-send"></i> <?php echo (isset($Business['B']) ? $this->_Lang_ceo_business['save_btn'] : $this->_Lang_ceo_business['register_btn']);?></button></div>
			
</div>
		
