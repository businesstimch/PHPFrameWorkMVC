<?
class CartC_Controller extends GGoRok
{
	var $cat;
	var $_Callable = array(
		
	);
	
	function home()
	{
		
		$this->AllCat = $this->_Model_Category->AllCat();
		$URL_Arr = $this->Controllers->getRequestArray();
		$CategoryURL = $URL_Arr[sizeof($URL_Arr) - 1];
		$C_Info = $this->_Model_Category->getCategory(array(
			'Cat_SEO_URL' => $CategoryURL
		));
		
		$C_Parents = $this->_Category->getParents_FromUrl($CategoryURL);
		
		/* Verify Category URL { */
		$URLVerify['Verify'] = array_slice($URL_Arr,1,-1);
		$URLVerify['URL'] = array();
		
		foreach($C_Parents AS $C_Parents_F)
		{
			$URLVerify['URL'][] = $C_Parents_F['Cat_SEO_URL'];
		}
		
		$isCategoryURLVerified = (sizeof(array_diff_assoc($URLVerify['Verify'],$URLVerify['URL'])) == 0 ? TRUE:FALSE);
		
		/* } Verify Category URL */
		
		
		# If Category does exist
		if(sizeof($C_Info) > 0 && $isCategoryURLVerified)
		{
			$C_Info = $C_Info[0];
		
			
			echo $this->Load->View('cart/header.tpl',array(
				'title' => $C_Info['Cat_Meta_Title'].'GGoRok Cart',
				'metaK' => $C_Info['Cat_Meta_Key'],
				'metaD' => $C_Info['Cat_Meta_Desc'],
				'login_token' => $this->token->login_token(true),
				'Category_HTML' => $this->_Cache->get_cache('Category')['data']
			));
			
			# Show all products in all nested categories?	
			if($C_Info['Cat_DisplaySubCatPrd'] == 1)
			{
				
				# Get child categories IDs
				$ChildCat_Tree = $this->getChildCat_Tree($C_Info['Cat_ID'], $this->AllCat);
				
				if(sizeof($ChildCat_Tree) > 0)
					$cID_ToPrint = $ChildCat_Tree;
				
				$cID_ToPrint[] = $C_Info['Cat_ID'];
				
			}
			else
				$cID_ToPrint = $C_Info['Cat_ID'];
			
			# Get products in this category
			$Prd_List = $this->_Model_Category->getProductList_SQL(array(
				'cID' => $cID_ToPrint,
				'Page' => (isset($_GET['p']) && is_numeric($_GET['p']) ? $_GET['p'] : NULL)
			));
		
			
			$ProductsList_HTML = '';
			
			# Display Products in this Category
			if(sizeof($Prd_List['P']) > 0)
			{
				
				foreach($Prd_List['P'] AS $Prd_List_F)
				{
					$P_Url = '/p/'.$Prd_List_F['Prd_SEO_URL'].'.html';
					
					if($Prd_List_F['isCall4Price'] == 1)
						$Prd_Price = 'Call for Price';
					else
						$Prd_Price = ($Prd_List_F['Prd_Price'] != "" && $Prd_List_F['Prd_Price'] > 0 ? "$".$Prd_List_F['Prd_Price'] : "Check Inside");
					
					$ProductsList_HTML .= $this->Load->View('cart/Category/ProductList.tpl', array(
						'cURL' => $C_Info['Cat_SEO_URL'],
						'Prd_ID' => $Prd_List_F['Prd_ID'],
						'Prd_Name' => $Prd_List_F['Prd_Name'],
						'Prd_Desc_Short' => $Prd_List_F['Prd_Desc_Short'],
						'Prd_Price' => $Prd_Price,
						'Prd_ListPrice' => ($Prd_List_F['Prd_ListPrice'] != "" && $Prd_List_F['Prd_ListPrice'] > 0 ? "$".$Prd_List_F['Prd_ListPrice'] : "--"),
						'Prd_Image' => ($Prd_List_F['Img_FileName'] != "" ? '<img src="/Template/Upload/'.__StoreID__.'/Products/'.$Prd_List_F['Prd_ID'].'/SC_List/'.$Prd_List_F['Img_FileName'].'" >' : "No Picture"),
						'P_F' => $Prd_List_F,
						'hasMandatoryOption' => $Prd_List_F['isMandatory'],
						'P_Url' => $P_Url
					));
					
					
					#$this->ProductList_HTML($Prd_List_F, $Prd_List_F['isMandatory'],$C_Info['Cat_SEO_URL']);
				}
			}
			else if($C_Info['Cat_Desc_Top'] == "")
				$ProductsList_HTML = $this->Load->View('cart/Category/NoProductList.tpl');
				
			$PG['hasPagination'] = ($Prd_List['T'][0]['Total'] > $this->_Setting->Data['General']['ProductPerPage'] ? True : False);
			$PG['Total_Page'] = ($Prd_List['T'][0]['Total'] / $this->_Setting->Data['General']['ProductPerPage']) + 1;
			$PG['Current_Page'] = (isset($_GET['p']) && is_numeric($_GET['p']) ? $_GET['p'] : 1);
			
			
			echo $this->Load->View('cart/c.tpl', array(
				'breadCrumb' => $this->breadCrumb($C_Info,$C_Parents),
				'Category_HTML' => $this->_Cache->get_cache('Category')['data'],
				'Cat_Desc_Top' => $C_Info['Cat_Desc_Top'],
				'Cat_Desc_Bottom' => $C_Info['Cat_Desc_Bottom'],
				'Total_Products' => sizeof($Prd_List['P']),
				'Product_List' => $ProductsList_HTML,
				'Total_Products' => sizeof($Prd_List['P']),
				'Total_Products_inThisPage' => $Prd_List['T'][0]['Total'],
				'hasPagination' => $PG['hasPagination'],
				'Total_Page' => $PG['Total_Page'], # +1 to start page from 1 not from 0
				'Current_Page' => $PG['Current_Page'],
				'URL' => '/'.implode('/',$URL_Arr).'/'
				
			));
			echo $this->Load->View('cart/footer.tpl');
		}
		else
		{
			
			echo $this->Load->View('404.tpl');
		}	
		
		
	}
	
	function getChildCat_Tree($CatID, $CatArr)
	{
		
		$IDs = array();
		foreach($CatArr as $K => $CatArr_F)
		{
			if($CatArr_F['Cat_Parent_ID'] == $CatID)
			{
				$IDs[] = $CatArr_F['Cat_ID'];
				$IDs = array_merge($IDs,$this->getChildCat_Tree($CatArr_F['Cat_ID'], $CatArr));
				unset($CatArr[$K]);
			}
			
		}
		
		return $IDs;
		
	}
	
	
	function getFullURL($cID, $Data = null, $output = array())
	{
		
		if(is_null($Data))
		{
			$Data = $this->_Model_Category->getCategory();
		}
		
		foreach($Data as $Data_F)
		{
			if($Data_F['Cat_ID'] == $cID)
			{
				$output[] = array($Data_F['Cat_SEO_URL'],$Data_F['Cat_Name']);
				$output = $this->getFullURL($Data_F['Cat_Parent_ID'],$Data,$output);
				break;
			}
			
		}
		
		if($cID == 0)
		{
			$output = array_reverse($output);
		}
		return $output;
		
	}
	
	function breadCrumb($C_Info, $C_Parents)
	{
		
		$HTML = '<a href="/">Home</a>';
		$URL_Stack = '/c/';
	
		foreach($C_Parents AS $K => $C_Parents_F)
		{
			$URL_Stack .= $C_Parents_F['Cat_SEO_URL'].'/';
			$HTML .= '<span> &gt; </span><a href="'.$URL_Stack.'">'.$C_Parents_F['Cat_Name'].'</a>';
			/*
			$Link = $URL_Tree_F.'/';
			$HTML .= '<a href="/c/'.$Link.'"'.(sizeof($URL_Tree) == $K + 1 ? ' class="currentCB"' : "").'>'.$URL_Tree_F.'</a><span>'.(sizeof($URL_Tree) != $K + 1 ? ' &gt; </span>' : "");
			*/
		}
			
		$HTML .= '<span> &gt; </span><b>'.$C_Info['Cat_Name'].'</b>';
		
		
		return $HTML;
	}
	
}

?>