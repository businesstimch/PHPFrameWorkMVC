<?

class _Store extends GGoRok{
	
	var $SQL_AllCategory;
	var $SQL_AllCategory_Domain;
	var $css_template_global;
	var $ListLimitDistance_Increase;
	var $lang;
	function __construct()
	{
		
			
		
	}
	function SQL_AllCategory($Domain = null)
	{
		
		
		$WHERE = '';
		if(!is_null($Domain))
		{
			$WHERE .= " AND c.category_subdomain = '".$this->db->escape($Domain)."'";
		}
		
		$C = $this->db->QRY("
			SELECT
				*
			FROM
				b_category c
					LEFT JOIN
						b_category_name cN
					ON
						cN.category_id = c.category_id
			WHERE
				cN.lang_id = '".$this->db->escape(__langID__)."'
				".$WHERE."
			ORDER BY
				c.category_sort ASC
		");
		
		return $C;
	}
	
	
	function HTML_StoreCategory_0($customTag = null, $List_Menu = 0, $Domain = null)
	{
		
		$html = "<select ".$customTag.">";
		$html .= '<option value="-1">- Select Store Type -</option>';
		$ParentCatName = null;
		
		foreach($this->SQL_AllCategory() as $C)
		{
			if
			(
				(
					($List_Menu == 0) || /*	ALL Category	*/
					($List_Menu == 1 && $C['business_or_service'] == 1) ||  /*Business Owner Category*/
					($List_Menu == 2 && $C['business_or_service'] == 0) ||  /*Business Owner Category*/
					($List_Menu == 3 && $C['business_or_service'] == 2) || 	/*Service Category*/
					($List_Menu == 4 && $C['business_or_service'] == 3)  	/*Service Category*/
			   )
				&& $C['category_depth'] == 0
				
			   
			)
			{
				//echo '['.$onlyService_Category.'/'.$C['business_or_service'].']';
				$html .= '<option value="'.$C['category_id'].'" disabled="disabled">'.$C['category_name'].'</option>';
			
				foreach($this->SQL_AllCategory as $C2)
				{
					if($C2['category_depth'] == 1 && $C['category_id'] == $C2['category_parent_id'])
						$html .= '<option value="'.$C2['category_id'].'">&nbsp; '.$C2['category_name'].'</option>';
				}
			}
		}
		
		$html .= "</select>";
		return $html;
	}
	
	
	function HTML_StoreCategory_2($customTag = null, $parentID = null)
	{
		$html = "<select ".$customTag.">";
		$html .= '<option value="-1">- Select Store Sub Type -</option>';
		$counterOPT = 0;
		
		
		foreach($this->SQL_AllCategory as $C)
		{
			if($C['category_depth'] == 2 && $C['category_parent_id'] == $parentID)
			{
				$html .= '<option value="'.$C['category_id'].'">'.$C['category_name'].'</option>';
				$counterOPT++;
			}
		}
		$html .= "</select>";
		
		if($counterOPT < 1)
			return false;
		
		return $html;
		
	}
	function getCategoryID_by_url($catURL = null)
	{
		
		$output = array();
		
		$where = "";
		$where .= (!is_null($catURL)? " c.category_url = '".($this->db->escape($catURL))."'" : "");
		
		
		$C = $this->db->QRY("
			SELECT
				c.category_id,
				c.category_url,
				cn.category_name
			FROM
				b_category c
					LEFT JOIN
						b_category_name cn
					ON
						c.category_id = cn.category_id AND cn.lang_id = '".$this->db->escape(__langID__)."'
			WHERE
				".$where."
				
				/*
					AND c.category_subdomain = '".$this->db->escape(_SubDomain_)."'
				*/
		");
		foreach($C as $C_F)
		{
			$output['c_ID'] = $C_F['category_id'];
			$output['c_URL'] = $C_F['category_url'];
			$output['c_Name'] = $C_F['category_name'];
		}
		
		
		
		return $output;
	}
	function getStoreID_by_URL($StoreURL)
	{
		
		$StoreID = $this->db->QRY("
			SELECT
				store_id
			FROM
				b_burugo_stores s
			WHERE
				s.store_url = '".$this->db->escape($StoreURL)."' AND
				s.customers_id = '".$this->db->escape($this->login->_customerID)."'
		");
		if(sizeof($StoreID) > 0)
			return $StoreID[0]['store_id'];
	}
	
	function loadThisStore($StoreDomain,$secure_access = false)
	{
		
		$where_secure = '';
		if($secure_access)
			$where_secure = ' AND customers_id = "'.$this->db->escape($this->login->_customerID).'"';
		$Store = $this->db->QRY("
			SELECT
				*
			FROM
				b_burugo_stores s
			WHERE
				s.store_id = '".$this->db->escape($this->getStoreID_by_URL($StoreDomain))."'"
				.$where_secure."
		");
		return $Store;
	}
	function getTxt_ExpDate($ExpDate)
	{
			if(isset($ExpDate) && !($ExpDate == '0000-00-00'))
			{
				if($ExpDate >= date('Y-m-d'))
					$exp_date = date("M/d/y", strtotime($ExpDate));
				else
					$exp_date = '<span>'.date("M/d/y", strtotime($ExpDate)).'</span>';
			}
			else
				$exp_date = '-';
				
			return $exp_date;
	}

	function getHTML_storeType($MyStores_F)
	{
		$ret_class = '';
		$ret_txt = '';
		
		if($MyStores_F['domain_group_id'] == 1) // www
		{
			if($MyStores_F['store_service_or_business'] == 1) // delivery
			{
				$ret_class = 'storeList_StoreType_Service';
				$ret_txt = 'Burugo Delivery';
			}
			else
			{
				if($MyStores_F['service_type_FreeOrPay']==1) // Premium
				{
					$ret_class = 'storeList_StoreType_Premium';
					$ret_txt = 'Premium Business';
				}
				else // basic
				{
					$ret_class = 'storeList_StoreType_Basic';
					$ret_txt = 'Basic Business';
				}
			}
		}
		else // helper
		{
			$ret_class = 'storeList_StoreType_Helper';
			$ret_txt = 'Burugo Helper';
		}
		
		
		$output['class'] = $ret_class;
		$output['txt'] = $ret_txt;
		return $output;
	}

	function getHTML_storeStatus($MyStores_F, $Apply_Data = null)
	{
		$ret_class = '';
		$ret_txt = '';
		
		
		
		if($MyStores_F['store_approved'] == 1)	 /*	If not approved yet	*/
		{
			$ret_class = 'storeList_Status_Approved';
			$ret_txt = 'Active Business';
		}
		else
		{
			if(sizeof($Apply_Data) > 0)
			{
				
				if($Apply_Data[0]['apply_status'] == 1)
				{
					$ret_class = 'storeList_Status_Pending';
					$ret_txt = 'Pending Approval';
				}
				else if($Apply_Data[0]['apply_status'] == 2)
				{
					$ret_class = 'storeList_Status_Process';
					$ret_txt = 'Processing Approval';
				}
				else if($Apply_Data[0]['apply_status'] == 3)
				{
					$ret_class = 'storeList_Status_Declined';
					$ret_txt = 'Decliined';
				}
			}
			else
			{
				$ret_class = 'storeList_Status_BeforeApply';
				$ret_txt = 'Please Finish Forms';
			}
		}
		
		$output['class'] = $ret_class;
		$output['txt'] = $ret_txt;
		return $output;
	}

	function saveStoreCategory($StoreID, $categoryIDs)
	{
		
		$this->db->QRY('
			DELETE FROM
				b_category_to_store
			WHERE
				customers_id = "'.$this->db->escape($this->login->_customerID).'" AND
				store_id = "'.$this->db->escape($StoreID).'"
		');
		
		$categoryIDs_Arr = explode(',',$categoryIDs);
		
		foreach($categoryIDs_Arr as $categoryIDs_Arr_F)
		{
			
			if(sizeof($this->db->QRY("SELECT category_id FROM b_category WHERE category_id = '".$categoryIDs_Arr_F."'")) > 0)
			{
				$this->db->QRY("
					INSERT INTO
						b_category_to_store
						(
							store_id,
							customers_id,
							category_id
						)
						VALUES
						(
							'".$this->db->escape($StoreID)."',
							'".$this->db->escape($this->login->_customerID)."',
							'".$this->db->escape($categoryIDs_Arr_F)."'
						)
						
				");
			}
		}
		
		
		
	}
	function loadThisStore_by_ID($StoreID,$secure_access = false, $Get_Also_DeactivedStore = false)
	{
		
		$where_secure = '';
		$output = '';
		if($secure_access)
			$where_secure = ' AND customers_id = "'.$this->db->escape($this->login->_customerID).'"';
		
		
		//Load General Information about this store
		$output_temp = $this->db->QRY("
			SELECT
				*,
				IF(subscription_expiration_date IS NOT NULL and subscription_expiration_date >= now(), 1,0) as PaidStore
			FROM
				b_burugo_stores s
			WHERE
				s.store_id = '".$this->db->escape($StoreID)."'
				".($Get_Also_DeactivedStore?"":" AND s.store_active = 1 ")."
				".($secure_access?' AND s.customers_id = "'.$this->db->escape($this->login->_customerID).'"':'')."
				
		");
		
		
		//If store exists
		if(sizeof($output_temp) > 0)
		{
			
			#[Load] : Store
			$output['Store'] = (isset($output_temp[0]) ? $output_temp[0]:null);
			
			//$output['Store']['subscription_expiration_date']
			
			
			#[Load] : Store Category
			$output['Store_Categories'] = $this->db->QRY("
				SELECT
					*
				FROM
					b_category_to_store s2c
				WHERE
					s2c.store_id = '".$this->db->escape($StoreID)."'
			");
			
			
			#[Load] : Store List Images
			$output['Store_Images'] = $this->db->QRY("
				SELECT
					*
				FROM
					b_burugo_stores_images i
				WHERE
					i.store_id = '".$this->db->escape($StoreID)."'"
					.($secure_access?' AND i.customers_id = "'.$this->db->escape($this->login->_customerID).'"':'')."
				ORDER BY
					i.img_default DESC , i.img_sort DESC
			");
			
			
			#[Load] : Store Description Images
			$output['Store_Desc_Images'] = $this->db->QRY("
				SELECT
					*
				FROM
					b_burugo_stores_description_images i
				WHERE
					i.store_id = '".$this->db->escape($StoreID)."'"
					.($secure_access?' AND i.customers_id = "'.$this->db->escape($this->login->_customerID).'"':'')."
				ORDER BY
					i.img_id DESC
			");
			
			
			$output['Store_Sub_Category'] = $this->db->QRY("
				SELECT
					subC.category_sub_id,
					subC.category_sub_name
				FROM
					b_category_sub subC,
					b_category_sub_to_store sub_c2S
				WHERE
					sub_c2S.category_sub_id = subC.category_sub_id AND
					sub_c2S.store_id = '".$this->db->escape($StoreID)."'" 
					.($secure_access?' AND sub_c2S.customers_id = "'.$this->db->escape($this->login->_customerID).'"':'')."
			");
			
			
			# Check Domain Group = WWW && Is this regular business store? Not a service?
			if($output['Store']['domain_group_id'] == 1 && $output['Store']['store_service_or_business'] == 0)
				$output['Store_ShouldCheckPay_Or_Not'] = true;
			else
				$output['Store_ShouldCheckPay_Or_Not'] = false;
			
			
			
			
			/*
			$Subscription_Package = $this->db->QRY("
				SELECT
					pk.package_amt
				FROM
					b_burugo_store_package pk,
					b_burugo_store_payment_subscriptions ps
				WHERE
					pk.package_id = ps.package_id AND
					ps.store_id = '".$this->db->escape($StoreID)."'
			");
			if(sizeof($Subscription_Package) > 0)
			{
				$output_temp = $this->db->QRY("
					SELECT
						ph.service_exp_date,
						ph.payment_amt,
						ph.payment_type
					FROM
						b_burugo_store_payment_history ph,
						b_burugo_store_payment_subscriptions ps
					WHERE
						ph.store_id = ps.store_id AND
						ph.store_id = '".$this->db->escape($StoreID)."' AND
						ph.service_exp_date >= now()
				");
				
				if(sizeof($output_temp) > 0)
				{
					
					$oneTimePayment = false;
					$temp_Payment_Total = 0;
					foreach($output_temp AS $output_temp_F)
					{
						if(!$oneTimePayment && $output_temp_F['payment_type'] == 1)
							$oneTimePayment = true;
						$temp_Payment_Total = $temp_Payment_Total + $output_temp_F['payment_amt'];
					}
					
					//echo $temp_Payment_Total.'/'.$Subscription_Package;
					if($temp_Payment_Total >= $Subscription_Package[0]['package_amt'] || $oneTimePayment)
					{
						$output['Store_Paid'] = true;
					}
					
				}
			}
			
			*/
				
			
			
			
			# [Load] Item Group
			$output['Store_Group'] = $this->db->QRY("
				SELECT
					group_id,
					group_name,
					group_folded
				FROM
					b_burugo_store_item_group
				WHERE
					store_id = '".$this->db->escape($StoreID)."'"
					.($secure_access?' AND customers_id = "'.$this->db->escape($this->login->_customerID).'"':'')."
			");
			
			$ItemGroup_Loop = 0;
			$Item_Loop = 0;
			$output_temp = $output['Store_Group'];
			foreach($output_temp AS $ItemGroup)
			{
				$Items = $this->db->QRY("
					SELECT
						customers_id,
						item_id,
						item_name,
						item_short_description,
						item_price,
						item_texable,
						item_img_file
					FROM
						b_burugo_store_item
					WHERE
						group_id = '".$this->db->escape($ItemGroup['group_id'])."'"
						.($secure_access?' AND customers_id = "'.$this->db->escape($this->login->_customerID).'"':'')."
				");
				
				if(sizeof($Items) > 0)
				{
					foreach($Items AS $Items_F)
					{
						$output['Store_Group'][$ItemGroup_Loop]['Item'][$Item_Loop]['customers_id'] = $Items_F['customers_id'];
						$output['Store_Group'][$ItemGroup_Loop]['Item'][$Item_Loop]['item_id'] = $Items_F['item_id'];
						$output['Store_Group'][$ItemGroup_Loop]['Item'][$Item_Loop]['item_name'] = $Items_F['item_name'];
						$output['Store_Group'][$ItemGroup_Loop]['Item'][$Item_Loop]['item_short_description'] = $Items_F['item_short_description'];
						$output['Store_Group'][$ItemGroup_Loop]['Item'][$Item_Loop]['item_price'] = $Items_F['item_price'];
						$output['Store_Group'][$ItemGroup_Loop]['Item'][$Item_Loop]['item_texable'] = $Items_F['item_texable'];
						$output['Store_Group'][$ItemGroup_Loop]['Item'][$Item_Loop]['item_img_file'] = $Items_F['item_img_file'];
						$Item_Loop++;	
					}
				}
				else
				{
					$output['Store_Group'][$ItemGroup_Loop]['Item'] = '';
				}
				
				$Item_Loop = 0;
				$ItemGroup_Loop++;
			}
		}
		
		
			
		return $output;
	}
	
	
	function generate_SEO_URL_FromTXT($txt)
	{
		$txt = strtolower($txt);
		$txt = preag_replace('/ /','-',$txt);
		$txt = preag_replace('/[^\w\d]/','',$txt);
		
		return $txt;
	}
	function loadAllStore($secure_access = false)
	{
		
		$WHERE = 'store_active = 1 ';
		if($secure_access)
			$WHERE .= 'AND customers_id = "'.$this->db->escape($this->login->_customerID).'"';
		 
		 
		$Store = $this->db->QRY("
			SELECT
				s.*
			FROM
				b_burugo_stores s
			WHERE
				".$WHERE."
			ORDER BY
				s.store_created
		");
		return $Store;
		
	}
	
	function getCurrentStoreTime($storeTZ,$customTimeStamp = null)
	{
		$date = new DateTime();
		if(!is_null($customTimeStamp))
			$date->setTimestamp($customTimeStamp);
		
		$date->setTimezone(new DateTimeZone($storeTZ));
		return $date;
	}
	
	function deleteBusiness($storeID)
	{
		
		$output['ack'] = 'error';
		if($this->login->_customerInfo[0]['is_admin'] == 1)
			if(is_numeric($storeID))
			{
				/*
				b_burugo_store_item_group
				b_burugo_store_item
				
				*/
				$this->db->QRY("
					UPDATE
						b_burugo_stores
					SET
						store_active = 0
					WHERE
						store_id = '".$this->db->escape($storeID)."'
				");
				$output['ack'] = 'success';
			}
		
		return $output;
		
	}
	
	function listBusinesses_HTML($cID = null, $Location = null, $Search = null, $limit = 100, $Page = 0 , $Mile_Pagination = 1)
	{
		global $arr_Service_ID;
		
		#####################
		$Mile_Pagination = abs(intval($Mile_Pagination)); //Sanitize $_Post Value
		$ListLimitDistance = $this->ListLimitDistance_Increase * $Mile_Pagination;
		#####################
		
		$cID_Where = null;
		$Is_In_Category = false;
		$SELECT = '';
		$FROM = '';
		$WHERE = '';
		$HAVING = '';
		$ORDER = '
			ORDER BY
				PaidStore DESC
		';
		
		
		
		
		# SEARCH ?
		if(sizeof($Search) > 0)
		{
			if(isset($Search['Keyword']) && !empty($Search['Keyword']))
				$WHERE .= ' AND s.store_name like "%'.$this->db->escape($Search['Keyword']).'%"';
				
			if(isset($Search['State']) && !empty($Search['State']))
				$WHERE .= ' AND s.store_state COLLATE UTF8_GENERAL_CI LIKE "%'.$this->db->escape($Search['State']).'%"';
				
			if(isset($Search['City']) && !empty($Search['City']))
				$WHERE .= ' AND s.store_city like "%'.$this->db->escape($Search['City']).'%"';
				
			if(isset($Search['Zipcode']) && !empty($Search['Zipcode']))
				$WHERE .= ' AND s.store_zipcode like "%'.$this->db->escape($Search['Zipcode']).'%"';
			
			
			if(isset($Search['CityOrState']) && !empty($Search['CityOrState']))
				$WHERE .= ' AND (s.store_city like "%'.$this->db->escape($Search['CityOrState']).'%" or s.store_city like "%'.$this->db->escape($Search['CityOrState']).'%") ';
				
			
		}
		# in CATEGORY ?
		else if(!is_null($cID))
		{
			
			$WHERE .= ' AND c2s.category_id = "'.$this->db->escape($cID).'"';
			
			
			$FROM .= "
				,
			b_category_to_store c2s,
			b_burugo_store_category c
				LEFT JOIN
					b_burugo_store_category_group cg
				ON
					c.category_group_id = cg.category_group_id
			";
			
			$WHERE .= '
				AND s.store_id = c2s.store_id
				AND c.category_id = c2s.category_id';
				
				
			
			
		}
		
		
		if(_SubDomain_ == 'www')
			$WHERE .= ' AND s.domain_group_id = 1 AND s.store_service_or_business = 0';
		else if(_SubDomain_ == 'social')
			$WHERE .= ' AND s.domain_group_id = 3 AND s.store_service_or_business = 0';
		else if(_SubDomain_ == 'helper')
			$WHERE .= ' AND s.domain_group_id = 2 AND s.store_service_or_business = 0';
		else if(_SubDomain_ == 'job')
			$WHERE .= ' AND s.domain_group_id = 4 AND s.store_service_or_business = 0';
		else
			$WHERE .= ' AND s.domain_group_id = 1 AND s.store_service_or_business = 0';
	
		
		if(is_array($Location) && sizeof($Search) == 0)
		{
			$SELECT .= ",
			
				 3956 * 2 * ASIN(SQRT( POWER(SIN((".$Location['lat']." - store_latitude) *  pi()/180 / 2), 2) +COS(".$Location['lat']." * pi()/180) * COS(store_latitude * pi()/180) * POWER(SIN((".$Location['long']." - store_longitudes) * pi()/180 / 2), 2) )) as distance
				 
				
			";
			
			if($Mile_Pagination > 1)
			{
				$ListLimitDistance_Temp = ($Mile_Pagination - 1) * $this->ListLimitDistance_Increase;
				$WHERE .= "
					AND
						!MBRContains(
							GeomFromText(
								'LineString(
									".
									($Location['lat'] + $ListLimitDistance_Temp / ( 111.1 / cos($Location['lat'])))." ".($Location['long'] + $ListLimitDistance_Temp / 111.1).",
									".
									($Location['lat'] - $ListLimitDistance_Temp / ( 111.1 / cos($Location['lat'])))." ".($Location['long'] - $ListLimitDistance_Temp / 111.1)."
								)'
							), store_lnglat
						)";
						
			
				
			}
			
			$WHERE .= "
				AND
					MBRContains(
						GeomFromText(
							'LineString(
								".
								($Location['lat'] + $ListLimitDistance / ( 111.1 / cos($Location['lat'])))." ".($Location['long'] + $ListLimitDistance / 111.1).",
								".
								($Location['lat'] - $ListLimitDistance / ( 111.1 / cos($Location['lat'])))." ".($Location['long'] - $ListLimitDistance / 111.1)."
							)'
						), store_lnglat
					)";
				
			
			
					
			
					
			
			$ORDER .= '
				,distance asc
			';
			
		}
		
		
		
			
		
		$Businesses = $this->db->QRY("
			SELECT
				*,
				s.customers_id as customers_id,
				s.store_id as s_store_id,
				(
					SELECT
						count(store_id)
					FROM
						b_burugo_store_item_group IG
					WHERE
						IG.store_id = s.store_id
				) AS TotalGroup,
				
				IF(s.subscription_expiration_date IS NOT NULL and s.subscription_expiration_date >= now(), 1,0) as PaidStore
				
				".$SELECT."
			FROM
				b_burugo_stores s
					LEFT JOIN
						b_burugo_stores_images i
					ON
						s.store_id = i.store_id and
						i.img_default = 1
				".$FROM."
			
			WHERE
				s.store_approved = 1 AND
				s.store_active = 1
				".$WHERE."
			
			
			
			
			".$HAVING."
			".$ORDER."
			
			LIMIT ".($Page * $limit).", ".$limit."
			
			
		");
		
		$html = '';
		$endofpage = 0;
		if(sizeof($Businesses) > 0)
		{
			$loopCount = 0;
			$NewLine_Divide = 3;
			FOREACH($Businesses AS $Businesses_F)
			{
				$open = $this->openedStore($Businesses_F);
				
				//PaidStore
				if($Businesses_F['domain_group_id'] == 1 && $Businesses_F['store_service_or_business'] == 0 && $Businesses_F['PaidStore'] == 0)
				{
					$Service['Reservation'] = 'res_icn_off';
					$Service['ToGo'] = 'res_icn_off';
					$Service['Delivery'] = 'res_icn_off';
					$Service['Open'] ='res_icn_off';
				}
				else
				{
					
					$Service['Reservation'] = ($Businesses_F['store_service_reservation'] == 1	?	$this->css_template_global['icon_on']	:	"res_icn_off");
					$Service['ToGo'] = ($Businesses_F['store_service_togo'] == 1 && $Businesses_F['TotalGroup'] > 0	?	$this->css_template_global['icon_on']	:	"res_icn_off");
					$Service['Delivery'] = ($Businesses_F['store_service_delivery'] == 1 && $Businesses_F['TotalGroup'] > 0	?	$this->css_template_global['icon_on']	:	"res_icn_off");
					$Service['Open'] =($open? $this->css_template_global['icon_on'] : "res_icn_off");
				}
				
				$html .= '<div class="one_business"';
				if($NewLine_Divide == $loopCount + 1)
				{
					$html .= ' style="margin-right:0px"';
					$loopCount = -1;
				}
				$html .= '>';
				$addr = $Businesses_F['store_street_addr'].', '.$Businesses_F['store_city'].', '.$Businesses_F['store_state'];
				$html .= '
							<div class="one_business_Top">
								<a href="/b/'. $Businesses_F['s_store_id'].'/'.$Businesses_F['store_url'].'/" class="res_img">'.
								($Businesses_F['img_file'] != "" ?
									'<img src="/Template/Img/cData/'. $Businesses_F['customers_id'].'/business-pictures/list/'.$Businesses_F['img_file'].'" />' :
									'<img src="/Template/Img/no-image-list.gif" />'
								).'</a>
								<div class="business_Top_Right">
									<a href="/b/'.$Businesses_F['s_store_id'].'/'.$Businesses_F['store_url'].'/" class="res_info_Name">
										<span class="name '.$this->css_template_global['business_name'].'">'.$Businesses_F['store_name'].'</span>
									</a>
									<a href="/b/'.$Businesses_F['s_store_id'].'/'.$Businesses_F['store_url'].'/#map" class="res_info_Address">
										<span>'.$addr.'</span>
									</a>
									<div class="res_info_Tel">'.$Businesses_F['store_telephone'].'</div>
									
									
									
								</div>
							</div>
							<div class="one_business_Bottom">
								<div class="resIcnBlock">
									<div class="res_icn_reserv '.$Service['Reservation'].'"></div>
									<div class="res_icn_togo '. $Service['ToGo'].'"></div>
									<div class="res_icn_delivery '. $Service['Delivery'].'"></div>
									<div class="res_icn_open '.$Service['Open'].'"></div>
								</div>
								<div class="busNavigationICN"></div>
								<a href="/b/'.$Businesses_F['s_store_id'].'/'.$Businesses_F['store_url'].'/#navigation" class="busNavigationBlock block">DIRECTIONS</a>
								<div class="busRatingBlock">
									<div class="busRating_Score"></div>
									<div class="busRating_Qty">(0)</div>
								</div>
							</div>
							
						</div>';
				

				$loopCount++;
			}
			
			
			if(isset($Search['Keyword']) && !empty($Search['Keyword']))
			{
				$this->db->QRY("
					
					INSERT INTO
						b_search_history
						(
							search_keyword,
							search_popular
						)
						VALUES
						(
							'".$this->db->escape($Search['Keyword'],false)."',
							0
						)
						ON DUPLICATE KEY UPDATE
							search_popular = search_popular + 1;
				");
				
				
			}
			
			
		}
		else
		{
			$html =  '<div class="NoResult_Business_List">'.$this->lang[_lang_]['noResult'].'
					 <input type="hidden" id="endofpage" value = "1"/></div>';
			$endofpage = 1;
		}
		
		$output['html'] = $html;
		$output['endofpage'] = $endofpage;
		$output['listfound'] = sizeof($Businesses);
		
		return $output;
	}
	
	function openedStore($Businesses_F, $SpecificDate = null)
	{
		//$open,$close,$Timezone
		
		if(!is_null($SpecificDate))
		{
			$Time = $this->getCurrentStoreTime($Businesses_F['store_timezone'],$SpecificDate);
			$hourToCheck = $Time->format("G");
			$dayToCheck  = $Time->format("D");
		}
		else
		{
			$hourToCheck = $this->getCurrentStoreTime($Businesses_F['store_timezone']);
			$dayToCheck = $hourToCheck->format("D");
			$hourToCheck = $hourToCheck->format("G");
		}
		
		switch($dayToCheck)
		{
			case "Sun";
				$dInfo['y'] = 'sat';
				$dInfo['t'] = 'sun';
				break;
			case "Mon";
				$dInfo['y'] = 'sun';
				$dInfo['t'] = 'mon';
				break;
			case "Tue";
				$dInfo['y'] = 'mon';
				$dInfo['t'] = 'tue';
				break;
			case "Wed";
				$dInfo['y'] = 'tue';
				$dInfo['t'] = 'wed';
				break;
			case "Thu";
				$dInfo['y'] = 'wed';
				$dInfo['t'] = 'thur';
				break;
			case "Fri";
				$dInfo['y'] = 'thur';
				$dInfo['t'] = 'fri';
				break;
			case "Sat";
				$dInfo['y'] = 'fri';
				$dInfo['t'] = 'sat';
				break;
		}
		
		if(
			// Opened Today?
			($Businesses_F['store_open_'.$dInfo['y']] != -1 && $Businesses_F['store_close_'.$dInfo['y']] != -1) &&
			// Yesterday Opened & will be closed on tomorrow.
			($Businesses_F['store_open_'.$dInfo['y']] >= $Businesses_F['store_close_'.$dInfo['y']]) &&
			!($Businesses_F['store_open_'.$dInfo['y']] == 0 && $Businesses_F['store_close_'.$dInfo['y']] == 0) && 
			!($Businesses_F['store_open_'.$dInfo['t']] == 0 && $Businesses_F['store_close_'.$dInfo['t']] == 0) 
		)
		{
			//Started From Yesterday
			$open = $Businesses_F['store_open_'.$dInfo['y']];
			$close = ($Businesses_F['store_close_'.$dInfo['y']] == 0 ? 24 : $Businesses_F['store_close_'.$dInfo['y']]);
			
			
				
			if($hourToCheck < $close)
				return true;
			else if(($Businesses_F['store_open_'.$dInfo['t']] > $Businesses_F['store_close_'.$dInfo['t']])) // This case, closing time is tomorrow.
				return true;
		}
		else if($Businesses_F['store_open_'.$dInfo['t']] > -1 && $Businesses_F['store_close_'.$dInfo['t']] > -1 || !($Businesses_F['store_open_'.$dInfo['t']] == 0 && $Businesses_F['store_close_'.$dInfo['t']] == 0))
		{
			
			//Started From Today
			$TimeFrom_Yesterday = false;
			$open = $Businesses_F['store_open_'.$dInfo['t']];
			$close = ($Businesses_F['store_close_'.$dInfo['t']] == 0 ? 24 : $Businesses_F['store_close_'.$dInfo['t']]);
			
			if($open > $close) /* Open until tomorrow */
					return true;
				else if($hourToCheck >= $open && $hourToCheck < $close) /*Open,Close today*/
					return true;
		}	
		
		
		return false;
	}
	
	
}


?>