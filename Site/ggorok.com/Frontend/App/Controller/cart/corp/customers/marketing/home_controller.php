<?php
class CartCorpCustomersMarketingHome_Controller extends GGoRok
{
	var $_isAdminPage = true;
	var $Old_DB;
	var $_ResultPerPG = 1000;
	var $_CurrentPG = 1;

	function __construct()
	{
		$this->Old_DB = new $this->db;
		$this->Old_DB->connect(array(
			'DB_Name' => 'janilink_new',
			'DB_Server' => '76.74.252.180',
			'DB_UserName' => 'remote',
			'DB_Password' => 'MJaCall@MQNb^!%'
		));
		$this->_CurrentPG = (isset($_POST['PG']) && is_numeric($_POST['PG']) && $_POST['PG'] > 0 ? $_POST['PG'] : 1 );
	}
	function home()
	{
			
		$Data['title'] = 'Email Marketing | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		$Data['CurrentCategory'] = '';
		
		
		$Data['MAIN_HTML'] = $this->Load->View('cart/corp/customers/marketing/home.tpl', array(
			'PG' => $this->_CurrentPG
		));
		
		echo $this->loadHeader($Data);
	
	}
	function sendEmailByOrder($Data = null)
	{
		$output['ack'] = 'error';
		
		if(!isset($Data['oID']) && $_POST['oID'])
			$Data['oID'] = $_POST['oID'];
		
		if(is_numeric($_POST['oID']))
		{
			$output['ack'] = 'success';
			$Order = $this->Old_DB->QRY("
				SELECT
					*
				FROM
					orders O
				WHERE
					orders_id = '".$this->db->escape($Data['oID'])."'
			");
			
			if(sizeof($Order))
			{
				$output['ack'] = 'success';
				
			}
			
		}
		
		
		
	}
	function sendEmail($Data = null)
	{
		
		
		if(!isset($Data['Name']) && $_POST['Name'])
			$Data['Name'] = $_POST['Name'];
			
		if(!isset($Data['Name']) && $_POST['Name'])
			$Data['Name'] = $_POST['Name'];
		
		return $output;
	
		$this->mail->sendGMail(array(
			'From' => 'no-reply@janilink.com',
			'FromName' => 'Janitorial Supply Janilink',
			'Password' => 'mccall2016',
			'To' => 'tim@janilink.com',
			'Subject' => $Data['Name'].', we would like to hear from you about your purchase. Review in on Janilink.com',
			'Body_HTML' => $this->Load->View('cart/corp/customers/marketing/email_template_01.tpl', array(
			)),
			'Body_Plain' => 'Test'
		));
	}
	
	function loadList()
	{
		
		$Filter = (isset($_POST['Filter']) && ($_POST['Filter'] == 'Ready' || $_POST['Filter'] == 'Sent') ? $_POST['Filter'] : NULL);
		if(isset($_POST['PG']) && is_numeric($_POST['PG']) && $_POST['PG'] > 0)
		{
			
			$this->_CurrentPG = $_POST['PG'];
		}
		
		
		$From = ($this->_CurrentPG * $this->_ResultPerPG) - $this->_ResultPerPG;
		
		$OrderList = $this->Old_DB->QRY("
			SELECT
				SQL_CALC_FOUND_ROWS
				*,
				datediff(CURDATE(),O.last_modified) AS DateAgo
			FROM
				orders O
					LEFT JOIN
						gc_order_email_marketing OEM
					ON
						OEM.Orders_ID = O.orders_id
					LEFT JOIN
						orders_status OS
					ON
						OS.orders_status_id = O.orders_status
					LEFT JOIN
						customers C
					ON
						C.customers_id = O.customers_id
			WHERE
				O.customers_email_address != '' AND
				".($Filter == 'Ready' ? '( O.orders_status = "3" OR O.orders_status = "4" ) AND review_email_sent = 0 AND' : '')."
				".($Filter == 'Sent' ? '( O.orders_status = "3" OR O.orders_status = "4" ) AND review_email_sent = 1 AND' : '')."
				O.last_modified >= '".$this->db->escape($_POST['OrderFrom'])."' AND
				O.last_modified <= '".$this->db->escape($_POST['OrderTo'])."'
				
			GROUP BY
				O.orders_id
			ORDER BY
				O.last_modified DESC
			LIMIT
				".$From.",".$this->_ResultPerPG."
			
		");
		
		
		$OrderTotal = $this->Old_DB->QRY("SELECT FOUND_ROWS() AS Total;");
		
		$output['ack'] = 'success';
		$output['html'] = $this->Load->View('cart/corp/customers/marketing/list.tpl', array(
			'OrderList' => $OrderList,
			'OrderTotal' => $OrderTotal[0]['Total'],
			'Pagination' => $this->Pagination($this->_CurrentPG, ceil($OrderTotal[0]['Total'] / $this->_ResultPerPG)),
			'Filter' => $Filter
		));
		
		return $output;
		
	}
	
	function Pagination($CurrentPage, $TotalPage)
	{
		$Page = array();
		preg_match('/[0-9]$/',$CurrentPage,$LastDigit);
		
		
		for($i = ($CurrentPage - $LastDigit[0] + 1) ; $i < ($CurrentPage - $LastDigit[0]) + 11 ; $i++)
		{
			if($TotalPage >= $i)
				$Page[$i] = ($CurrentPage ==  $i ? true:false);
		
		}
		
		
		return $Page;
	}
	
	function loadHeader($Data = array())
	{
		
		$AdminMenu = $this->_Model_Admin_Header->getCategory();
		foreach($AdminMenu AS $_K => $_C)
		{
			$AdminMenu[$_K]['isCurrent'] = ($_C['is_DoorMenu'] == 1 && (isset($Data['CurrentCategory']) && $_C['AM_Name'] == $Data['CurrentCategory']) ? TRUE : FALSE);
		}
		$Data['AdminMenu'] = $AdminMenu;
		
		return $this->Load->View('cart/corp/header.tpl',$Data);
	}
	
	
	
	
}


?>