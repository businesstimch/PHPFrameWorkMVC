<?php #CSS : ceo/business/add.tpl?>
<div class="Item_One">
	<div class="Item_Pic_Box">
		<i class="fa fa-picture-o"></i>
	</div>
	<input type="file" class="Item_Pic_Inp" />
	<div class="Item_Name_Box"><input type="text" class="must" placeholder="<?php echo $this->_Lang_ceo_business['ex_item_name'];?>" /></div>
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
			<div class="ItemD_Fields"><input type="text" placeholder="<?php echo $this->_Lang_ceo_business['short_desc_ex'];?>" /></div>
		</div>
		
		<div class="ItemD_One">
			<div class="ItemD_Header"><?php echo $this->_Lang_ceo_business['item_price'];?></div>
			<div class="ItemD_Fields"><input type="text" placeholder="<?php echo $this->_Lang_ceo_business['item_price_ex'];?>" /></div>
			<div class="ItemD_Desc"><?php echo $this->_Lang_ceo_business['item_price_desc'];?></div>
		</div>
		
		<div class="ItemD_One">
			<div class="ItemD_Header"><?php echo $this->_Lang_ceo_business['item_stock'];?></div>
			<div class="ItemD_Fields"><input type="text" placeholder="<?php echo $this->_Lang_ceo_business['item_stock_ex'];?>" /></div>
			<div class="ItemD_Desc">
				<?php echo $this->_Lang_ceo_business['item_stock_desc'];?>
			</div>
		</div>
		
		<div class="ItemD_One">
			<div class="ItemD_Header">카테고리 추가</div>
			<div class="ItemD_Fields"><input type="text" placeholder="<?php echo $this->_Lang_ceo_business['item_stock_ex'];?>" /></div>
			<div class="ItemD_Desc">
				<?php echo $this->_Lang_ceo_business['item_stock_desc'];?>
			</div>
		</div>
		
		<div class="ItemD_Close_Box"><button class="Button_1"><?php echo $this->_Lang_ceo_business['save_close'];?></button></div>
	</div>
</div>