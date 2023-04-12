<?php
class CartCorpCatalogCategoryHome_Controller extends GGoRok
{
	var $UploadPath = array();
	var $_isAdminPage = true;
	function __construct()
	{
		$this->UploadPath['Absolute_Base'] = __UploadPath__.__StoreID__.'/Categories/';
		$this->UploadPath['Relative_Base'] = '/Template/Upload/Products/'.__StoreID__.'/';
	}
	function home()
	{
		$Data['title'] = 'Cateogry | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		$Data['CurrentCategory'] = '';
		$Data['MAIN_HTML'] = $this->Load->View('cart/corp/catalog/category/home.tpl', array(
			'CategoryList' => $this->CategoryList()['html']
			
		));
		
		$Home_Controller = $this->Load->Controller('cart/corp/home');
		echo $Home_Controller->loadHeader($Data);
	}
	
	function Images($cID = NULL)
	{
		global $db;
		$output['ack'] = 'success';
		$output['html'] = "";
		
		if(isset($cID) && is_numeric($cID))
		{
			$C = $this->db->QRY("
				SELECT
					*
				FROM
					gc_category_description_images
				WHERE
					Cat_ID = '".$db->escape($cID)."'
			");
			if(sizeof($C) > 0)
			{
				foreach($C as $C_F)
				{
					$output['html'] .= $this->Images_Html($C_F)['html'];
				}
				$output['html'] .= $this->Images_Html()['html'];
			}
			else
				$output['html'] = $this->Images_Html()['html'];
		}
		else
		{
			$output['html'] = $this->Images_Html()['html'];
		}
		
		
		
			
		
		
		return $output;
	}
	
	function Images_Html($Data = null)
	{
		$output['ack'] = 'success';
		$output['html'] = '
			<div class="TP_Image_One" data-descimgid="'.(!is_null($Data) ? $Data['CD_Img_ID']:"").'">
				<div class="xButton deleteImg_BTN"></div>
				<div class="TP_Img_Preview">'.(!is_null($Data) ? '<img src="/Template/Upload/'.__StoreID__.'/Categories/'.$Data['Cat_ID'].'/Description/'.$Data['CD_Img_FileName'].'">' : 'Upload(+)').'</div>
				<div class="noSelect TP_Img_Default_Btn">Copy Link</div>
				'.($Data == null ? '<input type="file" class="TP_Img_Inp" />':'').'
			</div>
		';
		
		return $output;
	}
	
	function CategoryList($cID = null)
	{
		$output['ack'] = 'success';
		$C = $this->db->QRY("
			SELECT
				*
			FROM
				gc_category
			WHERE
				Store_ID = ".__StoreID__."
			ORDER BY
				Cat_Parent_ID ASC,
				Cat_Sort ASC
		");
		$output['html'] = '';
		
		if(sizeof($C) > 0)
		{
			$output['html'] = $this->CategoryList_Recursive($C);
		}
		else
		{
			$output['html'] = 'No Category Found';
		}
		
		return $output;
	}
	
	function CategoryList_Recursive($Data,$ParentID = 0, $Depth = 0)
	{
		$HTML = '';
		
		if($Depth == 0)
		{
			$HTML .= '<div class="CatList_Block CatList_OuterMost CL_Opened" data-parentcatid="0">';
			if(sizeof($Data) > 0)
			{
				$HTML .= '<div class="OpenCloseCategory_BTN" data-targetcatid="0">+</div>';
			}
		}
		
		
		
		foreach($Data as $K => $Data_F)
		{
			
			if($Data_F['Cat_Parent_ID'] == $ParentID)
			{
				$HTML .= '<div class="CatList_Group'.($Depth == 0 ? ' CG_Top' : '').'">';
				$HTML .= '	<div class="CatList_One noSelect" data-catid="'.$Data_F['Cat_ID'].'"><div class="changeOrder"></div><i class="fa fa-folder-open-o"></i>'.$Data_F['Cat_Name'].'<div class="foldMenu fa fa-minus"></div></div>
									<div class="CatList_Block" data-parentcatid="'.$Data_F['Cat_ID'].'">';
										unset($Data[$K]);
										
										foreach($Data as $K2 => $Data2_F)
										{
											if($Data2_F['Cat_Parent_ID'] == $Data_F['Cat_ID'])
											{
												$HTML .= $this->CategoryList_Recursive($Data, $Data2_F['Cat_Parent_ID'],$Depth + 1);
												$HTML .= '<div class="OpenCloseCategory_BTN">+</div>';
												break;
											}
										}
				$HTML .= '	</div>
							</div>';
			}
			
		}
		if($Depth == 0)
			$HTML .= '</div>';
			
		return $HTML;
	}
	
	function saveCategory()
	{
		
		$output['ack'] = 'error';
		$Go = true;
			
		$Config["Data"] = $_POST;
		
		$URLExist = $this->checkURLExist($Config["Data"]['Cat_SEO_URL_CatINP'], (isset($Config["Data"]['Cat_ID_CatINP'])?$Config["Data"]['Cat_ID_CatINP']:null));
		
		if($Config["Data"]["Cat_Name_CatINP"] == "")
		{
			$Go = false;
			$output['error_msg'] = "Category name is required field.";
		}
		else if($URLExist['ack'] == "error" || ($URLExist['ack'] == "success" && $URLExist['Dup'] == 1))
		{
			$Go = false;
			$output['error_msg'] = "SEO friendly URL should be unique. Please try another.";
		}
		
		if($Go)
		{
			
			$Config["Type"] = "Insert";
			$Config["Suffix"] = "_CatINP";
			$Config["Table"] = "gc_category";
			$Config["Allow"] = array(
				"Store_ID",
				"Cat_Name",
				"Cat_Desc_Top",
				"Cat_Desc_Bottom",
				"Cat_Meta_Title",
				"Cat_Meta_Key",
				"Cat_Meta_Desc",
				"Cat_SEO_URL",
				"Cat_Parent_ID",
				"Cat_DisplaySubCatPrd"
			);
			
			
			if(isset($Config["Data"]['Cat_ID_CatINP']) && is_numeric($Config["Data"]['Cat_ID_CatINP']))
			{
				$Config["Type"] = "Update";
				$Config["Where"] = array(
					"Cat_ID"
				);
				
			}
			else
			{
				$Config["Data"]["Store_ID".$Config["Suffix"]] = __StoreID__;
				
				if(isset($Config["Data"]['Cat_Parent_ID'.$Config["Suffix"]]))
				{
					$Config["Data"]["Cat_Sort".$Config["Suffix"]] = $this->getSortNumber();
					$Config["Allow"][] = "Cat_Sort";
				}
			}
			
			
			$SQL = $this->db->autoSQL($Config);
			if($SQL != "")
			{
				$newCatID = $this->db->QRY($SQL,true);
				$cID = (isset($Config["Data"]['Cat_ID_CatINP']) ? $Config["Data"]['Cat_ID_CatINP'] : $newCatID);
				
				# Upload Image Files :
				$Upload_Path = $this->UploadPath['Absolute_Base'].'/'.$cID."/Description/";
				
				if(!is_dir($Upload_Path) && sizeof($_FILES) > 0)
					mkdir($Upload_Path,0707,true);
				
				if(isset($_POST['ImgUploaded']) && isJson($_POST['ImgUploaded']))
				{
					$ImgUploaded = $this->db->escapeArray(json_decode($_POST['ImgUploaded'],TRUE));
					$ImgToDelete = $this->db->QRY("
						SELECT
							CD_Img_ID,
							CD_Img_FileName
						FROM
							gc_category_description_images
						WHERE
							Cat_ID = '".$this->db->escape($cID)."' AND
							CD_Img_ID NOT IN (".(sizeof($ImgUploaded) == 0?"''": implode(",",$ImgUploaded)).")
					");
					foreach($ImgToDelete as $ImgToDelete_F)
					{
						
						if(is_file($this->UploadPath['Absolute_Base'].$cID.'/Description/'.$ImgToDelete_F['CD_Img_FileName']))
							unlink($this->UploadPath['Absolute_Base'].$cID.'/Description/'.$ImgToDelete_F['CD_Img_FileName']);
						
						# FYI : Already filtered by 'Cat_ID', don't need to filter it again.
						$this->db->QRY("DELETE FROM gc_category_description_images WHERE CD_Img_ID = '".$ImgToDelete_F['CD_Img_ID']."'");
					}
				}
				
				foreach($_FILES as $K => $_FILES_F)
				{
					
					if(preg_match("/^Img_/",$K))
					{
						$isRealImage = getimagesize($_FILES_F['tmp_name']);
						if($isRealImage !== false)
						{
							
							
							$Upload_Image_File_Name = $_FILES_F["name"];
							
							if(is_file($Upload_Path.$Upload_Image_File_Name))
							{
								//$Upload_Image_File_Name = $_FILES_F["name"];
								
								$File_FirstName = pathinfo(basename($_FILES_F["name"]), PATHINFO_FILENAME);
								$Extention = pathinfo(basename($_FILES_F["name"]), PATHINFO_EXTENSION);
								$File_Count = 0;
								
								while(is_file($Upload_Path.$Upload_Image_File_Name))
								{
									$Upload_Image_File_Name = $File_FirstName."_".$File_Count.($Extention != "" ? '.'.$Extention : "");
									$File_Count++;
								}
								
								
							}
							
							$ImgID = $this->db->QRY("
								INSERT INTO
									gc_category_description_images
									(
										CD_Img_FileName,
										Cat_ID
									)
									VALUES
									(
										'".$this->db->escape($Upload_Image_File_Name)."',
										'".$this->db->escape($cID)."'
									)
							",true);
							
							
							
							move_uploaded_file($_FILES_F["tmp_name"], $Upload_Path.$Upload_Image_File_Name);
							
						}
					}
				}
				$output['ack'] = 'success';
				if(is_numeric($newCatID) && $Config["Type"] == "Insert")
					$output['newCatID'] = $newCatID;
			}
				
		}
		
		
		
		$this->_Cache->Generate('All');
		return $output;
	}
	
	function rearrangeCategory()
	{
		$output['ack'] = 'error';
		if(isset($_POST['Tree']) && isset($_POST['Tree']))
		{
			$output['ack'] = 'success';
			$Tree = json_decode($_POST['Tree'],true);
			
			foreach($Tree AS $K => $Tree_F)
			{
				foreach($Tree_F AS $K2 => $Tree_F_2)
				{
					$this->db->QRY("UPDATE gc_category SET Cat_Parent_ID = '".$K."', Cat_Sort = '".$K2."' WHERE Cat_ID = '".$Tree_F_2."'");
				}
				//
			}
		}
		return $output;
	}
	function deleteCategory()
	{
		
		$output['ack'] = 'error';
		if(isset($_POST['cID']) && isset($_POST['ItemsToo']))
		{
			
			$C = $this->db->QRY("
				SELECT
					*
				FROM
					gc_category
				WHERE
					Store_ID = '".__StoreID__."' AND
					Cat_ID = '".$this->db->escape($_POST['cID'])."'
				ORDER BY
					Cat_Parent_ID ASC,
					Cat_Sort ASC
			");
			
			if(sizeof($C) > 0)
			{
				$IDs = $this->deleteCategorySQL_Recursive($C);
				if(sizeof($IDs) > 0)
				{
					$this->db->QRY("
						DELETE FROM
							gc_category
						WHERE
							Cat_ID IN (".implode(",",array_map(array($this->db,"escape"),$IDs)).")
					");
					
					foreach($IDs AS $IDs_F)
					{
						$this->File->DeleteDirectory($this->UploadPath['Absolute_Base'].$IDs_F);
					}
				}
				
				$output['ack'] = 'success';
			}
			else
			{
				$output['error_msg'] = "This category doesn't exsist or is already deleted.";
			}
			
			/*
			$this->db->QRY("
				DELETE FROM
					gc_category
				WHERE
					Cat_ID = '".$this->db->escape($_POST['cID'])."'
			");
			*/
		}
		return $output;
	}
	function deleteCategorySQL_Recursive($Data)
	{
		
		$IDs = array();
		foreach($Data as $Data_F)
		{
			
			$IDs[] = $Data_F['Cat_ID'];
			$C = $this->db->QRY("
				SELECT
					Cat_ID
				FROM
					gc_category
				WHERE
					Cat_Parent_ID = '".$Data_F['Cat_ID']."'
			");
			if(sizeof($C) > 0)
			{
				
				$IDs_Temp = $this->deleteCategorySQL_Recursive($C);
				if(sizeof($IDs_Temp) > 0)
					$IDs = array_merge($IDs, $IDs_Temp);
			}
		
		}
		return $IDs;
		
	}
	
	function getSortNumber($cID = 0)
	{
		$N = $this->db->QRY("
			SELECT
				max(Cat_Sort) as LastNum
			FROM
				gc_category
			WHERE
				Cat_ID = '".$this->db->escape($cID)."' AND
				Store_ID = '".__StoreID__."'
		");
		return $N[0]['LastNum'] + 1;
	}
	function checkURLExist($URL = null, $cID = null)
	{
		$output['ack'] = 'error';
		
		if(is_null($URL))
			$URL = (isset($_POST['URL']) && $_POST['URL'] != "" ? $_POST['URL'] : null);
		
		if(is_null($cID))
			$cID = (isset($_POST['cID']) && $_POST['cID'] != "" ? $_POST['cID'] : null);
		
		if(
		   !is_null($URL)
		)
		{
			$Where = "";
			if(!is_null($cID) && is_numeric($cID))
				$Where .= "Cat_ID != '".$this->db->escape($cID)."' AND ";
				
			$U = $this->db->QRY("
				SELECT
					Cat_ID
				FROM
					gc_category
				WHERE
					".$Where."
					Cat_SEO_URL = '".$this->db->escape($URL)."' AND
					Store_ID = '".__StoreID__."'
			");
			$output['ack'] = 'success';
			$output['Dup'] = 0;
			if(sizeof($U) > 0)
			{
				$output['Dup'] = 1;
			}
			
		}
		return $output;
	}
	
	
	
}


?>