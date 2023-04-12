<style type="text/css">
	#SlidingBanner_Block{height:340px;}
	#SlidingBanner_Block #SB_Stage{width:818px;height:100%;}
	#SlidingBanner_Block #SB_Waiting{width:207px;height:100%;}
	#SlidingBanner_Block #SB_Waiting{background-color:#666563;}
	#SlidingBanner_Block .SBW_One{width:100%;height:66px;margin-bottom:2px;background-repeat:no-repeat;}
	#SlidingBanner_Block .SBW_Yellow{background-color:#f5cc3d;}
	#SlidingBanner_Block .SBW_Gray{background-color:#c5c5c5;}
	#SlidingBanner_Block .SBW_Sky{background-color:#88dcff;}
	#SlidingBanner_Block .SBW_Red{background-color:#ffb0b0;}
	#SlidingBanner_Block .SBW_Upper{color:white;font-weight:bold;font-size:18px;width:100%;margin-top:9px;}
	#SlidingBanner_Block .SBW_Upper span{margin-left:12px;}
	#SlidingBanner_Block .SBW_Lower{width:100%;margin-top:6px;margin-left:12px;color:#666563;font-weight:bold;opacity:0.90;}
	#SlidingBanner_Block .SBW_PriceDollar{font-size:25px;}
	#SlidingBanner_Block .SBW_PriceCents{font-size:18px;}
	
	#SBW_1{background-image:url('/Template/Img/Banners/SideBannerIcon-1.png');background-position:172px center;}
	#SBW_2{background-image:url('/Template/Img/Banners/SideBannerIcon-1.png');background-position:172px center;}
	#SBW_3{background-image:url('/Template/Img/Banners/SideBannerIcon-3.png');background-position:157px center;}
	#SBW_4{background-image:url('/Template/Img/Banners/SideBannerIcon-4.png');background-position:155px center;}
	
	.SectionHeader .SH_Title{height:49px;line-height:49px;color:#4e4e4e;font-size:20px;font-weight:bold;}
	.SectionHeader .SHB_1{height:100%;width:275px;background-color:#ffcc00;}
	.SectionHeader .SHB_Border{height:5px;width:100%;background-color:#d6d6d6;}
	
	.ItemSlider_Block{background-color:#f7f7f7;height:307px;text-align:center;overflow:hidden;position:relative;}
	.ItemSlider_Block .ISB_ItemBlock{margin-top:21px;}
	.ItemSlider_Block .ISB_Item_One{width:180px;height:100%;margin-right:20px;}
	.ItemSlider_Block .ISB_Item_One:first-child{margin-left:21px;}
	.ItemSlider_Block .ISB_Item_One:last-child{margin-right:0!important;}
	.ItemSlider_Block .ISBI_Text{margin-top:10px;}
	.ItemSlider_Block .ISBI_Image{width:100%;height:221px;}
	.ItemSlider_Block .ISBI_ItemName{color:#121212;font-size:15px;width:100%;overflow:hidden;}
	.ItemSlider_Block .ISBI_Price{font-size:18px;width:100%;font-weight:bold;line-height:28px;overflow:hidden;}
	.ItemSlider_Block .ISB_BTN{position:relative;border-radius:3px;border-top:3px solid white;border-bottom:3px solid white;position:absolute;top:50%;margin-top:-46px;background-color:#ffc600;opacity:0.65;width:56px;height:92px;line-height:92px;font-size:25px;color:white;font-family: "Times New Roman", Times, serif;cursor:pointer;}
	.ItemSlider_Block .ISB_BTN_Left{border-right:3px solid white;}
	.ItemSlider_Block .ISB_BTN_Right{border-left:3px solid white;right:0;}
	.ItemSlider_Block .ISB_BTN_Icn{background-image:url('/Template/Img/LeftRightBTN-Sliding.png');position:absolute;top:50px;left:50%;margin-left:-7px;margin-top:-16px;width:15px;height:28px;}
	.ItemSlider_Block .ISB_BTN_Icn_L{background-position:-15px;}
	
	
</style>
<div id="SlidingBanner_Block" class="outline">
	<div id="SB_Stage">
		<div id="SBS_One"><img src="/Template/Img/Banners/SlidingBanner-1.jpg" /></div>
	</div>
	<div id="SB_Waiting">
		<div class="SBW_One SBW_Yellow" id="SBW_1">
			<div class="SBW_Upper"><span>5 Years Warranty</span></div>
			<div class="SBW_Lower">
				<span class="SBW_PriceDollar">$864.</span><span class="SBW_PriceCents">60</span>
			</div>
			
		</div>
		<div class="SBW_One SBW_Gray" id="SBW_2">
			<div class="SBW_Upper"><span>JL Low Speed</span></div>
			<div class="SBW_Lower">
				<span class="SBW_PriceDollar">$864.</span><span class="SBW_PriceCents">60</span>
			</div>
		</div>
		<div class="SBW_One SBW_Sky" id="SBW_3">
			<div class="SBW_Upper"><span>500 PSI Extractor</span></div>
			<div class="SBW_Lower">
				<span class="SBW_PriceDollar">$864.</span><span class="SBW_PriceCents">60</span>
			</div>
		</div>
		<div class="SBW_One SBW_Red" id="SBW_4">
			<div class="SBW_Upper"><span>JL Bidet</span></div>
			<div class="SBW_Lower">
				<span class="SBW_PriceDollar">$864.</span><span class="SBW_PriceCents">60</span>
			</div>
		</div>
	</div>
	<div class="SectionHeader w100">
		<div class="SH_Title w100">Your Recently Viewed Items</div>
		<div class="w100 SHB_Border">
			<div class="SHB_1"></div>
		</div>
	</div>
	
	<div class="ItemSlider_Block w100">
		<div class="ISB_BTN_Left ISB_BTN"><div class="ISB_BTN_Icn ISB_BTN_Icn_L"></div></div>
		<div class="ISB_BTN_Right ISB_BTN"><div class="ISB_BTN_Icn ISB_BTN_Icn_R"></div></div>
		<div class="ISB_ItemBlock h100">
			<div class="ISB_Item_One">
				<div class="ISBI_Image"><img src="/Template/Img/delete/Sample1.jpg"></div>
				<div class="ISBI_Text w100">
					<span class="ISBI_ItemName w100">Mytee lite 8060</span><br />
					<span class="ISBI_Price w100 center">$809.20</span>
				</div>
			</div>
			<div class="ISB_Item_One">
				<div class="ISBI_Image"><img src="/Template/Img/delete/Sample1.jpg"></div>
				<div class="ISBI_Text w100">
					<span class="ISBI_ItemName w100">Mytee lite 8060</span><br />
					<span class="ISBI_Price w100 center">$809.20</span>
				</div>
			</div>
			<div class="ISB_Item_One">
				<div class="ISBI_Image"><img src="/Template/Img/delete/Sample1.jpg"></div>
				<div class="ISBI_Text w100">
					<span class="ISBI_ItemName w100">Mytee lite 8060</span><br />
					<span class="ISBI_Price w100 center">$809.20</span>
				</div>
			</div>
			<div class="ISB_Item_One">
				<div class="ISBI_Image"><img src="/Template/Img/delete/Sample1.jpg"></div>
				<div class="ISBI_Text w100">
					<span class="ISBI_ItemName w100">Mytee lite 8060</span><br />
					<span class="ISBI_Price w100 center">$809.20</span>
				</div>
			</div>
			<div class="ISB_Item_One">
				<div class="ISBI_Image"><img src="/Template/Img/delete/Sample1.jpg"></div>
				<div class="ISBI_Text w100">
					<span class="ISBI_ItemName w100">Mytee lite 8060</span><br />
					<span class="ISBI_Price w100 center">$809.20</span>
				</div>
			</div>
			<div class="ISB_Item_One">
				<div class="ISBI_Image"><img src="/Template/Img/delete/Sample1.jpg"></div>
				<div class="ISBI_Text w100">
					<span class="ISBI_ItemName w100">Mytee lite 8060</span><br />
					<span class="ISBI_Price w100 center">$809.20</span>
				</div>
			</div>
		</div>
	</div>
	
	<div class="w100">
		<img src="/Template/Img/Banners/JL-WetDryVac-Banner.jpg" /><img src="/Template/Img/Banners/JL-500PSI-Banner.jpg" />
	</div>
	<div class="SectionHeader w100">
		<div class="SH_Title w100">Best Selling Items</div>
		<div class="w100 SHB_Border">
			<div class="SHB_1"></div>
		</div>
	</div>
	
	<div class="ItemSlider_Block w100">
		<div class="ISB_BTN_Left ISB_BTN"><div class="ISB_BTN_Icn ISB_BTN_Icn_L"></div></div>
		<div class="ISB_BTN_Right ISB_BTN"><div class="ISB_BTN_Icn ISB_BTN_Icn_R"></div></div>
		<div class="ISB_ItemBlock h100">
			<div class="ISB_Item_One">
				<div class="ISBI_Image"><img src="/Template/Img/delete/Sample1.jpg"></div>
				<div class="ISBI_Text w100">
					<span class="ISBI_ItemName w100">Mytee lite 8060</span><br />
					<span class="ISBI_Price w100 center">$809.20</span>
				</div>
			</div>
			<div class="ISB_Item_One">
				<div class="ISBI_Image"><img src="/Template/Img/delete/Sample1.jpg"></div>
				<div class="ISBI_Text w100">
					<span class="ISBI_ItemName w100">Mytee lite 8060</span><br />
					<span class="ISBI_Price w100 center">$809.20</span>
				</div>
			</div>
			<div class="ISB_Item_One">
				<div class="ISBI_Image"><img src="/Template/Img/delete/Sample1.jpg"></div>
				<div class="ISBI_Text w100">
					<span class="ISBI_ItemName w100">Mytee lite 8060</span><br />
					<span class="ISBI_Price w100 center">$809.20</span>
				</div>
			</div>
			<div class="ISB_Item_One">
				<div class="ISBI_Image"><img src="/Template/Img/delete/Sample1.jpg"></div>
				<div class="ISBI_Text w100">
					<span class="ISBI_ItemName w100">Mytee lite 8060</span><br />
					<span class="ISBI_Price w100 center">$809.20</span>
				</div>
			</div>
			<div class="ISB_Item_One">
				<div class="ISBI_Image"><img src="/Template/Img/delete/Sample1.jpg"></div>
				<div class="ISBI_Text w100">
					<span class="ISBI_ItemName w100">Mytee lite 8060</span><br />
					<span class="ISBI_Price w100 center">$809.20</span>
				</div>
			</div>
			<div class="ISB_Item_One">
				<div class="ISBI_Image"><img src="/Template/Img/delete/Sample1.jpg"></div>
				<div class="ISBI_Text w100">
					<span class="ISBI_ItemName w100">Mytee lite 8060</span><br />
					<span class="ISBI_Price w100 center">$809.20</span>
				</div>
			</div>
		</div>
	</div>
	
	<div class="w100">
		<img src="/Template/Img/Banners/SkyBlue-Banner.jpg" /><img src="/Template/Img/Banners/JetForceBackpack-Banner.jpg" />
	</div>
	
	
	
	
</div>