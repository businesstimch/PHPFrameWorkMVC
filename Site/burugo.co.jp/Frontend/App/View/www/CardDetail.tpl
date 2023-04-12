<style type="text/css">
	.Front_Contents_Body{background-image:url("/Template/Img/ceo-olympic-bg.png");}
	.CardDetailBox_Container{width:1000px;margin-left:auto;margin-right:auto;float:none;}
	.CardDetailBox{width:100%;margin:20px;border-radius:5px;border:1px solid #eaeaea;padding:20px;}
	.CardDetailBox .C_MImage{width:200px;height:200px;border-radius:10px;overflow:hidden;margin-right:20px;}
	.CardDetailBox .C_MImage img{width:100%;height:100%;}
	.CardDetailBox .C_Left{width:780px;margin-right:20px;}
	.CardDetailBox .C_Right{width:200px;}
	.CardDetailBox .C_Name{font-size:24px;color:#4c4c4c;clear:right;width:100%;margin-bottom:10px;}
	.CardDetailBox .C_ShortDesc{font-size:13px;color:#8b8b8b;width:100%;margin-bottom:10px;}
	.CardDetailBox .C_TelNumber{font-size:13px;font-size:16px;width:100%;line-height:30px;font-weight:bold;color:#5d5d5d;margin-top:10px;}
	.CardDetailBox .C_GInfo{width:540px;margin-right:20px;}
	.CardDetailBox .Line{width:100%;border-bottom:1px solid #eaeaea;margin-top:20px;margin-bottom:20px;}
	.CardDetailBox .IcnBox{width:30px;height:30px;line-height:30px;text-align:center;border-radius:5px;background-color:#43a6d4;color:white;margin-right:7px;}
	.CardDetailBox #C_Map{width:200px;height:200px;background-color:#f6f6f6;border-radius:10px;overflow:hidden;}
	.CardDetailBox .C_Addr{width:100%;line-height:30px;margin-top:10px;font-size:16px;font-weight:bold;}
	.CardDetailBox .C_Addr .Addr1{margin-right:5px;}
	.CardDetailBox .C_Addr .Addr2{margin-left:37px;clear:both;}
	.CardDetailBox .C_OwnerName{width:100%;line-height:30px;font-size:16px;font-weight:bold;margin-top:10px;color:#6f6f6f;}
	.CardDetailBox .RightActionBtn{height:40px;width:100%;line-height:40px;text-align:center;border-radius:5px;font-size:16px;color:white;cursor:pointer;margin-bottom:10px;}
	
	.CardDetailBox .BusinessHoursBox{width:100%;background-color:#7f7166;border-radius:5px;padding:10px;box-sizing:border-box;margin-bottom:10px;}
	.CardDetailBox .BusinessHoursBox .BHB_Head{border-bottom:1px dotted #acacac;width:100%;padding-top:5px;padding-bottom:10px;font-size:16px;text-align:center;color:white;margin-bottom:10px;}
	.CardDetailBox .BH_One{height:25px;line-height:25px;width:100%;color:#ede7e2;text-align:center;}
	.CardDetailBox .BH_Today{font-weight:bold;color:#ffd585;}
	.CardDetailBox #C_ChatBtn{background-color:#f2a612;}
	.CardDetailBox #C_AddFavoriteBtn{background-color:#e75252;}
	.CardDetailBox #BH_CurrentStatus{width:100%;font-size:14px;text-align:center;background-color:#a08b7a;padding:10px 0;border-radius:5px;color:white;margin-top:10px;}
	.CardDetailBox .C_MajorContents{position:relative;min-height:100px;}
	
	
	.CardDetailBox #C_LongDesc img{max-width:100%;}
	.CardDetailBox #C_Items{display:none;position:absolute;top:35px;left:0;}
	.CardDetailBox .C_Tab{height:35px;line-height:35px;margin-left:10px;}
	.CardDetailBox .C_Tab .C_Tab_One{color:#868686;line-height:35px;z-index:0;position:relative;padding-left:20px;padding-right:20px;margin-right:10px;border-radius:10px 10px 0 0;border-top:1px solid #e9e9e9;border-left:1px solid #e9e9e9;border-right:1px solid #e9e9e9;cursor:pointer;}
	.CardDetailBox .C_Tab .C_Tab_Selected{color:#555555!important;z-index:10;font-weight:bold;border-top:1px solid #dcdcdc;border-left:1px solid #dcdcdc;border-right:2px solid #dcdcdc;background-color:#f7f7f7;color:gray;}
	.CardDetailBox .CMC_One{position:absolute;top:35px;left:0;border:1px solid #dcdcdc;width:100%;min-height:300px;background-color:#f7f7f7;padding:20px;box-sizing:border-box;border-radius:10px;}
	
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		Map.init();
		ContentsTab.init();
		
		$(document).on(touchOrClick,"#C_AddFavoriteBtn",function(){
			showSideMSGBox("<i class='fa fa-search'></i> 현재 준비중인 서비스 입니다.","msgBox_One_2");
		});
		$(document).on(touchOrClick,"#C_ChatBtn",function(){
			var obj = $(this);
			Chat.createNewChat({
				"cid" : obj.parents('.CardDetailBox').data('cid')
			});
		});
	});
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
		};
	};
</script>
<div class="Front_Contents_Body Cover">
	<div class="CardDetailBox_Container">
		<div class="CardDetailBox <?php echo $Card_Class;?>" data-cid="<?php echo $C['customers_id'].'-'.$C['Store_ID'];?>">
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
			<div class="Line"></div>
			<div class="C_Left C_MajorContents">
				<div class="C_Tab noSelect">
					<div class="C_Tab_One C_Tab_Selected Glow" data-target="C_LongDesc"><i class="fa fa-book"></i> 자세히</div>
					<div class="C_Tab_One Glow" data-target="C_Items"><i class="fa fa-shopping-basket"></i> 상품 / 아이템</div>
				</div>
				<div id="C_LongDesc" class="CMC_One">
					<?php echo $C['Store_Desc'];?>
				</div>
				
				<div id="C_Items" class="CMC_One">
					<div class=""></div>
				</div>
				
			</div>
			<div class="C_Right">
				<div class="RightActionBtn" id="C_ChatBtn"><i class="fa fa-comments"></i> 채팅하기</div>
				<div class="RightActionBtn" id="C_AddFavoriteBtn"><i class="fa fa-newspaper-o"></i> 명함북에 저장하기</div>
				<div class="BusinessHoursBox">
					<div class="BHB_Head">
						<i class="fa fa-calendar"></i> 영업시간
					</div>
					<div>
						<?php echo $BusinessHours;?>
					</div>
					<div id="BH_CurrentStatus"><?php echo $BusinessHours_CurrentStatus;?></div>
				</div>
				
			</div>
			
		</div>
	
	</div>
</div>