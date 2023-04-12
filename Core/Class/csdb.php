<?php

class csdb extends GGoRok{
	var $dbCon;
	var $curDB;
	var $insert_QRY;
	function __construct()
	{
		if(defined('__CASSANDRA_DB_SERVER__'))
		{
			$cluster = Cassandra::cluster()
							->withCredentials(__CASSANDRA_DB_USERNAME__, __CASSANDRA_DB_PASSWORD__)
							->build();
			$session = $cluster->connect(__CASSANDRA_DB_KEYSPACENAME__);
		}
	}
	
	
	function QRY($sql,$return_inserted_id = false)
	{
		$statement = new Cassandra\SimpleStatement($sql);
		$future = $session->executeAsync($statement);  // fully asynchronous and easy parallel execution
		return($future->get());
	}
	function QRY2($sql)
	{
		echo $sql;
	}
	
	function escape($string)
	{
		return preg_replace("/'/","''",$string);
	}
	function escapeArray($Arr)
	{
		foreach($Arr as $K => $Arr_F)
		{
			$Arr[$K] = $this->escape($Arr_F);
		}
		return $Arr;
	}
}


?>