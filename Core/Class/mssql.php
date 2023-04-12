<?

class mssql extends GGoRok
{
	var $conn;
	private $_Server;
	private $_ID;
	private $_PS;
	private $_DriverType = 'sqlsrv';

	public function QRY($QRY)
	{
		return ($this->_DriverType == 'sqlsrv' ? $this->dataFactory(sqlsrv_query($this->conn,$QRY)) : $this->dataFactory(mssql_query($QRY)));

	}

	function dataFactory($Result)
	{
		$output = array();

		if($this->_DriverType == 'sqlsrv')
		{
			if($Result !== false)
			{
				while ($row = sqlsrv_fetch_array($Result, SQLSRV_FETCH_ASSOC)) {
					$output[] = $row;
				}
				
				sqlsrv_free_stmt($Result);
			}
		}
		else
		{
			while ($row = mssql_fetch_array($Result, MSSQL_ASSOC)) {
				$output[] = $row;
			}
			mssql_free_result($Result);

		}


		return $output;
	}
	function connect($Data)
	{

		$this->conn = sqlsrv_connect ($Data['DB_Server'], array(
			"Database" => $Data['DB_Name'],
			"UID" => $Data['DB_UserName'],
			"PWD" =>$Data['DB_Password']
		));
		if(!$this->conn)
		{
			die( print_r( sqlsrv_errors(), true));
			die();
		}
		//$selected = mssql_select_db($Data['DB_Name'], $this->conn);

	}
	public function escape()
	{

	}
}

?>
