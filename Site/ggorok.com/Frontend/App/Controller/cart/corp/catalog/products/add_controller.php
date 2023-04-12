<?php
class CartCorpCatalogProductsAdd_Controller extends GGoRok
{
	var $_isAdminPage = true;
	var $UploadPath = array();
	protected $Uploadable_Exts = array(
		'jpg' => 'image/jpeg',
		'jpeg' => 'image/jpeg',
		'png' => 'image/png',
		'gif' => 'image/gif',
		'bmp' => 'image/bmp',
		'png' => 'image/png',
		'png' => 'image/png',
		'png' => 'image/x-citrix-png',
		'png' => 'image/x-png',
		'tiff' => 'image/tiff',
		'avi' => 'video/x-msvideo',
		'flv' => 'video/x-flv',
		'mov' => 'video',
		'ogg' => 'video/ogg',
		'mp4' => 'video/mp4'
	);
	
	function __construct()
	{
		$this->UploadPath['Absolute_Base'] = __UploadPath__.__StoreID__.'/Products/';
		$this->UploadPath['Relative_Base'] = '/Template/Upload/'.__StoreID__.'/Products/';
		
		$this->UploadPath['PrdFile']['Tube'] = '/Tube/';
		$this->UploadPath['PrdFile']['DescImg'] = '/DescImg/';
		
		$this->UploadPath['Showcase']['Original'] = 	'/SC_Original/';
		
		$this->imgAbsolutePath = __DocumentPath__.$this->imgRelativePath;
		$this->tubeAbsolutePath = __DocumentPath__."Site/".__domain__."/Frontend/".__StoreID__."/Tubes/";
	}
	function home()
	{
		$Data['title'] = 'Add Product | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		$Data['CurrentCategory'] = '';
		
		
		$Data['MAIN_HTML']  = $this->Load->View('cart/corp/catalog/products/add.tpl');
		$Data['MAIN_HTML'] .= $this->Load->View('cart/corp/catalog/products/addmod-fields.tpl', array(
			'Prd_ID' => '',
			'Prd_isActive' => 1,
			'Prd_isFeatured' => 0,
			'Prd_Name' => '',
			'Prd_SEO_URL' => '',
			'Prd_Desc_Short' => '',
			'DescFiles' => $this->DescFiles( Null , 2 )['html'],
			'Prd_Desc_Long' => '',
			'Prd_Tags' => htmlentities(''),
			'Prd_Price' => '',
			'Prd_ListPrice' => '',
			'Prd_isTaxble' => 0,
			'Prd_Qty' => htmlentities(''),
			'Prd_MinimumQty' => '',
			'Prd_SKU' => '',
			'Prd_UPC' => '',
			'Prd_EAN' => '',
			'Prd_JAN' => '',
			'Prd_ISBN' => '',
			'Prd_MPN' => '',
			'Prd_Weight' => '',
			'Prd_Dimension_L' => '',
			'Prd_Dimension_W' => '',
			'Prd_Dimension_H' => '',
			'Prd_RewardPoint' => '',
			
			'CategoryList' => $this->CategoryList(null)['html'],
			'OptType_HTML' => $this->OptType_HTML(null),
			'OptGrp_HTML' => $this->OptGrp_HTML(null),
			'Product_Image' => $this->Images(null)['html'],
			
			'Prd_Meta_Title' => '',
			'Prd_Meta_Key' => '',
			'Prd_Meta_Desc' => '',
			'AjaxURL' => __AdminPath__.'catalog/products/add?ajaxProcess'
		));
		
		$Home_Controller = $this->Load->Controller('cart/corp/home');
		echo $Home_Controller->loadHeader($Data);
	
	}
	
	function saveProduct()
	{
		$output['ack'] = 'error';
		$Go = true;
		
		$URLExist = $this->checkURLExist($_POST['Prd_SEO_URL_PrdINP'], (isset($_POST['Prd_ID_PrdINP'])?$_POST['Prd_ID_PrdINP']:null));
		
		if(isset($_POST['Prd_Tags_PrdINP']) && $_POST['Prd_Tags_PrdINP'] != "")
		{
			$_POST['Prd_Tags_PrdINP'] = preg_replace("/[\s]+\,/",",",$_POST['Prd_Tags_PrdINP']);
			$_POST['Prd_Tags_PrdINP'] = preg_replace("/\,[\s]+/",",",$_POST['Prd_Tags_PrdINP']);
		}
		
		$Config["Data"] = $_POST;
		if($_POST["Prd_Name_PrdINP"] == "")
		{
			$Go = false;
			$output['error_msg'] = "Product name is required field.";
		}
		else if($URLExist['ack'] == "error" || ($URLExist['ack'] == "success" && $URLExist['Dup'] == 1))
		{
			$Go = false;
			$output['error_msg'] = "SEO friendly URL should be unique. Please try another.";
		}
		
		foreach($_FILES as $K => $_FILES_F)
		{
			$ValidateFiles = $this->File->ValidateFiles($_FILES_F,$this->Uploadable_Exts);
			if($ValidateFiles['ack'] == 'error')
			{
				$Go = false;
				$output['error_msg'] = $ValidateFiles['error_msg'];
			}
		}
		
		if($Go)
		{
			
			$Config["Type"] = "Insert";
			$Config["Suffix"] = "_PrdINP";
			$Config["Table"] = "gc_products";
			$Config["Allow"] = array(
				"Store_ID",
				"Prd_Name",
				"Prd_Desc_Short",
				"Prd_Desc_Long",
				"Prd_SEO_URL",
				"Prd_ListPrice",
				"Prd_Price",
				"Prd_isTaxble",
				"Prd_isActive",
				"Prd_isFeatured",
				"Prd_Qty",
				"Prd_MinimumQty",
				"Prd_Weight",
				"Prd_Weight_Unit",
				"Prd_Dimension_Unit",
				"Prd_Dimension_L",
				"Prd_Dimension_W",
				"Prd_Dimension_H",
				"Prd_SKU",
				"Prd_UPC",
				"Prd_EAN",
				"Prd_JAN",
				"Prd_ISBN",
				"Prd_MPN",
				"Prd_StorePickup_Available",
				"Prd_DateAvailable_From",
				"Prd_DateAvailable_To",
				"Prd_RewardPoint",
				"Prd_Meta_Title",
				"Prd_Meta_Key",
				"Prd_Meta_Desc",
				"Prd_Tags"
			);
			
			
			if(isset($_POST['Prd_ID_PrdINP']) && is_numeric($_POST['Prd_ID_PrdINP']))
			{
				$Config["Type"] = "Update";
				$Config["Where"] = array(
					"Prd_ID"
				);
				
			}
			else
			{
				$Config["Data"]["Store_ID".$Config["Suffix"]] = __StoreID__;
				
				if(isset($Config["Data"]['Prd_Parent_ID'.$Config["Suffix"]]))
				{
					$Config["Data"]["Prd_Sort".$Config["Suffix"]] = $this->getSortNumber();
					$Config["Allow"][] = "Prd_Sort";
				}
			}
			
			
			$SQL = $this->db->autoSQL($Config);
			if($SQL != "")
			{
				$newPrdID = $this->db->QRY($SQL,true);
				$output['ack'] = 'success';
				
				$pID = ($Config["Type"] == "Insert" ? $newPrdID : $_POST['Prd_ID_PrdINP']);
				
				if(is_numeric($newPrdID) && $Config["Type"] == "Insert")
					$output['newPrdID'] = $newPrdID;
					
				$Category_IDs = json_decode($_POST['Category_IDs'],true);
				if($Config["Type"] == "Update")
					$this->db->QRY("DELETE FROM ".DB_Table_Prefix."products_to_categories WHERE Prd_ID='".$this->db->escape($pID)."'");
				
				if(sizeof($Category_IDs) > 0)
				{
					$Cat_SQL = "";
					foreach($Category_IDs AS $Category_IDs_F)
					{
						$Cat_SQL .= "(".$pID.",".$this->db->escape($Category_IDs_F)."),";
					}
					$Cat_SQL = preg_replace("/\,$/","",$Cat_SQL);
					
					$this->db->QRY("
						INSERT INTO
							".DB_Table_Prefix."products_to_categories
							(
								Prd_ID,
								Cat_ID
							)
							VALUES
								".$Cat_SQL."
							
					");
				}
				
				
					
				# Delete Product Files (Media : Image, Video) ::
				if(isset($_POST['PrdFileUploaded']) && isJson($_POST['PrdFileUploaded']))
				{
					$FileUploaded = $this->db->escapeArray(json_decode($_POST['PrdFileUploaded'],TRUE));
					$FileToDelete_SQL = $this->db->QRY("
						SELECT
							Media_ID,
							File_Name,
							File_Type
						FROM
							".DB_Table_Prefix."products_files
						WHERE
							Prd_ID = '".$this->db->escape($pID)."' AND
							Media_ID NOT IN (".(sizeof($FileUploaded) == 0 ? "''": implode(",",$FileUploaded)).")
					");
					foreach($FileToDelete_SQL as $FileToDelete_F)
					{
						if($FileToDelete_F['File_Type'] == 1)
							$PrdFile_Folder = $this->UploadPath['PrdFile']['Tube'];
						else if($FileToDelete_F['File_Type'] == 2)
							$PrdFile_Folder = $this->UploadPath['PrdFile']['DescImg'];
							
						$PrdFile_Path = $this->UploadPath['Absolute_Base'].$pID.$PrdFile_Folder;
						
						if(is_file($PrdFile_Path.$FileToDelete_F['File_Name']))
							unlink($PrdFile_Path.$FileToDelete_F['File_Name']);
						
						# FYI : Already filtered by 'Prd_ID', don't need to filter it again.
						$this->db->QRY("DELETE FROM ".DB_Table_Prefix."products_files WHERE Media_ID = '".$FileToDelete_F['Media_ID']."'");
					}
				}
				# Delete Product Files (Media : Image, Video) ;;
				
				# Delete Showcase Images ::
				if(isset($_POST['ImgUploaded']) && isJson($_POST['ImgUploaded']))
				{
					$ImgUploaded = $this->db->escapeArray(json_decode($_POST['ImgUploaded'],TRUE));
					$FileToDelete_SQL = $this->db->QRY("
						SELECT
							Img_ID,
							Img_FileName
						FROM
							".DB_Table_Prefix."products_images
						WHERE
							Prd_ID = '".$this->db->escape($pID)."' AND
							Img_ID NOT IN (".(sizeof($ImgUploaded) == 0 ? "''": implode(",",$ImgUploaded)).")
					");
					foreach($FileToDelete_SQL as $FileToDelete_F)
					{
						
						foreach($this->UploadPath['Showcase'] AS $imgFolder_Arr_F)
						{
							$FileToDelete = $this->UploadPath['Absolute_Base'].$pID.$imgFolder_Arr_F.'/'.$FileToDelete_F['Img_FileName'];
							if(is_file($FileToDelete))
								unlink($FileToDelete);
						}
						
						
						# FYI : Already filtered by 'Prd_ID', don't need to filter it again.
						$this->db->QRY("DELETE FROM ".DB_Table_Prefix."products_images WHERE Img_ID = '".$FileToDelete_F['Img_ID']."'");
					}
				}
				# Delete Showcase Images ;;
				
				
					
				
				# Upload Product Image Files :
				$Upload_Path['PrdShowcaseImg'] = $this->UploadPath['Absolute_Base'].$pID.$this->UploadPath['Showcase']['Original'];
				$Upload_Path['PrdFile'] = $this->UploadPath['Absolute_Base'].$pID;
				
				
				foreach($_FILES as $K => $_FILES_F)
				{
					
					if(preg_match("/^PrdShowcaseImg/",$K))
					{
						$isRealImage = getimagesize($_FILES_F['tmp_name']);
						if($isRealImage !== false)
						{
							
							
							$Upload_Image_File_Name = $_FILES_F["name"];
							$CheckIfDefaultImg_Exist = $this->db->QRY("
								SELECT
									Prd_ID
								FROM
									".DB_Table_Prefix."products_images
								WHERE
									Prd_ID = '".$this->db->escape($pID)."' AND
									Img_isDefault = 1
							");
							
							if(is_file($Upload_Path['PrdShowcaseImg'].$Upload_Image_File_Name))
							{
								//$Upload_Image_File_Name = $_FILES_F["name"];
								
								$File_FirstName = pathinfo(basename($_FILES_F["name"]), PATHINFO_FILENAME);
								$Extention = pathinfo(basename($_FILES_F["name"]), PATHINFO_EXTENSION);
								$File_Count = 0;
								
								while(is_file($Upload_Path['PrdShowcaseImg'].$Upload_Image_File_Name))
								{
									$Upload_Image_File_Name = $File_FirstName."_".$File_Count.($Extention != "" ? '.'.$Extention : "");
									$File_Count++;
								}
								
								
							}
							
							$ImgID = $this->db->QRY("
								INSERT INTO
									".DB_Table_Prefix."products_images
									(
										Img_FileName,
										Img_isDefault,
										Img_Sort,
										Prd_ID
									)
									VALUES
									(
										'".$this->db->escape($Upload_Image_File_Name)."',
										'".(sizeof($CheckIfDefaultImg_Exist) == 0 ? "1" : "0")."',
										'".$this->db->escape(0)."',
										'".$this->db->escape($pID)."'
									)
							",true);
							
							
							if(!is_dir($Upload_Path['PrdShowcaseImg']))
								mkdir($Upload_Path['PrdShowcaseImg'],0775,true);
							
							move_uploaded_file($_FILES_F["tmp_name"], $Upload_Path['PrdShowcaseImg'].$Upload_Image_File_Name);
							
							foreach($this->XML->Loaded['Showcase'] AS $Images_F)
							{
								
								if(is_file($Upload_Path['PrdShowcaseImg'].$Upload_Image_File_Name))
									$this->image->resample($Upload_Path['PrdShowcaseImg'].$Upload_Image_File_Name, $this->UploadPath['Absolute_Base'].$pID.'/'.$Images_F['ID']."/",$Images_F['Width'],$Images_F['Height']);
								
							}
							
						}
					}
					else if(preg_match("/^PrdFile/",$K))
					{
						#Video or Image
						
						$isImage = getimagesize($_FILES_F['tmp_name']);
						$Upload_File_Name = $_FILES_F["name"];
						$Upload_Path_SubFolder = ($isImage ? $this->UploadPath['PrdFile']['DescImg'] : $this->UploadPath['PrdFile']['Tube']);
						
						
						$DescFile_Type = ($isImage ? 2 : 1);
						
						if(is_file($Upload_Path['PrdFile'].$Upload_Path_SubFolder.$Upload_File_Name))
						{
							
							$File_FirstName = pathinfo(basename($_FILES_F["name"]), PATHINFO_FILENAME);
							$Extention = pathinfo(basename($_FILES_F["name"]), PATHINFO_EXTENSION);
							$File_Count = 0;
							
							while(is_file($Upload_Path['PrdFile'].$Upload_Path_SubFolder.$Upload_File_Name))
							{
								$Upload_File_Name = $File_FirstName."_".$File_Count.($Extention != "" ? '.'.$Extention : "");
								$File_Count++;
							}
							
						}
						
						$this->db->QRY("
							INSERT INTO
								".DB_Table_Prefix."products_files
								(
									Prd_ID,
									File_Name,
									File_Type
								)
								VALUES
								(
									'".$this->db->escape($pID)."',
									'".$this->db->escape($Upload_File_Name)."',
									'".$this->db->escape($DescFile_Type)."'
								)
						");
						
						
						if(!is_dir($Upload_Path['PrdFile'].$Upload_Path_SubFolder))
							mkdir($Upload_Path['PrdFile'].$Upload_Path_SubFolder,0775,true);
							
						move_uploaded_file($_FILES_F["tmp_name"], $Upload_Path['PrdFile'].$Upload_Path_SubFolder.$Upload_File_Name);
						
						
					}
				}
				
				# Insert / Update Options ::
				$OptGrp_IDs_ToAdd = array();
				if(isset($_POST['PrdOptGrps']) && sizeof(json_decode($_POST['PrdOptGrps'],true)) > 0)
				{
					$PrdOptGrps = json_decode($_POST['PrdOptGrps'],true);
					
					
					
					foreach($PrdOptGrps as $PrdOptGrps_F)
					{
						$SubOpt = $PrdOptGrps_F[4];
						
						# Check : Option Group ID = Numeric (INSERT / UPDATE)
						if(is_numeric($PrdOptGrps_F[2]))
						{
							$this->db->QRY("
								UPDATE
									".DB_Table_Prefix."products_option_group
								SET
									OptGrp_Name = '".$this->db->escape(urldecode($PrdOptGrps_F[0]))."',
									OptGrp_Type_ID =  '".$this->db->escape(urldecode($PrdOptGrps_F[1]))."',
									isMandatory = '".$this->db->escape(json_encode($PrdOptGrps_F[3]))."'
								WHERE
									OptGrp_ID = '".$this->db->escape($PrdOptGrps_F[2])."' AND
									Prd_ID = '".$pID."'
							");
							
							
							
							# Update / Insert Sub Option
							if(sizeof($SubOpt) > 0)
							{
								foreach($SubOpt as $SubOpt_F)
								{
									# Update
									if(is_numeric($SubOpt_F[0]))
									{
										$this->db->QRY("
											UPDATE
												".DB_Table_Prefix."products_option_group_item
											SET
												Opt_Name = '".$this->db->escape($SubOpt_F[1])."',
												Opt_Price = '".$this->db->escape(floatval($SubOpt_F[2]))."',
												Opt_Operand = '".$this->db->escape($SubOpt_F[3])."'
											WHERE
												OptGrp_ID = '".$this->db->escape($PrdOptGrps_F[2])."' AND
												Opt_ID = '".$this->db->escape($SubOpt_F[0])."'
										");
										
									}
									# Insert
									else
									{
										$NewOptID = $this->db->QRY("
											INSERT
												".DB_Table_Prefix."products_option_group_item
												(
													Opt_Name,
													Opt_Price,
													Opt_Operand,
													OptGrp_ID
												)
												VALUES
												(
													'".$this->db->escape($SubOpt_F[1])."',
													'".$this->db->escape(floatval($SubOpt_F[2]))."',
													'".$this->db->escape($SubOpt_F[3])."',
													'".$this->db->escape($PrdOptGrps_F[2])."'
												)
										",TRUE);
										
									}
								}
							}
							
							
						}
						else
						{
							# Add Option Group
							$AddedOptGrp_ID = $this->db->QRY("
								INSERT INTO
									".DB_Table_Prefix."products_option_group
									(
										OptGrp_Type_ID,
										OptGrp_Name,
										Prd_ID,
										isMandatory
									)
									VALUES
									(
										'".$this->db->escape($PrdOptGrps_F[1])."',
										'".$this->db->escape(urldecode($PrdOptGrps_F[0]))."',
										'".$pID."',
										'".$this->db->escape(json_encode($PrdOptGrps_F[3]))."'
									)
							",true);
							
							if(sizeof($SubOpt) > 0)
							{
								foreach($SubOpt as $SubOpt_F)
								{
									$NewOptID = $this->db->QRY("
										INSERT
											".DB_Table_Prefix."products_option_group_item
											(
												Opt_Name,
												Opt_Price,
												Opt_Operand,
												OptGrp_ID
											)
											VALUES
											(
												'".$this->db->escape($SubOpt_F[1])."',
												'".$this->db->escape(floatval($SubOpt_F[2]))."',
												'".$this->db->escape($SubOpt_F[3])."',
												'".$this->db->escape($AddedOptGrp_ID)."'
											)
									",TRUE);
								}
							}
							
						}
					}
					
					
				}
				
				if(isset($_POST['OptionDelete_IDs']))
				{
					$OptionDelete_IDs = json_decode($_POST['OptionDelete_IDs'],true);
					
					
					if(isset($OptionDelete_IDs['Grp']) && is_array($OptionDelete_IDs['Grp']) && sizeof($OptionDelete_IDs['Grp']) > 0)
					{
						# Sanitize
						foreach($OptionDelete_IDs['Grp'] AS $K => $OptGrp_Del_F)
						{
							$OptionDelete_IDs['Grp'][$K] = $this->db->escape($OptGrp_Del_F);
						}
						$this->db->QRY("
							DELETE FROM
								".DB_Table_Prefix."products_option_group
							WHERE
								OptGrp_ID IN (".implode(',',$OptionDelete_IDs['Grp']).") AND
								Prd_ID = '".$pID."'
						");
					}
					
					if(isset($OptionDelete_IDs['Opt']) && is_array($OptionDelete_IDs['Opt']) && sizeof($OptionDelete_IDs['Opt']) > 0)
					{
						# Sanitize
						foreach($OptionDelete_IDs['Opt'] AS $K => $Opt_Del_F)
						{
							$OptionDelete_IDs['Opt'][$K] = $this->db->escape($Opt_Del_F);
						}
						$this->db->QRY("
							DELETE FROM
								".DB_Table_Prefix."products_option_group_item
							WHERE
								Opt_ID IN (".implode(',',$OptionDelete_IDs['Opt']).")
						");
					}
				}
				# Insert / Update Options ;;
				
				
				
			}
				
		}	
	
		
		
		
		return $output;
	}
	
	
	function getSortNumber($pID = 0)
	{
		global $db;
		$N = $this->db->QRY("
			SELECT
				max(Prd_Sort) as LastNum
			FROM
				".DB_Table_Prefix."category
			WHERE
				Prd_ID = '".$this->db->escape($pID)."' AND
				Store_ID = '".__StoreID__."'
		");
		return $N[0]['LastNum'] + 1;
	}
	function default_Image()
	{
		global $db;
		$output['ack'] = "error";
		if(
			(isset($_POST['pID']) && is_numeric($_POST['pID'])) &&
			(isset($_POST['pImgID']) && is_numeric($_POST['pImgID']))
		)
		{
			$output['ack'] = "success";
			$CheckIfDefaultImg_Exist = $this->db->QRY("
				SELECT
					Img_ID
				FROM
					".DB_Table_Prefix."products_images
				WHERE
					Prd_ID = '".$this->db->escape($_POST['pID'])."'
			");
			if(sizeof($CheckIfDefaultImg_Exist))
			{
				$this->db->QRY("UPDATE ".DB_Table_Prefix."products_images SET Img_isDefault = 0 WHERE Prd_ID = '".$this->db->escape($_POST['pID'])."'");
				$this->db->QRY("UPDATE ".DB_Table_Prefix."products_images SET Img_isDefault = 1 WHERE Img_ID = '".$this->db->escape($_POST['pImgID'])."' AND Prd_ID = '".$this->db->escape($_POST['pID'])."'" );
			}
		}
		return $output;
	}
	
	function searchOptGrpTpl()
	{
		$output['ack'] = 'error';
		
		if(isset($_POST['K']) && $_POST['K'] != "")
		{
			$K = urldecode($_POST['K']);
			$output['html'] = "";
			$output['ack'] = 'success';
			$D = $this->db->QRY("
				SELECT
					TP.OptGrp_ID,
					TP.OptGrp_Name,
					T.OptGrp_Type_Name
				FROM
					gc_products_option_group TP,
					gc_products_option_group_type T
				WHERE
					TP.OptGrp_Name LIKE '%".$this->db->escape($K)."%' AND
					T.OptGrp_Type_ID = TP.OptGrp_Type_ID AND
					TP.isTemplate = 1
			");
			
			if(sizeof($D) > 0)
			{
				foreach($D AS $D_F)
				{
					$output['html'] .= '
						<div class="TplSrc_One" data-tplid="'.$D_F['OptGrp_ID'].'">
							<div class="OptGrpTplSrc_L">'.$D_F['OptGrp_Name'].'</div>
							<div class="OptGrpTplSrc_R">'.$D_F['OptGrp_Type_Name'].'</div>
						</div>
					';
				}
			}
		
		}
		return $output;
	}
	
	function Images($pID = NULL)
	{

		$output['ack'] = 'success';
		$output['html'] = "";
		
		if(isset($pID) && is_numeric($pID))
		{
			$C = $this->db->QRY("
				SELECT
					*
				FROM
					".DB_Table_Prefix."products_images
				WHERE
					Prd_ID = '".$this->db->escape($pID)."'
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
			<div class="TP_File_One Prd_ShowCaseImg_One" data-pimgid="'.(!is_null($Data) ? $Data['Img_ID']:"").'">
				<div class="xButton deleteImg_BTN"></div>
				<div class="TP_File_Preview">'.(!is_null($Data) ? '<img src="'.$this->UploadPath['Relative_Base'].$Data['Prd_ID'].'/SC_List/'.$Data['Img_FileName'].'">' : 'Upload(+)').'</div>
				<div class="noSelect PD_Img_Default_Btn'.(!is_null($Data) && $Data['Img_isDefault'] == 1 ? " PD_ImgDefault_Selected":"").'">Set Default</div>
				'.($Data == null ? '<input type="file" class="TP_File_Inp" data-type="PrdShowcaseImg" />':'').'
			</div>
		';
		
		return $output;
	}
	
	function OptType_HTML($Data = null)
	{
		$OptType = $this->db->QRY("
			SELECT
				OptGrp_Type_ID,
				OptGrp_Type_name
			FROM
				gc_products_option_group_type
			ORDER BY
				OptGrp_Type_ID
		");
		
		$OptType_HTML = "";
		foreach($OptType as $OptType_F)
		{
			$OptType_HTML .= '<option value="'.$OptType_F['OptGrp_Type_ID'].'">'.$OptType_F['OptGrp_Type_name'].'</option>';
		}
		
		return $OptType_HTML;
	}
	
	
	function OptGrp_HTML($Data = null)
	{
		$OptGrp_HTML = "";
		if(!is_null($Data))
		{
			
			$OptGrps = $this->db->QRY("
				SELECT
					G.OptGrp_ID,
					G.OptGrp_Type_ID,
					GT.OptGrp_Type_Name,
					G.OptGrp_Name,
					G.isMandatory,
					GT.OptGrp_Type_Name
				FROM
					gc_products_option_group G,
					gc_products_option_group_type GT
				WHERE
					G.OptGrp_Type_ID = GT.OptGrp_Type_ID AND
					G.Prd_ID = '".$Data['Prd_ID']."'
			");
			
			foreach($OptGrps AS $OptGrps_F)
			{
				$OptGrp_HTML .= $this->OptionGroup_HTML($OptGrps_F)['html'];
			}
			
		}
		
		return $OptGrp_HTML;
	}
	
	function addOptionGroup()
	{
		$output['ack'] = 'error';
		
		if(isset($_POST['Method']))
		{
			if($_POST['Method'] == 'Custom' && isset($_POST['OptGrpName']) && isset($_POST['TypeID']))
			{
				$Data['Method'] = 'Custom';
				$Data['OptGrp_Name'] = $_POST['OptGrpName'];
				$Data['OptGrp_Type_ID'] = $_POST['TypeID'];
				$output['ack'] = "success";
			}
			else if($_POST['Method'] == 'Template' && isset($_POST['TplID']) && (is_numeric($_POST['TplID']) || preg_match("/[0-9]+\:/",$_POST['TplID'])))
			{
				if(preg_match("/\:/",$_POST['TplID']))
				{
					$TplID = explode(":",$_POST['TplID']);
					$TplID = $TplID[0];
				}
				else
					$TplID = $_POST['TplID'];
				
				if(is_numeric($TplID))
				{
					$Template = $this->db->QRY("
						SELECT
							OptGrp_Type_ID,
							OptGrp_Name
						FROM
							gc_products_option_group
						WHERE
							OptGrp_ID =  '".$this->db->escape($TplID)."' AND
							Store_ID = '".__StoreID__."' AND
							isTemplate = 1
					");
					
					if(sizeof($Template) > 0)
					{
						$Data['OptGrp_Name'] = $Template[0]['OptGrp_Name'];
						$Data['OptGrp_Type_ID'] = $Template[0]['OptGrp_Type_ID'];
						
						$Data['Method'] = 'Template';
						$output['ack'] = "success";
					}
				}
			}
			else
				$output['error_msg'] = "Please check all required field and try again.";
		}
		else
			$output['error_msg'] = "There is an error please check and try again.";
			
		
		if($output['ack'] == "success")
		{
			$output['html'] = $this->OptionGroup_HTML($Data)['html'];
		}
		
		return $output;
	}
	
	function Option_HTML($OptGrp_Type_ID = null, $Data = null)
	{
		if($OptGrp_Type_ID == null && isset($_POST['OptGrp_Type_ID']))
		{
			$OptGrp_Type_ID = $_POST['OptGrp_Type_ID'];
		}
		
		if($OptGrp_Type_ID == 1 || $OptGrp_Type_ID == 2 || $OptGrp_Type_ID == 3)
		{
			$output['html'] = '
				<div class="Opt_Sub_One" data-optid="'.(isset($Data['Opt_ID']) ? $Data['Opt_ID']: "").'">
					<div class="Opt_Drop_1">
						<input type="text" placeholder="Option Name" value="'.(isset($Data['Opt_Name']) ? $Data['Opt_Name']: "").'" class="Ogts_Name_OptINP" name="OS_Name" class="Opt_Sub_INP">
					</div>
					<div class="Opt_Drop_2">
						<div data-val="+" class="BTN_PlusMinus BTN_Plus fa fa-plus '.(!isset($Data['Opt_Operand']) ? " BTN_PlusMinus_Selected": "").(isset($Data['Opt_Operand']) && $Data['Opt_Operand'] == "+" ? " BTN_PlusMinus_Selected": "").'"></div>
					</div>
					<div class="Opt_Drop_3">
						<div data-val="-" class="BTN_PlusMinus BTN_Minus fa fa-minus '.(isset($Data['Opt_Operand']) && $Data['Opt_Operand'] == "-" ? " BTN_PlusMinus_Selected": "").'""></div>
					</div>
					<div class="Opt_Drop_4">
						<input type="text" placeholder="Price" value="'.(isset($Data['Opt_Price']) ? $Data['Opt_Price'] : "").'" class="Ogts_Price_OptINP" class="Opt_Sub_INP">
					</div>
					<div class="Opt_Drop_5">
						<div data-tooltip="Delete Option" class="square_button square_button_white fa fa-trash DelSubOption_BTN"></div>
						<div data-tooltip="Add Option Under This Row" class="square_button square_button_white AddSubOption_BTN">
							<i class="fa fa-plus"></i>
						</div>
						<div data-tooltip="Change Order" class="square_button square_button_white changeOrder">
							<i class="fa fa-arrows"></i>
						</div>
					</div>
				</div>
			';
			$output['ack'] = 'success';
		}
		return $output;
	}
	
	function OptionGroup_HTML($Data)
	{
		
		$Option_HTML = "";
		if(isset($Data['OptGrp_ID']))
		{
			$SubOpt = $this->db->QRY("
				SELECT
					*
				FROM
					gc_products_option_group_item
				WHERE
					OptGrp_ID = '".$this->db->escape($Data['OptGrp_ID'])."'
				ORDER BY
					Opt_Sort ASC
			");
			
			foreach($SubOpt as $SubOpt_F)
			{
				$Option_HTML .= $this->Option_HTML($Data['OptGrp_Type_ID'], $SubOpt_F)['html'];
			}
		}
		$output['html'] = '
			<div class="OptGrp_One noSelect" data-grptype="'.$Data['OptGrp_Type_ID'].'" data-ogid="'.(isset($Data['OptGrp_ID']) ? $Data['OptGrp_ID'] : "").'">
				<div class="OptGrp_Btns_L">
					<div class="OptGrp_Btn openCloseOptGrp_Btn" data-tooltip="Open / Close Option Group"><i class="fa fa-folder"></i></div>
				</div>
				<div class="OptGrpName"><input type="text" class="OptGrpName_Inp" placeholder="Option Group Name" value="'.$Data['OptGrp_Name'].'" /></div>
				<div class="OptGrp_Btns_R">
					<div class="OptGrp_Btn deleteOptGrp_Btn" data-tooltip="Delete Option Group"><i class="fa fa-trash"></i></div>
				</div>
				<div class="OptGrpContents_Container">
					<div class="OptGrpContents_Menu">
						<div class="AddSubOpt_Btn OPT_Top_Btn"><i class="fa fa-plus"></i> Add Option</div>
						<div class="OPT_Top_Btn Mandatory_Btn'.(isset($Data['isMandatory']) && $Data['isMandatory'] == 1 ? " Mandatory_Btn_Selected" : "").'"><i class="fa fa-thumb-tack"></i> Check If Mandatory</div>
					</div>
					<div class="OptGrpContents">'.$Option_HTML.'</div>
				</div>
			</div>
		';
		
		return $output;
	}
	
	function CategoryList($pID = null)
	{
		$output['ack'] = 'success';
		$C = $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."category
			WHERE
				Store_ID = ".__StoreID__."
			ORDER BY
				Cat_Parent_ID ASC,
				Cat_Sort ASC
		");
		
		$P2C = null;
		if(!is_null($pID) && is_numeric($pID))
		{
			$P2C_SQL = $this->db->QRY("
				SELECT
					Cat_ID
				FROM
					".DB_Table_Prefix."products_to_categories
				WHERE
					Prd_ID = '".$this->db->escape($pID)."'
			");
			$P2C_Tmp = null;
			$P2C = array();
			foreach($P2C_SQL as $P2C_F)
			{
				$P2C[] = $P2C_F['Cat_ID'];
			}
			
			 
		}
		$output['html'] = '';
		if(sizeof($C) > 0)
		{
			$output['html'] = $this->CategoryList_Recursive($C,0,0,$P2C);
		}
		else
		{
			$output['html'] = 'No Category Found';
		}
		
		return $output;
	}
	
	function CategoryList_Recursive($Data,$ParentID = 0, $Depth = 0, $P2C = null)
	{
		$HTML = '<div class="CatList_Block">';
		
		foreach($Data as $K => $Data_F)
		{
			
			if($Data_F['Cat_Parent_ID'] == $ParentID)
			{
				
				
				$HTML .= '<div class="CatList_Group">';
				$HTML .= '	<div class="CatList_One noSelect'.(!is_null($P2C) && in_array($Data_F['Cat_ID'],$P2C) ? " CatList_Selected":"").'" data-catid="'.$Data_F['Cat_ID'].'"><i class="fa fa-folder-open-o"></i> '.$Data_F['Cat_Name'].'</div>';
				unset($Data[$K]);
				
				foreach($Data as $K2 => $Data2_F)
				{
					
					if($Data2_F['Cat_Parent_ID'] == $Data_F['Cat_ID'])
					{
						$HTML .= $this->CategoryList_Recursive($Data, $Data2_F['Cat_Parent_ID'],$Depth + 1,$P2C);
						break;
					}
				}
				$HTML .= '</div>';
			}
			
		}
		
		$HTML .= '</div>';
		return $HTML;
	}
	
	function checkURLExist($URL = null, $pID = null)
	{
		$output['ack'] = 'error';
		
		if(is_null($URL))
			$URL = (isset($_POST['URL']) && $_POST['URL'] != "" ? $_POST['URL'] : null);
		
		if(is_null($pID))
			$pID = (isset($_POST['pID']) && $_POST['pID'] != "" ? $_POST['pID'] : null);
		
		if(
		   !is_null($URL)
		)
		{
			$Where = "";
			if(!is_null($pID) && is_numeric($pID))
				$Where .= "Prd_ID != '".$this->db->escape($pID)."' AND ";
				
			$U = $this->db->QRY("
				SELECT
					Prd_ID
				FROM
					".DB_Table_Prefix."products
				WHERE
					".$Where."
					Prd_SEO_URL = '".$this->db->escape($URL)."' AND
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
	
	function DescFiles($pID = NULL, $Type = NULL)
	{
		$output['ack'] = 'success';
		$output['html'] = "";
		
		if(isset($pID) && is_numeric($pID))
		{
			$D = $this->db->QRY("
				SELECT
					*
				FROM
					".DB_Table_Prefix."products_files
				WHERE
					Prd_ID = '".$this->db->escape($pID)."'
					".(!is_null($Type) ? " AND File_Type = '".$this->db->escape($Type)."'" : '' )."
			");
			if(sizeof($D) > 0)
			{
				foreach($D as $D_F)
				{
					$output['html'] .= $this->DescFiles_Html($D_F)['html'];
				}
				$output['html'] .= $this->DescFiles_Html()['html'];
			}
			else
				$output['html'] = $this->DescFiles_Html()['html'];
		}
		else
		{
			$output['html'] = $this->DescFiles_Html()['html'];
		}
		
		
		return $output;
	}
	
	function DescFiles_Html($Data = null)
	{
		$output['ack'] = 'success';
		
		
		if(!is_null($Data))
		{
			$File_HTML = '';
			
			if($Data['File_Type'] == 1)
				$File_HTML = '<video></video>';
			else if($Data['File_Type'] == 2)
				$File_HTML = '<img src="'.$this->UploadPath['Relative_Base'].$Data['Prd_ID'].$this->UploadPath['PrdFile']['DescImg'].'/'.$Data['File_Name'].'" />';
			
				
		}
		
			
		$output['html'] = '
			<div class="TP_File_One Prd_File_One" data-hasfile="'.(!is_null($Data) ? 1:0).'" data-descfileid="'.(!is_null($Data) ? $Data['Media_ID']:"").'">
				<div class="xButton deleteImg_BTN"></div>
				<div class="TP_File_Preview">'.(!is_null($Data) ? $File_HTML : 'Upload(+)').'</div>
				<div class="noSelect TP_EmbedFile_Btn">Embed</div>
				'.($Data == null ? '<input type="file" class="TP_File_Inp" data-type="PrdFile" />':'').'
			</div>
		';
		
		return $output;
	}
}