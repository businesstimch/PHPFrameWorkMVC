<?
class _Order extends GGoRok
{
	function get_pendingOrder($Owner_customerID,$timestamp_Later = false)
	{
		
		$LastPending = $this->db->QRY("
			SELECT
				oh.order_id
			FROM
				b_burugo_stores s,
				b_burugo_order o,
				b_burugo_order_status_history oh
			WHERE
				oh.order_status_type_id = 1 AND
				o.order_store_id = s.store_id AND
				s.customers_id = '".$this->db->escape($Owner_customerID)."' AND
				".($timestamp_Later != false? "UNIX_TIMESTAMP(time_stamp) >= ".$timestamp_Later." AND" : "" )."
				o.order_id = oh.order_id
				
			ORDER BY
				oh.order_status_datetime DESC
			
			
		");
		return $LastPending;
		
	}
	
	
	function get_AllOrder($Owner_customerID, $limit = null, $onlyPending = false, $pg=1)
	{
		
		
		$order['order'] = $this->db->QRY("
			SELECT
				o.order_id,
				o.order_store_id,
				o.customers_id,
				o.order_type_id,
				o.customer_first_name,
				o.customer_last_name,
				o.customer_paid_total,
				o.order_date,
				o.order_memo,
				o.order_type_id,
				o.contact_phone,
				DATE_FORMAT(od.delivery_time,'%b/%d/%y %H:%i') as delivery_time,
				DATE_FORMAT(ors.reservation_time,'%b/%d/%y %H:%i') as reserv_time,
				ors.reservation_time,
				DATE_FORMAT(op.pickup_time,'%b/%d/%y %H:%i') as pickup_time,
				DATE_FORMAT(o.order_date,'%b/%d/%y %H:%i') as order_date
			FROM
				b_burugo_order o
					LEFT JOIN
						b_burugo_order_type ot
					ON
						ot.order_type_id = o.order_type_id
					LEFT JOIN
						b_burugo_order_reservation ors
					ON
						ors.order_id = o.order_id
					LEFT JOIN
						b_burugo_order_pickup op
					ON
						op.order_id = o.order_id
					LEFT JOIN
						b_burugo_order_delivery od
					ON
						od.order_id = o.order_id
						
			WHERE
				o.order_store_id in
				(
					SELECT
						store_id
					FROM
						b_burugo_stores
					WHERE
						customers_id = '".$this->db->escape($Owner_customerID)."'
				)
				
			
			ORDER BY
				o.order_date DESC "
			.( is_null($limit) ? ""
				: " LIMIT ".($pg-1)*$limit.", ".$limit." "
			)."
		");
		
		
		return $order;
	}
//.(!is_null($limit)?" LIMIT $limit":"")."
	
	
	function get_OrderToDrawChart($Owner_customerID)
	{
		
		
		$order = $this->db->QRY("
			SELECT
				UNIX_TIMESTAMP(cart_added)*1000 AS timestamp,
				item_price AS price
			FROM
				b_burugo_customers_cart
			WHERE
				customers_id = '".$this->db->escape($Owner_customerID)."'
		");
		
		return json_encode($order);
	}
	
	
	function get_StatusTXT($statusID)
	{
		$status ='';
		$lang = $this->language->loadLanguage('order');
		
		if($statusID == 1)
		{
			$status['txt'] = $lang[_lang_]['order_status_1'];
			$status['txt_desc'] = $lang[_lang_]['order_status_desc_1'];
		}	
		else if($statusID == 2)
		{
			$status['txt'] = $lang[_lang_]['order_status_2'];
			$status['txt_desc'] = $lang[_lang_]['order_status_desc_2'];
		}
		else if($statusID == 3)
		{
			$status['txt'] = $lang[_lang_]['order_status_3'];
			$status['txt_desc'] = $lang[_lang_]['order_status_desc_3'];
		}
		else if($statusID == 4)
		{
			$status['txt'] = $lang[_lang_]['order_status_4'];
			$status['txt_desc'] = $lang[_lang_]['order_status_desc_4'];
		}
		else if($statusID == 5)
		{
			$status['txt'] = $lang[_lang_]['order_status_5'];
			$status['txt_desc'] = $lang[_lang_]['order_status_desc_5'];
		}
		else if($statusID == 6)
		{
			$status['txt'] = $lang[_lang_]['order_status_6'];
			$status['txt_desc'] = $lang[_lang_]['order_status_desc_6'];
		}
		else if($statusID == 7)
		{
			$status['txt'] = $lang[_lang_]['order_status_7'];
			$status['txt_desc'] = $lang[_lang_]['order_status_desc_7'];
		}
		else if($statusID == 8)
		{
			$status['txt'] = $lang[_lang_]['order_status_8'];
			$status['txt_desc'] = $lang[_lang_]['order_status_desc_8'];
		}
		
		return $status;
	}
	function get_Order_Status_History($orderID)
	{
		
		$history = $this->db->QRY("
			SELECT
				oh.order_status_history_id,
				oh.order_id,
				oh.order_status_type_id,
				DATE_FORMAT(oh.order_status_datetime,'%b/%d/%y %H:%i') as order_status_datetime,
				oh.memo,
				oh.updated_id
			FROM
				b_burugo_order_status_history oh
				
			WHERE
				oh.order_id = '".($this->db->escape($orderID))."'
			ORDER BY
				oh.order_status_datetime DESC
		");
		
		return $history;
		
	}
	
	
	/* order history in customers,
		need to add order by, sort by, search */
	function get_Orders($customerID, $orderBy='order_date', $pg=1, $limit=20, $onlyPending=false)
	{
		
		
		$order['order'] = $this->db->QRY("
								
			SELECT
				o.order_id,
				o.order_store_id,
				o.customers_id,
				o.order_type_id,
				o.customer_first_name,
				o.customer_last_name,
				o.customer_paid_total,
				o.order_date,
				o.order_memo,
				o.order_type_id,
				o.contact_phone,
				DATE_FORMAT(od.delivery_time,'%b/%d/%y %H:%i') as delivery_time,
				DATE_FORMAT(ors.reservation_time,'%b/%d/%y %H:%i') as reserv_time,
				st.store_name,
				DATE_FORMAT(op.pickup_time,'%b/%d/%y %H:%i') as pickup_time,
				DATE_FORMAT(o.order_date,'%b/%d/%y %H:%i') as order_date
			FROM
				b_burugo_order o
				    LEFT JOIN
					    b_burugo_stores st
				    ON
					    st.store_id = o.order_store_id
					LEFT JOIN
						b_burugo_order_type ot
					ON
						ot.order_type_id = o.order_type_id
					LEFT JOIN
						b_burugo_order_reservation ors
					ON
						ors.order_id = o.order_id
					LEFT JOIN
						b_burugo_order_pickup op
					ON
						op.order_id = o.order_id
					LEFT JOIN
						b_burugo_order_delivery od
					ON
						od.order_id = o.order_id
						

		    WHERE
				o.customers_id = '".$this->db->escape($customerID)."'
				
			
			ORDER BY
				o.".$orderBy." DESC
				
				LIMIT ".($pg-1)*$limit.", ".$limit."
		");
		
		
		return $order;
	}
	
	
	/* order history in customers,
		need to add order by, sort by, search */
	function count_Orders($customerID, $orderBy='order_date', $onlyPending=false)
	{
		
		
		$order = $this->db->QRY("
			SELECT
				count(*) as count
			FROM
				b_burugo_order o
				    LEFT JOIN
					    b_burugo_stores st
				    ON
					    st.store_id = o.order_store_id
					LEFT JOIN
						b_burugo_order_type ot
					ON
						ot.order_type_id = o.order_type_id
					LEFT JOIN
						b_burugo_order_reservation ors
					ON
						ors.order_id = o.order_id
					LEFT JOIN
						b_burugo_order_pickup op
					ON
						op.order_id = o.order_id
					LEFT JOIN
						b_burugo_order_delivery od
					ON
						od.order_id = o.order_id
						

		    WHERE
				o.customers_id = '".$this->db->escape($customerID)."'
				
		");
		
		return $order;
	}
	
	
	function get_Order($orderID)
	{
		
		
		$order['order'] = $this->db->QRY("
			SELECT
				o.order_id,
				o.order_store_id,
				o.customers_id,
				o.order_type_id,
				o.customer_first_name,
				o.customer_last_name,
				o.customer_paid_total,
				o.order_date,
				o.order_memo,
				o.order_type_id,
				o.contact_phone,
				DATE_FORMAT(od.delivery_time,'%b/%d/%y %H:%i') as delivery_time,
				DATE_FORMAT(ors.reservation_time,'%b/%d/%y %H:%i') as reserv_time,
				st.store_name,
				DATE_FORMAT(op.pickup_time,'%b/%d/%y %H:%i') as pickup_time,
				DATE_FORMAT(o.order_date,'%b/%d/%y %H:%i') as order_date
			FROM
				b_burugo_order o
				    LEFT JOIN
					    b_burugo_stores st
				    ON
					    st.store_id = o.order_store_id
					LEFT JOIN
						b_burugo_order_type ot
					ON
						ot.order_type_id = o.order_type_id
					LEFT JOIN
						b_burugo_order_reservation ors
					ON
						ors.order_id = o.order_id
					LEFT JOIN
						b_burugo_order_pickup op
					ON
						op.order_id = o.order_id
					LEFT JOIN
						b_burugo_order_delivery od
					ON
						od.order_id = o.order_id
						

		    WHERE
				o.order_id = '".$this->db->escape($orderID)."'
				
		");
		
		
		return $order['order'][0];
	}
	
	function get_Order_Items($orderID)
	{
		
		
		$order_item_list = $this->db->QRY("
			SELECT
				order_item_id,
				order_id,
				customers_id,
				item_id,
				item_name,
				item_qty,
				item_price_each,
				item_tax
				
			FROM
				b_burugo_order_item
		    WHERE
				order_id = '".$this->db->escape($orderID)."'
				
			ORDER BY item_name 
				
		");
		
		return $order_item_list;
	}
	function get_Order_Summary($customerID)
	{
		
		
		$orderList = $this->db->QRY("
			SELECT
				UNIX_TIMESTAMP(b_burugo_order.order_date)*1000 AS timestamp,
				SUM(b_burugo_order.order_price_total) AS price,
				DATE(b_burugo_order.order_date) AS dateonly
			FROM
				b_burugo_order
			INNER JOIN
				b_burugo_stores
			ON
				b_burugo_order.order_store_id = b_burugo_stores.store_id
			INNER JOIN
				b_burugo_order_status_history
			ON
				b_burugo_order.order_id = b_burugo_order_status_history.order_id
			WHERE
				b_burugo_order.customers_id = '".$this->db->escape($customerID)."' AND
				b_burugo_order.order_type_id != 1 AND
				b_burugo_order_status_history.order_status_type_id = 7
			GROUP BY
				DATE (dateonly)
		");
				
		return $orderList;				
	}
	
	function get_Order_Status_List()
	{
		
		$order_Status_List = $this->db->QRY("
			SELECT
				order_status_id,
				order_status_name,
				order_type_id
			FROM
				b_burugo_order_status
			ORDER BY
				order_status_id
		");
		
		return $order_Status_List;
		
	}
	
	function update_Order_Status($orderID, $status, $updatedby, $memo=null)
	{
		
		
		$ret_order = $this->db->QRY("
			INSERT INTO
				b_burugo_order_status_history
				(
					order_id,
					order_status_type_id,
					order_status_datetime,
					updated_id
				)
			VALUES
				(
					'".$this->db->escape($orderID)."',
					'".$this->db->escape($status)."',
					now(), 
					'".$this->db->escape($updatedby)."' 
				)
		");
		return $ret_order;
	}
	
	function get_Timezone_by_OrderID($order_id, $customTimeStamp = null)
	{
		
		
		$storeTZ = $this->db->QRY("
			SELECT
				store_timezone
			FROM b_burugo_stores
			WHERE
				store_id =
				( SELECT order_store_id FROM b_burugo_order
					WHERE order_id = ".$this->db->escape($order_id)." )
		");
		
		$date = new DateTime();
		if(!is_null($customTimeStamp))
			$date->setTimestamp($customTimeStamp);
		
		$date->setTimezone(new DateTimeZone($storeTZ));
		return $date;
	
	}
	
}
?>