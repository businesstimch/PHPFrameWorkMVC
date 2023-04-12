<?php
class CartCorpModulesGoogleMerchantHome_Controller extends GGoRok
{
	
	var $Old_DB;
	
	function home()
	{
		$Data['title'] = 'Migration POS | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		$Data['MAIN_HTML'] = $this->Load->View('cart/corp/modules/google-merchant/home.tpl',array(
		));
		
		//$this->NoLookupCodeInPOS();
		$Home_Controller = $this->Load->Controller('cart/corp/home');
		echo $Home_Controller->loadHeader($Data);
	}
	
	function getFeed()
	{
		$GM_Data = $this->getList();
		
		echo 'id	title	description	condition 	price	availability	link	mpn	image_link	additional_image_link	gtin	brand	google_product_category	material	item_group_id	shipping_weight	sale_price_effective_date	product_type	custom_label_0	custom_label_1	custom_label_2	custom_label_3	custom_label_4'."\n";
		foreach($GM_Data['OnAD'] AS $_F)
		{
			if($_F['GM_google_merchant_status'] == 1)
			{
					
				echo
					$_F['Prd_ID'].'	'.
					$_F['GM_title'].'	'.
					$_F['GM_description'].'	'.
					$_F['GM_condition'].'	'.
					number_format(($_F['products_froogle_price'] > 0 ? $_F['products_froogle_price'] : $_F['products_price']),2).'	'.
					($_F['products_quantity'] > 0 ? 'in stock' : 'out of stock').'	'.
					'https://www.janilink.com/product_info.php?products_id='.$_F['products_id'].'	'.
					$_F['products_model'].'	'.
					'https://www.janilink.com/img/p/O/'.$_F['products_image'].'	'.
					'	'.
					$_F['GM_gtin'].'	'.
					$_F['GM_brand'].'	'.
					$_F['GM_google_product_category'].'	'.
					$_F['GM_material'].'	'.
					$_F['GM_item_group_id'].'	'.
					$_F['products_weight'].'	'.
					'	'.
					$_F['GM_product_type'].'	'.
					$_F['GM_custom_label_0'].'	'.
					$_F['GM_custom_label_1'].'	'.
					'	'.
					$_F['GM_custom_label_3'].'	'.
					$_F['GM_custom_label_4']."\n";
			}
		}
		
	}
	function saveGridData()
	{
		
		$output['status'] = 'error';
		if(isset($_POST['request']))
		{
			$Data = json_decode($_POST['request'],true);
			$output['status'] = 'success';
			
			
			foreach($Data['changes'] AS $_F)
			{
				
				
				$this->db->QRY("
					UPDATE
						gc_extensions_google_merchant
					SET ".
						(isset($_F['title']) ? "GM_title = '".$this->db->escape($_F['title'])."'," : "").
						(isset($_F['description']) ? "GM_description = '".$this->db->escape($_F['description'])."'," : "").
						(isset($_F['condition']) ? "GM_condition = '".$this->db->escape($_F['condition'])."'," : "").
						(isset($_F['google_product_category']) ? "GM_google_product_category = '".$this->db->escape($_F['google_product_category'])."'," : "").
						(isset($_F['material']) ? "GM_material = '".$this->db->escape($_F['material'])."'," : "").
						(isset($_F['item_group_id']) ? "GM_item_group_id = '".$this->db->escape($_F['item_group_id'])."'," : "").
						(isset($_F['product_type']) ? "GM_product_type = '".$this->db->escape($_F['product_type'])."'," : "").
						(isset($_F['custom_label_0']) ? "GM_custom_label_0 = '".$this->db->escape($_F['custom_label_0'])."'," : "").
						(isset($_F['custom_label_1']) ? "GM_custom_label_1 = '".$this->db->escape($_F['custom_label_1'])."'," : "").
						(isset($_F['custom_label_3']) ? "GM_custom_label_3 = '".$this->db->escape($_F['custom_label_3'])."'," : "").
						(isset($_F['custom_label_4']) ? "GM_custom_label_4 = '".$this->db->escape($_F['custom_label_4'])."'," : "").
						(isset($_F['gtin']) ? "GM_gtin = '".$this->db->escape($_F['gtin'])."'," : "").
						(isset($_F['onOff']) ? "GM_google_merchant_status = '".$this->db->escape($_F['onOff'])."'," : "").
						"Prd_ID = Prd_ID
					WHERE
						Prd_ID = '".$this->db->escape($_F['recid'])."'");
				
			}
			
			
		}
		return $output;
		
	}
	function getGridData()
	{
		
		/*
		
	
		{ field: 'itemName', caption: 'Title on AD', size: '300px', sortable: true, resizable: true,
			editable: { type: 'text' }
		},
		{ field: 'itemDescription', caption: 'Description on AD', size: '300px', sortable: true, resizable: true,
			editable: { type: 'text' }
		},
		{ field: 'condition', caption: 'condition', size: '70px', sortable: true, resizable: true,
			editable: { type: 'text' }
		},
		{ field: 'price', caption: 'price', size: '100px', sortable: true, resizable: true},
		{ field: 'availability', caption: 'availability', size: '100px', sortable: true, resizable: true},
		{ field: 'link', caption: 'Link', size: '200px', sortable: true, resizable: true},
		{ field: 'mpn', caption: 'mpn', size: '100px', sortable: true, resizable: true},
		{ field: 'image_link', caption: 'image_link', size: '200px', sortable: true, resizable: true},
		{ field: 'additional_image_link', caption: 'additional_image_link', size: '150px', sortable: true, resizable: true},
		{ field: 'gtin', caption: 'gtin', size: '100px', sortable: true, resizable: true},
		{ field: 'brand', caption: 'brand', size: '100px', sortable: true, resizable: true},
		{ field: 'google_product_category', caption: 'google_product_category', size: '200px', sortable: true, resizable: true},
		{ field: 'material', caption: 'material', size: '100px', sortable: true, resizable: true},
		{ field: 'item_group_id', caption: 'item_group_id', size: '100px', sortable: true, resizable: true},
		{ field: 'shipping_weight', caption: 'weight', size: '100px', sortable: true, resizable: true},
		{ field: 'sale_price_effective_date', caption: 'sale_price_effective_date', size: '100px', sortable: true, resizable: true},
		{ field: 'product_type', caption: 'product_type', size: '200px', sortable: true, resizable: true},
		{ field: 'custom_label_0', caption: 'custom_label_0', size: '200px', sortable: true, resizable: true},
		{ field: 'custom_label_1', caption: 'custom_label_1', size: '200px', sortable: true, resizable: true},
		{ field: 'custom_label_2', caption: 'custom_label_2', size: '200px', sortable: true, resizable: true},
		{ field: 'custom_label_3', caption: 'custom_label_3', size: '200px', sortable: true, resizable: true},
		{ field: 'custom_label_4', caption: 'custom_label_4', size: '200px', sortable: true, resizable: true},
		
		
					?>
						<tr class="OnAd noSelect" data-prdid="<?php echo $_F['Prd_ID'];?>">
							<td class="CL_Col CL_ADPower"><div class="CL_ADPowerBTN <?php echo ($_F['GM_google_merchant_status'] == 0 ? 'ADOff' : 'ADOn')?>"><i class="fa fa-power-off"></i></div></td>
							<td class="CL_Col CL_ID"><div class="noInput<?php echo ($_F['products_status'] == 0 ? ' disabledItem" data-tooltip="This item is not on sale now.' : '');?>"><?php echo $_F['Prd_ID'];?></div></td>
							<td class="CL_Col CL_Title"><div class="hasInput"><input data-id="GM_title" value="<?php echo htmlspecialchars($_F['GM_title']);?>" /></div></td>
							
							
							<td class="CL_Col CL_Desc"><div class="hasInput"><input data-id="GM_description" value="<?php echo htmlspecialchars($_F['GM_description']);?>" /></div></td>
							<td class="CL_Col CL_CDT"><div class="hasInput"><input data-id="GM_condition" value="<?php echo htmlspecialchars($_F['GM_condition']);?>" /></div></td>
							<td class="CL_Col CL_Price"><div class="noInput">$<?php echo number_format($_F['products_price'],2);?></div></td>
							
							<td class="CL_Col CL_Avl"><div class="noInput<?php echo ($_F['products_quantity'] > 0 ? '' : ' outOfStock ');?>"><?php echo ($_F['products_quantity'] > 0 ? 'in stock' : 'out of stock');?></div></td>
							<td class="CL_Col CL_Link"><div class="noInput"><a href="http://www.janilink.com/product_info.php?products_id=<?php echo $_F['products_id'];?>">http://www.janilink.com/product_info.php?products_id=<?php echo $_F['products_id'];?></a></div></td>
							
							<td class="CL_Col CL_MPN"><div class="noInput"><?php echo htmlspecialchars($_F['products_model']);?></div></td>
							<td class="CL_Col CL_ImgLnk"><div class="noInput"><a href="https://www.janilink.com/img/p/O/<?php echo $_F['products_image'];?>">https://www.janilink.com/img/p/O/<?php echo $_F['products_image'];?></a></div></td>
							<td class="CL_Col CL_ImgLnkAdd"><div class="noInput"></div></td>
							
							<td class="CL_Col CL_GTIN"><div class="hasInput"><input data-id="GM_gtin" value="<?php echo htmlspecialchars($_F['GM_gtin']);?>" /></div></td>
							<td class="CL_Col CL_Brand"><div class="hasInput"><input data-id="GM_brand" value="<?php echo htmlspecialchars($_F['GM_brand']);?>" /></div></td>
							<td class="CL_Col CL_GPCat"><div class="hasInput"><input data-id="GM_google_product_category" value="<?php echo htmlspecialchars($_F['GM_google_product_category']);?>" /></div></td>
							<td class="CL_Col CL_Mat"><div class="hasInput"><input data-id="GM_material" value="<?php echo $_F['GM_material'];?>" /></div></td>
							<td class="CL_Col CL_GID"><div class="hasInput"><input data-id="GM_item_group_id" value="<?php echo $_F['GM_item_group_id'];?>" /></div></td>
							<td class="CL_Col CL_Weight"><div class="noInput"><?php echo $_F['products_weight'];?></div></td>
							<td class="CL_Col CL_AffDate"><div class="hasInput"><input data-id="GM_addfate" value="" /></div></td>
							<td class="CL_Col CL_PType"><div class="hasInput"><input data-id="GM_product_type" value="<?php echo $_F['GM_product_type'];?>" /></div></td>
							<td class="CL_Col CL_Lbl0"><div class="hasInput"><input data-id="GM_custom_label_0" value="<?php echo $_F['GM_custom_label_0'];?>" /></div></td>
							<td class="CL_Col CL_Lbl1"><div class="hasInput"><input data-id="GM_custom_label_1" value="<?php echo $_F['GM_custom_label_1'];?>" /></div></td>
							<td class="CL_Col CL_Lbl2"><div class="noInput"><?php echo $_F['products_model'];?></div></td>
							<td class="CL_Col CL_Lbl3"><div class="hasInput"><input data-id="GM_custom_label_3" value="<?php echo $_F['GM_custom_label_3'];?>" /></div></td>
							<td class="CL_Col CL_Lbl4"><div class="hasInput"><input data-id="GM_custom_label_4" value="<?php echo $_F['GM_custom_label_4'];?>" /></div></td>
						</tr>
					<?
					
		*/
		$Data = $this->getList();
		$Count = 0;
		foreach($Data['OnAD'] AS $_F)
		{
			
			$output[$Count] = array(
				'recid' => $_F['Prd_ID'],
				'onOff' => ($_F['GM_google_merchant_status'] ? true : false),
				'title' => $_F['GM_title'],
				'description' => $_F['GM_description'],
				'condition' => $_F['GM_condition'],
				'price' => number_format(($_F['products_froogle_price'] > 0 ? $_F['products_froogle_price'] : $_F['products_price']),2),
				'availability' => ($_F['products_quantity'] > 0 ? 'in stock' : 'out of stock'),
				'link' => '<a target="_blank" href="http://www.janilink.com/product_info.php?products_id='.$_F['products_id'].'">http://www.janilink.com/product_info.php?products_id='.$_F['products_id'].'</a>',
				'mpn' => $_F['products_model'],
				'image_link' => '<a target="_blank" href="https://www.janilink.com/img/p/O/'.$_F['products_image'].'">https://www.janilink.com/img/p/O/'.$_F['products_image'].'</a>',
				'additional_image_link' => '',
				'gtin' => $_F['GM_gtin'],
				'brand' => $_F['GM_brand'],
				'google_product_category' => $_F['GM_google_product_category'],
				'material' => $_F['GM_material'],
				'item_group_id' => $_F['GM_item_group_id'],
				'shipping_weight' => $_F['products_weight'],
				'sale_price_effective_date' => '',
				'product_type' => $_F['GM_product_type'],
				'custom_label_0' => $_F['GM_custom_label_0'],
				'custom_label_1' => $_F['GM_custom_label_1'],
				'custom_label_2' => '',
				'custom_label_3' => $_F['GM_custom_label_3'],
				'custom_label_4' => $_F['GM_custom_label_4']
				
				
			);
			//'w2ui' => array('style' => 'background-color: fff1f1;')
			
			if($_F['products_status'] == 0)
				$output[$Count]['w2ui'] = array('style' => 'background-color: #ffe1e1;');
			
			$Count++;
			
		}
		
		return $output;
		
	}
	function saveFeed()
	{
		$output['ack'] = 'error';
		
		if(isset($_POST['Data']))
		{
			$output['ack'] = 'success';
			
			$Data = json_decode($_POST['Data'],true);
			
			foreach($Data AS $_K => $_F)
			{
				$this->db->QRY("
					UPDATE
						gc_extensions_google_merchant
					SET
						GM_title = '".$this->db->escape($_F['GM_title'])."',
						GM_description = '".$this->db->escape($_F['GM_description'])."',
						GM_condition = '".$this->db->escape($_F['GM_condition'])."',
						GM_google_product_category = '".$this->db->escape($_F['GM_google_product_category'])."',
						GM_material = '".$this->db->escape($_F['GM_material'])."',
						GM_item_group_id = '".$this->db->escape($_F['GM_item_group_id'])."',
						GM_product_type = '".$this->db->escape($_F['GM_product_type'])."',
						GM_custom_label_0 = '".$this->db->escape($_F['GM_custom_label_0'])."',
						GM_custom_label_1 = '".$this->db->escape($_F['GM_custom_label_1'])."',
						GM_custom_label_3 = '".$this->db->escape($_F['GM_custom_label_3'])."',
						GM_custom_label_4 = '".$this->db->escape($_F['GM_custom_label_4'])."',
						GM_brand = '".$this->db->escape($_F['GM_brand'])."',
						GM_gtin = '".$this->db->escape($_F['GM_gtin'])."',
						GM_google_merchant_status = '".$this->db->escape($_F['GM_google_merchant_status'])."'
					WHERE
						Prd_ID = '".$this->db->escape($_K)."'
				");
			}
			
			
		}
		return $output;
	}
	function getList()
	{
		$this->Old_DB = new $this->db;
		$this->Old_DB->connect(array(
			'DB_Name' => 'janilink_new',
			'DB_Server' => '76.74.252.180',
			'DB_UserName' => 'remote',
			'DB_Password' => 'MJaCall@MQNb^!%'
		));
		
		$Products_Data = $this->Old_DB->QRY("
			SELECT
				*
			FROM
				products P,
				products_description PD
			WHERE
				P.products_id = PD.products_id
			ORDER BY
				PD.products_id DESC
		");
		
		$GM_Data = $this->db->QRY("
			SELECT
				*
			FROM
				gc_extensions_google_merchant
			ORDER BY
				Prd_ID
		");
		
		$tmp['Prd'] = array();
		foreach($Products_Data AS $_F)
		{
			$tmp['Prd'][$_F['products_id']] = $_F;
		}
		
		
		
		foreach($GM_Data AS $_F)
		{
			if(isset($tmp['Prd'][$_F['Prd_ID']]))
			{
				if($tmp['Prd'][$_F['Prd_ID']]['products_status'] == 0 && $_F['GM_google_merchant_status'] == 1)
					$tmp['AdToDeactivate'][] = $_F['Prd_ID'];
					
				$tmp['Prd'][$_F['Prd_ID']] = array_merge($tmp['Prd'][$_F['Prd_ID']], $_F);
			}
			else
				$tmp['AdToDelete'][] = $_F['Prd_ID'];
		}
		
		$output['ListToAdd'] = array();
		foreach($tmp['Prd'] AS $_F)
		{
			if(isset($_F['Prd_ID']))
			{
				$output['OnAD'][] = $_F;
			}
			else
			{
				$output['ListToAdd'][] = $_F;
			}
		}
		
		
		# Add all items not on AD
		foreach($output['ListToAdd'] AS $_F)
		{
			if($_F['products_status'] == 1)
			{
				$this->db->QRY("
					INSERT INTO
						gc_extensions_google_merchant
						(
							Prd_ID,
							GM_title,
							GM_description,
							GM_condition,
							GM_google_product_category,
							GM_material,
							GM_item_group_id,
							GM_product_type,
							GM_custom_label_0,
							GM_custom_label_1,
							GM_custom_label_3,
							GM_custom_label_4,
							GM_brand,
							GM_gtin,
							GM_google_merchant_status
						)
						VALUES
						(
							'".($this->db->escape($_F['products_id']))."',
							'".($this->db->escape(($_F['products_froogle_title'] != "" ? $_F['products_froogle_title'] : $_F['products_name'])))."',
							'".($this->db->escape(($_F['products_froogle_description'] != "" ? $_F['products_froogle_description'] : $_F['products_head_desc_tag'])))."',
							'new',
							'".($this->db->escape($_F['products_google_type']))."',
							NULL,
							NULL,
							'".($this->db->escape($_F['products_google_type']))."',
							'addnewly',
							NULL,
							NULL,
							NULL,
							'Janilink',
							NULL,
							0
						)
				");
			}
		}
		
		if(isset($tmp['AdToDeactivate']))
		{
			
			$this->db->QRY("
				UPDATE
					gc_extensions_google_merchant
				SET
					GM_google_merchant_status = 0
				WHERE
					Prd_ID IN (".implode(',',$tmp['AdToDeactivate']).")
			");
		}
		return $output;
	}
}
?>