<?php
class CartCorpCatalogCategoryEdit_Controller extends GGoRok
{
	var $_isAdminPage = true;
	function home()
	{
		
		$Data['title'] = 'Edit Category | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		$Data['CurrentCategory'] = '';
		$Category_Model = $this->Load->Model('Category');
		
		if(isset($_GET['cID']) && is_numeric($_GET['cID']))
		{
			$CatInfo = $Category_Model->getCategory(array(
				'Cat_ID' => $_GET['cID']
			));
			
		
			if(sizeof($CatInfo) > 0)
			{
				$Category_Controller = $this->Load->Controller('cart/corp/catalog/category/home');
				$Data['MAIN_HTML']  = $this->Load->View('cart/corp/catalog/category/add.tpl');
				
				
				
				$Data['MAIN_HTML'] .= $this->Load->View('cart/corp/catalog/category/addmod-fields.tpl',array(
					'Cat_ID' => $CatInfo[0]['Cat_ID'],
					'Cat_DisplaySubCatPrd' => $CatInfo[0]['Cat_DisplaySubCatPrd'],
					'Cat_Name' => htmlentities($CatInfo[0]['Cat_Name']),
					'Cat_SEO_URL' => $CatInfo[0]['Cat_SEO_URL'],
					'Cat_Image_HTML' => $Category_Controller->Images($CatInfo[0]['Cat_ID'])['html'],
					'Cat_Desc_Top' => $CatInfo[0]['Cat_Desc_Top'],
					'Cat_Meta_Title' => htmlentities($CatInfo[0]['Cat_Meta_Title']),
					'Cat_Meta_Key' => htmlentities($CatInfo[0]['Cat_Meta_Key']),
					'Cat_Meta_Desc' => $CatInfo[0]['Cat_Meta_Desc'],
					'Cat_Desc_Bottom' => $CatInfo[0]['Cat_Desc_Bottom'],
					'Cat_DoorImage_HTML' => ''
				));
			
	
			
				$Home_Controller = $this->Load->Controller('cart/corp/home');
				echo $Home_Controller->loadHeader($Data);
			}
		}
		
		
		
		
	
	}
	
	
	
}
?>