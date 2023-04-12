<?php #CSS : ceo/business/add.tpl?>
<div class="Item_One" data-itemid="<?php echo (isset($Item_ID) ? $Item_ID : "");?>">
	<div class="Item_Pic_Box">
		<?php echo (isset($Item_Image) && $Item_Image != "" ? '<img src="'.$Item_Image.'" />' : '<i class="fa fa-picture-o"></i>');?>
	</div>
	<input type="file" class="Item_Pic_Inp" />
	<div class="Item_Name_Box"><input type="text" value="<?php echo (isset($Item_Name) ? $Item_Name : "");?>" class="Item_Name_Inp must" placeholder="<?php echo $this->_Lang_ceo_business['ex_item_name'];?>" /></div>
	<div class="Item_Menu_Box">
		<div class="Glow I_Activate_BTN" data-tooltip="<?php echo $this->_Lang_ceo_business['activate'];?>" data-activated="true"><i class="fa fa-eye"></i></div>
		<div class="Glow I_Down_BTN" data-tooltip="<?php echo $this->_Lang_ceo_business['down'];?>"><i class="fa fa-arrow-down"></i></div>
		<div class="Glow I_Up_BTN" data-tooltip="<?php echo $this->_Lang_ceo_business['up'];?>"><i class="fa fa-arrow-up"></i></div>
		<div class="Glow I_Edit_BTN" data-tooltip="<?php echo $this->_Lang_general['edit'];?>"><i class="fa fa-edit"></i></div>
		<div class="Glow I_Delete_BTN" data-tooltip="<?php echo $this->_Lang_general['delete'];?>"><i class="fa fa-close"></i></div>
	</div>
	<div class="Item_Detail">
		
		<div class="ItemD_One">
			<div class="ItemD_Header"><?php echo $this->_Lang_ceo_business['short_desc'];?></div>
			<div class="ItemD_Fields"><input value="<?php echo (isset($Item_Desc) ? $Item_Desc : "");?>" class="Item_D_Inp" type="text" placeholder="<?php echo $this->_Lang_ceo_business['short_desc_ex'];?>" /></div>
		</div>
		
		<div class="ItemD_One">
			<div class="ItemD_Header"><?php echo $this->_Lang_ceo_business['item_price'];?></div>
			<div class="ItemD_Fields"><input value="<?php echo (isset($Item_Price) ? $Item_Price : "");?>" class="Item_Price_Inp" type="text" placeholder="<?php echo $this->_Lang_ceo_business['item_price_ex'];?>" /></div>
			<div class="ItemD_Desc"><?php echo $this->_Lang_ceo_business['item_price_desc'];?></div>
		</div>
		
		<div class="ItemD_One">
			<div class="ItemD_Header">카테고리 선택</div>
			<div class="ItemD_Fields GGoRokCheckBox ItemCatBox">
				<?php
				
				if(isset($ItemGroups))
					foreach($ItemGroups AS $ItemGroups_F)
					{
						$isChecked = false;
						
						if(isset($ItemToGroup))
							foreach($ItemToGroup AS $ItemToGroup_F)
							{
								if($ItemToGroup_F['ItemGrp_ID'] == $ItemGroups_F['ItemGrp_ID'] && $Item_ID == $ItemToGroup_F['Item_ID'])
								{
									$isChecked = true;
									break;
								}
							}
						
						echo '
							<div class="GC_ChkBox_One Glow" data-grpid="'.$ItemGroups_F['ItemGrp_ID'].'">
								<div class="GC_ChkBox'.($isChecked ? ' GC_ChkBox_Checked' : '').'">
									<i class="fa fa-check"></i>
								</div>
								<div class="GC_ChkBox_Name">'.$ItemGroups_F['ItemGrp_Name'].'</div>
							</div>
						';
						
					}
				else
					echo '<div class="w100 center" style="margin-top:80px;">등록된 카테고리가 없습니다.</div>';
				?>
			</div>
			<div class="ItemD_Desc">
				필수체크사항 : 카테고리에 등록된 아이템만 실제로 고객들에게 노출 됩니다. 등록된 카테고리가 없을 경우 상단 카테고리 박스에서 카테고리를 등록해 주세요.
			</div>
		</div>
		
		<div class="ItemD_One">
			<div class="ItemD_Header"><?php echo $this->_Lang_ceo_business['item_stock'];?></div>
			<div class="ItemD_Fields"><input type="text" value="<?php echo (isset($Item_Qty) ? $Item_Qty : "");?>" class="Item_ItemStock_Inp" placeholder="<?php echo $this->_Lang_ceo_business['item_stock_ex'];?>" /></div>
			<div class="ItemD_Desc">
				<?php echo $this->_Lang_ceo_business['item_stock_desc'];?>
			</div>
		</div>
		
		<div class="ItemD_Close_Box"><button class="Button_1"><?php echo $this->_Lang_ceo_business['save_close'];?></button></div>
	</div>
</div>