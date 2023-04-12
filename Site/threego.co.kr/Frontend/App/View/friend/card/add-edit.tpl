<script type="text/javascript">
	<?php
	if(isset($Card))
	{
		echo 'var Card_ID = "'.$Card['Card_ID'].'";';
	}
	?>
	$(document).ready(function(){
		PreviewCard.init();
		CardPic.init();
		BusinessKeyword.init();
		Submit.init();
		
		$("#Religion_SLT").GGoRokSelect(
			<?php echo (isset($Card) ? "{'initValue' : '".$Card['Friend_Religion']."'}" : '');?>
		);
		
		$("#Gender_SLT").GGoRokSelect(
			<?php echo (isset($Card) ? "{'initValue' : '".$Card['Friend_Gender']."'}" : '');?>
		);
		
		
		
		$("#ReligionImp_SLT").GGoRokSelect(
			<?php echo (isset($Card) ? "{'initValue' : '".$Card['Friend_ReligionImp']."'}" : '');?>
		);
		
		$("#GenderImp_SLT").GGoRokSelect(
			<?php echo (isset($Card) ? "{'initValue' : '".$Card['Friend_GenderImp']."'}" : '');?>
		);
		
		$("#CurrentStatus_SLT").GGoRokSelect({
			'onSelect' : function(O){
				if(O.getValue() != -1)
				{
					$("#CN_Status").html('( '+$("#CurrentStatus_SLT").find('.SLT_Selected_Text').html()+' )');
				}
			}
			
			<?php echo (isset($Card) ? ",'initValue' : '".$Card['Friend_Relationship']."'" : '');?>
			
		});
		
		$("#BDayY_SLT").GGoRokSelect(function(){
			
		});
		
		$("#BDayM_SLT").GGoRokSelect(function(){
			
		});
		
		$("#BDayD_SLT").GGoRokSelect(function(){
			
		});
		
		
		
		
		
		
		
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
			
			
			
			
			var i = 0;
			args['CardKeywords_INP'] = {};
			$('.SearchKeyword').each(function(){
				args['CardKeywords_INP'][i] = $(this).find('.SK_Text').text();
				i++;
			});
			
			
			
			
			$(".CardPic_Inp").each(function(){
				if($(this) != "")
				{
					var ImgFile = $(this)[0];
					if(typeof ImgFile.files[0] != "undefined")
						FormGroup.append('CardPics'+$(this).data('picaddtid'),ImgFile.files[0]);
				}
			});
			
			FormGroup.append('menu','saveCard');
			if(typeof Card_ID != "undefined")
				args['Card_ID'] = Card_ID;
			
			var i = 0;
			
				
			FormGroup.append('Args',JSON.stringify(args));
			
			
			
			
			$.ajax({
				type: "POST",
				url: "/card?ajaxProcess",
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
						
						if(typeof Card_ID != "undefined")
						{
							showSideMSGBox('<i class="fa fa-info-circle"> <?php echo $this->_Lang_ceo_business['save_completed'];?>','msgBox_One_1');
						}
						else
						{
							showSideMSGBox('<i class="fa fa-info-circle"> <?php echo $this->_Lang_ceo_business['register_completed'];?>','msgBox_One_1');
							window.location = '/card';
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
				$("#SearchKeyword_Box").html(this.noKeywordMSG);
			
			$(document).on(touchOrClick,"#AddBusinessKeyword_Btn",function(){
				self.addKeyword();
			});
			
			
			$(document).on(touchOrClick,".SKDelete_BTN",function(){
				var obj = $(this);
				timconfirm("<?php echo $this->_Lang_general['confirm'];?>","<?php echo $this->_Lang_general['confirm_delete'];?>",function(){
					obj.parents('.SearchKeyword').fadeOut().remove();
					if($(".SearchKeyword").length == 0)
					{
						$("#SearchKeyword_Box").html(self.noKeywordMSG);
					}
					self.refreshCurrentKeyword();
				});
			});
			$(document).on("keyup","#SearchKeyword_INP",function(e){
				if(e.which == 13)
				{
					self.addKeyword();
				}
			});
		};
		
		this.addKeyword = function(){
			var self = this;
			
			if(self.maximum_keyword == self.current_keyword)
			{
				showSideMSGBox('<i class="fa fa-info-circle"> <?php echo $this->_Lang_ceo_business['err_keyword_maximum_1'];?> '+self.maximum_keyword+'<?php echo $this->_Lang_ceo_business['err_keyword_maximum_2'];?>','msgBox_One_2');
			}
			else
			{
				if(!self.isDupicated())
				{
					if($("#SearchKeyword_INP").val() != "")
					{
						$("#NoKeywordMSG").remove();
						$("#SearchKeyword_Box").append('<div class="SearchKeyword"><div class="SK_Text">'+$("#SearchKeyword_INP").val()+'</div><div class="SKDelete_BTN"><i class="fa fa-times-circle"></div></div>');
						self.refreshCurrentKeyword();
						$("#SearchKeyword_INP").val("");
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
			this.current_keyword = $(".SearchKeyword").length;
			$("#CurrentKeyword_Count").text(this.current_keyword);
		};
		
		this.isDupicated = function(){
			var isDuplicated = false;
			$(".SearchKeyword").each(function(){
				if($(this).find('.SK_Text').text() == $("#SearchKeyword_INP").val())
					isDuplicated = true;
			});
			
			return isDuplicated;
		};
	
	};
	
	
	
	var CardPic = new function(){
		this.init = function(){
			
			$(document).on(touchOrClick,'.Card_Pic',function(){
				$('.CardPic_Inp[data-picaddtid='+$(this).data('picaddtid')+']').click();
			});
			
			$(document).on("change",".CardPic_Inp",function(){
				var obj = $(this);
				if(this.files && this.files[0])
				{
					var reader = new FileReader();

					reader.onload = function (e) {
						$(".Card_Pic[data-picaddtid="+obj.data('picaddtid')+"]").html('<img class="CardPic_Img" src="'+e.target.result+'" />');
					};
					reader.readAsDataURL(this.files[0]);
					
				}
			});
			
			
			
		};
	}
</script>

<style type="text/css">
	
	.Front_Contents_Body{background-image:url("/Template/Img/ceo-olympic-bg.png");padding: 0 30px;}
	.Contents_Box_Wrap{margin-top:30px;}
	.Card_One{width:360px;height:200px;border-radius:10px;background-color:white;border:1px solid #e5e6e9;position:relative;overflow:hidden;float:none;margin-left:auto;margin-right:auto;margin-bottom:15px;}
	.Card_One:hover{border:1px solid #d5d5d8;}
	.Card_One input[type=text]{width:100%;box-sizing:border-box;border:0;background-color:transparent;height:25px;padding-left:10px;padding-right:10px;}
	.Card_One .C_Comon{position:absolute;}
	.Card_One .Card_Pic img{width:100%;height:100%;}
	.Card_One .Card_Pic_Main{background-color:#f6f7f8;width:80px;height:80px;border-radius:5px;left:10px;top:10px;text-align:center;color:gray;text-align:center;line-height:80px;font-size:12px;cursor:pointer;overflow:hidden;}
	.Card_One .Card_Pic_Main:hover{background-color:#ededed;}
	.Card_One .Card_Pic_Addt{height:35px;width:290px;top:95px;left:10px;}
	.Card_One .Card_Pic_Addt_One{background-color:#f6f7f8;height:100%;width:35px;margin-right:6px;border-radius:5px;text-align:center;line-height:35px;cursor:pointer;overflow:hidden;}
	.Card_One .Card_Pic_Addt_One span{opacity:0;}
	.Card_One .Card_Pic_Addt_One:hover span{opacity:1;}
	.Card_One .Card_Name{width:190px;left:100px;border-radius:2px;top:17px;line-height:25px;font-weight:bold;max-height:54px;overflow:hidden;}
	.Card_One .Card_Name #CN_Name{font-size:23px;color:#36a7db;}
	.Card_One .Card_Name #CN_Status{color:#747474;font-size:12px;}
	.Card_One .Card_Age{width:100px;left:100px;border-radius:2px;top:60px;font-size:11px;color:#bd6565;}
	.Card_One .Card_Menu{width:60px;right:0;top:0;height:200px;background-color:white;background-color:#f0f0f0;}
	.Card_One .CM_Icon_One{width:40px;height:40px;background-color:white;font-size:20px;text-align:center;line-height:40px;margin-left:10px;border-radius:5px;margin-top:8px;color:white;cursor:pointer;}
	.Card_One .CMI_Phone{background-color:#71cbf5;}
	.Card_One .CMI_Chat{background-color:#6cc5ee;}
	.Card_One .CMI_Map{background-color:#43a6d4;}
	.Card_One .CMI_Detail{background-color:#2d95c6;}
	.Card_One #Card_ShortD{padding-bottom:10px;padding-top:10px;left:10px;top:140px;border-left:5px solid #f6f7f8;padding-left:10px;color:#8a8a8a;max-width:260px;}
	.Card_One #Card_ShortD p{overflow:hidden;max-height:30px;line-height:15px;}
	.Card_One .CM_Icon_One:hover{background-color:#616161;color:white;}
	
	.Box_Row{width:100%;border-bottom:1px dotted #c8c8c8;padding-top:15px;padding-bottom:15px;}
	.Box_Row .Box_Title{width:100%;line-height:20px;}
	.Box_Row .Box_Title b{color:#e02f2f;margin-right:3px;}
	.Box_Row .Box_Title span{color:#aaaaaa;}
	.Box_Row .Box_Field{width:100%;margin-top:10px;}
	.Box_Row .Box_Field input[type=text],
	.Box_Row .Box_Field textarea{width:100%;border:1px solid #929292;margin:0;padding:10px;box-sizing:border-box;font-size:14px;margin-bottom:5px;}
	.Box_Row .Box_Desc{width:100%;color:#999999;margin-top:10px;line-height:20px;}
	
	.CardPic_Img{width:100%;height:100%;}
	#BDayY_SLT,#BDayM_SLT,#BDayD_SLT{min-width:150px;margin-right:5px;}
	#Submit_Box{width:100%;max-width:1430px;padding-bottom:100px;clear:both;}
	#Submit_Box button{width:100%;height:40px;font-size:14px;}
	#Top_Box{background-image: url("/Template/Img/ceo-add-top-bg.jpg");color: white;float: none;font-size: 30px;height: 138px;line-height: 138px;margin-left: auto;margin-right: auto;max-width: 1430px;min-width: 350px;text-align: center;width: 100%;}
	#Religion_SLT,#Gender_SLT{margin-right:10px;}
	#SearchKeyword_Box{
		border: 1px dotted gray;
		border-radius: 5px;
		box-sizing: border-box;
		color: gray;
		padding: 20px;
		width: 100%;
		margin-bottom:10px;
	}
	
	.SearchKeyword{padding-left:10px;padding-right:10px;height:25px;line-height:25px;background-color:#b8e5ff;border-radius:5px;position:relative;cursor:default;border:3px dotted #82c3e9;color:#004b76;margin-right:10px;margin-bottom:10px;}
	.SearchKeyword:hover .SKDelete_BTN{display:block;}
	.SearchKeyword i{color:#3f3f3f;}
	.SearchKeyword .SKDelete_BTN{display:none;cursor:pointer;line-height:25px;height:25px;font-size:16px;margin-left:5px;}
	
</style>

<div class="Front_Contents_Body Cover">
	<div class="Cover" id="Top_Box"> 프렌드 명함 <?php echo (isset($Card) ? $this->_Lang_general['edit'] : $this->_Lang_ceo_business['create'] );?></div>
	<div class="Contents_Box_Wrap">
		<div class="Contents_Box_One Glow">
			<div class="CBox_Title"><span>기본정보</span></div>
			<div class="CBox_Body">
				<div class="Box_Row">
					<div class="Card_One Glow">
						<div class="Card_Pic Card_Pic_Main Glow C_Comon" data-picaddtid="1" data-tooltip="사진 업로드"><?php echo (isset($Card['CardPics'][0]) ? '<img src="/Template/Img/CData/'.$this->login->customers_id.'/F/'.$Card['Card_ID'].'/CardImg/'.$Card['CardPics'][0].'" />' : '사진');?></div>
						<div class="Card_Pic_Addt C_Comon">
							<div class="Card_Pic Card_Pic_Addt_One" data-picaddtid="2" data-tooltip="추가사진"><?php echo (isset($Card['CardPics'][1]) ? '<img src="/Template/Img/CData/'.$this->login->customers_id.'/F/'.$Card['Card_ID'].'/CardImg/'.$Card['CardPics'][1].'" />' : '<span class="Glow">+</span>');?></div>
							<div class="Card_Pic Card_Pic_Addt_One" data-picaddtid="3" data-tooltip="추가사진"><?php echo (isset($Card['CardPics'][2]) ? '<img src="/Template/Img/CData/'.$this->login->customers_id.'/F/'.$Card['Card_ID'].'/CardImg/'.$Card['CardPics'][2].'" />' : '<span class="Glow">+</span>');?></div>
							<div class="Card_Pic Card_Pic_Addt_One" data-picaddtid="4" data-tooltip="추가사진"><?php echo (isset($Card['CardPics'][3]) ? '<img src="/Template/Img/CData/'.$this->login->customers_id.'/F/'.$Card['Card_ID'].'/CardImg/'.$Card['CardPics'][3].'" />' : '<span class="Glow">+</span>');?></div>
							<div class="Card_Pic Card_Pic_Addt_One" data-picaddtid="5" data-tooltip="추가사진"><?php echo (isset($Card['CardPics'][4]) ? '<img src="/Template/Img/CData/'.$this->login->customers_id.'/F/'.$Card['Card_ID'].'/CardImg/'.$Card['CardPics'][4].'" />' : '<span class="Glow">+</span>');?></div>
							<div class="Card_Pic Card_Pic_Addt_One" data-picaddtid="6" data-tooltip="추가사진"><?php echo (isset($Card['CardPics'][5]) ? '<img src="/Template/Img/CData/'.$this->login->customers_id.'/F/'.$Card['Card_ID'].'/CardImg/'.$Card['CardPics'][5].'" />' : '<span class="Glow">+</span>');?></div>
							<div class="Card_Pic Card_Pic_Addt_One" data-picaddtid="7" data-tooltip="추가사진"><?php echo (isset($Card['CardPics'][6]) ? '<img src="/Template/Img/CData/'.$this->login->customers_id.'/F/'.$Card['Card_ID'].'/CardImg/'.$Card['CardPics'][6].'" />' : '<span class="Glow">+</span>');?></div>
							<div class="Card_Pic Card_Pic_Addt_One" data-picaddtid="8" data-tooltip="추가사진"><?php echo (isset($Card['CardPics'][7]) ? '<img src="/Template/Img/CData/'.$this->login->customers_id.'/F/'.$Card['Card_ID'].'/CardImg/'.$Card['CardPics'][7].'" />' : '<span class="Glow">+</span>');?></div>
						</div>
						<div class="hidden">
							<input type="file" class="CardPic_Inp" data-picaddtid="1" />
							<input type="file" class="CardPic_Inp" data-picaddtid="2" />
							<input type="file" class="CardPic_Inp" data-picaddtid="3" />
							<input type="file" class="CardPic_Inp" data-picaddtid="4" />
							<input type="file" class="CardPic_Inp" data-picaddtid="5" />
							<input type="file" class="CardPic_Inp" data-picaddtid="6" />
							<input type="file" class="CardPic_Inp" data-picaddtid="7" />
							<input type="file" class="CardPic_Inp" data-picaddtid="8" />
						</div>
						<div class="Card_Name C_Comon"><span id="CN_Name"><?php echo (isset($Card) ? $Card['Friend_Name'] : '김부르고');?></span> <span id="CN_Status">( <i class="fa fa-heart-o"></i> 싱글 )</span></div>
						
						<div class="Card_Menu C_Comon">
							<div class="CM_Icon_One CMI_Phone Glow" data-tooltip="<?php echo (isset($Card) ? $Card['Friend_Telephone'] : '연락처');?>"><i class="fa fa-phone"></i></div>
							<div class="CM_Icon_One CMI_Chat Glow" data-tooltip="채팅"><i class="fa fa-commenting-o"></i></div>
							<div class="CM_Icon_One CMI_Map Glow" data-tooltip="위치"><i class="fa fa fa-map-o"></i></div>
							<div class="CM_Icon_One CMI_Detail Glow" data-tooltip="자세히"><i class="fa fa-folder-open-o"></i></div>
						</div>
						<div id="Card_ShortD" class="C_Comon">
							<p id="Card_ShortD_Contents"><?php echo (isset($Card) ? $Card['Friend_ShortDesc'] : '나에 대해 한마디로 표현 한다면?');?></p>
						</div>
					</div>
					<div class="Box_Desc">
						프렌드 명함 미리보기 화면 입니다. 기본사진 및 추가 사진은 이곳에서 업로드 가능합니다. 카드 형식에 맞게 예쁘게 꾸며 보세요.
					</div>
				</div>
				
				<div class="Box_Row">
					<div class="Box_Title"><b>*</b>이름</div>
					<div class="Box_Field">
						<input class="must rapidUpdate_Card" data-target="CN_Name" id="Name_INP" data-submit="true" type="text" value="<?php echo (isset($Card) ? $Card['Friend_Name'] : '');?>" placeholder="예) 김부르고" />
					</div>
					<div class="Box_Desc">
						본인의 실명으로 기재해 주세요. 카드 맨 위 상단, 이름란에 표시 됩니다.
					</div>
				</div>
				
				<div class="Box_Row">
					<div class="Box_Title">현재상태</div>
					<div class="Box_Field">
						<div class="SLT_Box noSelect" id="CurrentStatus_SLT" data-submit="true" data-value="-1">
							<div class="SLT_Selected">
								<div class="SLT_Selected_Text"><?php echo $this->_Lang_general['select'];?></div>
								<i class="fa fa-caret-down SLT_DropDown"></i>
							</div>
							<div class="SLT_Lists">
								<div class="SLT_List_One Glow" data-value="-1"><?php echo $this->_Lang_general['select'];?></div>
								<div class="SLT_List_One Glow" data-value="1"><i class="fa fa-heart-o"></i> 싱글</div>
								<div class="SLT_List_One Glow" data-value="2"><i class="fa fa-heart"></i> 기혼</div>
								<div class="SLT_List_One Glow" data-value="3"><i class="fa fa-superscript"></i> 복잡해요</div>
								<div class="SLT_List_One Glow" data-value="4"><i class="fa fa-user-secret"></i> 비공개</div>
								
							</div>
						</div>
						
					</div>
				</div>
				
				<div class="Box_Row">
					<div class="Box_Title"><b>*</b>연락처</div>
					<div class="Box_Field">
						<input class="must" id="Phone_INP" data-submit="true" type="text" value="<?php echo (isset($Card) ? $Card['Friend_Telephone'] : '');?>" placeholder="예) 010-1234-5678" />
					</div>
					
				</div>
				
				<div class="Box_Row">
					<div class="Box_Title">생년월일</div>
					<div class="Box_Field">
						<div class="SLT_Box noSelect" id="BDayY_SLT" data-submit="true" data-value="-1">
							<div class="SLT_Selected">
								<div class="SLT_Selected_Text">년 (Year)</div>
								<i class="fa fa-caret-down SLT_DropDown"></i>
							</div>
							<div class="SLT_Lists">
								<div class="SLT_List_One Glow" data-value="-1">년 (Year)</div>
								<?php
								$Y = date('Y') - 120;
								for($i = date('Y') ; $i > $Y ; $i--)
								{
									echo '<div class="SLT_List_One Glow" data-value="'.$i.'">'.$i.'년</div>';
								}
								?>
							</div>
						</div>
						
						<div class="SLT_Box noSelect" id="BDayM_SLT" data-submit="true" data-value="-1">
							<div class="SLT_Selected">
								<div class="SLT_Selected_Text">월 (Month)</div>
								<i class="fa fa-caret-down SLT_DropDown"></i>
							</div>
							<div class="SLT_Lists">
								<div class="SLT_List_One Glow" data-value="-1">월 (Month)</div>
								<?php
								for($i = 1 ; $i < 13 ; $i++)
								{
									echo '<div class="SLT_List_One Glow" data-value="'.$i.'">'.$i.'월</div>';
								}
								?>
							</div>
						</div>
						
						<div class="SLT_Box noSelect" id="BDayD_SLT" data-submit="true" data-value="-1">
							<div class="SLT_Selected">
								<div class="SLT_Selected_Text">일 (Day)</div>
								<i class="fa fa-caret-down SLT_DropDown"></i>
							</div>
							<div class="SLT_Lists">
								<div class="SLT_List_One Glow" data-value="-1">일 (Day)</div>
								<?php
								for($i = 1 ; $i < 32 ; $i++)
								{
									echo '<div class="SLT_List_One Glow" data-value="'.$i.'">'.$i.'일</div>';
								}
								?>
							</div>
						</div>
					</div>
					<div class="Box_Desc">
						
					</div>
				</div>
				<div class="Box_Row">
					<div class="Box_Title"><b>*</b><?php printf($this->_Lang_ceo_business['keyword_to_call'],'(<b id="CurrentKeyword_Count">0</b>/10)');?></div>
					<div class="Box_Field">
						<div id="SearchKeyword_Box"><?php
							if(isset($Card))
							{
								foreach($Card['CardKeywords'] AS $CardKeywords_F)
								{
									if($CardKeywords_F['Keyword_Activated'] == 1)
										echo '<div class="SearchKeyword"><div class="SK_Text">'.$CardKeywords_F['Keyword'].'</div><div class="SKDelete_BTN"><i class="fa fa-times-circle"></i></div></div>';
								}
							}
						?></div>
						<div class="w100">
							<input id="SearchKeyword_INP" type="text" placeholder="예) 일본라면 매니아, 박태환 뺨치는 어깨, 영화광" />
						</div>
						<div class="w100">
							<button class="Button_1 Glow" id="AddBusinessKeyword_Btn"><i class="fa fa-plus-circle"></i> <?php echo $this->_Lang_ceo_business['add_keyword'];?></button> <span style="color:gray;margin-left:5px;"><i class="fa fa-keyboard-o"></i> <?php echo $this->_Lang_ceo_business['can_enter'];?></span>
						</div>
					</div>
					
					<div class="Box_Desc">
						 
					</div>
				</div>
				<div class="Box_Row">
					<div class="Box_Title"><b>*</b>자신에 대해 한마디로 표현하면</div>
					<div class="Box_Field">
						<input class="must rapidUpdate_Card" id="ShortDesc_INP" data-target="Card_ShortD_Contents" data-submit="true" type="text" value="<?php echo (isset($Card) ? $Card['Friend_ShortDesc'] : '');?>" placeholder="예) 재즈음악 같이 어디로 튈 줄 모르는 독특한" />
					</div>
					<div class="Box_Desc">
						카드 하단에 표시되며, 다른 사람들에게 가장 처음으로 노출되는 소개글인 만큼 간결하고 유니크한 소개글을 만들어 보세요. 상업적인 광고, 선정성 혹은 타인에게 피해를 끼칠 수 있는 내용이 입력될 경우 카드가 삭제 되거나, 계정의 제재 조치를 당할 수 있습니다.
					</div>
				</div>
				
			</div>
			
		</div>
		
		<div class="Contents_Box_One Glow">
			<div class="CBox_Title"><span>자세한정보</span></div>
			<div class="CBox_Body">
				
				
				
				
				<div class="Box_Row">
					<div class="Box_Title">외모</div>
					<div class="Box_Field">
						<input id="Look_INP" data-submit="true" type="text" value="<?php echo (isset($Card) ? $Card['Friend_Look'] : '');?>" placeholder="예) 대한민국 표준키, 백옥피부, 순정파 만화 주인공 같은" />
					</div>
					<div class="Box_Desc">
						본인의 외모에 대해 표현해 보세요.
					</div>
				</div>
				
				<div class="Box_Row">
					<div class="Box_Title">직업</div>
					<div class="Box_Field">
						<input id="Job_INP" data-submit="true" type="text" value="<?php echo (isset($Card) ? $Card['Friend_Job'] : '');?>" placeholder="예) 전문직 종사, 회사원, 학생" />
					</div>
					<div class="Box_Desc">
						본인이 현재 하고 있는 일에 대해 표현해 주세요. 
					</div>
				</div>
				
				<div class="Box_Row">
					<div class="Box_Title">성격</div>
					<div class="Box_Field">
						<input id="Character_INP" data-submit="true" type="text" value="<?php echo (isset($Card) ? $Card['Friend_Character'] : '');?>" placeholder="예) 차분하지만 호기심 많은, 다정하고 잘 챙겨주는" />
					</div>
					<div class="Box_Desc">
						
					</div>
				</div>
				
				<div class="Box_Row">
					<div class="Box_Title">종교</div>
					<div class="Box_Field">
						<div class="SLT_Box clearB noSelect" id="Religion_SLT" data-submit="true" data-value="-1">
							<div class="SLT_Selected">
								<div class="SLT_Selected_Text"><?php echo $this->_Lang_general['select'];?></div>
								<i class="fa fa-caret-down SLT_DropDown"></i>
							</div>
							<div class="SLT_Lists">
								<div class="SLT_List_One Glow" data-value="-1"><?php echo $this->_Lang_general['select'];?></div>
								<div class="SLT_List_One Glow" data-value="1">종교없음</div>
								<div class="SLT_List_One Glow" data-value="2">기독교</div>
								<div class="SLT_List_One Glow" data-value="3">천주교</div>
								<div class="SLT_List_One Glow" data-value="4">불교</div>
								<div class="SLT_List_One Glow" data-value="5">이슬람교</div>
								<div class="SLT_List_One Glow" data-value="6">힌두교</div>
								<div class="SLT_List_One Glow" data-value="7">기타</div>
							</div>
						</div>
						
						<div class="SLT_Box noSelect" id="ReligionImp_SLT" data-submit="true" data-value="-1">
							<div class="SLT_Selected">
								<div class="SLT_Selected_Text">중요도 선택</div>
								<i class="fa fa-caret-down SLT_DropDown"></i>
							</div>
							<div class="SLT_Lists">
								<div class="SLT_List_One Glow" data-value="-1">중요도 선택</div>
								<div class="SLT_List_One Glow" data-value="1">상관없음</div>
								<div class="SLT_List_One Glow" data-value="2">중요함</div>
							</div>
						</div>
					</div>
					<div class="Box_Desc">
						자세한 정보는 본인이 원하는 친구를 찾는데 더욱 도움이 됩니다. 부르고 서비스가 여러분에게 맞는 친구를 찾을 수 있게 가능한 자세히 많은 정보를 입력해 주세요. 만약 같은 종교의 친구를 찾을 경우 두번째 필드를 꼭 채워 주세요.
					</div>
				</div>
				
				
				
				
				
				<div class="Box_Row">
					<div class="Box_Title">성별</div>
					<div class="Box_Field">
						<div class="SLT_Box noSelect" id="Gender_SLT" data-submit="true" data-value="-1">
							<div class="SLT_Selected">
								<div class="SLT_Selected_Text"><?php echo $this->_Lang_general['select'];?></div>
								<i class="fa fa-caret-down SLT_DropDown"></i>
							</div>
							<div class="SLT_Lists">
								<div class="SLT_List_One Glow" data-value="-1">중요도 선택</div>
								<div class="SLT_List_One Glow" data-value="1">남성</div>
								<div class="SLT_List_One Glow" data-value="2">여성</div>
							</div>
						</div>
						<div class="SLT_Box noSelect" id="GenderImp_SLT" data-submit="true" data-value="-1">
							<div class="SLT_Selected">
								<div class="SLT_Selected_Text">중요도 선택</div>
								<i class="fa fa-caret-down SLT_DropDown"></i>
							</div>
							<div class="SLT_Lists">
								<div class="SLT_List_One Glow" data-value="-1">중요도 선택</div>
								<div class="SLT_List_One Glow" data-value="1">상관없음</div>
								<div class="SLT_List_One Glow" data-value="2">중요함</div>
							</div>
						</div>
					</div>
					<div class="Box_Desc">
						본인의 성별을 선택해 주세요. 찾고자 하는 친구의 성별이 있다면, 두번째 필드에 반드시 중요도를 선택해 주세요.
					</div>
				</div>
			</div>
		</div>
		<div id="Submit_Box"><button class="Button_1 Glow" id="Submit_BTN"><i class="fa fa-send"></i> <?php echo (isset($Business['B']) ? $this->_Lang_ceo_business['save_btn'] : $this->_Lang_ceo_business['register_btn']);?></button></div>
	</div>
</div>