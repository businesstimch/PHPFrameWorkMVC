<style type="text/css">
	#Product_Block_Container{width:100%;box-sizing:border-box;border:1px solid #dedede;}
	#Product_Block{width:100%;}
	.P_Outline{width:100%;}
	#PName_Block{width:100%;font:16px/30px "DaysRegular",Arial,sans-serif;color:#3f3f3f!important;font-weight:bold;padding-left:10px;box-sizing:border-box;line-height:50px;border-bottom:1px solid #dedede;}
	
	#PImg_Block{width:155px;margin:13px;}
	#PIS_Pic_Block{width:100%;height:185px;box-shadow:0 0 15px 2px #cecfce;}
	#PIS_Pic_Block img{width:100%;height:100%;}
	
	#PImg_Block .PIW_One{width:47px;height:57px;}
	#PImg_Block .PIW_One img{width:100%;height:100%;}
	
	#PInfo_Block{width:274px;}
	#P_Price{color:#9e0b0f;font-size:20px;font-weight:bold;}
	.PInfo_One{width:100%;line-height:30px;color:#686868;}
	.PInfo_One .PInfo_Name{width:85px;text-align:right;}
	.PInfo_One .PInfo_Value{width:180px;padding-left:6px;box-sizing:border-box;}
	#PImg_Showcase{width:150px;height:184px;text-align:center;line-height:184px;background-color:#eaeaea;color:gray;}
	#PImg_WaitingRoom{width:100%;height:57px;margin-top:10px;}
	#PImg_WaitingRoom .PIW_Btn{width:15px;height:100%;background-color:#cdcdcd;text-align:center;color:white;line-height:57px;font-size:20px;cursor:pointer;}
	#PImg_WaitingRoom .PIW_Btn:hover{background-color:#b5b5b5;}
	#PImg_WaitingRoom #PIW_Right{float:right;}
	#PImg_WaitingRoom #PIW_Showroom{width:124px;height:57px;overflow:hidden;padding-left:6px;box-sizing:border-box;}
	.SmallPrice_TXT{font-size:13px;color:gray;}
	
	#P_Cart_Block{position:relative;height:108px;}
	#P_Cart{width:787px;height:108px;background-image:url('/Template/Img/bar.png');background-repeat:no-repeat;position:absolute;left:-10px;}
	#P_CartQty{width:50px;height:38px;border-radius:10px;overflow:hidden;border:1px solid gray;position:absolute;top:10px;left:79px;}
	#P_CartQty_Inp{width:100%;height:100%;text-align:center;border:0;padding:0;font-weight:bold;font-size:15px;}
	#P_CartAdd_Btn{padding:15px;border-radius:5px;position:absolute;right:26px;top:37px;background-color:white;box-shadow:0 0 15px 2px #858585;font-weight:bold;cursor:pointer;cursor:pointer;}
	#P_CartAdd_Btn:hover{background-color:#25adf4;color:white;}
	#PTab_Block{width:100%;border-bottom:1px solid #dedede;}
	#PTab_Block .PTab_One{padding:10px;background-color:#efefef;border-radius:10px 10px 0px 0px;margin-left:10px;border-left:1px solid gray;border-right:1px solid gray;border-top:1px solid gray;cursor:pointer;}
	
	.PDetail_Block{display:none;width:100%;min-height:300px;padding-top:15px;}
	.PTabSelected{background-color:#2493d3!important;color:white;border-color:#085b8b!important;}
	#P_SDesc{width:100%;min-height:30px;}
	
	.P_OptField{width:100%;cursor:pointer;}
	.OptStyl_1{width:100%;border:1px solid #b8b8b8;border-radius:5px;box-sizing:border-box;line-height:26px;position:relative;}
	.OptStyl_1 .Opt_Selected_Name span{margin-left:10px;}
	.OptStyl_1 .OptField_One{text-align:center;}
	.OptStyl_1 .Opt_Select_One{width:100%;text-align:center;}
	.OptStyl_1 .Opt_Lists{display:none;position:absolute;top:26px;width:100%;left:-1px;background-color:white;z-index:100;border-left:1px solid #b8b8b8;border-right:1px solid #b8b8b8;border-bottom:1px solid #b8b8b8;border-radius:0 0 5px 5px;}
	.OptStyl_1 .Opt_Selected{width:100%;text-align:center;position:relative;}
	.OptStyl_1 .Opt_Selected_Arrow{position:absolute;right:5px;line-height:30px;}
	.OptStyl_1 .Opt_Select_One:hover{background-color:#31b2ee;color:white;}
	.Opt_Activated{border-radius:5px 5px 0 0!important;}
	
</style>
<script type="text/javascript" src="/Template/JS/P.js?0"></script>

<div id="Product_Block_Container">
	<div id="Product_Block" class="P_Outline" data-pid="<?php echo $Prd_ID;?>">
		<div id="PName_Block"><?echo $Prd_Name;?></div>
		
		<div class="P_Outline">
			<div id="PImg_Block">
				<?
				$Img_Showcase = '';
				$Img_Waiting = '';
				if(sizeof($Prd_Img) > 0)
				{
					foreach($Prd_Img AS $K => $Img_F)
					{
						
						if($Img_F['Img_isDefault'] == 1)
							$Img_Showcase = '<div id="PIS_Pic_Block"><img id="PIS_Pic" src="/Template/Upload/'.__StoreID__.'/Products/'.$Img_F['Prd_ID'].'/SC_Showcase/'.$Img_F['Img_FileName'].'" /></div>';
						
						$Img_Waiting .= '<div class="PIW_One'.($K == 0 ? " PIW_One_Selected":"").' Glow"><img class="PIW_Pic" src="/Template/Upload/'.__StoreID__.'/Products/'.$Img_F['Prd_ID'].'/SC_Thumb/'.$Img_F['Img_FileName'].'" /></div>';
					}
				}
				
				?>
				<div id="PImg_Showcase"><?echo ($Img_Showcase == '' ? 'No Image' : $Img_Showcase);?></div>
				<div id="PImg_WaitingRoom">
					<div id="PIW_Left" class="PIW_Btn Glow"><i class="fa fa-caret-left"></i></div>
					<div id="PIW_Showroom"><?echo $Img_Waiting;?></div>
					<div id="PIW_Right" class="PIW_Btn Glow"><i class="fa fa-caret-right"></i></div>
				</div>
			</div>
			
			<div id="PInfo_Block">
				<div class="PInfo_One">
					<div class="PInfo_Name">Item # : </div>
					<div class="PInfo_Value" id="SKU_Block"><?php echo $Prd_SKU;?></div>
				</div>
				
				<?php if($Prd_ListPrice > 0){?>
				<div class="PInfo_One">
					<div class="PInfo_Name">List Price : </div>
					<div class="PInfo_Value" id="PList_Price"><?php echo ($Prd_ListPrice > 0 ? ' $'.$Prd_ListPrice:"");?></div>
				</div>
				<?php }?>
				<div class="PInfo_One">
					<div class="PInfo_Name">Price : </div>
					<div class="PInfo_Value" id="P_Price" data-baseprice="<?php echo $Prd_Price;?>"><?php echo $Price_HTML;?></div>
				</div>
				<div id="P_Option">
					<?php echo $Option_HTML;?>
				</div>
				
			</div>
		</div>
		<div class="P_Outline" id="P_Cart_Block">
			<div id="P_Cart">
				<div id="P_CartQty" class="Glow"><input id="P_CartQty_Inp" maxlength="4" type="text" value="1" /></div>
				<div id="P_CartAdd_Btn" class="Glow noSelect"><i class="fa fa-cart-plus"></i> ADD TO CART</div>
			</div>
		</div>
		<div class="P_Outline">
			<div id="P_SDesc"><?php echo $Prd_Desc_Short;?></div>
			
			<div id="PTab_Block" class="noSelect">
				
				
				<?echo (sizeof($Tubes) > 0 ? '<div class="PTab_One" data-tabid="PTube_Block">VIDEOS <i class="fa fa-caret-down"></i></div>':'');?>
				<?echo ($Prd_Desc_Long != "" ? '<div class="PTab_One PTabSelected" data-tabid="PDesc_Block">ITEM DESCRIPTION <i class="fa fa-caret-down"></i></div>':'');?>
				
				<div class="PTab_One" style="margin-left:10px;" data-tabid="PRelated_Block">RELATED ITEMS <i class="fa fa-caret-down"></i></div>
				<div class="PTab_One" data-tabid="PReviews_Block">CUSTOMERS REVIEWS <i class="fa fa-caret-down"></i></div>
				<div class="PTab_One" data-tabid="PShipDel_Block">SHIPPING &amp; DELIVERY <i class="fa fa-caret-down"></i></div>
			</div>
		</div>
		<div class="P_Outline">
			
			<?
			
			
			if(sizeof($Tubes) > 0)
			{
			?>
			<div id="PTube_Block" class="PDetail_Block">
				<div class="w100">
				<?php
					foreach($Tubes AS $Tube_F)
					{
						echo '<video class="PVideo_One" width="700" height="394" src="/Template/Stores/'.__StoreID__.'/Tubes/'.$Tube_F.'"></video>';
					}
				?>
				</div>
			</div>
			<?
			}
			?>	
			
			<div id="PDesc_Block" class="PDetail_Block" style="display:block;">
				<?echo $Prd_Desc_Long;?>
			</div>

			<div id="PRelated_Block" class="PDetail_Block">
				
				
			</div>
			<div id="PReviews_Block" class="PDetail_Block">
				
			</div>
			<div id="PShipDel_Block" class="PDetail_Block">
				
				
			</div>
			<div id="PMSDSDown_Block" class="PDetail_Block">
				
			</div>
		</div>
	</div>
</div>