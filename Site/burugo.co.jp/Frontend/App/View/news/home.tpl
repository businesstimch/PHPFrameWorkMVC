<style type="text/css">
	#home_bg{background-image:url('/Template/Img/home-news-bg.jpg');width:100%;height:100%;background-position:50% 50%;background-size:cover;position:absolute;top:0;z-index:0;}
	
	.home_bg_searchmode{opacity:0.3;}
	#Search_Container{width:525px;height:525px;position:absolute;z-index:10;top:50%;left:50%;margin-left:-262px;margin-top:-262px;display:none;}
	#Search_BG{
		background-image:url('/Template/Img/search-news-bg.png');position:absolute;width:525px;height:525px;z-index:1;
	}
	#Search_Field_Box{z-index:3;width:364px;height:30px;position:absolute;left:50%;margin-left:-182px;bottom:203px;}
	
	#Search_Field_Box input{height:30px;width:100%;border:0;font-size:20px;color:#3f3f3f;}
	#Logo_2{z-index:3;width:526px;position:absolute;margin-left:-263px;left:50%;top:80px;text-align:center;color:white;font-family: 'Nanum Gothic Bold', sans-serif;cursor:default;line-height:80px;}
	#Logo_2 #Hello{font-size:60px;}
	#Logo_2 #Burugo{font-size:80px;font-weight:bold;letter-spacing: -5px;}
	#Search_Button{margin-left:-94px;width:128px;}
	#SearchByVoice_Button{width:60px;margin-left:44px;}
	#Search_Button,
	#SearchByVoice_Button{height:60px;color:white;line-height:60px;text-align:center;font-size:35px;cursor:pointer;font-family: 'Nanum Gothic Bold', sans-serif;border:1px solid white;border-radius:10px;position:absolute;bottom:82px;left:50%;z-index:100;}
	#SearchByVoice_Button:hover,
	#Search_Button:hover{color:#307fb0;background-color:white;}
	#RelatedKeyword_Box{top:-130px;position:absolute;z-index:1;}
	.KBox{visibility:hidden;padding:5px;box-sizing:border-box;cursor:pointer;top:0;left:50%;display:table;background-image:url('/Template/Img/keyword-idea-box.png');width:108px;height:120px;font-size:14px;line-height:20px;position:absolute;font-weight:bold;font-family: 'Nanum Gothic', sans-serif;}
	.KBox_Checked{color:yellow;left:50%;top:-11px;position:absolute;width:20px;height:20px;line-height:20px;text-align:center;font-size:20px!important;margin-left:-10px;}
	.KBox, .KBox *{float:none;}
	
	
	.activatedKeywordShow{color:#868686!important;}
	.activatedKeywordShow:hover{color:#5c5c5c!important;}
	#Tab_Stage{overflow:hidden!important;left:84px;right:0;top:0;bottom:0;position:fixed;}
	#Tab_Wrap{width:100%;height:100%;position:absolute;left:0;top:0;}
	
	.Tab{width:100%;height:100%;overflow:hidden;position:relative;}
	
	
	#Left_Tab .Activated{opacity:1.0!important;}
	#MovingIcons .MI_One{visibility:hidden;display:table;position:absolute;border-radius:50%;color:white;text-align:center;left:0;top:0;z-index:0;opacity:0.9;cursor:pointer;}
	#MovingIcons .MI_One .MI_Wrap{display:table-cell;vertical-align: middle;text-align:center;color:white;width:100%;float:none;font-weight:bold;line-height:20px;}
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
	
	
	#Tab_03{background-color:#d2d2d2;text-align:center;font-size:30px;color:white;}
	#Tab_04{background-color:gray;text-align:center;font-size:30px;color:white;}
	
	#Tab_03 div,#Tab_04 div{position:absolute;left:50%;}
	#Tab1_Scroll_Dots .Scroll_Dot_One{background-color:#646461;width:16px;height:16px;border-radius:50%;clear:both;margin-bottom:25px;cursor:pointer;}
	#Tab1_Scroll_Dots .Scroll_Dot_Selected{background-color:#efefef!important;}
	
	#Tab1_Scroll_Dots .Scroll_Dot_One:hover{background-color:#ff9649;}
	
	#Tab1_Scroll_Dots {position:fixed;z-index:95;right:40px;top:50%;margin-top:-82px;}
	
	
	.Tab .Tab_Number{font-size:45px;font-family: 'Nanum Barun Gothic', sans-serif;border-radius:3px;width:70px;height:67px;text-align:center;line-height:67px;letter-spacing: -2px;}
	.Tab .Tab_BG{background-size:cover;}
	.Tab .Tab_Contents{width:1184px;height:519px;position:absolute;top:50%;left:50%;margin-left:-592px;margin-top:-259px;}
	.Tab .Tab_Number,
	.Tab .Tab_Title_1,
	.Tab .Tab_Title_2,
	.Tab .Tab_Desc,
	.Tab .Tab_Img{position:absolute;}
	
	.Tab .Tab_Title_1,
	.Tab .Tab_Title_2{font-size:80px;font-family: 'Nanum Barun Gothic';font-weight:bold;}
	
	.Tab .Tab_Title_1 span,
	.Tab .Tab_Title_2 span{font-size:105px;letter-spacing: -5px;}
	.Tab .Tab_Desc{font-size:25px;line-height:35px;}
	.Tab .Tab_Img{width:519px;height:519px;}
	
	
	#Tab_2 .Tab_BG{background-color:white;width:100%;height:100%;}
	#Tab_2 .Tab_Number{border:1px solid black;top:65px;left:0;}
	#Tab_2 .Tab_Title_1{color:#2f2f2f;top:173px;left:0;}
	#Tab_2 .Tab_Title_2{color:#2f2f2f;top:270px;left:0;}
	#Tab_2 .Tab_Desc{top:391px;left:0;color:#575757;}
	#Tab_2 .Tab_Img{top:0;right:0;background-image:url('/Template/Img/Home-PG2-bg.png');}
	#Tab_2 span{color:#ff6000;}
	
	
	#Tab_3 .Tab_BG{background-image:url('/Template/Img/Home-PG2-mainbg.jpg');width:100%;height:100%;}
	#Tab_3 .Tab_Number{background-color:white;top:65px;right:0;color:#2f2f2f;}
	#Tab_3 .Tab_Title_1{color:white;top:173px;right:0;}
	#Tab_3 .Tab_Title_2{color:white;top:270px;right:0;}
	#Tab_3 .Tab_Desc{top:391px;right:0;color:#eeeeee;}
	#Tab_3 .Tab_Img{top:0;left:0;background-image:url('/Template/Img/Home-PG3-bg.png');}
	#Tab_3 span{color:#ffc937;}
	
	#Tab_4 .Tab_BG{background-color:white;width:100%;height:100%;}
	#Tab_4 .Tab_Number{border:1px solid black;top:65px;left:0;}
	#Tab_4 .Tab_Title_1{color:#2f2f2f;top:173px;left:0;}
	#Tab_4 .Tab_Title_2{color:#2f2f2f;top:270px;left:0;}
	#Tab_4 .Tab_Desc{top:391px;left:0;color:#575757;}
	#Tab_4 .Tab_Img{top:0;right:0;background-image:url('/Template/Img/Home-PG4-bg.png');}
	#Tab_4 span{color:#ff6000;}
	
	#Tab_5 .Tab_BG{background-image:url('/Template/Img/Home-PG5-mainbg.jpg');width:100%;height:100%;}
	#Tab_5 .Tab_Number{background-color:white;top:65px;right:0;color:#2f2f2f;}
	#Tab_5 .Tab_Title_1{color:white;top:173px;right:0;}
	#Tab_5 .Tab_Title_2{color:white;top:270px;right:0;}
	#Tab_5 .Tab_Desc{top:391px;right:0;color:#eeeeee;}
	#Tab_5 .Tab_Img{top:0;left:0;background-image:url('/Template/Img/Home-PG5-bg.png');}
	#Tab_5 span{color:#ffc937;}
	@media all and (max-width: 1300px) {
		
		#Search_Container{width:324px;height:324px;margin-top:-162px;margin-left:-162px;}
		#Search_BG{
			width:324px;height:324px;background-size:cover;
		}
		#Search_Field_Box{width:224px;height:20px;position:absolute;left:50%;margin-left:-112px;bottom:124px;}
		#Search_Field_Box input{height:17px;width:100%;border:0;font-size:15px;color:#3f3f3f;}
		#Logo_2{top:50px;line-height:50px;width:260px;margin-left:-130px;}
		
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
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			type: "POST",
			url: "http://www.burugo.co.kr/Login?ajaxProcess",
			data: "menu=loginRequest",
			success: function(d){
				var res = $.parseJSON(d);
				if(res.ack == 'success')
				{
				
					
				}
			}
		});
		MyFunc.initPG();
		Scroll.init();
		/*
		google.maps.event.addDomListener(window, 'load', function(){
			var mapCanvas = document.getElementById('Tab_02');
			var mapOptions = {
				center: new google.maps.LatLng(44.5403, -78.5463),
				zoom: 18,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			var map = new google.maps.Map(mapCanvas, mapOptions)
		});
		*/

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
	});
	
	var Scroll = new function(){
		this.CurrentTab = 0;
		
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
			$("#Tab_Wrap").animate({'top':"-"+(TabID * 100)+"%"},1000);	
		};
		
	};
	var MyFunc = new function()
	{
		this.searchKeyword = $('#Search_Inp_Web').val();
		this.NewsearchKeyword = $('#Search_Inp_Web').val();
		this.relatedKeyword = {"Result":[{}]};
		this.KeywordBoxClasses = ['MI_Ocean','MI_Green','MI_Orange','MI_RedL','MI_Red','MI_Purple','MI_Grass','MI_Pink','MI_BlueL'];
		this.KeywordBoxSizes = [4,5,6];
		
		this.initPG = function(){
			var self = this;
			self.StartAni();
			self.initSearch();
			self.randomIcon();
			self.randomFadeIn(200);
			self.ScrollTab();
			self.leftTab();
			
			
			$(document).on(touchOrClick,'#SearchByVoice_Button',function(){
				showSideMSGBox("<i class='fa fa-search'></i> <?php echo $this->_Lang_news_home['no_voice_service'];?>","msgBox_One_1");
			});
			
		};
		
		this.ScrollTab = function(){
			
		};
		
		this.randomIcon = function(){
							
			var i = 0;
			
			
			$(".MI_One").each(function(){
				
				var Center_Radius = $("#Search_BG").outerWidth() / 2;
				var RandomObj_2Radius = getRandomInt($(this).outerWidth() * 2 ,$(this).outerWidth() - ($(this).outerWidth() / 2));
				var Pos_XY;
				if($("#home_bg").outerWidth() < 1300)
				{
					RandomObj_2Radius = 100;
					Pos_XY = 121;
				}
				else
				{
					RandomObj_2Radius = 100;
					Pos_XY = 201;
				}
				
				var x = Pos_XY + (Center_Radius + RandomObj_2Radius) * Math.cos(2 * Math.PI * i / $(".MI_One").length);
				var y = Pos_XY + (Center_Radius + RandomObj_2Radius) * Math.sin(2 * Math.PI * i / $(".MI_One").length);
				
				/*console.log(RandomObj_2Radius);*/
				
				$(this).css("left",x+"px");
				$(this).css("top",y+"px");
				
				i++;
			});
			
		
		};
		
		this.leftTab = function(){
			var PrevSelected;
			$(document).on(touchOrClick,'.LTab_Scroll',function(){
				$(".LTab_One").removeClass('Activated');
				$(this).addClass('Activated');
			});
		};
		this.StartAni = function(){
			$("#Search_Container").fadeIn(300,function(){
				$("#Logo_2").fadeIn(500);
				$("#Search_Field_Box").fadeIn(1000);
			});
		};
		
		this.searchNow = function(){
			if(typeof this.searchKeyword != "undefined" && this.searchKeyword != "")
				location.href='/search#K='+this.searchKeyword;
			else
				showSideMSGBox("<i class='fa fa-search'></i> <?php echo $this->_Lang_news_home['need_keyword'];?>","msgBox_One_2");
		};
		this.initSearch = function(){
			var self = this;
			var Timer = null;
			
			$(document).on('keyup',"#Search_Inp_Web",function(e){
				if(e.which == 13)
					self.searchNow();
			});
			$(document).on('focus',"#Search_Inp_Web",function(){
				
				clearInterval(Timer);
				Timer = setInterval(function(){
					self.searchKeyword = $('#Search_Inp_Web').val();
					if(self.searchKeyword != "")
					{
						if(self.NewsearchKeyword != self.searchKeyword)
						{
							self.getRelatedKeywords();
							self.NewsearchKeyword = self.searchKeyword;
						}
					}
				},200);
				
			});
			
			
			$(document).on(touchOrClick,"#Search_Button",function(){
				
				self.searchNow();
				
			});
			
			$(document).on('blur',"#Search_Inp_Web",function(){
				clearInterval(Timer);
				Timer = null;
			});
		};
		
		this.getRelatedKeywords = function(){
			var self = this;
			
			$.ajax({
				type: "POST",
				url: __AjaxURL__+"?ajaxProcess",
				data: "menu=getRelatedKeyword&K="+self.searchKeyword,
				success: function(d){
					var res = $.parseJSON(d);
					if(res.ack == 'success')
					{
						$("#RelatedKeyword_Box").html('');
						if(self.getJSonSize(res.Result) > 0)
						{
							
							$("#MovingIcons").html("");
							for(Key in res.Result)
							{
								if(res.Result.hasOwnProperty(Key))
									$("#MovingIcons").append('<div class="KBox_Pending '+self.KeywordBoxClasses[getRandomInt(0,(self.KeywordBoxClasses.length - 1))]+' MI_One noSelect MI_Size_'+self.KeywordBoxSizes[getRandomInt(0,(self.KeywordBoxSizes.length - 1))]+'"><div class="fa KBox_Checked"></div><div class="MI_Wrap">'+res.Result[Key]['K']+'</div></div>');
							}
							self.randomIcon();
							self.randomFadeIn(100);
							
						}
						else
							$(".MI_One").fadeOut(1000);
						
					}
				}
			});
			
			
			
		};
		
		var randomRemainArray = new Array();
		this.randomFadeIn = function(Speed){
			var PickedOne;
			var self = this;
			randomRemainArray = new Array();
			if($('.KBox_Pending').length > 0)
			{
				
				$('.KBox_Pending').each(function(){
					randomRemainArray.push($(this));
				});
				
				PickedOne = getRandomInt(0,(randomRemainArray.length - 1));
				randomRemainArray[PickedOne].css('visibility','visible').hide().fadeIn(Speed,function(){
					$(this).removeClass('KBox_Pending');
					self.randomFadeIn(Speed);
				});
			}
		};
		
		
		this.getJSonSize = function(JSonOBJ){
			var Count = 0;
			for(Key in JSonOBJ)
			{
				/*console.log(JSonOBJ[Key].K);*/
				Count++;
				
			}
			return Count;
		
		};
	};
	
	function getRandomInt(min, max) {
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}
</script>
<?php echo $this->Load->View('www/inc/left_tab.tpl',array("PG"=>"Home"));?>
<div id="Tab_Stage" class="Front_Contents_Body">
	<div id="Tab_Wrap">
		<div class="Tab" id="Tab_1">
			<div id="Search_Container">
				<div id="Logo_2" class="noSelect"><span id="Hello"><?php echo $this->_Lang_news_home['burugo'];?></span><br /><span id="Burugo"><?php echo $this->_Lang_news_home['news'];?></span></div>
				<div id="Search_BG"></div>
				<div id="Search_Field_Box">
					<div id="RelatedKeyword_Box"></div>
					<div class="w100"><input id="Search_Inp_Web" type="text" /></div>
				</div>
				<div id="Search_Button" class="Glow noSelect">Go<i>!</i></div>
				<div id="SearchByVoice_Button" class="Glow noSelect"><i class="fa fa-microphone"></i></div>
				<div id="MovingIcons">
					<div id="MI_01" class="KBox_Pending MI_Ocean MI_One MI_Size_2"><i class="fa fa-youtube-play"></i></div>
					<div id="MI_02" class="KBox_Pending MI_Green MI_One MI_Size_1"><i class="fa fa-user"></i></div>
					<div id="MI_03" class="KBox_Pending MI_Orange MI_One MI_Size_3"><i class="fa fa-commenting-o"></i></div>
					<div id="MI_04" class="KBox_Pending MI_RedL MI_One MI_Size_3"><i class="fa fa-camera"></i></div>
					<div id="MI_05" class="KBox_Pending MI_Red MI_One MI_Size_1"><i class="fa fa-home"></i></div>
					<div id="MI_06" class="KBox_Pending MI_Purple MI_One MI_Size_2"><i class="fa fa-car"></i></div>
					<div id="MI_07" class="KBox_Pending MI_Grass MI_One MI_Size_2"><i class="fa fa-map"></i></div>
					<div id="MI_08" class="KBox_Pending MI_Pink MI_One MI_Size_3"><i class="fa fa-heart"></i></div>
					<div id="MI_09" class="KBox_Pending MI_BlueL MI_One MI_Size_3"><i class="fa fa-cube"></i></div>
					
				</div>
			</div>
			<div id="home_bg"></div>
		</div>
		<div class="Tab" id="Tab_2">
			
			<div class="Tab_Contents">
				<div data-aniinx="0" class="Tab_Number">01</div>
				<div data-aniinx="1" class="Tab_Title_1">What's <span>B</span>urugo?</div>
				<div data-aniinx="2" class="Tab_Title_2"><span>부르고</span>가 뭐죠?</div>
				<div data-aniinx="3" class="Tab_Desc">부르고에선 내 취향에 맞는, 어떤 것이든 부를 수 있습니다<i>!</i><br />당신이 부르면 찾아가는 서비스, 부르고와 함께하세요.</div>
				<div data-aniinx="4" class="Tab_Img"></div>
			</div>
			<div class="Tab_BG"></div>
			
		</div>
		<div class="Tab" id="Tab_3">
			<div class="Tab_Contents">
				<div data-aniinx="0" class="Tab_Number">02</div>
				<div data-aniinx="1" class="Tab_Title_1">To <span>B</span>usiness<i>?</i></div>
				<div data-aniinx="2" class="Tab_Title_2">It's <span>B</span>usiness<i>!</i></div>
				<div data-aniinx="3" class="Tab_Desc">부르고는 다양한 가맹점과 소비자를 연결합니다.<br />셀러와 바이어의 소통의 장, 부르고를 만나보세요.</div>
				<div data-aniinx="4" class="Tab_Img"></div>
			</div>
			<div class="Tab_BG"></div>
		</div>
		<div class="Tab" id="Tab_4">
			<div class="Tab_Contents">
				<div data-aniinx="0" class="Tab_Number">03</div>
				<div data-aniinx="1" class="Tab_Title_1">당신의 <span>F</span>riend는</div>
				<div data-aniinx="2" class="Tab_Title_2">나의 <span>B</span>riend<i>!!</i></div>
				<div data-aniinx="3" class="Tab_Desc">부르고에 친구를 등록하거나, 새로운 친구를 찾아보세요.<br />브렌드 시스템은 당신과 어울리는 수많은 친구들을 연결합니다.</div>
				<div data-aniinx="4" class="Tab_Img"></div>
			</div>
			<div class="Tab_BG"></div>
		</div>
		<div class="Tab" id="Tab_5">
			<div class="Tab_Contents">
				<div data-aniinx="0" class="Tab_Number">04</div>
				<div data-aniinx="1" class="Tab_Title_1">Life is HELP</div>
				<div data-aniinx="2" class="Tab_Title_2">Help is <span>Burumi</span><i>!</i></div>
				<div data-aniinx="3" class="Tab_Desc">부르고의 검색 시스템은 차별화되었고, 특별합니다.<br />단순한 검색에서 벗어나 사람들의 NEEDS에 부르미하세요!</div>
				<div data-aniinx="4" class="Tab_Img"></div>
			</div>
			<div class="Tab_BG"></div>
		</div>
		<!--
		<div id="Tab1_Scroll_Dots">
			<div class="Glow Scroll_Dot_One" data-tabid="0"></div>
			<div class="Glow Scroll_Dot_One" data-tabid="1"></div>
			<div class="Glow Scroll_Dot_One" data-tabid="2"></div>
			<div class="Glow Scroll_Dot_One" data-tabid="3"></div>
			<div class="Glow Scroll_Dot_One" data-tabid="4"></div>
		</div>
		-->
	</div>
</div>