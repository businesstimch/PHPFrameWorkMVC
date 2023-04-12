<?

class db extends GGoRok
{
	var $dbCon;
	var $curDB;
	var $insert_QRY;
	function __construct($table = false)
	{
		if(defined('MYSQL_DB_NAME'))
		{
			$this->Connect(array(
				'DB_Server' => MYSQL_DB_SERVER,
				'DB_Name' => MYSQL_DB_NAME,
				'DB_UserName' => MYSQL_DB_SERVER_USERNAME,
				'DB_Password' => MYSQL_DB_SERVER_PASSWORD
			));
		}
		
	}
	
	function Connect($Data)
	{
		
		$this->dbCon = new mysqli($Data['DB_Server'],$Data['DB_UserName'],$Data['DB_Password'], $Data['DB_Name']);
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
	}
	
	function Close()
	{
		mysqli_close($this->dbCon);
	}
	
	function QRY($sql,$return_inserted_id = false, $function = null)
	{
		$output = array();
		//$this->dbCon->query("set session character_set_connection=utf8;");
		//$this->dbCon->query("set session character_set_results=utf8;");
		//$this->dbCon->query("set session character_set_client=utf8;");
		$this->dbCon->set_charset("utf8");
		if($result = $this->dbCon->query($sql))
		{
			
			if(is_object($result))
			{
				while($rst_w = $result->fetch_assoc())		
				{
					$output[] = $rst_w;	
				}
				mysqli_free_result($result);
			}
		}
		else
			echo $function.']'/*.htmlspecialchars($sql)*/.']'.$this->dbCon->error;
		
		
		if($return_inserted_id)
			return $this->dbCon->insert_id;
		else
			return $output;
		
	}
	function QRY2($sql)
	{
		echo $sql;
	}
		
	function SQL($sql)
	{
		echo $sql;
	}
	

	function escape($string)
	{
		
		return mysqli_real_escape_string($this->dbCon,$string);
	}
	function escapeArray($Arr)
	{
		foreach($Arr as $K => $Arr_F)
		{
			$Arr[$K] = $this->escape($Arr_F);
		}
		return $Arr;
	}
	function autoSQL($Config)
	{
		$SQL = "";
		
		if($Config['Type'] == "Insert")
		{
			
			foreach($Config["Allow"] AS $Allow)
			{
				if(isset($Config["Data"][$Allow.$Config["Suffix"]]))
				{
					$Columns[] = $this->escape($Allow);
					$Values[] = '"'.$this->escape($Config["Data"][$Allow.$Config["Suffix"]]).'"';
				}
				
			}
			
			$SQL .= "INSERT INTO ".$Config["Table"]."(".implode(",",$Columns).") VALUES(".implode(",",$Values).")";
			
		}
		else if($Config['Type'] == "Update")
		{
			
			foreach($Config["Allow"] AS $Allow)
			{
				if(isset($Config["Data"][$Allow.$Config["Suffix"]]))
				{
					$Columns[] = $this->escape($Allow). ' = ' . '"'.$this->escape($Config["Data"][$Allow.$Config["Suffix"]]).'"';
					
				}
				
			}
			foreach($Config['Where'] as $W)
			{
				if(isset($Config["Data"][$W.$Config["Suffix"]]))
					$Where[] = $W. ' = "' . $Config["Data"][$W.$Config["Suffix"]].'"';
			}
			
			if(sizeof($Where) > 0)
				$Where = " WHERE ".implode(" AND ",$Where);
			
			$SQL .= "UPDATE ".$Config["Table"]." SET ".implode(",",$Columns).$Where;
			
		}
		
		
		return $SQL;
	}
	
	

}
?>