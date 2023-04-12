<style type="text/css">
	.Front_Contents_Body{background-image:url("/Template/Img/ceo-olympic-bg.png");}
	.CardDetailBox_Container{width:1000px;margin-left:auto;margin-right:auto;float:none;}
	.CardDetailBox{width:100%;margin:20px 20px 0 20px;border-radius:5px;border:1px solid #eaeaea;padding:20px;position:relative;}
	.CardDetailBox .C_MImage{width:200px;height:200px;border-radius:10px;overflow:hidden;margin-right:20px;}
	.CardDetailBox .C_MImage img{width:100%;height:100%;}
	.CardDetailBox .C_Left{width:780px;margin-right:20px;}
	.CardDetailBox .C_Right{width:200px;}
	.CardDetailBox .C_Name{font-size:24px;color:#4c4c4c;clear:right;width:100%;margin-bottom:10px;}
	.CardDetailBox .C_ShortDesc{font-size:13px;color:#8b8b8b;width:100%;margin-bottom:10px;}
	.CardDetailBox .C_TelNumber{font-size:13px;font-size:16px;width:100%;line-height:30px;font-weight:bold;color:#5d5d5d;margin-top:10px;}
	.CardDetailBox .C_GInfo{width:540px;margin-right:20px;}
	.CardDetailBox .IcnBox{width:30px;height:30px;line-height:30px;text-align:center;border-radius:5px;background-color:#43a6d4;color:white;margin-right:7px;}
	.CardDetailBox .IcnBox i{cursor:default;}
	.CardDetailBox #C_Map{width:200px;height:200px;background-color:#f6f6f6;border-radius:10px;overflow:hidden;}
	.CardDetailBox .C_Addr{width:100%;line-height:30px;margin-top:10px;font-size:16px;font-weight:bold;}
	.CardDetailBox .C_Addr .Addr1{margin-right:5px;}
	.CardDetailBox .C_Addr .Addr2{margin-left:37px;clear:both;}
	.CardDetailBox .C_OwnerName{width:100%;line-height:30px;font-size:16px;font-weight:bold;margin-top:10px;color:#6f6f6f;}
	
	#BusinessHoursBox{width:300px;background-color:#7f7166;border-radius:5px;padding:10px;box-sizing:border-box;margin-bottom:10px;border:5px solid white;}
	#BusinessHoursBox .BHB_Head{border-bottom:1px dotted #acacac;width:100%;padding-top:5px;padding-bottom:10px;font-size:16px;text-align:center;color:white;margin-bottom:10px;}
	.BH_One{height:25px;line-height:25px;width:100%;color:#ede7e2;text-align:center;}
	.BH_Today{font-weight:bold;color:#ffd585;}
	
	.CardDetailBox #C_LongDesc_Box{all: initial;}
	.DatePicker, .DatePicker div{float:none;}
	.DatePicker .ui-datepicker{font-size:25px;}
	.CardDetailBox #C_LongDesc{display:block;}
	.CardDetailBox #C_LongDesc img{max-width:100%;}
	
	.CardDetailBox #C_Items{display:none;}
	.CardDetailBox .C_Tab{height:35px;line-height:35px;margin-left:10px;width:100%;}
	
	.CardDetailBox .CMC_One{width:100%;min-height:300px;display:none;}
	.CardDetailBox .CMC_Title{width:100%;font-size:18px;margin-bottom:20px;color:#4c4c4c}
	.CardDetailBox .CMC_Desc{width:100%;color:gray;margin-bottom:20px;}
	.CardDetailBox .CMC_Left{width:460px;}
	.CardDetailBox .ItemGroups_Box{width:270px;min-height:300px;border:1px solid white;border-radius:10px;background-color:#afafaf;color:white;overflow:hidden;}
	.CardDetailBox .ItemGroup_One{width:100%;line-height:40px;height:40px;border-bottom:1px dotted #e1e1e1;}
	.CardDetailBox .ItemGroup_One:hover{background-color:#959595;cursor:pointer;}
	.CardDetailBox .ItemGroup_Selected{background-color:#43a6d4!important;}
	.CardDetailBox .IGO_Name{padding-left:10px;}
	.CardDetailBox #Items_Box{width:710px;min-height:300px;margin-left:15px;border-radius:10px;background-color:#ececec;overflow:hidden;}
	.CardDetailBox .LoadingItems,
	.CardDetailBox .noItemsAdded
	{width:100%;text-align:center;line-height:300px;color:gray;font-weight:bold;}
	.CardDetailBox .Item_One{width:100%;line-height:50px;height:50px;background-color:#dedede;border-bottom:1px dotted white;padding-top:5px;padding-bottom:5px;cursor:pointer;}
	.CardDetailBox .Item_One:hover{background-color:#919191;color:white;}
	.CardDetailBox .Item_Img{margin-left:5px;width:50px;height:50px;border-radius:5px;overflow:hidden;color:gray;text-align:center;line-height:50px;background-color:#f6f6f6;}
	
	.CardDetailBox .Item_Img img{width:100%;height:100%;}
	.CardDetailBox .Item_Name{margin-left:10px;width:350px;}
	
	.CardDetailBox .Item_AddCart{padding-left:10px;padding-right:10px;line-height:38px;margin-top:5px;float:right;margin-right:10px;border-radius:10px;background-color:#43a6d4;color:white;border:1px solid white;}
	.CardDetailBox .Item_AddCart i{margin-right:7px;}
	.CardDetailBox .Item_AddCart:hover{background-color:#3496c4;}
	.CardDetailBox .Item_AddCart .fa-shopping-cart{display:inline;}
	.CardDetailBox .Item_AddCart .fa-plus-square{display:none;}
	.CardDetailBox .Item_AddCart:hover .fa-plus-square{display:inline;}
	.CardDetailBox .Item_AddCart:hover .fa-shopping-cart{display:none;}
	.CartItem_One{width:100%;}
	
	.RightIcnMenu{position:absolute;width:60px;right:-60px;top:5px;}
	.RightIcnMenu .RIM_One{height:50px;width:45px;font-size:20px;text-align:center;line-height:50px;cursor:pointer;border-radius:0 20px 20px 0;clear:both;margin-bottom:10px;}
	.RightIcnMenu .RIM_One:hover{width:60px;}
	
	
	.RightIcnMenu .C_Tab_Selected{width:60px!important;background-color:white!important;color:#3b3b3b!important;border-top:1px solid #eaeaea;border-right:1px solid #eaeaea;border-bottom:1px solid #eaeaea;}
	.RightIcnMenu #FlyingShoppingCart{background-color:#43a6d4;color:#05405b;cursor:pointer;position:relative;}
	.RightIcnMenu #FlyingShoppingCart:hover{background-color:#5fb9e3;}
	.RightIcnMenu #C_ChatBtn{background-color:#f2a612;top:65px;color:#543a09;}
	.RightIcnMenu #C_AddFavoriteBtn{background-color:#e75252;top:125px;color:#4b0404;}
	.RightIcnMenu #C_CurrentStatus{top:185px;background-color:#84b409;}
	
	.RightIcnMenu #FSC_QTY{position:absolute;top:-5px;right:-5px;background-color:#cf1111;font-size:10px;width:24px;height:24px;border-radius:12px;line-height:24px;color:white;text-align:center;font-weight:bold;display:none;}
	.RightIcnMenu .C_Tab_One{background-color:#3b3b3b;color:white;}
	.CMC_Right{width:530px;}
	.CMC_Right .ORD_INP{width:180px;height:30px;border-radius:5px;border:1px solid gray;padding:10px;font-size:16px;background-color:white;color:#3e3e3e;}
	.CMC_Right .CMCR_One{width:100%;margin-bottom:20px;}
	.CMC_Right .CMCR_Title{width:100%;margin-bottom:10px;font-weight:bold;color:#474747;border-top:1px dotted #b0b0b0;padding-top:10px;}
	.CMC_Right .CMCR_Field{width:100%;}
	.CMC_Right .TimePickerRow{width:100%;}
	.CMC_Right .TPR_Top{width:100%;}
	.CMC_Right .TPR_Middle{width:100%;}
	.CMC_Right .TPR_Bottom{width:100%;}
	.CMC_Right .OTime_One{width:50px;height:50px;line-height:50px;margin-right:5px;text-align:center;cursor:default;font-size:20px;font-weight:bold;color:#494949;}
	.CMC_Right .OTime_Divider{width:10px;height:50px;line-height:50px;text-align:center;cursor:default;}
	.CMC_Right .OTime_BTN_One{width:50px;height:30px;line-height:30px;margin-right:15px;text-align:center;height:30px;cursor:pointer;border-radius:10px;}
	.CMC_Right .OTime_BTN_One:hover{background-color:#e0f5ff;}
	.CMC_Right .OTime_BTN_One i{font-size:18px;}
	
	.CMC_Right .CMCR_ShortBTN{height:50px;line-height:50px;padding-left:19px;padding-right:19px;background-color:#43a6d4;color:white;border-radius:10px;margin-left:10px;cursor:pointer;}
	.CMC_Right .CMCR_ShortBTN:hover{background-color:#5ebbe6;}
	.CMC_Right #Personnel_Up{font-size:15px;}
	.CMC_Right #Personnel_Down{font-size:15px;}
	.CMC_Right #TimeNow_BTN{margin-left:27px;}
	.CardDetailBox .OrderNow_BTN{padding-left:30px;padding-right:30px;line-height:50px;background-color:#f2a612;color:white;border:0;border-radius:5px;cursor:pointer;font-size:18px;}
	.CardDetailBox .OrderNow_BTN:hover{background-color:#f6b12b;}
	
	.OConfirm_Title{width:100%;}
	.OConfirm_One{width:100%;}
	.OConfirm_Bot{margin-top:10px;}
</style>
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCEmRg5jDJbcvzjEqcfxAoAm4r38r8nEA"></script>
<script type="text/javascript">
	
	var cID = "<?php echo $C['Store_ID'];?>";
	$(document).ready(function(){
		Map.init();
		ContentsTab.init();
		Items.init();
		FlyingCart.init();
		ServiceOrder.init();
		$(document).on(touchOrClick,"#C_AddFavoriteBtn",function(){
			showSideMSGBox("<i class='fa fa-search'></i> 현재 준비중인 서비스 입니다.","msgBox_One_2");
		});
		$(document).on(touchOrClick,"#C_ChatBtn",function(){
			var obj = $(this);
			Chat.createNewChat({
				"cid" : obj.parents('.CardDetailBox').data('cid')
			});
		});
		
		$(document).on(touchOrClick,"#C_CurrentStatus",function(){
			timPopup(
				'<div id="BusinessHoursBox">'+
					'<div class="BHB_Head">'+
						'<i class="fa fa-calendar"></i> 영업시간'+
					'</div>'+
					'<div class="w100">'+
						'<?php echo $BusinessHours;?>'+
					'</div>'+
				'</div>'
			,true);
		});
		
	});
	
	var ServiceOrder = new function(){
		var self = this;
		this.init = function(){
			$.datepicker.setDefaults({
				minDate:'0d',
				dateFormat:'yy-mm-dd'
			},$.datepicker.regional[ "ko" ]);
			$('#ReservationDate_DP').datepicker(
				{
					onSelect: function(dateText) {
						$("#ReservationDate_INP").val(dateText);
						
					}
				}
				
			);
			
			
			$(document).on(touchOrClick,".OrderNow_BTN",function(){
				var obj = $(this);
				self.makeOrder(obj);
			});
			$(document).on(touchOrClick,".ComfortDate_BTN",function(){
				var DP = $('#'+$(this).data('datapicker'));
				var Target = $('#'+$(this).data('target'));
				DP.datepicker("setDate", $(this).data('setdate'));
				Target.val($.datepicker.formatDate('yy-mm-dd',DP.datepicker('getDate')));
			});
			
			$(document).on(touchOrClick,".ComfortTime_BTN",function(){
				var Target = $(this).data('target').split(':');
				var Value = $(this).data('value').split(':');
				var i = 0;
				Target.forEach(function(Item,Inx){
					$("#"+Item).data('value',Value[i]);
					$("#"+Item).text(Value[i]);
					i++;
				});
			});
			
			
			$(document).on(touchOrClick,".IncDec_BTN",function(){
				var Target = $('#'+$(this).data('target'));
				var Current = Target.val();
				var SetValue;
				if($(this).data('type') == "+")
				{
					SetValue = ++Current;
				}
				else
				{
					SetValue = --Current;
				}
				
				if(!(typeof $(this).data('min') != "undefined" && $(this).data('min') > SetValue))
				{
					Target.val(SetValue);
				}
				
					
			});
			
			$(document).on(touchOrClick,".OTime_BTN_One",function(){
				var Target = $('#'+$(this).data('target'));
				var Current = Target.data('value');
				var SetValue;
				
				if(Current == 'AM' || Current == 'PM')
				{
					SetValue = (Current == 'AM' ? 'PM' : 'AM');
				}
				else
				{
					Current = parseInt(Current);
					if($(this).data('type') == "+")
					{
						SetValue = ++Current;
					}
					else
					{
						SetValue = --Current;
					}
					
					if(SetValue > $(this).data('max'))
						SetValue = $(this).data('min');
						
					if(SetValue < $(this).data('min'))
						SetValue = $(this).data('max');
						
					if(SetValue < 10)
					{
						SetValue = '0'+SetValue;
					}
				}
				
				Target.data('value',SetValue);
				Target.text(SetValue);
			});
			
		};
		
		this.makeOrder = function(Button)
		{
			var Confirm_MSG;
			var Confirm_Title;
			var Error_MSG = "";
			var RTime;
			var OK = true;
			var Args = {};
			
			Args['Card_Type'] = $("#CardBox").data("cardtype");
			
			if(Button.data('type') == 'Reservation')
			{
				/* Nothing to Confirm on Reservation */
				
				Args['Mode'] = 'R';
				Args['OReserv_Date'] = $.datepicker.formatDate('yy-mm-dd',$("#ReservationDate_DP").datepicker('getDate'));
				Args['OReserv_Time'] = $("#RTime_H").data('value')+":"+$("#RTime_M").data('value')+" "+$("#RTime_Meridiem").data('value');
				Args['OReserv_Personnel'] = $("#RPersonnel_INP").val();
			}
			
			
			if(OK)
			{
				
				RTime = $("#RTime_H").data('value')+"시 "+$("#RTime_M").data('value')+"분 "+$("#RTime_Meridiem").data('value');
				RPersonel = $("#RPersonnel_INP").val();
				if(Button.data('type') == 'Reservation')
				{
					
					Confirm_Title = '예약확인';
					Confirm_MSG =
						'<div class="OConfirm_Title"></div>'+
						'<div class="OConfirm_One"><b>날짜</b> : '+$.datepicker.formatDate('yy-mm-dd',$("#ReservationDate_DP").datepicker('getDate'))+'</div>'+
						'<div class="OConfirm_One"><b>시간</b> : '+RTime+'</div>'+
						'<div class="OConfirm_One"><b>인원</b> : '+RPersonel+'명</div>'+
						'<div class="OConfirm_One OConfirm_Bot">위 내용으로 예약을 진행 할까요?</div>'
						
				}
				
				timconfirm(Confirm_Title,Confirm_MSG,function(){
					$.ajax({
						type: "POST",
						url: "/CardOrder?ajaxProcess",
						data: 'menu=MakeOrder&Args='+JSON.stringify(Args),
						success: function(d){
							var res = $.parseJSON(d);
							if(res.ack == 'success')
							{
								showSideMSGBox(res.success_msg,"msgBox_One_1");
							}
							else if(typeof res.error_msg != "undefined")
							{
								showSideMSGBox("<i class='fa fa-info-circle'></i> "+res.error_msg,"msgBox_One_2");
							}

						}
					});
				});
			}
			
		};
		
	};
	
	var FlyingCart = new function(){
		var self = this;
		var noItemsInCart = true;
		var popupCart_HTML = '';
		
		this.init = function(){
			<?php
			if($this->login->isLogin())
			{
			?>
				self.refreshCart();
			<?php
			}
			?>
			
			$('#FlyingShoppingCart').on(touchOrClick,function(){
				if(noItemsInCart)
					showSideMSGBox("<i class='fa fa-info-circle'></i> 현재 카트에 추가된 상품/아이템이 없습니다.","msgBox_One_2");
				else
				timPopup(popupCart_HTML);
			});
		};
		
		this.refreshCart = function(){
			$.ajax({
				type: "POST",
				url: __AjaxURL__+"?ajaxProcess",
				data: 'menu=refreshCart',
				success: function(d){
					var res = $.parseJSON(d);
					if(res.ack == 'success')
					{
						popupCart_HTML = res.popupCart_HTML;
						noItemsInCart = false;
						$('#FSC_QTY').text(res.qty);
						$('#FSC_QTY').show(500);
					}
					else
					{
						noItemsInCart = true;
					}
				}
			});
		};
	};
	
	var Items = new function(){
		var self = this;
		
		this.init = function(){
			
			$(document).on(touchOrClick,".ItemGroup_One",function(){
				if(!$(this).hasClass('ItemGroup_Selected'))
				{
					var obj = $(this);
					$('.ItemGroup_One').removeClass('ItemGroup_Selected');
					$(this).addClass('ItemGroup_Selected');
					self.getItemList(obj.data('grpid'));
				}
			});
			
			if($('.ItemGroup_One').length > 0)
			{
				self.getItemList($('.ItemGroup_One').first().data('grpid'));
			}
		};
		
		
		
		this.getItemList = function(ItemGroupID){
			$("#Items_Box").html('<div class="LoadingItems"><i class="fa fa-spinner fa-spin"></i> 로딩중 ...</div>');
			$.ajax({
				type: "POST",
				url: __AjaxURL__+"?ajaxProcess",
				data: 'menu=getItemList&ItmGrpID='+ItemGroupID,
				success: function(d){
					var res = $.parseJSON(d);
					if(res.ack == 'success')
					{
						$("#Items_Box").html(res.html);
					}
				}
			});
		};
	};
	
	var ContentsTab = new function(){
		this.init = function(){
			$(document).on(touchOrClick,".C_Tab_One",function(){
				$(".CMC_One").hide();
				$(".C_Tab_One").removeClass('C_Tab_Selected');
				$(this).addClass('C_Tab_Selected');
				$("#"+$(this).data('target')).show();
			});
			
		};
	};
	
	var Map = new function(){
		this.map;
		this.lat = '<?php echo $C['Store_Lat'];?>';
		this.lng = '<?php echo $C['Store_Lng'];?>';
		this.init = function(){
			if(typeof google != "undefined")
			{
				var self = this;
				var mapCanvas = document.getElementById('C_Map');
				var mapOptions = {
					center: new google.maps.LatLng(this.lat, this.lng),
					zoom: 16,
					scrollwheel: false,
					mapTypeControl: false,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				self.map = new google.maps.Map(mapCanvas, mapOptions);
				var marker = new google.maps.Marker({
					position: new google.maps.LatLng(self.lat, self.lng),
					animation: google.maps.Animation.DROP,
					map: self.map,
					icon: '<?php echo $Google_Marker_Icon;?>'
				});
			}
		};
	};
</script>



<div class="Front_Contents_Body Cover">
	<div class="CardDetailBox_Container">
		<div id="CardBox" class="CardDetailBox <?php echo $Card_Class;?>" data-cid="<?php echo $C['customers_id'].'-'.$C['Store_ID'];?>" data-cardtype="b">
			<div class="RightIcnMenu">
				<div id="FlyingShoppingCart" class="Glow RIM_One" data-tooltip="장바구니">
					<div id="FSC_QTY"></div>
					<i class="fa fa-shopping-cart"></i>
				</div>
				
				<div class="Glow RIM_One" id="C_ChatBtn" data-tooltip="채팅하기"><i class="fa fa-comments"></i></div>
				<div class="Glow RIM_One" id="C_AddFavoriteBtn"  data-tooltip="명함저장"><i class="fa fa-save"></i></div>
				<div class="Glow RIM_One" id="C_CurrentStatus"  data-tooltip="<?php echo $BusinessHours_CurrentStatus;?>"><i class="fa <?php echo $BusinessHours_CurrentStatus_Icon;?>"></i></div>
			
			</div>
			<div class="C_Left">
				<div class="C_MImage">
					<?php echo (is_null($FrontImage) ? '' : '<img src="'.$FrontImage.'">');?>
				</div>
				<div class="C_GInfo">
					<div class="C_Name">
						<?php echo $C['Store_Name'];;?>
					</div>
					<div class="C_ShortDesc">
						<?php echo $C['Store_ShortDesc'];?>
					</div>
					<div class="C_OwnerName">
						<div class="IcnBox"><i class="fa fa-user"></i></div>
						<div><?php echo $C['Store_OwnerName'];?></div>
					</div>
					<div class="C_TelNumber">
						<div class="IcnBox"><i class="fa fa-phone"></i></div>
						<div><?php echo $C['Store_ContactNumber'];?></div>
					</div>
					
					<div class="C_Addr">
						<div class="IcnBox"><i class="fa fa-map-o"></i></div>
						<div class="Addr1"><?php echo $C['Store_Address1'];?></div>
						<div class="Addr2"><?php echo $C['Store_Address2'];?></div>
					</div>
					
					
					
						
				</div>
			</div>
			<div class="C_Right">
				<div id="C_Map"></div>
			</div>
			
			
		</div>
	
		<div id="MajorContents_Block" class="CardDetailBox <?php echo $Card_Class;?>" data-cid="<?php echo $C['customers_id'].'-'.$C['Store_ID'];?>">
			<div class="RightIcnMenu">
				<div id="C_LongDescBTN" class="C_Tab_One C_Tab_Selected RIM_One Glow" data-target="C_LongDesc" data-tooltip="자세히"><i class="fa fa-ellipsis-h"></i></div>
				<?php
				if(sizeof($Card_ItemGroups) > 0)
				{
					echo '<div id="C_ItemsBTN" class="C_Tab_One Glow RIM_One" data-target="C_Items" data-tooltip="'.$Store_ItemTitle.'"><i class="fa fa-shopping-basket"></i></div>';
				}
				
				if($C['Store_Service_Reservation'] == 1)
				{
					echo '<div id="C_ReservationBTN" class="C_Tab_One Glow RIM_One" data-target="C_Reservation" data-tooltip="예약하기"><i class="fa fa-calendar-check-o"></i></div>';
				}
				
				if($C['Store_Service_Delivery'] == 1)
				{
					echo '<div id="C_DeliveryBTN" class="C_Tab_One Glow RIM_One" data-target="C_Delivery" data-tooltip="배달/배송"><i class="fa fa-truck"></i></div>';
				}
				
				if($C['Store_Service_Pickup'] == 1)
				{
					echo '<div id="C_PickupBTN" class="C_Tab_One Glow RIM_One" data-target="C_Pickup" data-tooltip="픽업하기"><i class="fa fa-hand-grab-o"></i></div>';
				}
				?>
				
				
			</div>
		
			<div id="C_LongDesc" class="CMC_One">
				<div class="w100" id="C_LongDesc_Box">
					<?php echo $C['Store_Desc'];?>
				</div>
			</div>
			
			<div id="C_Items" class="CMC_One">
				<div class="ItemGroups_Box">
				<?php
					foreach($Card_ItemGroups AS $K => $Card_ItemGroups_F)
					{
						echo '
							<div data-grpid="'.$Card_ItemGroups_F['ItemGrp_ID'].'" class="ItemGroup_One noSelect Glow'.($K == 0 ? ' ItemGroup_Selected':'').'">
								<div class="IGO_Name">'.$Card_ItemGroups_F['ItemGrp_Name'].'</div>
							</div>
						';
					}
				?>
				</div>
				<div id="Items_Box"></div>
			</div>
			
			
			<div id="C_Reservation" class="CMC_One">
				<div class="CMC_Title">
					<i class="fa fa-calendar-check-o"></i> 예약하기
				</div>
				<div class="CMC_Desc">
					아래에서 예약하고자 하는 날짜를 선택 후, 예약 인원을 선택하여 예약할 수 있으며, 현재 장바구니에 들어있는 상품/아이템은 예약과 함께 동시에 처리 됩니다.
				</div>
				<div class="CMC_Left">
					<div class="DatePicker" id="ReservationDate_DP" target="ReservationDate_INP"></div>
				</div>
				<div class="CMC_Right">
					<div class="CMCR_One">
						<div class="CMCR_Title">
							예약날짜
						</div>
						<div class="CMCR_Field">
							<div>
								<input type="text" class="ORD_INP" id="ReservationDate_INP" placeholder="예약날짜" value="<?php echo $Date_Today;?>" data-tooltip="왼쪽 날짜창을 이용해 선택해 주세요." disabled="disabled" />
							</div>
							<div>
								<div class="CMCR_ShortBTN Glow noSelect ComfortDate_BTN" data-datapicker="ReservationDate_DP" data-setdate="today" data-target="ReservationDate_INP" data-tooltip="오늘로 예약">오늘</div>
								<div class="CMCR_ShortBTN Glow noSelect ComfortDate_BTN" data-datapicker="ReservationDate_DP" data-setdate="1" data-target="ReservationDate_INP" data-tooltip="내일로 예약">내일</div>
								<div class="CMCR_ShortBTN Glow noSelect ComfortDate_BTN" data-datapicker="ReservationDate_DP" data-setdate="7" data-target="ReservationDate_INP" data-tooltip="일주일 후로 예약">일주일</div>
							</div>
						</div>
					</div>
					<div class="CMCR_One">
						<div class="CMCR_Title">
							예약시간
						</div>
						<div class="CMCR_Field">
							<div class="TimePickerRow">
								<div class="TPR_Top">
									<div class="OTime_BTN_One Glow noSelect" data-min="1" data-max="12" data-type="+" data-target="RTime_H"><i class="fa fa-angle-up"></i></div>
									<div class="OTime_BTN_One Glow noSelect" data-min="0" data-max="59" data-type="+" data-target="RTime_M"><i class="fa fa-angle-up"></i></div>
									<div class="OTime_BTN_One Glow noSelect" data-type="+" data-target="RTime_Meridiem"><i class="fa fa-angle-up"></i></div>
								</div>
								<div class="TPR_Middle">
									<div class="OTime_One" id="RTime_H" data-value="<?php echo $TimeNow_H;?>"><?php echo $TimeNow_H;?></div>
									<div class="OTime_Divider">:</div>
									<div class="OTime_One" id="RTime_M" data-value="<?php echo $TimeNow_M;?>"><?php echo $TimeNow_M;?></div>
									<div class="OTime_Divider">:</div>
									<div class="OTime_One" id="RTime_Meridiem" data-value="<?php echo $TimeNow_Meridiem;?>"><?php echo $TimeNow_Meridiem;?></div>
									
									<div class="CMCR_ShortBTN Glow noSelect ComfortTime_BTN" id="TimeNow_BTN" data-target="RTime_H:RTime_M:RTime_Meridiem" data-value="<?php echo $TimeNow_Now;?>" data-tooltip="현재 시간으로 예약">지금</div>
									<div class="CMCR_ShortBTN Glow noSelect ComfortTime_BTN" id="Time1Hour_BTN" data-target="RTime_H:RTime_M:RTime_Meridiem" data-value="<?php echo $TimeNow_30M;?>" data-tooltip="1시간 후로 예약">30분</div>
									<div class="CMCR_ShortBTN Glow noSelect ComfortTime_BTN" id="Time1Hour_BTN" data-target="RTime_H:RTime_M:RTime_Meridiem" data-value="<?php echo $TimeNow_1H;?>" data-tooltip="1시간 후로 예약">1시간</div>
									<div class="CMCR_ShortBTN Glow noSelect ComfortTime_BTN" id="Time1Hour_BTN" data-target="RTime_H:RTime_M:RTime_Meridiem" data-value="<?php echo $TimeNow_2H;?>" data-tooltip="2시간 후로 예약">2시간</div>
								</div>
								<div class="TPR_Bottom">
									<div class="OTime_BTN_One Glow noSelect" data-min="1" data-max="12" data-type="-" data-target="RTime_H"><i class="fa fa-angle-down"></i></div>
									<div class="OTime_BTN_One Glow noSelect" data-min="0" data-max="59" data-type="-" data-target="RTime_M"><i class="fa fa-angle-down"></i></div>
									<div class="OTime_BTN_One Glow noSelect" data-type="-" data-target="RTime_Meridiem"><i class="fa fa-angle-down"></i></div>
								</div>
							</div>
							<div></div>
						</div>
					</div>
					<div class="CMCR_One">
						<div class="CMCR_Title">
							예약인원 (명)
						</div>
						<div class="CMCR_Field">
							<div>
								<input type="text" class="ORD_INP" id="RPersonnel_INP" placeholder="예약인원" data-tooltip="오른쪽 화살표를 이용해 주세요." value="1" disabled="disabled" />
							</div>
							<div>
								<div class="CMCR_ShortBTN Glow noSelect IncDec_BTN" data-type="+" data-target="RPersonnel_INP" id="Personnel_Up" data-tooltip="예약인원 추가 (+)"><i class="fa fa-plus"></i></div>
								<div class="CMCR_ShortBTN Glow noSelect IncDec_BTN" data-type="-" data-min="1" data-target="RPersonnel_INP" id="Personnel_Down" data-tooltip="예약인원 감소 (-)"><i class="fa fa-minus"></i></div>
							</div>
						</div>
					</div>
					<div class="CMCR_One">
						<button id="Make_Reservation_BTN" data-type="Reservation" class="OrderNow_BTN Glow">예약하기</button>
					</div>
				</div>
				
			</div>
			
			<div id="C_Delivery" class="CMC_One">
				<div class="CMC_Title">
					<i class="fa fa-truck"></i> 배달/배송
				</div>
				<div class="CMC_Desc">
					현재 준비 중 입니다.
				</div>
			</div>
			
			<div id="C_Pickup" class="CMC_One">
				<div class="CMC_Title">
					<i class="fa fa-hand-grab-o"></i> 픽업하기
				</div>
				<div class="CMC_Desc">
					현재 준비 중 입니다.
				</div>
			</div>
			
			
				
			
		</div>
	
	</div>
</div>
