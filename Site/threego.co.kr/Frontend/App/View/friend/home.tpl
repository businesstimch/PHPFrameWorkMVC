<style type="text/css">
	
	#Search_Container{width:525px;height:525px;position:absolute;z-index:10;top:50%;left:50%;margin-left:-262px;margin-top:-262px;display:none;}
	#Search_BG{
		background-image:url('/Template/Img/search-bg.png');position:absolute;width:525px;height:525px;z-index:1;background-size:cover;
	}
	
	#Tab_Stage{overflow:hidden!important;left:84px;right:0;top:0;bottom:0;position:fixed;z-index:10;}
	#Tab_Wrap{width:100%;height:100%;position:absolute;left:0;top:0;}
	
	.Tab{width:100%;height:100%;overflow:hidden;position:relative;}
	
	
	#Left_Tab .Activated{opacity:1.0!important;}
	#MovingIcons .MI_One{visibility:hidden;display:table;position:absolute;border-radius:50%;color:white;text-align:center;left:0;top:0;z-index:0;opacity:0.9;cursor:pointer;}
	#MovingIcons .MI_One .MI_Wrap{display:table-cell;vertical-align: middle;text-align:center;color:white;width:100%;float:none;font-weight:bold;}
	#MovingIcons .MI_One i{text-shadow: 1px 1px 3px #4c4c4c;}
	
	#MovingIcons .MI_Ocean{background-color:#2a6990;}
	#MovingIcons .MI_Green{background-color:#84b409;}
	#MovingIcons .MI_Orange{background-color:#cd6039;}
	#MovingIcons .MI_RedL{background-color:#ce241b;}
	#MovingIcons .MI_Red{background-color:#b52520;}
	#MovingIcons .MI_Purple{background-color:#653678;}
	#MovingIcons .MI_Grass{background-color:#4e8f1b;}
	#MovingIcons .MI_Pink{background-color:#cb2161;}
	#MovingIcons .MI_BlueL{background-color:#238a9b;}
	
	
	#MovingIcons .MI_Size_1{min-width:150px;min-height:150px;}
	#MovingIcons .MI_Size_2{min-width:128px;min-height:128px;}
	#MovingIcons .MI_Size_3{min-width:70px;min-height:70px;}
	
	#MovingIcons .MI_Size_4{min-width:70px;min-height:70px;height:70px;}
	#MovingIcons .MI_Size_5{min-width:90px;min-height:90px;height:90px;}
	#MovingIcons .MI_Size_6{min-width:110px;min-height:110px;height:110px;}
	
	
	#MovingIcons .MI_Size_1 i{line-height:150px;font-size:70px;}
	#MovingIcons .MI_Size_2 i{line-height:128px;font-size:55px;}
	#MovingIcons .MI_Size_3 i{line-height:70px;font-size:30px;}
	
	#Tab_0{top:-100%;position:absolute;}
	#Tab_03{background-color:#d2d2d2;text-align:center;font-size:30px;color:white;}
	#Tab_04{background-color:gray;text-align:center;font-size:30px;color:white;}
	
	#Tab_03 div,#Tab_04 div{position:absolute;left:50%;}
	
	#Tab1_Scroll_Dots {position:fixed;z-index:95;right:20px;top:50%;margin-top:-82px;}
	#Tab1_Scroll_Dots .Scroll_Dot_One{background-color:#646461;width:16px;height:16px;border-radius:50%;clear:both;margin-bottom:25px;cursor:pointer;border:1px solid #646461;}
	#Tab1_Scroll_Dots .Scroll_Dot_One:hover{background-color:#ff9649;}
	#Tab1_Scroll_Dots .Scroll_Dot_Selected{background-color:#efefef!important;}
	
	.Tab .Tab_Register_BTN{display:block;float:left;padding:20px;border:1px solid #2f2f2f;border-radius:5px;font-size:22px;}
	.Tab .Tab_Register_BTN:hover{background-color:#ececec;}
	.Tab .Tab_Number{font-size:45px;font-family: 'Nanum Gothic Bold','Nanum Gothic', sans-serif;border-radius:3px;width:70px;height:67px;text-align:center;line-height:67px;letter-spacing: -2px;}
	.Tab .Tab_BG{background-size:cover;}
	.Tab .Tab_Contents{width:950px;height:519px;position:absolute;top:50%;left:50%;margin-left:-475px;margin-top:-230px;}
	.Tab .Tab_Number,
	.Tab .Tab_Title_1,
	.Tab .Tab_Title_2,
	.Tab .Tab_Desc,
	.Tab .Tab_Register_BTN,
	.Tab .Tab_Img{position:absolute;}
	.Tab .Tab_Img img{width:459px;height:459px;}
	
	
	.Tab .Tab_Number,
	.Tab .Tab_Title_1,
	.Tab .Tab_Title_2,
	.Tab .Tab_Desc{z-index:5;}
	
	
	
	.Tab .Tab_Title_1,
	.Tab .Tab_Title_2{font-family: 'Nanum Barun Gothic Bold','Nanum Gothic', sans-serif;font-weight:bold;}
	
	.Tab .Tab_Title_1{font-size:80px;}
	.Tab .Tab_Title_2{font-size:108px;}
	.Tab .Tab_Title_2 span{color:#6fc8ee;}
	.Tab .Tab_Desc{font-size:25px;line-height:35px;}
	.Tab .Tab_Img{width:459px;height:459px;top:-128px;z-index:0;}
	
	
	#Tab_1 .Tab_BG{background-color:white;width:100%;height:100%;}
	#Tab_1 .Tab_Number{border:1px solid black;top:65px;left:0;}
	#Tab_1 .Tab_Title_1{color:#2f2f2f;top:173px;left:0;}
	#Tab_1 .Tab_Title_2{color:#00a3e8;top:270px;left:0;}
	#Tab_1 .Tab_Register_BTN{top:480px;}
	#Tab_1 .Tab_Desc{top:391px;left:0;color:#575757;}
	#Tab_1 .Tab_Img{right:0;}
	
	#ListView{width:350px;height:100%;position:absolute;left:0;background-color:#f8f8f8;z-index:85;box-shadow: 10px 10px 5px #888888;
		border-right:1px solid #787878;
		-webkit-box-shadow: 11px 0px 35px -28px rgba(0,0,0,1);
		-moz-box-shadow: 11px 0px 35px -28px rgba(0,0,0,1);
		box-shadow: 11px 0px 35px -28px rgba(0,0,0,1);
	}
	#MapView{left:350px;right:0;top:0;bottom:0;position:absolute;z-index:0;}
	#LV_Search_Block{width:293px;height:26px;border:1px solid #787878;background-color:white;float:none;margin-left:auto;margin-right:auto;margin-top:29px;overflow:hidden;}
	#LV_Search_Inp{display:block;float:left;border:0;width:240px;height:26px;padding:0;font-size:15px;margin-left:10px;margin-right:10px;}
	#LV_Search_BTN{display:block;float:left;border:0;background-color:transparent;font-size:15px;width:28px;height:25px;cursor:pointer;color:#545454;}
	#LV_Search_BTN:hover{color:#f47d15}
	#LV_Tabs{border-top:1px solid #6e6e6e;width:100%;margin-top:28px;}
	#LV_Tabs .LVT_Header{line-height:42px;height:42px;width:116px;text-align:center;background-color:#242424;color:white;cursor:pointer;box-sizing:border-box;}
	#LVT_2 .LVT_Header{border-left:1px solid #787878;border-right:1px solid #787878;width:117px;}
	#LV_Tabs .LVT_Selected{color:#242424!important;background-color:transparent!important;}
	
	#LV_Tabs .LVT_One{}
	#LV_Tabs .LVT_List{width:100%;display:none;}
	#LV_Tabs .LVT_NoResult{width:100%;text-align:center;line-height:200px;height:200px;color:#717070;}
	#LV_Tabs .LVT_List_Selected{display:block!important;}
	
	#LV_Tabs .LVT_Business_One{width:100%;height:87px;border-bottom:1px solid #787878}
	#LV_Tabs .LVT_Business_One:hover{background-color:#dddddd;cursor:pointer;}
	#LV_Tabs .LVTB_LeftIcn{width:50px;line-height:87px;font-size:20px;text-align:center;color:#242424;}
	#LV_Tabs .LVTB_DescWrap{width:220px;line-height:20px;}
	#LV_Tabs .LVTB_Name{width:100%;font-weight:bold;margin-top:23px;}
	#LV_Tabs .LVTB_EstimatedTime{color:#717070;}
	#LV_Tabs .LVTB_Distance{text-align:center;width:80px;color:#ff6c00;line-height:87px;font-size:18px;font-weight:bold;}
	
	
	@media all and (max-width: 1300px) {
		
		#Search_Container{width:324px;height:324px;margin-top:-162px;margin-left:-162px;}
		#Search_BG{
			width:324px;height:324px;background-size:cover;
		}
		#Search_Field_Box{width:224px;height:20px;position:absolute;left:50%;margin-left:-112px;bottom:124px;}
		#Search_Field_Box input{height:17px;width:100%;border:0;font-size:15px;color:#3f3f3f;}
		#Logo_2{top:50px;width:260px;margin-left:-130px;}
		
		#Logo_2 #Hello{font-size:40px;}
		#Logo_2 #Burugo{font-size:60px;}
		#Search_Button{height:45px;line-height:45px;font-size:25px;bottom:40px;width:100px;margin-left:-90px;}
		#SearchByVoice_Button{line-height:45px;height:45px;font-size:25px;bottom:40px;margin-left:20px;}
		
		#MovingIcons .MI_Size_1{min-width:120px;min-height:120px;}
		#MovingIcons .MI_Size_2{min-width:88px;min-height:88px;}
		#MovingIcons .MI_Size_3{min-width:50px;min-height:50px;}
		
		#MovingIcons .MI_Size_4{min-width:70px;min-height:70px;height:70px;}
		#MovingIcons .MI_Size_5{min-width:90px;min-height:90px;height:90px;}
		#MovingIcons .MI_Size_6{min-width:110px;min-height:110px;height:110px;}
		
		
		#MovingIcons .MI_Size_1 i{line-height:120px;font-size:60px;}
		#MovingIcons .MI_Size_2 i{line-height:88px;font-size:35px;}
		#MovingIcons .MI_Size_3 i{line-height:50px;font-size:20px;}
		
	}
	
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		MyFunc.initPG();
		Scroll.init();
		
		$(document).on(touchOrClick,'.MI_One',function(){
			var Obj = $(this).find('.KBox_Checked');
			if(Obj.hasClass('fa-star'))
			{
				Obj.fadeOut(500,function(){
					$(this).removeClass("fa-spin fa-star");
				});
			}
			else
			{
				Obj.addClass("fa-spin fa-star").hide();
				Obj.fadeIn(500);
			}
		});
		
		$(document).on('change','#Search_Inp_Web',function(){
			$('#LV_Search_Inp').val($(this).val());
		});
		
		
		
		
	});
	
	
	var markers = [];
	
	var Scroll = new function(){
		this.CurrentTab = 0;
		this.StartedMapView = false;
		
		this.init = function(){
			$("[data-tabid=0]").addClass("Scroll_Dot_Selected");
			this.tab_triggers();
		};
		
		this.tab_triggers = function(){
			var self = this;
			$(document).on(touchOrClick,'.Scroll_Dot_One',function(){
				if($(this).data('tabid') != self.CurrentTab)
				{
					self.CurrentTab = $(this).data('tabid');
					$('.Scroll_Dot_One').removeClass('Scroll_Dot_Selected');
					$(this).addClass('Scroll_Dot_Selected');
					self.moveTabTo($(this).data('tabid'));
					
					console.log("Load : Tab "+self.CurrentTab);
				}
			});
		};
		
		this.moveTabTo = function(TabID){
			var Self = this;
			$("#Tab_Wrap").animate({'top':(TabID * 100)+"%"},1000,function(){
				if(Self.CurrentTab == 1 && !Self.StartedMapView)
				{
					Self.StartedMapView = true;
					refreshPage.Submit();
				}
			});	
		};
		
	};
	var MyFunc = new function()
	{
		
		this.initPG = function(){
			var self = this;
			self.StartAni();
			self.leftTab();
			
		};
		
		
		
		this.leftTab = function(){
			var PrevSelected;
			$(document).on(touchOrClick,'.LTab_Scroll',function(){
				$(".LTab_One").removeClass('Activated');
				$(this).addClass('Activated');
			});
		};
		this.StartAni = function(){
			
		};
		
		
	}
	
	
</script>
<?php echo $this->Load->View('www/inc/left_tab.tpl',array("PG"=>"Home"));?>


<div id="Tab_Stage" class="Front_Contents_Body">
	<div id="Tab_Wrap">
		<div class="Tab" id="Tab_1">
			<div class="Tab_Contents">
				<div data-aniinx="0" class="Tab_Number">01</div>
				<div data-aniinx="1" class="Tab_Title_1"><?php echo $this->_Lang_friend_home['Tab_Title_1'];?></div>
				<div data-aniinx="2" class="Tab_Title_2"><?php echo $this->_Lang_friend_home['Tab_Title_2'];?></div>
				<div data-aniinx="3" class="Tab_Desc"><?php echo $this->_Lang_friend_home['Tab_Desc_1'];?></div>
				<a href="/card/add" class="Tab_Register_BTN"><?php echo $this->_Lang_friend_home['Create_Card_Button'];?></a>
				<div data-aniinx="4" class="Tab_Img"><img src="/Template/Img/Home-PG4-bg.png" /></div>
			</div>
			<div class="Tab_BG"></div>
		</div>
		<div id="Tab1_Scroll_Dots">
			<div class="Glow Scroll_Dot_One" data-tabid="0"></div>
			
		</div>
	</div>
</div>
