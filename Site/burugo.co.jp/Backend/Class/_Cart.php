<?
class _Cart
{

	function __construct()
	{
		
	}
	
	
	function insertItems_inCart($itemDATA)
	{
		global $db, $login;
		$output['ack'] = 'error';
		
		$ExistID = $this->findItem_IF_Exsist($itemDATA);
		if($ExistID == -1)
		{
			$Item = $db->QRY("
				SELECT			 
					i.item_name,
					i.item_price,
					i.item_texable,
					s.store_item_tax
				FROM
					b_burugo_store_item i,
					b_burugo_store_item_group ig,
					b_burugo_stores s
				WHERE
					i.item_id = '".$itemDATA['ItemID']."' AND
					ig.group_id = i.group_id AND
					s.store_id = ig.store_id
			");
			
			if(sizeof($Item) > 0)
			{
				$db->QRY("
					INSERT INTO
						b_burugo_customers_cart
						(
							customers_id,
							store_id,
							item_id,
							item_price,
							item_qty,
							item_name,
							item_tax,
							cart_added
						)
					VALUES
						(
							'".$db->escape($login->_customerID)."',
							'".$db->escape($itemDATA['storeID'])."',
							'".$db->escape($itemDATA['ItemID'])."',
							'".$db->escape($Item[0]['item_price'])."',
							'".$db->escape($itemDATA['ItemQTY'])."',
							'".$db->escape($Item[0]['item_name'])."',
							'".$db->escape(($Item[0]['item_texable'] == 1? $Item[0]['store_item_tax'] : 0))."',
							now()
						)
					
				");
			}
			else
			{
				$output['ack'] = 'error';
				$output['error_msg'] = 'Item is not exsisting.';
			}
		}
		else
			$db->QRY("
				UPDATE
					b_burugo_customers_cart
				SET
					item_qty = ".$itemDATA['ItemQTY']." + item_qty
				WHERE
					item_id = ".$itemDATA['ItemID']." AND
					customers_id = '".$db->escape($login->_customerID)."'
			");
		
		$output['html'] = $this->getItems_inCart_HTML_Style1();
		$output['ack'] = 'success';
		return $output;
	}
	
	function findItem_IF_Exsist($itemDATA)
	{
		global $db,$login;
		$exist = $db->QRY("
			SELECT
				cart_item_id
			FROM
				b_burugo_customers_cart
			WHERE
				item_id = '".$db->escape($itemDATA['ItemID'])."' AND
				customers_id = '".$db->escape($login->_customerID)."'
		");
		return (sizeof($exist) > 0 ? $exist[0]['cart_item_id'] : -1);
	}
	
	function deleteItems_inCart($itemArrayID_inCart)
	{
		global $db, $login;
		$where = '';
		if(is_array($itemArrayID_inCart))
			$where .= ' cart_item_id in ('.explode(',',$itemArrayID_inCart).') ';
		else if(is_numeric($itemArrayID_inCart))
			$where .= ' cart_item_id = "'.$db->escape($itemArrayID_inCart).'" ';
		else
		{
			$output['ack'] = 'error';
			return $output;
		}	
			
		$db->QRY("
			DELETE FROM
				b_burugo_customers_cart
			WHERE
				".$where."
		");
		$output['ack'] = 'success';
		$output['html'] = $this->getItems_inCart_HTML_Style1();
		return $output;
		
	}
	
	function getItems_inCart($StoreID = null)
	{
		global $db,$login;
		
		$output['ack'] = 'success';
		$texableGood = false;
		$Items = $db->QRY("
			SELECT
				c.store_id,
				c.cart_item_id,
				c.item_id,
				c.item_price,
				c.item_qty,
				c.item_name,
				c.item_tax,
				s.store_name,
				s.store_item_tax
			FROM
				b_burugo_customers_cart c
					LEFT JOIN
						b_burugo_stores s
					ON
						s.store_id = c.store_id
			WHERE
				c.customers_id = '".$db->escape($login->_customerID)."' AND
				c.store_id = '".$db->escape($StoreID)."'
			ORDER BY
				c.store_id DESC ,c.cart_added ASC
		");
				
		return $Items;
		
	}
	
	function getItems_inCart_HTML_Style1()
	{
		
		
		$cartItem = $this->getItems_inCart($_POST['storeID']);
		$Total['Sub_Total'] = 0;
		$Total['Tax'] = 0;
		$Total['Grand_Total'] = 0;
		$StoreID_Current = null;
		$HTML_Zigzag = true;
		$HTML = '';
		
		
		if(sizeof($cartItem) == 0)
			$HTML .= '<div class="noItems_cart">No item in cart</div>';
		else
		{
			foreach($cartItem as $I_F)
			{
				if($I_F['store_id'] != $StoreID_Current)
				{
					$HTML .= '<div class="Cart_StoreName"><span>'.strip_tags($I_F['store_name']).'</span></div>';
					$StoreID_Current = $I_F['store_id'];
				}
				
				$Total['Sub_Total'] = number_format($Total['Sub_Total'] + ($I_F['item_price'] * $I_F['item_qty']),2);
				
				$tax_amount_tmp = 0.00;
				
				if($I_F['item_tax'] > 0)
					$tax_amount_tmp = $I_F['item_price'] * ($I_F['item_tax']/100);
					
				$Total['Tax'] = number_format(($tax_amount_tmp+$Total['Tax']) * $I_F['item_qty'],2);
					
				$Total['Grand_Total'] = number_format($Total['Grand_Total'] + (($I_F['item_price'] + $tax_amount_tmp) * $I_F['item_qty']),2);
				
				
				$HTML .= '<div id="CartItemID_'.$I_F['cart_item_id'].'" class="oneCartItem '.($HTML_Zigzag ? 'oneCartItem_Style1':'oneCartItem_Style2').'">';
				$HTML .= 	'<div class="oneCartItem_Col1">';
				$HTML .= 		'<div class="Cart_ItemName">'.$I_F['item_name'].'</div>';
				$HTML .= 		'<div class="Cart_DeleteItem_BTN">Delete</div>';
				$HTML .= 		'<div class="Cart_ItemPrice"><span class="Cart_ItemPrice_Num">$'.$I_F['item_price'].'</span></div>';
				$HTML .= 	'</div>';
				$HTML .= 	'<div class="oneCartItem_Col2">'.$I_F['item_qty'].'</div>';
				$HTML .= '</div>';
				
				if($HTML_Zigzag)
					$HTML_Zigzag = false;
				else
					$HTML_Zigzag = true;
			}
			
			$HTML .= '
			<div id="cart_subtotal">
				<div class="cart_subtotal_one">
					<div class="cart_col1">Subtotal</div>
					<div class="cart_col2">:</div>
					<div class="cart_col2">$<span id="cart_subtotal_num">'.$Total['Sub_Total'].'</span></div>
				</div>
				
				
				<div class="cart_subtotal_one">
					<div class="cart_col1">Tax</div>
					<div class="cart_col2">:</div>
					<div class="cart_col2">$<span id="cart_tax_num">'.$Total['Tax'].'</span></div>
				</div>
				<div class="w100" style="font-weight:normal;font-size:12px;color:gray;margin-bottom:5px;">
					<span style="margin-left:7px;">(Delivery fee is not applied)</span>
				</div>
			</div>
			<div id="cart_total">
				<div class="cart_col1">Total</div>
				<div class="cart_col2">:</div>
				<div class="cart_col2">$<span id="cart_total_num">'.$Total['Grand_Total'].'</span></div>
				
			</div>
			';
		}
		
		return $HTML;
	
		
	}
	
	
	function emptyCart($customerID, $storeID)
	{
		global $db, $login;
		
		$output['ack'] = 'error';
			
		if($customerID > 0 && $storeID > 0)
		{
			$db->QRY("
				DELETE FROM
					b_burugo_customers_cart
				WHERE
					customers_id = ".$db->escape($customerID)."
				AND store_id = ".$db->escape($storeID).";
			");
			$output['ack'] = 'success';
		}
		else
		{
			
		}
		
		return $output;
		
	}
	
	
}
?>