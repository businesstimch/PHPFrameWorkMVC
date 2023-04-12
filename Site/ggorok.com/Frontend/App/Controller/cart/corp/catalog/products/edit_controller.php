<?php
class CartCorpCatalogProductsEdit_Controller extends GGoRok
{
	var $_isAdminPage = true;
	var $imgRelativePath,$imgAbsolutePath,$tubeAbsolutePath;
	
	function __construct()
	{
		$this->imgRelativePath = "Site/".__domain__."/Frontend/Img/Products/".__StoreID__;
		$this->imgAbsolutePath = __DocumentPath__.$this->imgRelativePath;
		$this->tubeAbsolutePath = __DocumentPath__."Site/".__domain__."/Backend/Stores/".__StoreID__."/Tubes/";
	}
	
	function home()
	{
		$Data['title'] = 'Edit Product | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		$Data['CurrentCategory'] = '';
		
		$Data['MAIN_HTML']  = $this->Load->View(_SubDomain_.'/corp/catalog/products/edit.tpl');
		
		if(isset($_GET['pID']) && !empty($_GET['pID']))
		{
			$P = $this->db->QRY("
				SELECT
					*
				FROM
					gc_products
				WHERE
					Prd_ID = '".$this->db->escape($_GET['pID'])."'
			");
			
			
			if(sizeof($P) > 0)
			{
				$P = $P[0];
				$Add_Controller = $this->Load->Controller(_SubDomain_.'/corp/catalog/products/add');
				$Data['MAIN_HTML'] .= $this->Load->View(_SubDomain_.'/corp/catalog/products/addmod-fields.tpl', array(
					'Prd_ID' => $P['Prd_ID'],
					'Prd_isActive' => $P['Prd_isActive'],
					'Prd_isFeatured' => $P['Prd_isFeatured'],
					'Prd_Name' => $P['Prd_Name'],
					'Prd_SEO_URL' => $P['Prd_SEO_URL'],
					'Prd_Desc_Short' => $P['Prd_Desc_Short'],
					'DescFiles' => $Add_Controller->DescFiles( $P['Prd_ID'] )['html'],
					'Prd_Desc_Long' => $P['Prd_Desc_Long'],
					'Prd_Tags' => htmlentities($P['Prd_Tags']),
					'Prd_Price' => $P['Prd_Price'],
					'Prd_ListPrice' => $P['Prd_ListPrice'],
					'Prd_isTaxble' => $P['Prd_isTaxble'],
					'Prd_Qty' => htmlentities($P['Prd_Qty']),
					'Prd_MinimumQty' => $P['Prd_MinimumQty'],
					'Prd_SKU' => $P['Prd_SKU'],
					'Prd_UPC' => $P['Prd_UPC'],
					'Prd_EAN' => $P['Prd_EAN'],
					'Prd_JAN' => $P['Prd_JAN'],
					'Prd_ISBN' => $P['Prd_ISBN'],
					'Prd_MPN' => $P['Prd_MPN'],
					'Prd_Weight' => $P['Prd_Weight'],
					'Prd_Dimension_L' => $P['Prd_Dimension_L'],
					'Prd_Dimension_W' => $P['Prd_Dimension_W'],
					'Prd_Dimension_H' => $P['Prd_Dimension_H'],
					'Prd_RewardPoint' => $P['Prd_RewardPoint'],
					
					'CategoryList' => $Add_Controller->CategoryList($P['Prd_ID'])['html'],
					'OptType_HTML' => $Add_Controller->OptType_HTML($P),
					'OptGrp_HTML' => $Add_Controller->OptGrp_HTML($P),
					'Product_Image' => $Add_Controller->Images($P['Prd_ID'])['html'],
					
					'Prd_Meta_Title' => $P['Prd_Meta_Title'],
					'Prd_Meta_Key' => $P['Prd_Meta_Key'],
					'Prd_Meta_Desc' => $P['Prd_Meta_Desc'],
					
					'AjaxURL' => __AdminPath__.'catalog/products/add?ajaxProcess'
				));
			}
		}
		
		$Home_Controller = $this->Load->Controller(_SubDomain_.'/corp/home');
		echo $Home_Controller->loadHeader($Data);
	
	}
}