<style type="text/css">
	.Card_One{width:360px;height:200px;border-radius:10px;background-color:white;border:1px solid #e5e6e9;position:relative;overflow:hidden;margin-bottom:15px;margin-right:30px;margin-top:30px;}
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
	
	.CardBox{width:100%;}
	.Card_One_ex{width:360px;height:200px;border-radius:10px;background-color:white;margin-top:20px;border:1px solid #e5e6e9;position:relative;}
	.Card_One_ex:hover{border:1px solid #d5d5d8;}
	.Card_One_ex .C_Comon{position:absolute;background-color:#f6f7f8;}
	.Card_One_ex .Card_Pic{width:80px;height:80px;border-radius:5px;left:10px;top:10px;}
	.Card_One_ex .Card_Name{height:20px;width:190px;left:100px;border-radius:2px;top:10px;}
	.Card_One_ex .Card_Phone{height:15px;width:100px;left:100px;border-radius:2px;top:40px;}
	.Card_One_ex .Card_Add{width:250px;height:50px;bottom:25px;left:50%;margin-left:-125px;border:1px solid #e5e6e9;border-radius:10px;color:#bfbfbf;font-size:16px;text-align:center;line-height:50px;cursor:pointer;display:block;}
	.Card_One_ex .Card_Add:hover{background-color:#f2f2f2;color:#5b5b5b;border:1px dotted gray;}
</style>
<div class="Front_Contents_Body Cover">
	<div class="ContentsBody_1">
		<h1>프렌드 카드</h1>
		<div class="CardBox">
			<div class="Card_One_ex Glow">
				<div class="Card_Pic C_Comon"></div>
				<div class="Card_Name C_Comon"></div>
				<div class="Card_Phone C_Comon"></div>
				<a href="/card/add" class="Card_Add C_Comon Glow">프렌드 카드 만들기</a>
			</div>
		</div>
		<?php
			if(isset($Cards['C']))
			{
				
				foreach($Cards['C'] AS $Cards_F)
				{
					echo '
						<div class="Card_One Glow">
						<div class="Card_Pic Card_Pic_Main Glow C_Comon">'.(sizeof($Cards_F['CardPics']) > 0 ? '<img src="/Template/Img/CData/'.$this->login->customers_id.'/F/'.$Cards_F['Card_ID'].'/CardImg/'.$Cards_F['CardPics'][0].'" />' : '사진').'</div>
						<div class="Card_Pic_Addt C_Comon">
							<div class="Card_Pic Card_Pic_Addt_One">'.(isset($Cards_F['CardPics'][1]) ? '<img src="/Template/Img/CData/'.$this->login->customers_id.'/F/'.$Cards_F['Card_ID'].'/CardImg/'.$Cards_F['CardPics'][1].'" />' : '<span class="Glow">+</span>').'</div>
							<div class="Card_Pic Card_Pic_Addt_One">'.(isset($Cards_F['CardPics'][2]) ? '<img src="/Template/Img/CData/'.$this->login->customers_id.'/F/'.$Cards_F['Card_ID'].'/CardImg/'.$Cards_F['CardPics'][2].'" />' : '<span class="Glow">+</span>').'</div>
							<div class="Card_Pic Card_Pic_Addt_One">'.(isset($Cards_F['CardPics'][3]) ? '<img src="/Template/Img/CData/'.$this->login->customers_id.'/F/'.$Cards_F['Card_ID'].'/CardImg/'.$Cards_F['CardPics'][3].'" />' : '<span class="Glow">+</span>').'</div>
							<div class="Card_Pic Card_Pic_Addt_One">'.(isset($Cards_F['CardPics'][4]) ? '<img src="/Template/Img/CData/'.$this->login->customers_id.'/F/'.$Cards_F['Card_ID'].'/CardImg/'.$Cards_F['CardPics'][4].'" />' : '<span class="Glow">+</span>').'</div>
							<div class="Card_Pic Card_Pic_Addt_One">'.(isset($Cards_F['CardPics'][5]) ? '<img src="/Template/Img/CData/'.$this->login->customers_id.'/F/'.$Cards_F['Card_ID'].'/CardImg/'.$Cards_F['CardPics'][5].'" />' : '<span class="Glow">+</span>').'</div>
							<div class="Card_Pic Card_Pic_Addt_One">'.(isset($Cards_F['CardPics'][6]) ? '<img src="/Template/Img/CData/'.$this->login->customers_id.'/F/'.$Cards_F['Card_ID'].'/CardImg/'.$Cards_F['CardPics'][6].'" />' : '<span class="Glow">+</span>').'</div>
							<div class="Card_Pic Card_Pic_Addt_One">'.(isset($Cards_F['CardPics'][7]) ? '<img src="/Template/Img/CData/'.$this->login->customers_id.'/F/'.$Cards_F['Card_ID'].'/CardImg/'.$Cards_F['CardPics'][7].'" />' : '<span class="Glow">+</span>').'</div>	
						</div>
						<div class="Card_Name C_Comon"><a href="/card/edit?id='.$Cards_F['Card_ID'].'" id="CN_Name">'.$Cards_F['Friend_Name'].'</span> <span id="CN_Status">( <i class="fa fa-heart"></i> 미혼 )</a></div>
						
						<div class="Card_Menu C_Comon">
							<div class="CM_Icon_One CMI_Phone Glow" data-tooltip="'.$Cards_F['Friend_Telephone'].'"><i class="fa fa-phone"></i></div>
							<div class="CM_Icon_One CMI_Chat Glow" data-tooltip="채팅"><i class="fa fa-commenting-o"></i></div>
							<div class="CM_Icon_One CMI_Map Glow" data-tooltip="위치"><i class="fa fa fa-map-o"></i></div>
							<div class="CM_Icon_One CMI_Detail Glow" data-tooltip="자세히"><i class="fa fa-folder-open-o"></i></div>
						</div>
						<div id="Card_ShortD" class="C_Comon">
							<p id="Card_ShortD_Contents">'.$Cards_F['Friend_ShortDesc'].'</p>
						</div>
					</div>
					
					';
				}
			}
		?>
		
		
		
	</div>
</div>