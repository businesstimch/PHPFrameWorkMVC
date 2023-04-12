<?php
class CartCorpReportsNewOldHome_Controller extends GGoRok
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
				min(Visitor_Date) as dataFrom, 
				DATE_FORMAT(now(),'%Y-%m-%d') as dataTo
			FROM
				gc_reports_pos_daily_visitor
		");
		
		$this->updateDB();
		
	
		
		$Data['MAIN_HTML'] = $this->Load->View('cart/corp/reports/new-old/home.tpl', array(
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
			
			
			$ChartData = $this->_Model_cart_corp_reports_newold->getChartData(array(
				'DateFrom' => $Data['DateFrom'],
				'DateTo' => $Data['DateTo']
			));
			
			
			$output['TotalSales'] = array();
			
			$output['Internet'][0]['name'] = "Internet New";
			//$output['Internet'][1]['name'] = "Internet Old";
			
			$output['Internet'][0]['data'] = array();
			//$output['Internet'][1]['data'] = array();
			
			foreach($ChartData AS $_F)
			{
			
				
				$TimeStamp_Tmp = new DateTime($_F['Visitor_Date'], new DateTimeZone('America/New_York'));
				$TimeStamp = $TimeStamp_Tmp->getTimeStamp() * 1000;
				
			
				$output['InternetNew'][0]['data'][] = array(
					$TimeStamp,floatval($_F['Internet_New'])
				);
				
				$output['InternetOld'][0]['data'][] = array(
					$TimeStamp,floatval($_F['Internet_Old'])
				);
				
				$output['WalkNew'][0]['data'][] = array(
					$TimeStamp,floatval($_F['Walk_New'])
				);
				
				$output['WalkOld'][0]['data'][] = array(
					$TimeStamp,floatval($_F['Walk_Old'])
				);
				
				//$output['Internet'][1]['data'][] = array(
				//	$TimeStamp,floatval($_F['Internet_Old'])
				//);
				
				
			}
		
	
		}
		
		return $output;
	}
	
	public function updateDB()
	{
		$DBrefreshedOn = $this->db->QRY("
			SELECT
				DATE_FORMAT(RefreshedOn, '%Y-%m-%d') AS RefreshedOn
			FROM
				gc_reports_pos_refreshed
			WHERE
				RefreshType = 'NewOldVisitors'
		");
		
		
		$VisitorByDate = $this->_Model_cart_corp_reports_newold->getVisitorByDay(array(
			'RefreshedOn' => $DBrefreshedOn[0]['RefreshedOn']
		));
		
		
		$this->_Model_cart_corp_reports_newold->updateNewOldDB($VisitorByDate);
		$this->db->QRY("UPDATE gc_reports_pos_refreshed SET RefreshedOn = '".$this->localTime->format('Y-m-d, H:i:s')."' WHERE RefreshType = 'NewOldVisitors'");
		
	}
	
	private function localTime()
	{
		$LocalNow = new DateTime("now", new DateTimeZone('America/New_York'));
		$LocalNow->setTimestamp(time());
		return $LocalNow;
	}
	
}

?>