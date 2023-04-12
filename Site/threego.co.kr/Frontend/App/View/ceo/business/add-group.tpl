<div class="ItemGroup_One" data-id="<?php echo (isset($ItemGrp_ID) ? $ItemGrp_ID : '');?>">
	<div class="ItemGroup_Name_Box"><input class="ItemGroup_Name" type="text" class="must" placeholder="예) 점심메뉴, 할인행사 품목" value="<?php echo (isset($ItemGrp_Name) ? $ItemGrp_Name : '');?>" /></div>
	<div class="ItemGroup_Menu_Box">
		<div class="Glow IG_Activate_BTN" data-tooltip="활성화" data-activated="true"><i class="fa fa-eye"></i></div>
		<div class="Glow IG_Down_BTN" data-tooltip="아래로"><i class="fa fa-arrow-down"></i></div>
		<div class="Glow IG_Up_BTN" data-tooltip="위로"><i class="fa fa-arrow-up"></i></div>
		<div class="Glow IG_List_BTN" data-tooltip="아이템 리스트"><i class="fa fa-list"></i></div>
		<div class="Glow IG_Delete_BTN" data-tooltip="삭제"><i class="fa fa-close"></i></div>
	</div>
	<div class="ItemGroup_ItemList_Box"><?php
		foreach($ItemsInGroup AS $ItemsInGroup_F)
		{
			echo '<div class="IG_Item_One">'.htmlspecialchars($ItemsInGroup_F['Item_Name']).'</div>';
		}
	?></div>
</div>

<?
// echo '<div class="Group_noItemAdded">'.$this->_Lang_ceo_business['noitems'].'</div>';
?>