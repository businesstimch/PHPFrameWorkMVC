<?php
class CartCorpSalesOrdersHome_Controller extends GGoRok
{
	var $_isAdminPage = true;
	function home()
	{
		$Data['title'] = 'Orders | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		$Data['MAIN_HTML'] = $this->loadList();
			
		
		$Home_Controller = $this->Load->Controller('cart/corp/home');
		echo $Home_Controller->loadHeader($Data);
	}
	
	function loadList()
	{
		
		if(isset($_POST['Search']))
		{
			$Args['Search'] = $_POST['Search'];
		}
		
		return $this->Load->View('cart/corp/sales/orders/list.tpl', array(
			'Search_Keyword' => (isset($_POST['Search']) ? htmlspecialchars($_POST['Search']) : ""),
			'Page' => (isset($_POST['p']) && is_numeric($_POST['p']) && $_POST['p'] > 0? $_POST['p'] : 1),
			'Order_List' => $this->OrderList()['html']
		));
	}
	
	function deleteOrder()
	{
		$output['ack'] = 'error';
		if(isset($_POST['oID']))
		{
			
			$O = $this->db->QRY("
				SELECT
					Orders_ID
				FROM
					gc_orders
				WHERE
					Store_ID = '".__StoreID__."' AND
					Orders_ID = '".$this->db->escape($_POST['oID'])."'
			");
			
			if(sizeof($O) > 0)
			{
				
				$this->db->QRY("DELETE FROM gc_orders WHERE Orders_ID = '".$this->db->escape($_POST['oID'])."'");
				$this->db->QRY("DELETE FROM gc_orders_Items WHERE Orders_ID = '".$this->db->escape($_POST['oID'])."'");
				$this->db->QRY("DELETE FROM gc_products_images WHERE Prd_ID = '".$this->db->escape($_POST['oID'])."'");
				$this->db->QRY("DELETE FROM gc_orders_status_history WHERE Orders_ID = '".$this->db->escape($_POST['oID'])."'");
				
				$output['Target_PG_Contents'] = $this->OrderList()['html'];
				$output['ack'] = 'success';
			}
			else
			{
				$output['error_msg'] = "This product doesn't exsist or is already deleted.";
			}
		
		}
		return $output;
	}
	
	function OrderList($Args = null)
	{
		$Args['p'] = (isset($Args['p']) ? $Args['p'] : (isset($_POST['p']) && is_numeric($_POST['p']) && $_POST['p'] > 0? $_POST['p'] : 1));
		
		$Select = '';
		$Where = '';
		$OrderBy = '';
		if(isset($Args['Search']))
		{
			
			$Where .= '
				AND
					(
						Orders_ID = "'.$Args['Search'].'" OR
						C.
					)	
			';
		}
		
		$Limit = 20;
		$output['ack'] = 'success';
		$P = $this->db->QRY("
			SELECT
				SQL_CALC_FOUND_ROWS
				O.Orders_ID,
				O.Orders_Grandtotal,
				O.Orders_CreatedOn,
				C.customers_firstname,
				C.customers_lastname,
				(
					SELECT
						S.OStatus_Name
					FROM
						gc_orders_status S,
						gc_orders_status_history SH
					WHERE
						S.OStatus_ID = SH.OStatus_ID AND
						SH.Orders_ID = O.Orders_ID
					ORDER BY
						SH.OSH_ProcessedOn DESC
					LIMIT
						1
				) AS OStatus_Name
				
				".$Select."
			FROM
				gc_orders O
					LEFT JOIN
						gc_customers C
					ON
						C.customers_id = O.customers_id
				,
				gc_orders_status OS
			WHERE
				O.Store_ID = ".__StoreID__." AND
				O.OStatus_ID = OS.OStatus_ID
				".$Where."
			ORDER BY
				".($OrderBy == "" ? ' Orders_ID DESC ' : $OrderBy )."
			LIMIT
				".($Args['p'] * $Limit - $Limit).','.$Limit."
		");
		
		$Total_Rows = $this->db->QRY("SELECT FOUND_ROWS() as Total;");
		$output['html'] = '';
		
		if(sizeof($P) > 0)
		{
			$output['html'] .= '
					<div class="T1_List_One T1_List_Header">
						<div class="List_OrderID T1_List_Col">Order ID</div>
						<div class="List_CustomerName T1_List_Col">Customer Name</div>
						
						<div class="List_OrderTotalPrice T1_List_Col">Total Price</div>
						<div class="List_OrderPlacedOn T1_List_Col">Date</div>
						<div class="List_OrderStatus T1_List_Col">Status</div>
					</div>
			';
			foreach($P AS $P_F)
			{
				$output['html'] .= '
					<div class="T1_List_One T1_List_Contents hand Glow" data-oid="'.$P_F['Orders_ID'].'">
						<div class="List_OrderID T1_List_Col">'.$P_F['Orders_ID'].'</div>
						<div class="List_CustomerName T1_List_Col">'.$P_F['customers_firstname'].' '.$P_F['customers_lastname'].'</div>
						<div class="List_OrderTotalPrice T1_List_Col">$'.$P_F['Orders_Grandtotal'].'</div>
						<div class="List_OrderPlacedOn T1_List_Col">'.$P_F['Orders_CreatedOn'].'</div>
						<div class="List_OrderStatus T1_List_Col">'.$P_F['OStatus_Name'].'</div>
					</div>
				';
			}
		}
		else
		{
			$output['html'] .= 'No Product Found';
		}
		
		if($Total_Rows[0]['Total'] > 0)
		{
			$output['html'] .= '<div class="w100" id="Total_Found">'.($Args['p'] * $Limit - $Limit).' - '.($Args['p'] * $Limit).' of '.$Total_Rows[0]['Total'].' Orders Found</div>';
			
			$PG['Prev'] = false;
			$PG['Next'] = false;
			
			if($Total_Rows[0]['Total'] > ($Args['p'] * $Limit))
			{
				$PG['Next'] = true;
			}
			
			if($Args['p'] > 1)
			{
				$PG['Prev'] = true;
			}
			
			$output['html'] .= '
				<div id="Pagination">
					<div class="Pagi_Btn PagiPrev_Btn'.($PG['Prev'] ? '' : ' PagiDisabled').'"><i class="fa fa-caret-left"></i></div>
					<div class="Pagi_Btn PagiNext_Btn'.($PG['Next'] ? '' : ' PagiDisabled').'" id="Pagi_Next"><i class="fa fa-caret-right"></i></div>
				</div>
			';
				
		}
		
		return $output;
	}
	
	
	
	
}

?>