<?php

class CartCorpCatalogProductOptionsEdit_Controller extends GGoRok
{
	var $_isAdminPage = true;
	function home()
	{
		$Data['title'] = 'Edit Product Options | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		
		if(isset($_GET['TplID']) && is_numeric($_GET['TplID']))
		{
			$Add_Controller = $this->Load->Controller(_SubDomain_.'/corp/catalog/product-options/add');
			
			$O = $this->db->QRY("
				SELECT
					*
				FROM
					gc_products_option_group
				WHERE
					OptGrp_ID = '".$this->db->escape($_GET['TplID'])."' AND
					isTemplate = 1
			");
			if(sizeof($O) > 0)
			{
				$Data['MAIN_HTML'] = $this->Load->View('cart/corp/catalog/product-options/addmod-fields.tpl', array(
					'Title_Text' => 'Add Option Group Template',
					'optionGroupModAdd_HTML' => $Add_Controller->optionGroupModAdd_HTML($O[0])['html'],
					'AjaxURL' => __AdminPath__.'catalog/product-options/add?ajaxProcess'
					
				));
			}
		}
		
		$Home_Controller = $this->Load->Controller('cart/corp/home');
		echo $Home_Controller->loadHeader($Data);
	}
	
}

?>