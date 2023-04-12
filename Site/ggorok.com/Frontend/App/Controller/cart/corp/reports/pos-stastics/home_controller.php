<?php
class CartCorpReportsPOSStasticsHome_Controller extends GGoRok
{
	var $localTime;
	var $Old_DB;
	function __construct()
	{
		$this->localTime = $this->localTime();
		//echo $this->localTime->format('Y-m-d, H:i:s');
		
		$this->mssql->connect(array(
			'DB_Name' => 'JANIRMS2DB',
			'DB_Server' => '24.99.45.248:1433',
			'DB_UserName' => 'sa',
			'DB_Password' => 'janilinkDaniel'
		));
		
		$this->Old_DB = new $this->db;
		$this->Old_DB->connect(array(
			'DB_Name' => 'janilink_new',
			'DB_Server' => '76.74.252.180',
			'DB_UserName' => 'remote',
			'DB_Password' => 'MJaCall@MQNb^!%'
		));
	}
	
	function home()
	{
		
		$Data['title'] = 'Sales Report | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		$Data['CurrentCategory'] = '';
		$minMaxAdWords = $this->db->QRY("
			SELECT
				min(DateOn) as dataFrom, 
				max(DateOn) as dataTo
			FROM
				gc_reports_pos_daily_total
		");
		
		$this->updateDB();
		
		$Data['MAIN_HTML'] = $this->Load->View('cart/corp/reports/pos-stastics/home.tpl', array(
			'dataFrom' => (sizeof($minMaxAdWords) > 0 ? $minMaxAdWords[0]['dataFrom'] : '--'),
			'dataTo' => (sizeof($minMaxAdWords) > 0 ? $minMaxAdWords[0]['dataTo'] : '--'),
			'AtlantaTime' => $this->localTime,
			'TimeNow'=> $this->localTime->format('Y-m-d, H:i:s')
		));
		
		$Home_Controller = $this->Load->Controller('cart/corp/home');
		
		
		echo $Home_Controller->loadHeader($Data);
	
	}
	
	function validateDate($Args)
	{
		$Date = explode('/',$Args);
		if(sizeof($Date) == 3)
		{
			if(
				(is_numeric($Date[0]) &&
				is_numeric($Date[1]) &&
				is_numeric($Date[2]))
			)
			{
				return true;
			}
		}
		
		return false;
	}
	
	public function getChartData()
	{
		$output['ack'] = 'error';
		
		if(isset($_POST['DateFrom']) && isset($_POST['DateTo']) && !isset($Data['DateFrom']) && !isset($Data['DateTo']))
		{
			$Data['DateFrom'] = $_POST['DateFrom'];
			$Data['DateTo'] = $_POST['DateTo'];
		}
		else
		{
			$Data['DateFrom'] = date('Y/m/d');
			$Data['DateTo'] = date('Y/m/d');
		}
		
		
		if($this->validateDate($Data['DateFrom']) && $this->validateDate($Data['DateTo']))
		{
			
			$output['ack'] = 'success';
			
			
			$ChartData = $this->_Model_cart_corp_reports_posstastics->getChartData(array(
				'DateFrom' => $Data['DateFrom'],
				'DateTo' => $Data['DateTo']
			));
			
			
			$output['TotalSales'] = array();
			foreach($ChartData AS $_F)
			{
			
				
				$TimeStamp_Tmp = new DateTime($_F['DateOn'], new DateTimeZone('America/New_York'));
				$TimeStamp = $TimeStamp_Tmp->getTimeStamp() * 1000;
				
			
				if($_F['Type'] == 1)
					$output['TotalSales'][] = array($TimeStamp,floatval($_F['Amount']));
					
				if($_F['Type'] == 2)
					$output['TotalSalesWalkIn'][] = array($TimeStamp,floatval($_F['Amount']));
				
				if($_F['Type'] == 3)
					$output['TotalSalesInt'][] = array($TimeStamp,floatval($_F['Amount']));
			}
			
			$output['TotalSales'] = json_encode($output['TotalSales']);
			$output['TotalSalesWalkIn'] = json_encode($output['TotalSalesWalkIn']);
			$output['TotalSalesInt'] = json_encode($output['TotalSalesInt']);
	
		}
		
		return $output;
	}
	
	public function updateDB()
	{
		$DBrefreshedOn = $this->db->QRY("
			SELECT
				*
			FROM
				gc_reports_pos_refreshed
			WHERE
				RefreshType = 'POSStastics_Sales'
		");
		
		
		$SaleTotalByDate = $this->_Model_cart_corp_reports_posstastics->getTotalSaleByDay(array(
			'RefreshedOn' => $DBrefreshedOn[0]['RefreshedOn']
		));
		
		$SaleTotalByDate_WalkIn = $this->_Model_cart_corp_reports_posstastics->getTotalSaleByDay(array(
			'RefreshedOn' => $DBrefreshedOn[0]['RefreshedOn'],
		),2);
		
		$SaleTotalByDate_Internet = $this->_Model_cart_corp_reports_posstastics->getTotalSaleByDay(array(
			'RefreshedOn' => $DBrefreshedOn[0]['RefreshedOn'],
		),3);
		
		$this->_Model_cart_corp_reports_posstastics->updateStasticsDB($SaleTotalByDate,1);
		$this->_Model_cart_corp_reports_posstastics->updateStasticsDB($SaleTotalByDate_WalkIn,2);
		$this->_Model_cart_corp_reports_posstastics->updateStasticsDB($SaleTotalByDate_Internet,3);
		
	}
	
	private function localTime()
	{
		$LocalNow = new DateTime("now", new DateTimeZone('America/New_York'));
		$LocalNow->setTimestamp(time());
		return $LocalNow;
	}
	
}
?>