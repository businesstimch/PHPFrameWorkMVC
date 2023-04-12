<style type="text/css">
	#RC_List,#RC_Top_Desc,#RC_Bottom_Desc{width:100%;border: 1px solid rgba(223, 223, 223, 0.91);box-shadow: 0 0 5px rgba(223, 223, 223, 0.71);margin-bottom:10px;}
	
	#RC_Top_Desc,#RC_Bottom_Desc{width:100%;border:1px solid #dedede;line-height:20px;}
	
	#RC_List .TDI_One{width:190px;padding:5px;box-sizing:border-box;line-height:16px}
	#RC_List .TDI_One:hover{background-color:#f6f6f6;}
	#RC_List .TDI_One img{width:100%;height:100%;}
	#RC_List .TDI_Pic{background-color:#efefef;overflow:hidden;border-radius:10px;text-align:center;line-height:222px;display:block;float:left;width:180px;height:222px;margin-bottom:5px;color:gray;cursor:pointer;}
	#RC_List .TDI_DescBox{width:100%;}
	#RC_List .TDI_Name{width:100%;color:#34a511;font-size:12px;font-weight:bold;text-decoration:underline;min-height:50px;}
	#RC_List .TDI_Price b{color:#cf0000;font-size:14px;}
	#RC_List .TDI_Price span{font-weight:bold;}
	#RC_List .TDI_ShortD{width:100%;height:80px;padding:5px;box-sizing:border-box;border:1px solid #d2d2d2;border-radius:5px;margin-bottom:10px;margin-top:10px;background-color:#f5f5f5;overflow:auto;}
	#RC_List .TDI_Menus{width:100%;}
	#RC_List .TDI_Menus_One{line-height:30px;padding-left:8px;padding-right:8px;font-size:14px;border-radius:5px;color:white;cursor:pointer;}
	#RC_List .TDI_View{float:right;background-color:#595959;}
	#RC_List .TDI_AddCart{background-color:#00a8ff;}
	
	#RC_Bottom_Summary{width:100%;margin-bottom:50px;}
	
	
	#Pagination{width:100%;margin-top:20px;text-align:center;}
	#Pagination .Pagination_One{margin-right:10px;font-size:15px;color:gray;line-height:30px;text-align:center;height:30px;width:30px;background-color:#f4f4f4;cursor:pointer;border-radius:5px;}
	#Pagination .Pagination_Current{font-weight:bold;color:black;background-color:#595959;color:white;}
	#BreadCrumb_Block{width:100%;line-height:20px;margin-bottom:5px;border-radius:5px 5px 0 0;}
</style>
<div id="BreadCrumb_Block"><?php echo $breadCrumb;?></div>
<?php echo ($Cat_Desc_Top != "" ? '<div id="RC_Top_Desc">'.$Cat_Desc_Top.'</div>' : '' );?>
<div id="RC_List"<?php echo (sizeof($Total_Products) == 0 ? 'style="margin-top:0px;"':'');?>>
	<?php echo $Product_List;?>
</div>
<div id="RC_Bottom_Desc"><?php echo $Cat_Desc_Bottom;?></div>
<div id="RC_Bottom_Summary">
	<?php if(sizeof($Total_Products_inThisPage) > 0) {?>
	<div id="RB_TotalProduct">
		Displaying <b><?php echo $Total_Products;?></b> of <b><?php echo $Total_Products_inThisPage;?></b> Product(s)
	</div>
	<?php }?>
	
	<?php if($hasPagination) {?>
	<div id="Pagination">
		<?php
		for( $i = 1 ; $Total_Page > $i ; $i++ ) # +1 to start page from 1 not from 0
		{
			$URL_Pagi = addGetURL(array(
				'p' => $i
			));
			echo '<a href="'.$URL.'?'.$URL_Pagi.'" class="Block Pagination_One'.($Current_Page == $i ? ' Pagination_Current':'').'">'.$i.'</a>';
		}
		?>
	</div>
	<?php }?>
</div>
		