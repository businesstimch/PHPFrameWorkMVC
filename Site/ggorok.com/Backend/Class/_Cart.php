<?

class _Cart extends GGoRok
{
	
	#We keep cart contents at least 90 days to track customer's trend and behavior.
	var $Cart_Expiration_Days = 3;
	var $ItemsInCart, $ItemsInCart_SQL;
	
	var $_CartInfo = array();
	function __construct()
	{
		//$this->MergeCart();
		$this->cleanExpiredCart();
		# Using 'Session ID value' Or Customer ID.
		$this->ItemsInCart_SQL = "
			SELECT
				C.Prd_ID,
				C.Cart_ID,
				C.Cart_Qty,
				C.Cart_Options,
				P.Prd_Name,
				P.Prd_Price,
				P.Prd_isActive,
				P.Prd_isTaxble,
				P.Prd_Qty,
				P.Prd_SKU,
				P.Prd_RewardPoint,
				C.Cart_UniqueID,
				PI.Img_FileName
			FROM
				gc_cart C,
				gc_products P
					LEFT JOIN
						gc_products_images PI
					ON
						PI.Prd_ID = P.Prd_ID AND
						PI.Img_isDefault = 1
			WHERE
				".($this->login->isLogin()? "C.customers_id = '".$this->login->_customerID."'" : "C.Session_ID = '".$this->db->escape(session_id())."'")." AND
				C.Store_ID = '".__StoreID__."' AND
				C.Prd_ID = P.Prd_ID AND
				P.Prd_isActive = 1
		";
		$this->ItemsInCart = $this->db->QRY($this->ItemsInCart_SQL);
		
	}
	
	function delItem($Argv)
	{
		$output['ack'] = 'error';
		$error_msg = "";
		$Go = true;
		
		if(!is_numeric($Argv['cartID']) || $Argv['cuID'] == "")
		{
			$error_msg .= "- There was an error please try again.\n";
			$Go = false;
		}
		
		if($Go)
		{
			$output['ack'] = 'success';
			$this->db->QRY("
				DELETE FROM
					gc_cart
				WHERE
					Cart_ID = '".$this->db->escape($Argv['cartID'])."' AND
					Cart_UniqueID = '".$this->db->escape($Argv['cuID'])."'
			");
		}
		else
			$output['error_msg'] = $error_msg;
		
		return $output;
	}
	
	function modItem($Argv)
	{
		$output['ack'] = 'error';
		$error_msg = "";
		$Go = true;
		
		if(!is_numeric($Argv['Qty']) || $Argv['Qty'] < 1)
		{
			$error_msg .= "- Quantity is required.\n";
			$Go = false;
		}
		
		if(!is_numeric($Argv['cartID']) || $Argv['cuID'] == "")
		{
			$error_msg .= "- There was an error please try again.\n";
			$Go = false;
		}
		
		if($Go)
		{
			$output['ack'] = 'success';
			$this->db->QRY("
				UPDATE
					gc_cart
				SET
					Cart_Qty = '".$this->db->escape($Argv['Qty'])."'
				WHERE
					Cart_ID = '".$this->db->escape($Argv['cartID'])."' AND
					Cart_UniqueID = '".$this->db->escape($Argv['cuID'])."'
			");
		}
		else
			$output['error_msg'] = $error_msg;
		
		return $output;
	}
	
	function addItem($Argv)
	{

		$output['ack'] = 'error';
		$Go = true;
		if(!is_numeric($Argv['Cart_Qty']))
		{
			$error_msg .= "- Quantity is required.\n";
			$Go = false;
		}
		
		if(!is_numeric($Argv['Prd_ID']))
		{
			$error_msg .= "- Please check the product and try again.\n";
			$Go = false;
		}
		if(!isJson($Argv['Cart_Options']))
		{
			$error_msg .= "- There was an error please try again.\n";
			$Go = false;
		}
		
		
		if($Go)
		{
			$output['ack'] = 'error';
			
			$ItemsInCart = $this->getItem($Argv);
			$alreadyExisted = false; # That means the item will be added in next Foreach clause.
			
			$Argv['Cart_Qty'] = round($Argv['Cart_Qty'] < 1 ? 1 : $Argv['Cart_Qty']);
			$Argv['Cart_Options'] = json_decode($Argv['Cart_Options'],TRUE);
			
			# Sanitize Options : SQL Injection
			foreach($Argv['Cart_Options'] as $K => $K_F)
			{
				$Argv['Cart_Options'][$K] = $this->db->escape($K_F);
			}
			
			
			# Make loop in existing items in DB first, in case the item is already existed then just add quantity.
			foreach($ItemsInCart as $ItemsInCart_F)
			{
				# Same Prd_ID and Same Option ?
				//echo $ItemsInCart_F['Prd_ID'].$Argv['Prd_ID'];
				//echo print_r(json_decode($ItemsInCart_F['Cart_Options'],TRUE));
				//echo print_r($Argv['Cart_Options']);
				
				$ItemsInCart_F_Temp['Cart_Options'] = json_decode($ItemsInCart_F['Cart_Options'],TRUE);
				$Opt_Diff = array_merge(array_diff($ItemsInCart_F_Temp['Cart_Options'],$Argv['Cart_Options']) , array_diff($Argv['Cart_Options'],$ItemsInCart_F_Temp['Cart_Options']));
				
				if($ItemsInCart_F['Prd_ID'] == $Argv['Prd_ID'] && sizeof($Opt_Diff) == 0)
				{
					$this->db->QRY("
						UPDATE
							gc_cart
						SET
							Cart_Qty = Cart_Qty + ".$Argv['Cart_Qty'].",
							Cart_ExpiredOn = DATE_ADD(NOW(), INTERVAL ".$this->Cart_Expiration_Days." DAY)
						WHERE
							Cart_ID = '".$ItemsInCart_F['Cart_ID']."'
					");
					$alreadyExisted = true;
					$output['ack'] = 'success';
				}
				/*
				$Argv['pID'] = $_POST['pID'];
				$Argv['Qty'] = $_POST['Qty'];
				$Argv['Opt'] = $_POST['Opt'];
				*/
			}
				
			# If it is new item going to be added into cart.
			if(!$alreadyExisted)
			{
				$output['ack'] = 'success';
				$this->db->QRY("
					INSERT INTO
						gc_cart
						(
							".(!$this->login->isLogin()? "Session_ID," : "")."
							Cart_ExpiredOn,
							".($this->login->isLogin()? "customers_id," : "")."
							Store_ID,
							Cart_AddedOn,
							Cart_Options,
							Cart_Qty,
							Prd_ID,
							Cart_UniqueID
						)
						VALUES
						(
							".(!$this->login->isLogin()? "'".$this->db->escape(session_id())."'," : "")."
							DATE_ADD(NOW(), INTERVAL ".$this->Cart_Expiration_Days." DAY),
							".($this->login->isLogin()? "'".$this->login->_customerID."'," : "")."
							'".__StoreID__."',
							NOW(),
							'".$this->db->escape(json_encode($Argv['Cart_Options']))."',
							'".$this->db->escape($Argv['Cart_Qty'])."',
							'".$this->db->escape($Argv['Prd_ID'])."',
							'".md5(rand(9999,999999))."'
						)
				");
			}
			
			
			$output = array_merge($output,$this->getInfo());
			
			if($output['ack'] == 'success')
			{
				$output['html'] = '
					<div id="CartAdded_Block">
						<div class="Cart_TopMsg">Item(s) in your cart</div>
						<div class="Cart_TopMsg_Sub">Thank you for your business. Contact us if you have any questions at 888-234-2255.</div>
				';
				if(sizeof($output['Cart_Items']) > 0)
				{
					$output['html'] .= '
						<div class="Cart_Items">
					';
					
					foreach($output['Cart_Items'] as $Cart_Items_F)
					{
						$output['html'] .= '
							<div class="CI_One'.($Argv['Prd_ID'] == $Cart_Items_F['Prd_ID'] ? " CI_One_Current":"").'" data-cartid="'.$Cart_Items_F['Cart_ID'].'" data-cartuid="'.$Cart_Items_F['Cart_UniqueID'].'">
								<div class="CI_PImg">'.($Cart_Items_F['Img_FileName'] != "" ? '<img src="/Template/Upload/'.__StoreID__.'/Products/'.$Cart_Items_F['Prd_ID'].'/SC_Thumb/'.$Cart_Items_F['Img_FileName'].'" />' : "<span>No Img</span>").'</div>
								<div class="CI_Name">'.$Cart_Items_F['Prd_Name'].'</div>
								<div class="CI_Qty">x <span>'.$Cart_Items_F['Cart_Qty'].'</span></div>
								<div class="CI_Menu">
									<div class="CI_Menu_One CI_Delete_Btn" data-type="popup"><i class="fa fa-scissors"></i></div>
								</div>
								
							</div>	
						';
					}
					$output['html'] .= '
						</div>
						<div class="PCart_Buttons">
							<a href="/checkout/process/" class="block PCart_Button PCart_ChkoutBtn">Checkout</a>
							<a href="/checkout/cart/" class="block PCart_Button PCart_Cart">Cart Page</a>
						</div>
					';
					
				}
				$output['html'] .= '
					</div>
				';
			}
			else
				$output['error_msg'] = 'There was a problem while adding product into cart.';
		}
		
		return $output;
	}
	
	function getInfo()
	{
		$output['Cart_Sub_Total'] = 0;
		$output['Cart_Sub_Total_wTax'] = 0;
		$output['Cart_Qty'] = 0;
		
		$this->ItemsInCart = $this->db->QRY($this->ItemsInCart_SQL);
		if(sizeof($this->ItemsInCart) > 0)
		{
			
			$output['Cart_Items'] = $this->ItemsInCart;
			$output['Cart_Opt'] = array();
			foreach($this->ItemsInCart as $ItemInCart_F)
			{
				
				# Has option?
				if(sizeof(json_decode($ItemInCart_F['Cart_Options'],TRUE)) > 0)
				{
					
					$output['Cart_Opt'][$ItemInCart_F['Cart_ID']] = $this->db->QRY("
						SELECT
							*
						FROM
							gc_products_option_group_item
						WHERE
							Opt_isActive = 1 AND
							Opt_ID IN (".implode(',',json_decode($ItemInCart_F['Cart_Options'],TRUE)).")
						ORDER BY
							Opt_ID ASC
					");
				}
				
				//$output['Cart_Items'][$pID]['P_Name'] = 
				
				$output['Cart_Qty'] = $ItemInCart_F['Cart_Qty'] + $output['Cart_Qty'];
				$Option_TotalAmount = 0; # Init option total amount
				
				# If option does exist.
				if(sizeof($output['Cart_Opt']) > 0)
				{
					
					foreach($output['Cart_Opt'] as $Opt_F)
					{
						foreach($Opt_F AS $Opt_F_2)
						{
							
							if($Opt_F_2['Opt_Operand'] == '+')
								$Option_TotalAmount = $Option_TotalAmount + $Opt_F_2['Opt_Price'];
							else
								$Option_TotalAmount = $Option_TotalAmount - $Opt_F_2['Opt_Price'];
								
						}
					}
					//echo $Option_PriceAmount_Temp;
				}
				
				
				$Indi_SubTotal_Tmp = (($ItemInCart_F['Prd_Price'] + $Option_TotalAmount) * $ItemInCart_F['Cart_Qty']) + $output['Cart_Sub_Total'];
				
				$output['Cart_Sub_Total'] = number_format($Indi_SubTotal_Tmp,2,'.','');
				$output['Tax'] = number_format(($this->_Setting->Data['General']['SalesTax'] > 0 ? $Indi_SubTotal_Tmp * ($this->_Setting->Data['General']['SalesTax'] *  0.01) : 0),2,'.','');
				$output['Cart_Sub_Total_wTax'] = number_format(($this->_Setting->Data['General']['SalesTax'] > 0 ? $output['Tax'] : 0) + $Indi_SubTotal_Tmp,2,'.','');
				
			}
		}
		
		$this->_CartInfo['Cart_Sub_Total'] = $output['Cart_Sub_Total'];
		$this->_CartInfo['Cart_Sub_Total_wTax'] = $output['Cart_Sub_Total_wTax'];
		$this->_CartInfo['Cart_Qty'] = $output['Cart_Qty'];
		
		return $output;
	}
	
	function removeItem()
	{
		
	}
	function changeQtyItem()
	{
		
	}
	
	
	
	# Perform When Only Logged IN : We need to merge between 2 carts, made Before and After Login.
	function MergeCart()
	{
		
		if($this->login->isLogin())
		{
			$CartFound = $this->db->QRY("
				SELECT
					Session_ID,
					Data
				FROM
					gc_cart
				WHERE
					( Session_ID = '".$this->db->escape(session_id())."' OR customers_id = '".$this->login->_customerID."' ) AND
					Store_ID = '".__StoreID__."'
			");
			
			# Perform Merging
			if(sizeof($CartFound) > 1)
			{
				foreach($CartFound as $CartFound_F)
				{
					/*
					foreach($CartFound_F['Data'] as $CartFound_F_F)
					{
						//$CartFound_F_F['']
						//$DataMerged
					}
					*/
				}
				
			}
		}
		
	}
	function emptyCart()
	{
		$this->db->QRY("
			DELETE FROM
				gc_cart
			WHERE
				( Session_ID = '".$this->db->escape(session_id())."' OR customers_id = '".$this->login->_customerID."' ) AND
				Store_ID = '".__StoreID__."'
		");
	}
	function cleanExpiredCart()
	{
		
		
		#Delete expired cart contents to save DB storage.
		$this->db->QRY("
			DELETE FROM
				gc_cart
			WHERE
				Cart_ExpiredOn  < now()
		");
	}
	function getItem($Argv = null)
	{
		
		return $this->ItemsInCart;
	}
	
}
?>