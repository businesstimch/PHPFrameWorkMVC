<?php
class CartCorpCatalogCategoryAdd_Controller extends GGoRok
{
	
	var $_isAdminPage = true;
	
	function home()
	{
		
		$Data['title'] = 'Add Category | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		$Data['CurrentCategory'] = '';
		
		$Category_Controller = $this->Load->Controller('cart/corp/catalog/category/home');
		$Data['MAIN_HTML']  = $this->Load->View('cart/corp/catalog/category/add.tpl');
		$Data['MAIN_HTML'] .= $this->Load->View('cart/corp/catalog/category/addmod-fields.tpl',array(
			'Cat_ID' => '',
			'Cat_DisplaySubCatPrd' => false,
			'Cat_Name' => htmlentities(''),
			'Cat_SEO_URL' => '',
			'Cat_Image_HTML' => $Category_Controller->Images()['html'],
			'Cat_Desc_Top' => '',
			'Cat_Meta_Title' => htmlentities(''),
			'Cat_Meta_Key' => htmlentities(''),
			'Cat_Meta_Desc' => '',
			'Cat_Desc_Bottom' => '',
			'Cat_DoorImage_HTML' => ''
		));
		

		
		$Home_Controller = $this->Load->Controller('cart/corp/home');
		echo $Home_Controller->loadHeader($Data);
	
	}
	
}
?>