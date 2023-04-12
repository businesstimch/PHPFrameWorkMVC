<?php
class CartMigration_Controller extends GGoRok
{
	
	var $Jani_DB;
	function __construct()
	{
		$this->Jani_DB = $this->Jani_DB();
	}
	function home()
	{
		ini_set('memory_limit', '1024M');
		echo $this->Load->View('cart/migrate.tpl');
		//$this->startCategory();
		//$this->startProduct();
		//$this->startProductToCategory();
		$this->_Cache->Generate();
		
		
	}
	function startProductToCategory()
	{
		$this->resetTable('gc_products_to_categories');
		$JL_Prd = $this->Jani_DB->QRY("
			SELECT
				*
			FROM
				products P,
				products_to_categories P2C,
				categories C
			WHERE
				P.products_id = P2C.products_id AND
				C.categories_id = P2C.categories_id
		");
		$SQL = array();
		foreach($JL_Prd AS $JL_Prd_F)
		{
			
			
			$SQL[] .= '('.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_id']).'",'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['categories_id']).'",'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_sort_order']).'"'.
			')';
			
		}
		
		foreach($SQL AS $SQL_F)
		{
			$this->db->QRY('
				INSERT INTO
					gc_products_to_categories
					(
						Prd_ID,
						Cat_ID,
						Prd_Sort
					)
					VALUES
				'.$SQL_F);
		}
		
		
		return array(
			'ack' => 'success',
			'msg' => 'Category Migration Completed<br />'
		);
		
		
	}
	function getImageList()
	{
		$JL_Prd = $this->Jani_DB->QRY("
			SELECT
				products_id,
				products_image,
				products_subimage1,
				products_subimage2,
				products_subimage3,
				products_subimage4,
				products_subimage5,
				products_subimage6
			FROM
				products P
			WHERE
				P.products_id
		");
		foreach($JL_Prd AS $K => $JL_Prd_F)
		{
			$output['Img'][$K][$JL_Prd_F['products_id']][] = $JL_Prd_F['products_image'];
			if($JL_Prd_F['products_subimage1'])
				$output['Img'][$K][$JL_Prd_F['products_id']][] = $JL_Prd_F['products_subimage1'];
				
			if($JL_Prd_F['products_subimage2'])
				$output['Img'][$K][$JL_Prd_F['products_id']][] = $JL_Prd_F['products_subimage2'];
			
			if($JL_Prd_F['products_subimage3'])
				$output['Img'][$K][$JL_Prd_F['products_id']][] = $JL_Prd_F['products_subimage3'];
			
			if($JL_Prd_F['products_subimage4'])
				$output['Img'][$K][$JL_Prd_F['products_id']][] = $JL_Prd_F['products_subimage4'];
			
			if($JL_Prd_F['products_subimage5'])
				$output['Img'][$K][$JL_Prd_F['products_id']][] = $JL_Prd_F['products_subimage5'];
			
			if($JL_Prd_F['products_subimage6'])
				$output['Img'][$K][$JL_Prd_F['products_id']][] = $JL_Prd_F['products_subimage6'];
				
		}
		
		$output['ack'] = 'success';
		$output['msg'] = 'Product Showcase Image List Downloaded (<span id="CurrentImageInx">0/</span>'.sizeof($output['Img']).')<br />';
		return $output;
		
	}
	function resetShowCaseImage()
	{
		
		if(is_dir(__FrontendPath__.'Upload/1/Products/'))
			removeDirectory(__FrontendPath__.'Upload/1/Products/');
			
		mkdir(__FrontendPath__.'Upload/1/Products/',0777);
		$this->resetTable('gc_products_images');
			
		$output['ack'] = 'success';
		
		return $output;
	}
	function SampleImage()
	{
		$output['ack'] = 'success';
		$Img = json_decode($_POST['Data'],TRUE);
		$Upload_Path = __UploadPath__.'1/Products/';
		
		foreach($Img AS $_F)
		{
			
			
			foreach($_F AS $_K => $_F2)
			{
				
				foreach($_F2 AS $_F3)
				{
					$ImgFile = @file_get_contents('https://www.janilink.com/img/p/O/'.$_F3);
					
					if($ImgFile !== False)
					{
						$Upload_Path_Tmp = $Upload_Path.$_K.'/';
						
						if (!is_dir($Upload_Path_Tmp)) {
							mkdir($Upload_Path_Tmp,0777);
							mkdir($Upload_Path_Tmp.'SC_List',0777);
							mkdir($Upload_Path_Tmp.'SC_Original',0777);
							mkdir($Upload_Path_Tmp.'SC_Showcase',0777);
							mkdir($Upload_Path_Tmp.'SC_Thumb',0777);
							mkdir($Upload_Path_Tmp.'SC_Zoom',0777);
						}
						
						
						if(!is_file($Upload_Path_Tmp.'/SC_Original/'.$_F3))
						{
							
							$this->db->QRY("
								INSERT INTO
									gc_products_images
									(
										Img_FileName,
										Img_isDefault,
										Img_Sort,
										Prd_ID
									)
									
									SELECT
										'".$this->db->escape($_F3)."',
										IF(count(Prd_ID) = 0,1,0),
										count(Prd_ID),
										'".$this->db->escape($_K)."'
									FROM
										gc_products_images
									WHERE
										Prd_ID = '".$this->db->escape($_K)."'
							");
							
							file_put_contents($Upload_Path_Tmp.'SC_Original/'.$_F3, $ImgFile);
							
							foreach($this->XML->Loaded['Showcase'] AS $Images_F)
							{
								$this->image->resample($Upload_Path_Tmp.'SC_Original/'.$_F3, $Upload_Path_Tmp.$Images_F['ID'].'/',$Images_F['Width'],$Images_F['Height']);
							}
						}
					}
				}
				
			}
		}
		
		
		return $output;
	}
	function startProduct()
	{
		
		$this->resetTable('gc_products');
		$this->resetTable('gc_products_files');
		$this->resetTable('gc_products_images');
		$this->resetTable('gc_products_files');
		
		
		$JL_Prd = $this->Jani_DB->QRY("
			SELECT
				*
			FROM
				products P,
				products_description PD
			WHERE
				P.products_id = PD.products_id
		");
		
		/*
		products_image
		products_subimage1
		products_subimage2
		products_subimage3
		products_subimage4
		products_subimage5
		products_subimage6
		products_greenproduct
		products_hide_but_albe_to_order
		products_bundle_status
		products_ordered
		products_recent_sales
		products_fxf_class
		products_fxf_desc
		products_fxf_nmfc
		products_fxf_haz
		products_fxf_freezable
		products_sort_order
		products_master
		products_master_status
		products_listing_status
		products_ship_sep
		products_free_ship
		products_no_tax
		products_img_alt
		cleaning_tips_title
		cleaning_tips_t1title
		cleaning_tips_t1content
		cleaning_tips_t2title
		cleaning_tips_t2content
		cleaning_tips_t3title
		cleaning_tips_t3content
		cleaning_tips_t4title
		cleaning_tips_t4content
		cleaning_tips_t5title
		cleaning_tips_t5content
		cleaning_tips_t6title
		cleaning_tips_t6content
		video_tim
		video_tim_type
		products_suggestions_nick
		
		
		
		mini_desc
		
		*/
		$SQL = array();
		$i = 0;
		$URL_Stack = array(); // To Prevent duplicated SEO URL
		foreach($JL_Prd AS $JL_Prd_F)
		{
			$SEO_URL = $JL_Prd_F['products_name'];
			$SEO_URL = preg_replace('/[^A-Za-z0-9\s]+/','',strtolower($SEO_URL));
			$SEO_URL = preg_replace('/[_\s]+/','-',strtolower($SEO_URL));
			$SEO_URL = preg_replace('/--/','-',strtolower($SEO_URL));
			
			$CheckStack = array_count_values($URL_Stack);
			
			if(isset($CheckStack[$SEO_URL]))
			{
				if($CheckStack[$SEO_URL] == 0)
				{
					$URL_Stack[] = $SEO_URL;
				}
				else
				{
					$SEO_URL = $CheckStack[$SEO_URL].'_'.$JL_Prd_F['products_id'];
					$URL_Stack[] = $SEO_URL;
				}
			}
			else
				$URL_Stack[] = $SEO_URL;
			
			$SQL[] .= '('.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_id']).'",'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_name']).'",'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['short_desc']).'",'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_description']).'",'.
				'"'.$this->Jani_DB->escape($SEO_URL).'",'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_price']).'",'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_listprice']).'",'.
				'1,'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_bestbuy']).'",'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_status']).'",'.
				'999,'.
				'1,'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_weight']).'",'.
				'1,'.
				'1,'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_length']).'",'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_width']).'",'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_height']).'",'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_model']).'",'.
				'1,'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_head_title_tag']).'",'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_head_keywords_tag']).'",'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_head_desc_tag']).'",'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_head_keywords_tag']).'",'.
				'1,'.
				'"'.$this->Jani_DB->escape($JL_Prd_F['products_date_added']).'"'.
			')';
			$i++;
			
		}
		
		foreach($SQL AS $SQL_F)
		{
			$this->db->QRY('
				INSERT INTO
					gc_products
					(
						Prd_ID,
						Prd_Name,
						Prd_Desc_Short,
						Prd_Desc_Long,
						Prd_SEO_URL,
						Prd_Price,
						Prd_ListPrice,
						Prd_isTaxble,
						Prd_isFeatured,
						Prd_isActive,
						Prd_Qty,
						Prd_MinimumQty,
						Prd_Weight,
						Prd_Weight_Unit,
						Prd_Dimension_Unit,
						Prd_Dimension_L,
						Prd_Dimension_W,
						Prd_Dimension_H,
						Prd_SKU,
						Prd_StorePickup_Available,
						Prd_Meta_Title,
						Prd_Meta_Key,
						Prd_Meta_Desc,
						Prd_Tags,
						Store_ID,
						Prd_CreatedOn
					)
					VALUES
				'.$SQL_F);
		}
		
		
		return array(
			'ack' => 'success',
			'msg' => 'Product Migration Completed<br />'
		);
	}
	
	function startCategory()
	{
		$this->resetTable('gc_category');
		$this->resetTable('gc_category_description_images');
		
		$JL_Category = $this->Jani_DB->QRY("
			SELECT
				*
			FROM
				categories C,
				categories_description CD
			WHERE
				C.categories_id = CD.categories_id
		");
		
		$SQL = array();
		$URL_Stack = array(); // To Prevent duplicated SEO URL
		foreach($JL_Category AS $JL_Category_F)
		{
			if($JL_Category_F['rewrite_tim'] == '')
			{
				$JL_Category_F['rewrite_tim'] = preg_replace('/[^A-Za-z0-9\s]+/','',strtolower($JL_Category_F['categories_name']));
				$JL_Category_F['rewrite_tim'] = preg_replace('/[_\s]+/','-',strtolower($JL_Category_F['rewrite_tim']));
				$JL_Category_F['rewrite_tim'] = preg_replace('/--/','-',strtolower($JL_Category_F['rewrite_tim']));
				
				$CheckStack = array_count_values($URL_Stack);
				
				if(isset($CheckStack[$JL_Category_F['rewrite_tim']]))
				{
					if($CheckStack[$JL_Category_F['rewrite_tim']] == 0)
					{
						$URL_Stack[] = $JL_Category_F['rewrite_tim'];
					}
					else
					{
						$JL_Category_F['rewrite_tim'] = $CheckStack[$JL_Category_F['rewrite_tim']].'_'.$JL_Category_F['categories_id'];
						$URL_Stack[] = $JL_Category_F['rewrite_tim'];
					}
				}
				else
					$URL_Stack[] = $JL_Category_F['rewrite_tim'];
			}
			$SQL[] .= '('.
				$this->Jani_DB->escape($JL_Category_F['categories_id']).','.
				'1,'.
				'"'.$this->Jani_DB->escape($JL_Category_F['categories_name']).'",'.
				'"'.$this->Jani_DB->escape($JL_Category_F['categories_description_tim']).'",'.
				'"",'.
				'"'.$this->Jani_DB->escape($JL_Category_F['rewrite_tim']).'",'.
				'"'.$this->Jani_DB->escape($JL_Category_F['categories_htc_title_tag']).'",'.
				'"'.$this->Jani_DB->escape($JL_Category_F['categories_htc_keywords_tag']).'",'.
				'"'.$this->Jani_DB->escape($JL_Category_F['categories_htc_desc_tag']).'",'.
				'"'.$this->Jani_DB->escape($JL_Category_F['sort_order']).'",'.
				'"'.$this->Jani_DB->escape($JL_Category_F['parent_id']).'",'.
				'"'.$this->Jani_DB->escape($JL_Category_F['categories_status']).'",'.
				'1'.
			')';
		}
		
		$this->db->QRY('
			INSERT INTO
				gc_category
				(
					Cat_ID,
					Store_ID,
					Cat_Name,
					Cat_Desc_Top,
					Cat_Desc_Bottom,
					Cat_SEO_URL,
					Cat_Meta_Title,
					Cat_Meta_Key,
					Cat_Meta_Desc,
					Cat_Sort,
					Cat_Parent_ID,
					Cat_isActive,
					Cat_DisplaySubCatPrd
				)
				VALUES
				
			'.implode(',',$SQL));
		
		if(is_dir(__FrontendPath__.'Upload/1/Categories/'))
			removeDirectory(__FrontendPath__.'Upload/1/Categories/');
		
		$output['ack'] = 'success';
		$output['msg'] = 'Category Completed<br />';
		return $output;
	}
	
	function Jani_DB()
	{
		$this->Jani_DB = new $this->db;
		$this->Jani_DB->connect(array(
			'DB_Name' => 'janilink_new',
			'DB_Server' => 'janilink.com',
			'DB_UserName' => 'remote',
			'DB_Password' => 'MJaCall@MQNb^!%'
		));
		
		return $this->Jani_DB;
	}
	
	function resetTable($Table_Name)
	{
		$this->db->QRY("DELETE FROM ".$Table_Name);
		$this->db->QRY("ALTER TABLE ".$Table_Name." AUTO_INCREMENT = 1");
	}
	
}

?>