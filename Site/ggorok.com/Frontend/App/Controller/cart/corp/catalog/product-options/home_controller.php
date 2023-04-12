<?php
class CartCorpCatalogProductOptionsHome_Controller extends GGoRok
{
	var $_isAdminPage = true;
	function home()
	{
		$Data['title'] = 'Product Option List | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		
		$Data['MAIN_HTML'] = $this->Load->View('cart/corp/catalog/product-options/home.tpl', array(
			'OptionTemplateList' => $this->OptionTemplateList()['html']
			
		));
		
		$Home_Controller = $this->Load->Controller('cart/corp/home');
		echo $Home_Controller->loadHeader($Data);
	}
	
	function OptionTemplateList()
	{
		$Limit = 50;
		$output['ack'] = 'success';
		$Data = $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."products_option_group TP,
				".DB_Table_Prefix."products_option_group_type T
			WHERE
				TP.Store_ID = ".__StoreID__." AND
				T. OptGrp_Type_ID = TP.OptGrp_Type_ID AND
				TP.isTemplate = 1
			ORDER BY
				TP.OptGrp_ID ASC
			LIMIT
				".$Limit."
		");
		$output['html'] = '';
		
		if(sizeof($Data) > 0)
		{
			$output['html'] .= '
					<div class="OPT_List_One OPT_List_Header">
						<div class="OPT_List_Name OPT_List_Col">Option Template Name</div>
						<div class="OPT_List_Type OPT_List_Col">Option Type</div>
					</div>
			';
			foreach($Data AS $Data_F)
			{
				$output['html'] .= '
					<div class="OPT_List_One OPT_List_Contents hand Glow" data-tplid="'.$Data_F['OptGrp_ID'].'">
						<div class="OPT_List_Name OPT_List_Col">'.$Data_F['OptGrp_Name'].'</div>
						<div class="OPT_List_Type OPT_List_Col">'.$Data_F['OptGrp_Type_Name'].'</div>
					</div>
				';
			}
		}
		else
		{
			$output['html'] .= 'No Option Template Found';
		}
		
		return $output;
	}
	function deleteOptionTemplate()
	{
		
		$output['ack'] = 'error';
		if(isset($_POST['TplID']))
		{
			
			$Data = $this->db->QRY("
				SELECT
					OptGrp_ID
				FROM
					gc_products_option_group
				WHERE
					Store_ID = '".__StoreID__."' AND
					OptGrp_ID = '".$this->db->escape($_POST['TplID'])."' AND
					isTemplate = 1
			");
			
			if(sizeof($Data) > 0)
			{
				
				$this->db->QRY("DELETE FROM gc_products_option_group WHERE OptGrp_ID = '".$this->db->escape($_POST['TplID'])."' AND Store_ID = '".__StoreID__."' AND isTemplate = '1'");
				$output['ack'] = 'success';
			}
			else
			{
				$output['error_msg'] = "This option template doesn't exsist or is already deleted.";
			}
			
			
		}
		return $output;
	}
}
?>