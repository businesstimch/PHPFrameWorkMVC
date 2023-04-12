<style type="text/css">
	#home_bg{background-image:url('/Template/Img/home-bg.jpg');width:100%;height:100%;background-position:50% 50%;background-size:cover;position:absolute;top:0;z-index:0;}
	
	.home_bg_searchmode{opacity:0.3;}
	#Search_Container{width:525px;height:525px;position:absolute;z-index:10;top:50%;left:50%;margin-left:-262px;margin-top:-262px;display:none;}
	#Search_BG{
		background-image:url('/Template/Img/search-bg.png');position:absolute;width:525px;height:525px;z-index:1;background-size:cover;
	}
	#Search_Field_Box{z-index:3;width:364px;height:30px;position:absolute;left:50%;margin-left:-182px;bottom:203px;}
	
	#Search_Field_Box input{height:30px;width:100%;border:0;font-size:20px;color:#3f3f3f;}
	#Logo_2{z-index:3;width:526px;position:absolute;margin-left:-263px;left:50%;top:90px;text-align:center;color:white;font-family: 'Nanum Gothic', sans-serif;cursor:default;}
	#Logo_2 #Hello{font-size:65px;}
	#Logo_2 #Burugo{font-size:90px;font-weight:bold;letter-spacing: -5px;}
	#Search_Button{margin-left:-94px;width:128px;}
	#SearchByVoice_Button{width:60px;margin-left:44px;}
	#Search_Button,
	#SearchByVoice_Button{height:60px;color:white;line-height:60px;text-align:center;font-size:35px;cursor:pointer;font-family: 'Nanum Gothic', sans-serif;border:1px solid white;border-radius:10px;position:absolute;bottom:82px;left:50%;z-index:100;}
	
	#SearchByVoice_Button:hover,
	#Search_Button:hover{color:#ff6c00;background-color:white;}
	#RelatedKeyword_Box{top:-130px;position:absolute;z-index:1;}
	.KBox{visibility:hidden;padding:5px;box-sizing:border-box;cursor:pointer;top:0;left:50%;display:table;background-image:url('/Template/Img/keyword-idea-box.png');width:108px;height:120px;font-size:14px;line-height:20px;position:absolute;font-weight:bold;font-family: 'Nanum Gothic', sans-serif;}
	.KBox_Star{color:yellow;left:50%;top:-11px;position:absolute;width:20px;height:20px;line-height:20px;text-align:center;font-size:20px!important;margin-left:-10px;}
	.KBox, .KBox *{float:none;}
	
	
	.activatedKeywordShow{color:#868686!important;}
	.activatedKeywordShow:hover{color:#5c5c5c!important;}
	#Tab_Stage{overflow:hidden!important;position:fixed;z-index:10;}
	#Tab_Wrap{width:100%;height:100%;position:absolute;left:0;top:0;}
	
	.Tab{width:100%;height:100%;overflow:hidden;position:relative;}
	
	
	#Left_Tab .Activated{opacity:1.0!important;}
	#MovingIcons .MI_One{visibility:hidden;display:table;position:absolute;border-radius:50%;color:white;text-align:center;left:0;top:0;z-index:0;opacity:0.9;cursor:pointer;}
	#MovingIcons .MI_One .MI_Wrap{display:table-cell;vertical-align: middle;text-align:center;color:white;width:100%;float:none;font-weight:bold;padding:10px;line-height:15px;}
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
	
	
	.Tab .Tab_Number{font-size:45px;font-family: 'Nanum Gothic', sans-serif;border-radius:3px;width:70px;height:67px;text-align:center;line-height:67px;letter-spacing: -2px;}
	.Tab .Tab_BG{background-size:cover;}
	.Tab .Tab_Contents{width:950px;height:519px;position:absolute;top:50%;left:50%;margin-left:-475px;margin-top:-259px;}
	.Tab .Tab_Number,
	.Tab .Tab_Title_1,
	.Tab .Tab_Title_2,
	.Tab .Tab_Desc,
	.Tab .Tab_Img{position:absolute;}
	
	.Tab .Tab_Title_1,
	.Tab .Tab_Title_2,
	.Tab .Tab_Desc{z-index:5;}
	
	.Tab .Tab_Title_1,
	.Tab .Tab_Title_2{font-size:80px;font-family: 'Nanum Barun Gothic', sans-serif;font-weight:bold;}
	
	.Tab .Tab_Title_1 span,
	.Tab .Tab_Title_2 span{font-size:105px;letter-spacing: -5px;}
	.Tab .Tab_Desc{font-size:25px;line-height:35px;}
	.Tab .Tab_Img{width:519px;height:519px;z-index:0;opacity:0.7;}
	
	
	#Tab_2 .Tab_BG{background-color:white;width:100%;height:100%;}
	#Tab_2 .Tab_Number{border:1px solid black;top:65px;left:0;}
	#Tab_2 .Tab_Title_1{color:#2f2f2f;top:173px;left:0;}
	#Tab_2 .Tab_Title_2{color:#2f2f2f;top:270px;left:0;}
	#Tab_2 .Tab_Desc{top:391px;left:0;color:#575757;}
	#Tab_2 .Tab_Img{right:0;background-image:url('/Template/Img/Home-PG2-bg.png');}
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
	#ListView{width:300px;height:100%;position:absolute;left:0;background-color:#f8f8f8;z-index:85;box-shadow: 10px 10px 5px #888888;
		border-right:1px solid #787878;
		-webkit-box-shadow: 11px 0px 35px -28px rgba(0,0,0,1);
		-moz-box-shadow: 11px 0px 35px -28px rgba(0,0,0,1);
		box-shadow: 11px 0px 35px -28px rgba(0,0,0,1);
	}
	#MapView{left:300px;right:0;top:0;bottom:0;position:absolute;z-index:0;}
	#MapView div{float:none;}
	#LV_Search_Block{width:260px;height:26px;border:1px solid #787878;background-color:white;float:none;margin-left:auto;margin-right:auto;margin-top:10px;overflow:hidden;border-radius:5px;}
	#LV_Search_Inp{display:block;float:left;border:0;width:207px;height:26px;padding:0;font-size:15px;margin-left:10px;margin-right:10px;}
	#LV_Search_BTN{display:block;float:left;border:0;background-color:transparent;font-size:15px;width:28px;height:25px;cursor:pointer;color:#545454;}
	#LV_Search_BTN:hover{color:#f47d15;}
	#LV_Tabs{border-top:1px solid #6e6e6e;width:100%;height:100%;margin-top:18px;position:relative;}
	#LV_Tabs .LVT_Header{line-height:42px;height:42px;width:100px;text-align:center;background-color:#242424;color:white;cursor:pointer;box-sizing:border-box;}
	#LVT_2 .LVT_Header{border-left:1px solid #787878;border-right:1px solid #787878;}
	#LV_Tabs .LVT_Selected{color:#242424!important;background-color:transparent!important;width:99px;}
	
	#LV_Tabs .LVT_One{}
	#LV_Tabs .LVT_List{width:100%;display:none;overflow:auto;position:absolute;top:42px;bottom:0;}
	#LV_Tabs .LVT_NoResult{width:100%;text-align:center;line-height:200px;height:200px;color:#717070;}
	#LV_Tabs .LVT_List_Selected{display:block;}
	
	#LV_Tabs .LVT_Business_One{width:100%;height:87px;border-bottom:1px solid #787878;position:relative;}
	#LV_Tabs .LVT_Business_One:hover{background-color:#f1f1f1;cursor:pointer;}
	#LV_Tabs .LVT_Business_One .LVTB_Viewing{display:none;margin-right:5px;color:#fac31d}
	#LV_Tabs .LVT_Business_One .LVTB_CardView{width:360px;height:200px;background-color:white;position:absolute;right:-300px;}
	#LV_Tabs .LVT_Business_Selected{background-color:#f1f1f1;}
	#LV_Tabs .LVT_Business_Selected .LVTB_Viewing{display:inline-block;}
	#LV_Tabs .LVTB_MainImg{width:68px;height:68px;line-height:87px;font-size:20px;text-align:center;color:#242424;margin:10px;border:1px solid #d7d7d7;border-radius:5px;overflow:hidden;}
	#LV_Tabs .LVTB_MainImg img{width:100%;height:100%;}
	#LV_Tabs .LVTB_DescWrap{width:180px;line-height:20px;}
	#LV_Tabs .LVTB_Name{width:100%;font-weight:bold;margin-top:10px;}
	#LV_Tabs .LVTB_ShortDesc{width:100%;height:30px;overflow:hidden;color:#717070;font-size:12px;line-height:14px;}
	#LV_Tabs .LVTB_CardKeywords{width:100%;height:20px;overflow:hidden;font-size:12px;color:#2d95c6;}
	
	#LVT_2_CardList{width:362px;height:202px;background-color:red;position:absolute;top:0;right:-380px;display:none;overflow:hidden;}
	
	#LV_SearchLocation_Option{height:25px;line-height:25px;margin-left:auto;margin-right:auto;float:none;width:139px;background-color:white;border-radius:5px;margin-top:18px;overflow:hidden;border:1px solid gray;}
	#LV_SearchLocation_Option div{font-size:11px;width:50%;color:gray;cursor:pointer;text-align:center;}
	.LVSOpt_Selected{background-color:#ff6c00;color:white!important;}
	#Search_Inp_Web{font-family:'Nanum Gothic';}
	#Search_Inp_Web:focus{text-align:left;}
	
	/*
	.CardOnMap{width:250px;height:168px;background-color:white;}
	.CardOnMap div{float:left!important;}
	.CardOnMap .COM_Image{width:70px;height:70px;overflow:hidden;border-radius:5px;margin-right:5px;margin-bottom:5px;}
	.CardOnMap .COM_Image img{width:100%;height:100%;}
	.CardOnMap .COM_Name{font-size:16px;font-weight:bold;margin-top:5px;width:169px;}
	.CardOnMap .COM_ShortD{color:gray;width:169px;margin-top:5px;}
	.CardOnMap .COM_Address{width:100%;padding-top:10px;padding-left:5px;box-sizing:border-box;line-height:16px;color:#909090;font-size:12px;line-height:20px;}
	.CardOnMap .COM_Address b{color: #737373;font-style: italic;font-weight: bold;}
	.CardOnMap .COM_Address span{color:#707070;}
	.CardOnMap .COM_Menus{position:absolute;}
	.CardOnMap .COMM_Icon_Btn{margin-right:12px;width:34px;height:34px;line-height:34px;text-align:center;border-radius:5px;color:white;font-size:20px;cursor:pointer;}
	.CardOnMap .COMM_Home{background-color:#00a2ff;border:3px solid #00a2ff;}
	.CardOnMap .COMM_Call{background-color:#84b409;border:3px solid #84b409;}
	.CardOnMap .COMM_Chat{background-color:#fac31d;border:3px solid #fac31d;}
	.CardOnMap .COMM_Favorite{background-color:#b52520;border:3px solid #b52520;}
	.CardOnMap .COMM_Icon_Btn:hover{background-color:#b6b6b6;}
	*/
	
	
	.B_Card .Card_One{width:360px;height:200px;border-radius:10px;background-color:white;border:1px solid #e5e6e9;position:relative;overflow:hidden;float:none;margin-left:auto;margin-right:auto;}
	.B_Card .Card_One:hover{border:1px solid #d5d5d8;}
	.B_Card .Card_One input[type=text]{width:100%;box-sizing:border-box;border:0;background-color:transparent;height:25px;padding-left:10px;padding-right:10px;}
	.B_Card .Card_One .C_Comon{position:absolute;}
	.B_Card .Card_One .Card_Pic img{width:100%;height:100%;}
	.B_Card .Card_One #Card_Pic_Main{background-color:#f6f7f8;width:80px;height:80px;border-radius:5px;left:10px;top:10px;text-align:center;color:gray;text-align:center;line-height:80px;font-size:12px;cursor:pointer;overflow:hidden;border:1px solid #a5a5a5;}
	.B_Card .Card_One #Card_Pic_Main:hover{background-color:#ededed;}
	.B_Card .Card_One .Card_Pic_Addt{height:35px;width:290px;top:95px;left:10px;}
	
	.B_Card .Card_One .Card_BusinessName{width:190px;left:100px;border-radius:2px;top:12px;line-height:25px;font-weight:bold;max-height:54px;overflow:hidden;}
	.B_Card .Card_One .Card_BusinessName #CN_BusinessName{font-size:23px;color:#36a7db;}
	.B_Card .Card_One #Card_OwnerName{top:50px;left:100px;font-weight:bold;color:#3b3b3b;font-size:15px;}
	.B_Card .Card_One #Card_ContactNumber{top:73px;left:100px;color:#b02c29;}
	.B_Card .Card_One .Card_Address{top:100px;left:15px;max-width:280px;color:#909090;font-size:12px;line-height:20px;}
	.B_Card .Card_One .Card_Age{width:100px;left:100px;border-radius:2px;top:60px;font-size:11px;color:#bd6565;}
	.B_Card .Card_One .Card_Menu{width:60px;right:0;top:0;height:200px;background-color:white;background-color:#f0f0f0;}
	.B_Card .Card_One .CM_Icon_One{width:40px;height:40px;background-color:white;font-size:20px;text-align:center;line-height:40px;margin-left:10px;border-radius:5px;margin-top:8px;color:white;cursor:pointer;}
	.B_Card .Card_One .CMI_Phone{background-color:#71cbf5;}
	.B_Card .Card_One .CMI_CloseVideo{background-color:#df5b5b;}
	.B_Card .Card_One .CMI_Chat{background-color:#6cc5ee;}
	.B_Card .Card_One .CMI_Map{background-color:#43a6d4;}
	.B_Card .Card_One .CMI_Detail{background-color:#2d95c6;}
	.B_Card .Card_One #Card_ShortD{padding-bottom:10px;padding-top:10px;left:10px;top:150px;border-left:5px solid #f6f7f8;padding-left:10px;color:#8a8a8a;max-width:260px;}
	.B_Card .Card_One #Card_ShortD p{overflow:hidden;max-height:30px;line-height:15px;}
	.B_Card .Card_One .CM_Icon_One:hover{background-color:#616161;color:white;}
	.B_Card .Card_Video_Button{
		width: 40px;
		height: 40px;
		background-color: #df5b5b;
		font-size: 20px;
		text-align: center;
		line-height: 40px;
		margin-left: 10px;
		border-radius: 5px;
		margin-top: 8px;
		color: white;
		cursor: pointer;
		position:absolute;
		right:68px;bottom:8px
	}
	.B_Card .Card_Video_Button:active{background-color: #616161}
	
	.B_Card .Card_Video_Container{z-index:100;position:absolute;left:0;top:0;display:none;}
	.B_Card .Card_Video_Stage{background-color:white;width:302px;height:202px;}
	.B_Card .Card_Video_Stage video{width:302px;height:202px;}
	.B_Card .Card_Video_Menu{width:60px;height:200px;background-color:#f0f0f0;position:absolute;right:-60px;top:0;border-radius:10px 10px 0 0;}
	.F_Card .Card_One{width:360px;height:200px;border-radius:10px;background-color:white;border:1px solid #e5e6e9;position:relative;overflow:hidden;}
	.F_Card .Card_One:hover{border:1px solid #d5d5d8;}
	.F_Card .Card_One input[type=text]{width:100%;box-sizing:border-box;border:0;background-color:transparent;height:25px;padding-left:10px;padding-right:10px;}
	.F_Card .Card_One .C_Comon{position:absolute;}
	.F_Card .Card_One .Card_Pic img{width:100%;height:100%;}
	.F_Card .Card_One .Card_Pic_Main{background-color:#f6f7f8;width:80px;height:80px;border-radius:5px;left:10px;top:10px;text-align:center;color:gray;text-align:center;line-height:80px;font-size:12px;cursor:pointer;overflow:hidden;}
	.F_Card .Card_One .Card_Pic_Main:hover{background-color:#ededed;}
	.F_Card .Card_One .Card_Pic_Addt{height:35px;width:290px;top:95px;left:10px;}
	.F_Card .Card_One .Card_Pic_Addt_One{background-color:#f6f7f8;height:100%;width:35px;margin-right:6px;border-radius:5px;text-align:center;line-height:35px;cursor:pointer;overflow:hidden;}
	.F_Card .Card_One .Card_Pic_Addt_One span{opacity:0;}
	.F_Card .Card_One .Card_Pic_Addt_One:hover span{opacity:1;}
	.F_Card .Card_One .Card_Name{width:190px;left:100px;border-radius:2px;top:17px;line-height:25px;font-weight:bold;max-height:54px;overflow:hidden;}
	.F_Card .Card_One .Card_Name #CN_Name{font-size:23px;color:#36a7db;}
	.F_Card .Card_One .Card_Name #CN_Status{color:#747474;font-size:12px;}
	.F_Card .Card_One .Card_Age{width:100px;left:100px;border-radius:2px;top:60px;font-size:11px;color:#bd6565;}
	.F_Card .Card_One .Card_Menu{width:60px;right:0;top:0;height:200px;background-color:white;background-color:#f0f0f0;}
	.F_Card .Card_One .CM_Icon_One{width:40px;height:40px;background-color:white;font-size:20px;text-align:center;line-height:40px;margin-left:10px;border-radius:5px;margin-top:8px;color:white;cursor:pointer;}
	.F_Card .Card_One .CMI_Phone{background-color:#71cbf5;}
	.F_Card .Card_One .CMI_Chat{background-color:#6cc5ee;}
	.F_Card .Card_One .CMI_Map{background-color:#43a6d4;}
	.F_Card .Card_One .CMI_Detail{background-color:#2d95c6;}
	.F_Card .Card_One #Card_ShortD{padding-bottom:10px;padding-top:10px;left:10px;top:140px;border-left:5px solid #f6f7f8;padding-left:10px;color:#8a8a8a;max-width:260px;}
	.F_Card .Card_One #Card_ShortD p{overflow:hidden;max-height:30px;line-height:15px;}
	.F_Card .Card_One .CM_Icon_One:hover{background-color:#616161;color:white;}
	
	
	/* Google Maps */
	.gm-style-iw{left:9px!important;}
	@media all and (max-width: 1400px) {
		
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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCEmRg5jDJbcvzjEqcfxAoAm4r38r8nEA"></script>


<script type="text/javascript">
	$(document).ready(function(){
		MyFunc.initPG();
		Scroll.init();
		MapGoogle.init('MapView');
		IconAni.init();
		Search.init();
		ResultTab.init();
		
		Card.init();
		
		$(document).on(touchOrClick,'.MI_One',function(){
			var Obj = $(this).find('.KBox_Star');
			if(Obj.hasClass('fa-star'))
			{
				$(this).removeClass('KBox_Checked');
				Obj.fadeOut(500,function(){
					$(this).removeClass("fa-spin fa-star");
				});
			}
			else
			{
				$(this).addClass('KBox_Checked');
				Obj.addClass("fa-spin fa-star").hide();
				Obj.fadeIn(500);
			}
		});
		
		$(document).on('change','#Search_Inp_Web',function(){
			$('#LV_Search_Inp').val($(this).val());
		});
		
		
		
		
	});
	
	var Card = new function(){
		this.init = function(){

			
			$(document).on(touchOrClick,'.Card_Video_Button',function(){
				var Obj = $(this).parents('.Card_One').find('.Card_Video_Container');
				Obj.slideDown();
				Obj.find('video').get(0).play();
			});
			
			$(document).on(touchOrClick,'.CMI_CloseVideo',function(){
				var Obj = $(this).parents('.Card_One').find('.Card_Video_Container');
				Obj.slideUp();
				Obj.find('video').get(0).pause();
			});
				
			$(document).on(touchOrClick,'.CMI_Detail',function(){
				$.ajax({
					type: "POST",
					url: __AjaxURL__+"?ajaxProcess",
					data: "menu=getCardInfo&CT="+$(this).parents('.Card_One').data('type')+"&cID="+$(this).parents('.Card_One').data('id'),
					success: function(d){
						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{
							timPopup(res.html);
							
						}
					}
				});
				
			});
			
		};
	};
	
	var ResultTab = new function(){
		this.init = function(){
			$(document).on(touchOrClick,'.LVT_Header',function(){
				/*showSideMSGBox("<i class='fa fa-search'></i> <?php echo $this->_Lang_www_home['no_friend_service'];?>","msgBox_One_1");*/
				$('.LVT_List').hide();
				$('.LVT_Header').removeClass('LVT_Selected');
				$(this).addClass('LVT_Selected');
				$("#"+$(this).parents('.LVT_One').attr('id')+'_List').show();
			});
		};
	};
	var IconAni = new function(){
		this.init = function(){
			this.randomIcon();
			this.randomFadeIn(200);
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
	};
	var Search = new function(){
		this.searchKeyword = '';
		this.NewsearchKeyword = '';
		this.relatedKeyword = {"Result":[{}]};
		this.KeywordBoxClasses = ['MI_Ocean','MI_Green','MI_Orange','MI_RedL','MI_Red','MI_Purple','MI_Grass','MI_Pink','MI_BlueL'];
		this.KeywordBoxSizes = [4,5,6];
		
		this.init = function(){
			var self = this;
			
			var Timer = null;
			$(document).on('keyup',"#Search_Inp_Web",function(e){
				if(e.which == 13)
				{
					self.searchKeyword = $('#Search_Inp_Web').val();
					self.searchNow();
				}
			});
			
			/* Reset and Refresh according to cookie value*/
			
			if(getCookie('SPref') != "")
			{
				$('.LVSOpt_Selected').removeClass('LVSOpt_Selected');
				$("#LV_SearchLocation_Option div[data-value="+getCookie('SPref')+"]").addClass('LVSOpt_Selected');
			}
			
			
			$(document).on(touchOrClick,'#LV_SearchLocation_Option div',function(){
				if(!$(this).hasClass('LVSOpt_Selected'))
				{
					$('.LVSOpt_Selected').removeClass('LVSOpt_Selected');
					$(this).addClass('LVSOpt_Selected');
					self.switchSetting();
				}
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
			
			$(document).on('keyup',"#LV_Search_Inp",function(e){
				if(e.which == 13)
				{
					self.searchKeyword = $('#LV_Search_Inp').val();
					self.searchNow();
				}
			});
			
			$(document).on(touchOrClick,"#LV_Search_BTN",function(){
			
				self.searchKeyword = $('#LV_Search_Inp').val();
				self.searchNow();
				
			});
			$(document).on(touchOrClick,"#Search_Button",function(){
				
				self.searchKeyword = $('#Search_Inp_Web').val();
				self.searchNow();
				
			});
			
			$(document).on('blur',"#Search_Inp_Web",function(){
				clearInterval(Timer);
				Timer = null;
			});
			
			

		};
		
		this.switchSetting = function(){
			document.cookie = "SPref="+this.getSelectedValue()+"; expires=Thu, 18 Dec 2900 12:00:00 UTC; path=/;domain=<?php echo __SITE__;?>"
		};
		
		this.getSelectedValue = function(){
			return $(".LVSOpt_Selected").data('value');
		};
		
		this.searchNow = function(){
			if(typeof this.searchKeyword != "undefined" && this.searchKeyword != "")
			{
				var URL = '/#K='+this.searchKeyword;
				var RK = '';
				
				if($(".KBox_Checked").length > 0)
				{
					RK = '&RK=';
					$(".KBox_Checked").each(function(){
						RK += encodeURIComponent($(this).find('.MI_Wrap').text())+"+";
					});
				}
				location.href = URL+RK.replace(/\+$/,'');
			}
			else
				showSideMSGBox("<i class='fa fa-search'></i> <?php echo $this->_Lang_www_home['need_search_keyword'];?>","msgBox_One_2");
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
						if(getJSonSize(res.Result) > 0)
						{
							
							$("#MovingIcons").html("");
							for(Key in res.Result)
							{
								if(res.Result.hasOwnProperty(Key))
									$("#MovingIcons").append('<div class="KBox_Pending '+self.KeywordBoxClasses[getRandomInt(0,(self.KeywordBoxClasses.length - 1))]+' MI_One noSelect MI_Size_'+self.KeywordBoxSizes[getRandomInt(0,(self.KeywordBoxSizes.length - 1))]+'"><div class="fa KBox_Star"></div><div class="MI_Wrap">'+res.Result[Key]['K']+'</div></div>');
							}
							IconAni.randomIcon();
							IconAni.randomFadeIn(100);
						}
						else
							$(".MI_One").fadeOut(1000);
						
					}
				}
			});
			
			
			
		};
		
		
	};
	
	var MapGoogle = new function(){
		this.markers = [];
		this.map;
		this.askedGPSBrowser = false;
		this.mapData = {};
		this.infowindow = new google.maps.InfoWindow();
		this.noResult_HTML;
		this.init = function(MapObjID){
			var self = this;
			var mapCanvas = document.getElementById(MapObjID);
			var mapOptions = {
				center: new google.maps.LatLng(37.498410, 127.026838),
				zoom: 17,
				scrollwheel: false,
				mapTypeControl: false,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			self.map = new google.maps.Map(mapCanvas, mapOptions);
			self.noResult_HTML = $("#LVT_1_List").html();
			
			
			refreshPage.Callback = function(res)
			{
				
				if(res.ack == 'success')
				{
					if(Scroll.CurrentTab != 1)
						Scroll.moveTabTo(1);
					
					$(".LVT_List").html(self.noResult_HTML);
					
					/* Reset Google Map Markers */
					for (var i = 0; i < self.markers.length; i++) {
						self.markers[i].setMap(null);
					}
	
					if("Business" in res)
					{
						for(Key in res.Business)
						{
							if(res.Business.hasOwnProperty(Key))
							{
								var Icon = '/Template/Img/';
								
								if(res.Business[Key]['T'] == 1)
									Icon += 'map-marker-business.png';
								else if(res.Business[Key]['T'] == 2)
									Icon += 'map-marker-friend.png';
								else if(res.Business[Key]['T'] == 3)
									Icon += 'map-marker-helper.png';
								
								
								var marker = new google.maps.Marker({
									position: new google.maps.LatLng(res.Business[Key]['Lat'], res.Business[Key]['Lon']),
									animation: google.maps.Animation.DROP,
									map: self.map,
									url: res.Business[Key]['U'],
									icon: Icon
								});
								self.markers.push(marker);
								google.maps.event.addListener(marker, 'click', function() {
									window.location.href = this.url;
								});
								
								if(typeof self.mapData[Key] == "undefined")
									self.mapData[Key] = {};
								
								self.mapData[Key]['infowindow'] =
									'<div class="B_Card">'+
										'<div class="Card_One Glow CardOnMap" data-cid="'+res.Business[Key]['cID']+"-"+res.Business[Key]['bID']+'" data-id="'+res.Business[Key]['bID']+'" data-type="B">'+
											'<div id="Card_Pic_Main" class="Card_Pic Glow C_Comon" data-picaddtid="1"><img src="'+res.Business[Key]['I']+'" /></div>'+
											'<div class="Card_BusinessName C_Comon"><span id="CN_BusinessName">'+res.Business[Key]['Name']+'</span></div>'+
											'<div id="Card_OwnerName" class="C_Comon">'+res.Business[Key]['OwnerName']+'</div>'+
											'<div id="Card_ContactNumber" class="C_Comon">'+res.Business[Key]['CNum']+'</div>'+
											'<div class="Card_Address C_Comon">'+
												'<span style="color:#737373;font-weight:bold;font-style:italic;">찾아오시는길</span><br />'+
												'<span id="Card_Address1_SPN">'+res.Business[Key]['Addr1']+'</span> <span id="Card_Address2_SPN">'+res.Business[Key]['Addr2']+'</span>'+
											'</div>'+
											'<div class="Card_Menu C_Comon">'+
												'<div class="CM_Icon_One CMI_Phone Glow" data-tooltip="'+res.Business[Key]['CNum']+'"><i class="fa fa-phone"></i></div>'+
												'<div class="CM_Icon_One CMI_Chat COMM_Chat Glow" data-tooltip="채팅"><i class="fa fa-commenting-o"></i></div>'+
												'<div class="CM_Icon_One CMI_Map Glow" data-tooltip="위치"><i class="fa fa fa-map-o"></i></div>'+
												'<a href="'+res.Business[Key]['U']+'" class="block CM_Icon_One CMI_Detail Glow" data-tooltip="자세히"><i class="fa fa-folder-open-o"></i></a>'+
											'</div>'+
											(res.Business[Key]['Video'] != "No" ? '<div class="Card_Video_Button Glow"><i class="fa fa-caret-square-o-right"></i>'/*+res.Business[Key]['Video'][0]['File']+*/+'</div>' : '') +
											(res.Business[Key]['Video'] != "No" ? '<div class="Card_Video_Container"><div class="Card_Video_Stage"><video controls><source src="'+res.Business[Key]['Video']+'"></video></div><div class="Card_Video_Menu"><div class="CM_Icon_One CMI_CloseVideo Glow"><i class="fa fa-times"></i></div></div></div>' : '') +
											'<div id="Card_ShortD" class="C_Comon">'+
												'<p id="Card_ShortD_Contents">'+res.Business[Key]['ShortD']+'</p>'+
												
											'</div>'+
										'</div>'+
									'</div>';
									
									/*
									'<div class="CardOnMap" data-cid="'+res.Business[Key]['cID']+"-"+res.Business[Key]['bID']+'" data-type="B">'+
										'<div class="COM_Image"><img src="'+res.Business[Key]['I']+'" /></div>'+
										'<div class="COM_Name">'+res.Business[Key]['Name']+'</div>'+
										'<div class="COM_ShortD">'+res.Business[Key]['ShortD']+'</div>'+
										'<div class="COM_Address"><b><?php echo $this->_Lang_www_home['direction'];?></b><br /><span>'+res.Business[Key]['Addr1']+''+res.Business[Key]['Addr2']+'</span></span></div>'+
										'<div class="COM_Menus">'+
											'<div data-tooltip="<?php echo $this->_Lang_www_home['detail_page'];?>" class="COMM_Home COMM_Icon_Btn Glow"><i class="fa fa-home"></i></div>'+
											'<div data-tooltip="<?php echo $this->_Lang_www_home['call'];?>" class="COMM_Call COMM_Icon_Btn Glow"><i class="fa fa-phone"></i></div>'+
											'<div data-tooltip="<?php echo $this->_Lang_www_home['chatting'];?>" class="COMM_Chat COMM_Icon_Btn Glow"><i class="fa fa-commenting"></i></div>'+
											'<div data-tooltip="<?php echo $this->_Lang_www_home['add_to_burume_book'];?>" class="COMM_Favorite COMM_Icon_Btn Glow"><i class="fa fa-heart"></i></div>'+
										'</div>'+
									'</div>';
									*/
								
								var IconPF = {};
								IconPF[0] = '/Template/Img/Del/1029-PF.png';
								IconPF[1] = '/Template/Img/Del/1033-PF.png';
								IconPF[2] = '/Template/Img/Del/1055-PF.png';
								IconPF[4] = '/Template/Img/Del/1060-PF.png';
								IconPF[5] = '/Template/Img/Del/1070-PF.png';
								IconPF[6] = '/Template/Img/Del/1102-PF.png';
								IconPF[7] = '/Template/Img/Del/1139-PF.png';
								IconPF[8] = '/Template/Img/Del/1155-PF.png';
								
								
								var marker = new google.maps.Marker({
									position: new google.maps.LatLng(parseFloat(res.Business[Key]['Lat']) + parseFloat('0.00'+getRandomInt(0,9)), parseFloat(res.Business[Key]['Lon']) + parseFloat('0.00'+getRandomInt(0,9))),
									animation: google.maps.Animation.DROP,
									map: self.map,
									url: res.Business[Key]['U'],
									icon: IconPF[getRandomInt(0,8)]
								});
								
								
								var marker = new google.maps.Marker({
									position: new google.maps.LatLng(parseFloat(res.Business[Key]['Lat']) - parseFloat('0.00'+getRandomInt(0,9)), parseFloat(res.Business[Key]['Lon']) - parseFloat('0.00'+getRandomInt(0,9))),
									animation: google.maps.Animation.DROP,
									map: self.map,
									url: res.Business[Key]['U'],
									icon: IconPF[getRandomInt(0,8)]
								});
								
								
									
							}
						}
						
						
						
						if(typeof res.Business[0] != "undefined")
						{
							self.showInfoWindow(0);
							self.goToPositionOnMap(res.Business[0].Lat,res.Business[0].Lon);
						}
						
						
						if(typeof res.BusinessLists != "undefined")
						{
							$("#LVT_1_List").html(res.BusinessLists);
						}
						
						
					}
					
					if(typeof res.FriendLists != "undefined" && res.FriendLists != "")
					{
						$("#LVT_2_List").html(res.FriendLists);
					}
					
					if(typeof res.HelperLists != "undefined" && res.HelperLists != "")
					{
						$("#LVT_3_List").html(res.HelperLists);
					}
					
					
					
				}
			};
			if(typeof getHash()['K'] != 'undefined')
			{
				refreshPage.Submit();
			}
			
			$(document).on(touchOrClick,'#LVT_1_List .LVT_Business_One',function(){
				$('.LVT_Business_One').removeClass('LVT_Business_Selected');
				$('.LVT_Business_One[data-index="'+$(this).data('index')+'"]').addClass('LVT_Business_Selected');
				self.showInfoWindow($(this).data('index'));
			});
			
			$(document).on(touchOrClick,'#LVT_2_List .LVT_Business_One',function(){
				timPopup($(this).find('.LVTB_Card').html(),true);
			});
			
			
			
			
			
			
		};
		
		this.showInfoWindow = function(index)
		{
			var self = this;
			self.infowindow.close();
			self.infowindow.setContent(self.mapData[index]['infowindow']);
			self.infowindow.open(self.map,self.markers[index]);
			self.map.setCenter(self.markers[index].getPosition());
			
		};
		this.goToPositionOnMap = function(Lat,Lon){
			this.map.setCenter(new google.maps.LatLng(Lat, Lon));
		};
		this.goGPSLocation = function(){
			var self = this;
			if (navigator.geolocation)
			{
				navigator.geolocation.getCurrentPosition(function(position)
				{
					var pos = {
						lat: position.coords.latitude,
						lng: position.coords.longitude
					};
			
					self.map.setCenter(pos);
				}, function() {
					handleLocationError(true, infoWindow, map.getCenter());
				});
			}
			else
			{
				/* Browser doesn't support Geolocation*/
				handleLocationError(false, infoWindow, map.getCenter());
			}
		};
	};
	
	

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
					initMap('MapView');
					if(typeof getHash()['K'] != 'undefined')
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
			
			$(document).on(touchOrClick,'#SearchByVoice_Button',function(){
				showSideMSGBox("<i class='fa fa-search'></i> <?php echo $this->_Lang_www_home['no_voice_service'];?>","msgBox_One_1");
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
		
		
		
		
		
	
	};
	
	function getRandomInt(min, max) {
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}
</script>
<?php echo $this->Load->View('www/inc/left_tab.tpl',array("PG"=>"Home"));?>
<div id="Tab_Stage" class="Front_Contents_Body">
	<div id="Tab_Wrap">
		<div class="Tab" id="Tab_0">
			<div id="ListView">
				<div id="LV_SearchLocation_Option" class="noSelect">
					<div data-value="0" class="Glow LVSOpt_Selected"><?php echo $this->_Lang_www_home['prio_location'];?></div>
					<div data-value="1" class="Glow"><?php echo $this->_Lang_www_home['prio_keyword'];?></div>
				</div>
				<div id="LV_Search_Block">
					<input type="text" id="LV_Search_Inp" placeholder="<?php echo $this->_Lang_www_home['need_search_keyword_2'];?>" /><button id="LV_Search_BTN"><i class="fa fa-search"></i></button>
				</div>
				<div id="LV_Tabs">
					<div id="LVT_1" class="LVT_One">
						<div class="LVT_Header LVT_Selected noSelect Glow"><?php echo $this->_Lang_general['business'];?></div>
					</div>
					<div id="LVT_2" class="LVT_One">
						<div class="LVT_Header noSelect Glow"><?php echo $this->_Lang_general['friend'];?></div>
					</div>
					<div id="LVT_3" class="LVT_One">
						<div class="LVT_Header noSelect Glow"><?php echo $this->_Lang_general['helper'];?></div>
					</div>
					
					<div id="LVT_1_List" class="LVT_List LVT_List_Selected noSelect">
						<?php echo '<div class="LVT_NoResult"><i class="fa fa-cube"></i>'.$this->_Lang_www_home['no_search_result'].'</div>';?>
					</div>
					<div id="LVT_2_List" class="LVT_List">
						<?php echo '<div class="LVT_NoResult"><i class="fa fa-cube"></i>'.$this->_Lang_www_home['no_search_result'].'</div>';?>
					</div>
					<div id="LVT_3_List" class="LVT_List">
						<?php echo '<div class="LVT_NoResult"><i class="fa fa-cube"></i>'.$this->_Lang_www_home['no_search_result'].'</div>';?>
					</div>
					
					<div id="LVT_2_CardList"></div>
				</div>
			</div>
			<div id="MapView"></div>
		</div>
		<div class="Tab" id="Tab_1">
			<div id="Search_Container">
				<div id="Logo_2" class="noSelect"><span id="Hello"><?php echo $this->_Lang_www_home['hello'];?></span><br /><span id="Burugo"><?php echo $this->_Lang_www_home['burugo'];?></span></div>
				<div id="Search_BG"></div>
				<div id="Search_Field_Box">
					<div id="RelatedKeyword_Box"></div>
					<div class="w100"><input id="Search_Inp_Web" type="text" placeholder="<?php echo $this->_Lang_www_home['lets_call'];?>" /></div>
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
				<div data-aniinx="1" class="Tab_Title_1"><?php echo $this->_Lang_www_home['s1_title_1'];?></div>
				<div data-aniinx="2" class="Tab_Title_2"><?php echo $this->_Lang_www_home['s1_title_2'];?></div>
				<div data-aniinx="3" class="Tab_Desc"><?php echo $this->_Lang_www_home['s1_desc'];?></div>
				<div data-aniinx="4" class="Tab_Img"></div>
			</div>
			<div class="Tab_BG"></div>
			
		</div>
		<div class="Tab" id="Tab_3">
			<div class="Tab_Contents">
				<div data-aniinx="0" class="Tab_Number">02</div>
				<div data-aniinx="1" class="Tab_Title_1"><?php echo $this->_Lang_www_home['s2_title_1'];?></div>
				<div data-aniinx="2" class="Tab_Title_2"><?php echo $this->_Lang_www_home['s2_title_2'];?></div>
				<div data-aniinx="3" class="Tab_Desc"><?php echo $this->_Lang_www_home['s2_desc'];?></div>
				<div data-aniinx="4" class="Tab_Img"></div>
			</div>
			<div class="Tab_BG"></div>
		</div>
		<div class="Tab" id="Tab_4">
			<div class="Tab_Contents">
				<div data-aniinx="0" class="Tab_Number">03</div>
				<div data-aniinx="1" class="Tab_Title_1"><?php echo $this->_Lang_www_home['s3_title_1'];?></div>
				<div data-aniinx="2" class="Tab_Title_2"><?php echo $this->_Lang_www_home['s3_title_2'];?></div>
				<div data-aniinx="3" class="Tab_Desc"><?php echo $this->_Lang_www_home['s3_desc'];?></div>
				<div data-aniinx="4" class="Tab_Img"></div>
			</div>
			<div class="Tab_BG"></div>
		</div>
		<div class="Tab" id="Tab_5">
			<div class="Tab_Contents">
				<div data-aniinx="0" class="Tab_Number">04</div>
				<div data-aniinx="1" class="Tab_Title_1"><?php echo $this->_Lang_www_home['s4_title_1'];?></div>
				<div data-aniinx="2" class="Tab_Title_2"><?php echo $this->_Lang_www_home['s4_title_2'];?></div>
				<div data-aniinx="3" class="Tab_Desc"><?php echo $this->_Lang_www_home['s4_desc'];?></div>
				<div data-aniinx="4" class="Tab_Img"></div>
			</div>
			<div class="Tab_BG"></div>
		</div>
		<div id="Tab1_Scroll_Dots">
			<div class="Glow Scroll_Dot_One" data-tooltip="<?php echo $this->_Lang_www_home['tab_name_1'];?>" data-tabid="1"></div>
			<div class="Glow Scroll_Dot_One" data-tooltip="<?php echo $this->_Lang_www_home['tab_name_2'];?>" data-tabid="0"></div>
			<div class="Glow Scroll_Dot_One" data-tooltip="<?php echo $this->_Lang_www_home['tab_name_3'];?>" data-tabid="-1"></div>
			<div class="Glow Scroll_Dot_One" data-tooltip="<?php echo $this->_Lang_www_home['tab_name_4'];?>" data-tabid="-2"></div>
			<div class="Glow Scroll_Dot_One" data-tooltip="<?php echo $this->_Lang_www_home['tab_name_5'];?>" data-tabid="-3"></div>
			<div class="Glow Scroll_Dot_One" data-tooltip="<?php echo $this->_Lang_www_home['tab_name_6'];?>" data-tabid="-4" id="Slide_4"></div>
		</div>
	</div>
</div>