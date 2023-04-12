<?
class wwwAroundMe_controller extends GGoRok
{
	
	function home()
	{
		$Data['title'] = '내주변';
		$Data['metaK'] = 'Test';
		$Data['metaD'] = 'Test';
		
		echo $this->Load->View('www/header.tpl',$Data);
		echo $this->Load->View('www/AroundMe.tpl',$Data);
		echo $this->Load->View('www/footer.tpl');
	}
	
	function refreshPage()
	{
		$output['ack'] = 'success';
		$output = $this->getMapResult();
		return $output;
	}
	
	function getMapResult()
	{
		global $db;
		$output['ack'] = 'error';
		$output['ack'] = 'success';
		
		$displayRandom = true;
		$Lat = 37.458000;
		$Lng = 127.000650;
		
		
		
		if(isset($_POST['Lat']) && is_numeric($_POST['Lat']))
		{
			$Lat = $_POST['Lat'];
		}
		
		if(isset($_POST['Lng']) && is_numeric($_POST['Lng']))
		{
			$Lng = $_POST['Lng'];
		}
		
		
		$Lng_Max = $Lng + 0.05;
		$Lat_Max = $Lat + 0.05;
		
		$Lng = $Lng - 0.05;
		$Lat = $Lat - 0.05;
			
		
		if($displayRandom)
		{
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>1,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>1,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>1,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>1,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>1,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>1,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>1,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>1,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>1,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>1,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>1,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>1,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>1,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>1,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>1,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>1,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>2,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>3,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>3,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>3,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>3,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>3,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>3,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>3,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>3,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>3,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>3,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>3,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>3,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>3,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>3,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>3,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>3,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>3,'U'=>'http://www.burugo.com/b/295/choice-cap/');
			$output['Result'][] = array('Lon'=>$this->random_float($Lng,$Lng_Max),'Lat'=>$this->random_float($Lat,$Lat_Max),'T'=>3,'U'=>'http://www.burugo.com/b/140/chung-dam/');
			
		}
		
			
		
		return $output;
	}
	
	function random_float ($min,$max) {
		return round($min + lcg_value()*(abs($max - $min)),6);
	}
}